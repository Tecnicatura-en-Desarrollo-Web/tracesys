<template>
    <div
        class="
        posts
        view
        large-10
        medium-8
        columns
        contenido-central-detalleInforme
        "
    >
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Fecha y hora</th>
          <th scope="col">Derivado Por</th>
          <th scope="col">Tipo</th>
          <th scope="col">Modelo</th>
          <th scope="col">Estado</th>
          <th scope="col">Motivo</th>

          <th scope="col">Comentarios</th>
        </tr>
      </thead>
      <tbody>

        <tr v-for="report in reports.cambiosEstadoInforme">
          <td>{{ report.created }}</td>
          <td>
            {{ report.employee.user.nombre }}
            {{ report.employee.user.apellido }}
          </td>
          <td>{{ report.report.product.tipo }}</td>
          <td>{{ report.report.product.modelo }}</td>
          <td>{{ report.state.nombre_estado }}</td>
          <td>{{ report.report.product.motivo }}</td>
          <td>{{ report.comentarioEmpleado.commentsemployee.descripcion }}</td>
        </tr>
      </tbody>

    </table>

    <form @submit.prevent="onSubmit" novalidate="novalidate">
        <div class="row">
            <div class="col col-lg-6">
                    <h5 class="text-center">Derivar a:</h5>
                    <div class="row"><div class="col"></div></div>
                <select
                    v-model="primerSelect"
                    class="custom-select text-center"
                    id="inputGroupSelect01"
                    name="selectSector"
                    placeholder="holkaaa"
                >
                    <option value="0">Selecciona un sector...</option>
                    <option
                    v-for="sectorADerivar in sectoresADerivar"
                    :key="sectorADerivar.sector_id"
                    v-bind:value="sectorADerivar.sector_id"
                    >
                    <text>{{ sectorADerivar.nombre_sector }}</text>
                    </option>
                </select>
            </div>
            <div class="col col-lg-6">
                <!--****************Aca hago los llamados a los componentes hijos para mostrar la informacion correspondiente****************-->
                <sugerencias :arraysugerencias="sugerencias"
                :primerSelect="primerSelect" :idInforme="idInforme"
                ref="sugerencias"></sugerencias>
                <!--************************************************************-->
            </div>
        </div>
      <div class="row align-items-center mt-2">
        <div class="col col-lg-2">
          <h5>Comentarios:</h5>
        </div>
        <div class="col col-lg-10">
          <div class="form-group">
            <textarea
              class="form-control"
              id="exampleFormControlTextarea1"
              name="comentarios"
              rows="3"
            ></textarea>
          </div>
        </div>
        </div>
        <div class="row mt-4 d-flex justify-content-center">
            <div class="col col-lg-2">
            <button class="boton-classic" type="submit" >Derivar
            </button>
            </div>
        </div>
    </form>
  </div>
</template>

<script>

import formSerialize from "form-serialize";
import sugerenciasAplicadasReparacion from "../Informes/SugerenciasAplicadasReparacion.vue";
import sugerencias from "../Informes/Sugerencias.vue";

