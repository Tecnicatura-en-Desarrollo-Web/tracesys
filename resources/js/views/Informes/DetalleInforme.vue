
<template>
  <ul>
    <div
      class="posts view large-10 medium-8 columns contenido-central"
      v-if="
        ultimoInformeEmpleadoEstado.sector_id == empleadoSector ||
        empleadoSector == 1
      "
    >
      <!-- *********************Spinner de loading****************************** -->
      <loader
        v-if="mostrarSpinner == true"
        object="#6D9886"
        size="6"
        speed="2"
        bg="#343a40"
        objectbg="#999793"
        opacity="36"
        disableScrolling="false"
        name="spinning"
      ></loader>
      <!-- ********************************************************************* -->

      <!-- style="width: 73.7rem;" -->
      <div class="card2 p-0 shadow-sm p-3 mb-1 bg-body rounded">
        <h3 class="card-title">Historial de estados</h3>
        <p class="colorp" style="font-size: 15px">
          Se muestra el historial de estados por los que paso el informe
        </p>

        <div class="card-body table-full-width">
          <table class="table-striped p-4">
            <thead>
              <tr>
                <th scope="col">Fecha</th>
                <th scope="col">Hora</th>
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
                <td>{{ report.fecha }}</td>
                <td>{{ report.hora }}</td>
                <td>
                  {{ report.employee.user.nombre }}
                  {{ report.employee.user.apellido }}
                </td>
                <td>{{ report.report.product.tipo }}</td>
                <td>{{ report.report.product.modelo }}</td>
                <td>{{ report.state.nombre_estado }}</td>
                <td>{{ report.report.product.motivo }}</td>
                <td>
                  {{ report.comentarioEmpleado.commentsemployee.descripcion }}
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="card2 px-3 mt-2 rounded" v-if="
        ultimoInformeEmpleadoEstado.sector.stage_id == 3 && ultimoInformeEmpleadoEstado.state_id==6">
        <div class="card-body table-full-width">
            <div
                  class="
                    bg-body
                    p-3
                    rounded
                    border border-1
                    text-center
                  "
                >
            <p>Este informe está a la espera de aprobación del presupuesto por parte del cliente!!</p>
            <hr>
            <p>Una vez aprobado el presupuesto podrá continuar con el trámite</p>
            </div>
        </div>
      </div>
      <div v-else class="card2 px-3 mt-2 rounded">
        <div class="card-body table-full-width">
          <form @submit.prevent="onSubmit">
            <div class="row">
              <div class="col">
                <!--****************Aca hago los llamados a los componentes hijos para mostrar la informacion correspondiente****************-->
                <sugerencias
                  :arraysugerencias="sugerencias"
                  :primerSelect="primerSelect.sector_id"
                  :idInforme="idInforme"
                  ref="sugerencias"
                ></sugerencias>
                <!--************************************************************-->
              </div>
              <div class="col">
                <!-- <div class="card table-full-width">
                                        <div class="card-body border-1"> -->
                <div
                  class="
                    bg-body
                    p-3
                    rounded
                    border border-1
                    sugerencias-full-width
                  "
                >
                  <h5 class="text-center">Derivar a:</h5>
                  <p class="colorp" style="font-size: 15px">
                    Seleccione el sector a derivar el informe
                  </p>
                  <!-- <select
                                                    v-model="primerSelect"
                                                    class="form-select text-center "
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
                                                    {{ sectorADerivar.nombre_sector }}
                                                    </option>
                                                </select> -->
                  <div>
                    <multiselect
                      name="selectSector"
                      :options="sectoresADerivar"
                      label="nombre_sector"
                      v-model="primerSelect"
                      :searchable="false"
                      open-direction="bottom"
                      :close-on-select="true"
                      :show-labels="false"
                      :block-keys="['Tab', 'Enter']"
                      :hide-selected="true"
                      deselect-label="Can't remove this value"
                    >
                    </multiselect>
                  </div>
                </div>
                <!-- </div>
                                    </div> -->
              </div>
            </div>
            <div class="row">
              <div class="col col-lg-12">
                <div class="card3 py-3 mb-1 rounded">
                  <h5 class="text-start">Comentarios:</h5>

                  <div class="card-body">
                    <div class="form-group comentarios-full-width">
                      <textarea
                        class="form-control"
                        id="exampleFormControlTextarea1"
                        name="comentarios"
                        rows="3"
                        required
                      ></textarea>
                    </div>
                    <div class="mt-2 text-center">
                      <button class="boton-classic" type="submit">
                        Derivar
                      </button>
                      <a
                        v-bind:href="`https://api.whatsapp.com/send?phone=${telefonoCliente}&text=%C2%A1Hola%20${nombreCliente}!%20Somos%20de%20TraceSYS,%20quienes%20tenemos%20a%20cargo%20la%20reparacion%20de%20tu%20producto,%20queremos%20comunicarnos%20contigo.`"
                        target="_blank"
                      >
                        <button class="boton-redondo">
                          <icon name="whatsapp" width="40px" height="40px" />
                        </button>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </ul>
</template>

<script>
import formSerialize from "form-serialize";
import sugerenciasAplicadasReparacion from "../Informes/SugerenciasAplicadasReparacion.vue";
import sugerencias from "../Informes/Sugerencias.vue";
import Multiselect from "vue-multiselect";

export default {
  components: {
    sugerencias: sugerencias,
    Multiselect,
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
      value: "",
      primerSelect: 0,
      segundoSelect: 0,
      sugerenciasSeleccionadas: [],
      sugerenciasAplicadas: [],
      ultimoInformeEmpleadoEstado: {
        sector_id: null,
      },
      empleadoSector: null,
      empleadoEtapa:null,
      // para el spinner de loading
      mostrarSpinner: false,
      telefonoCliente: 0,
      nombreCliente: "",
    };
  },
  created() {
    this.idInforme = this.$route.params.id;
    if (!this.$session.exists()) {
      this.$router.push("/login");
    }
    this.empleadoSector = this.$session.get("sector_id");
    this.empleadoEtapa = this.$session.get("etapa_id");
  },
  mounted() {
    this.verInforme(this.$route.query);
    this.obtenerSugerencias(this.$route.query);
    this.obtenerSectores();
    this.obtenerCliente(this.$route.query);
  },
  methods: {
    activarSpinner() {
      this.mostrarSpinner = true;
    },
    obtenerCliente(query) {
      axios
        .get(`/api/reports/obtenerCliente/${this.idInforme}`, { params: query })
        .then((response) => {
          this.telefonoCliente = response.data.client.telefono;
          this.nombreCliente = response.data.client.denominacion;
        });
    },
    verInforme(query) {
      axios
        .get(
          `/api/informeempleadoestados/informesCambiosEstados/${this.idInforme}`,
          { params: query }
        )
        .then((response) => {
          //ver mas adelante mejorar la estructura del arreglo devuelto
          this.reports = response.data;
          //obtengo el ultimo informeEmpleadoEstado , para saber el ultimo empleado que derivo
          this.ultimoInformeEmpleadoEstado =
            this.reports.cambiosEstadoInforme[
              this.reports.cambiosEstadoInforme.length - 1
            ];
          //*********Muestro cartel de "no tienes permisos para este informe*********"
          if (
            this.ultimoInformeEmpleadoEstado.sector_id != this.empleadoSector &&
            this.empleadoSector != 1
          ) {
            this.$swal({
              title: "No tienes acceso a este informe",
              type: "error",
            }).then(function () {
              window.location = "http://localhost:8765/reports";
            });
          }
          //***************************************************** */
          this.idEmpleado = this.ultimoInformeEmpleadoEstado.employee_id;
          this.cuitEmpleado = this.$session.get("cuit");
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
      data += "&selectSector=" + this.primerSelect.sector_id;
      data += "&idIssueReport=" + this.idIssuesSelect;
      data += "&idInforme=" + this.idInforme;
      data += "&idEmpleado=" + this.idEmpleado;
      data += "&cuitEmpleado=" + this.cuitEmpleado;
      data += "&idEstado=" + this.$session.get("etapa_id");
      data += "&idSector=" + this.$session.get("sector_id");
      data += "&sugerenciasSeleccionadas=" + this.sugerenciasSeleccionadas;
      data += "&sugerenciasAplicadas=" + this.sugerenciasAplicadas;
      this.activarSpinner();
      this.actualizarCambioEstadoAnterior(data);
      data += "&idEmpleado=" + this.$session.get("user_id");
      // data["idEmpleado"]=this.$session.get("user_id");
      this.registrarCambioEstado(data);
      this.registrarComentario(data);
      switch (this.$session.get("etapa_id")) {
            case 3:
                this.$refs.sugerencias.registrarSugerenciasAplicadas(data);
                break;
            case 2:
                this.$refs.sugerencias.enviarPresupuesto(data);
                this.$refs.sugerencias.registrarSugerencia(data);
                break;
            case 4:
                if(this.primerSelect.stage_id==5){
                    this.$refs.sugerencias.subirValoracionSugerencias(data);
                    this.$refs.sugerencias.enviarFacturaFinal(data);
                }
                break;

      }
    //   if (this.$session.get("etapa_id") == 3) {
    //     this.$refs.sugerencias.registrarSugerenciasAplicadas(data);
    //   } else {
    //     if (this.$session.get("etapa_id") == 2) {
    //         this.$refs.sugerencias.enviarPresupuesto(data);
    //         this.$refs.sugerencias.registrarSugerencia(data);
    //     } else {
    //         if(this.$session.get("etapa_id") == 4){

    //         }else{
    //             this.$refs.sugerencias.subirValoracionSugerencias(data);
    //         }
    //     }
    //   }
    },

    actualizarCambioEstadoAnterior(data) {
      axios
        .post(`/api/informeempleadoestados/editInformeempleadoestados`, data, {
          headers: { "X-Requested-With": "XMLHttpRequest" },
        })
        .then((response) => {
          // Redirect on success
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
          if (response.data.success) {
            this.$notify({
              group: "default",
              type: "success",
              text: response.data.message,
            });

                window.location = "http://localhost:8765/reports";
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
          this.comentarioEmpleado = response.data.comentario;
          if (response.data.success) {
            data +=
              "&idComentarioEmpleado=" + response.data.idComentarioEmpleado;

            axios
              .post(`/api/informeempleadocomentarios/save`, data, {
                headers: { "X-Requested-With": "XMLHttpRequest" },
              })
              .then((response) => {})
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
<style>
.card2 {
  /* margin-top:40px;
        margin-left: 40px;*/
  /* margin-right: 20px; */
}
.card3 {
  margin-right: -24px;
}
.table-full-width {
  margin-left: -32px;
  margin-right: -32px;
}
.sugerencias-full-width {
  margin-right: -24px;
}
.comentarios-full-width {
  margin-left: -16px;
  margin-right: -16px;
}
.card-header {
  background-color: white;
}
.colorp {
  color: rgb(90, 90, 90);
}
.iconoVerMas {
  opacity: 0.6;
  color: #303030;
  margin-top: 6px;
}
.iconoVerMas :hover {
  opacity: 1;
  color: #198754;
}
.selectSector :hover {
  background-color: chocolate;
}
</style>