export default {
    components: {
    sugerencias: sugerencias
    },
    data() {
        return {
        i: 0,
        idInforme: null,
        idEmpleado: null,
        cuitEmpleado: null,
        usuarioADerivarSeleccionado: "",
        sectoresADerivar: [],
        sugerencias: [],
        idIssuesSelect: null,
        comentarioEmpleado: "",
        reports: [],
        value: '',
        primerSelect:0,
        segundoSelect:0,
        sugerenciasSeleccionadas:[],
        sugerenciasAplicadas:[],
        };
    },
    created() {
        this.idInforme = this.$route.params.id;
        if (!this.$session.exists()) {
        this.$router.push("/login");
        }
    },
    mounted() {
        this.verInforme(this.$route.query);
        this.obtenerSugerencias(this.$route.query);

        this.obtenerSectores();
    },
    methods: {
        verInforme(query) {
        axios
            .get(
            `/api/informeempleadoestados/informesCambiosEstados/${this.idInforme}`,
            { params: query }
            )
            .then((response) => {
                //ver mas adelante mejorar la estructura del arreglo devuelto
                this.reports = response.data;
                console.log("aca lee jonaaaaa", this.reports);
                //obtengo el ultimo informeEmpleadoEstado , para saber el ultimo empleado que derivo
                let ultimoInformeEmpleadoEstado = this.reports.cambiosEstadoInforme[this.reports.cambiosEstadoInforme.length - 1];
                this.idEmpleado = ultimoInformeEmpleadoEstado.employee_id;
                //this.idEmpleado = this.$session.get("user_id");
                this.cuitEmpleado =this.$session.get("cuit");
            })
            .catch((error) => {
            console.log("Error: " + error);
            });
        },
        obtenerSugerencias(query) {
        axios
            .get(`/api/problemasugerencias/issuesByReport/${this.idInforme}`, {
            params: query,
            })
            .then((response) => {
            if (response.data.suggestions[0] != null) {
                console.log("entro jonaaaaaaaa");
                this.sugerencias = response.data.suggestions;
                this.idIssuesSelect =
                response.data.suggestions[0].problemasugerencia_id;
            }
            })
            .catch((error) => {
            console.log("Error: " + error);
            });
        },
        obtenerSectores() {
        axios
            .get(
            `/api/sectors/obtenerSectoresPorEtapa/${this.$session.get(
                "etapa_id"
            )}`
            )
            .then((response) => {
            this.sectoresADerivar = response.data.sectors;
            console.log("sectores", response.data.sectors);
            })
            .catch((error) => {
            console.log("Error: " + error);
            });
        },
        onSubmit(event) {
            let data = formSerialize(event.target, {
                hash: false,
                empty: true,
            });
            data += "&idIssueReport=" + this.idIssuesSelect;
            data += "&idInforme=" + this.idInforme;
            data += "&idEmpleado=" + this.idEmpleado;
            data += "&cuitEmpleado=" + this.cuitEmpleado;
            data += "&idEstado=" + this.$session.get("etapa_id");
            data += "&idSector=" + this.$session.get("sector_id");
            data += "&sugerenciasSeleccionadas=" + this.sugerenciasSeleccionadas;
            data += "&sugerenciasAplicadas=" + this.sugerenciasAplicadas;
            this.actualizarCambioEstadoAnterior(data);
            data += "&idEmpleado="+this.$session.get("user_id");
            // data["idEmpleado"]=this.$session.get("user_id");
            this.registrarCambioEstado(data);
            this.registrarComentario(data);
            if(this.$session.get("etapa_id")==3){
                this.$refs.sugerencias.registrarSugerenciasAplicadas(data);
            }else{
                this.$refs.sugerencias.registrarSugerencia(data);
            }
        },
        actualizarCambioEstadoAnterior(data) {

            axios
            .post(`/api/informeempleadoestados/editInformeempleadoestados`, data, {
            headers: { "X-Requested-With": "XMLHttpRequest" },
            })
            .then((response) => {
            // Redirect on success
            console.log(response);
            if (response.data.success) {
                this.$notify({
                group: "default",
                type: "success",
                text: response.data.message,
                });
                //this.$router.push("/reports");
            }
            })
            .catch((error) => {
            this.$notify({
                group: "default",
                type: "error",
                text: error.response.data.message,
            });
            this.errors.add(error.response.data.errors);
            });
        },
        registrarCambioEstado(data) {
        axios
            .post(`/api/informeempleadoestados/save`, data, {
            headers: { "X-Requested-With": "XMLHttpRequest" },
            })
            .then((response) => {
            // Redirect on success
            console.log(response);
            if (response.data.success) {
                this.$notify({
                group: "default",
                type: "success",
                text: response.data.message,
                });

                this.$router.push("/reports");
            }
            })
            .catch((error) => {
            this.$notify({
                group: "default",
                type: "error",
                text: error.response.data.message,
            });
            this.errors.add(error.response.data.errors);
            });
        },
        registrarComentario(data) {
        //****Guardo el comentario en la tabla empleadoscomentarios */
        axios
            .post(`/api/commentsemployees/save`, data, {
            headers: { "X-Requested-With": "XMLHttpRequest" },
            })
            .then((response) => {
            //****una vez guardado el comentario ahora guardo la relacion del comentario del empleado con el informe*/
            //console.log(response);
            this.comentarioEmpleado = response.data.comentario;
            if (response.data.success) {
                data +=
                "&idComentarioEmpleado=" + response.data.idComentarioEmpleado;

                axios
                .post(`/api/informeempleadocomentarios/save`, data, {
                    headers: { "X-Requested-With": "XMLHttpRequest" },
                })
                .then((response) => {
                })
                .catch((error) => {
                    this.$notify({
                    group: "default",
                    type: "error",
                    text: error.response.data.message,
                    });

                    this.errors.add(error.response.data.errors);
                });
            }
            })
            .catch((error) => {
            this.$notify({
                group: "default",
                type: "error",
                text: error.response.data.message,
            });

            this.errors.add(error.response.data.errors);
            });
        },
  },
};
</script>

