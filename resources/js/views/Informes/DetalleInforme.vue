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
      <div class="row align-items-center">
        <div class="col col-lg-2">
          <h5>Derivar a:</h5>
        </div>
        <div class="col col-lg-10">
          <select
            class="custom-select"
            id="inputGroupSelect01"
            name="selectSector"
          >
            <option selected>Elija Sector...</option>
            <option
              v-for="sectorADerivar in sectoresADerivar"
              v-if="sectorADerivar.stage_id != 1"
              :key="sectorADerivar.stage_id"
              v-bind:value="sectorADerivar.stage_id"
            >
              <text>{{ sectorADerivar.nombre_etapa }}</text>
            </option>
          </select>
        </div>
      </div>
      <div class="row align-items-center mt-2">
        <div class="col col-lg-2">
          <h5>Sugerencias:</h5>
        </div>
        <div class="col col-lg-10">
          <!-- **********PROBANDO NUEVOS SELECTS **S*************** -->

          <!-- <input v-for="sugerencia in sugerencias" v-bind:value="sugerencia.suggestion.nombre_sugerencia" /> -->

          <!-- <multiselect v-model="value" :options="options" :searchable="false" :close-on-select="true" :show-labels="true" placeholder="Seleccione una sugerencia">
                <template slot="singleLabel" slot-scope="{ option }"><strong>{{ option.name }}</strong> is written in<strong>  {{ option.language }}</strong></template>
            </multiselect>
            {{value}} -->
          <!-- <pre class="language-json"><code>{{ value  }}</code></pre> -->

          <!-- **********PROBANDO NUEVOS SELECTS ***************** -->
          <select
            class="custom-select"
            id="inputGroupSelect01"
            name="selectSugerencia"
          >
            <option selected>Asigne sugerencia...</option>
            <option
              v-for="sugerencia in sugerencias"
              :key="sugerencia.suggestion.suggestion_id"
              v-bind:value="sugerencia.suggestion.suggestion_id"
            >
              {{ sugerencia.suggestion.nombre_sugerencia }}
            </option>
          </select>
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
          <button class="boton-classic" type="submit">Derivar</button>
        </div>
      </div>
    </form>
  </div>
</template>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>

<script>
import formSerialize from "form-serialize";
// import Errors from "../../helpers/FormErrors.js";
// import {mapState,mapMutations} from "vuex";
export default {
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
      options: "",
    };
  },
  created() {
    if (!this.$session.exists()) {
      this.$router.push("/login");
    }
  },
  mounted() {
    this.idInforme = this.$route.params.id;
    this.verInforme(this.$route.query);
    this.obtenerSugerencias(this.$route.query);
    this.obtenerEtapas(this.$route.query);
  },
  methods: {
    //...mapMutations(['actualizarIdComentario']),
    verInforme(query) {
      axios
        .get(
          `/api/informeempleadoestados/informesCambiosEstados/${this.idInforme}`,
          { params: query }
        )
        .then((response) => {
          //ver mas adelante mejorar la estructura del arreglo devuelto
          console.log("aca lee jonaaaaa", response.data);
          this.reports = response.data;
          //console.log("aca lee jonaaaaa222",this.reports);
          this.idEmpleado =
            this.reports.cambiosEstadoInforme[0].employee.employee_id;
          this.cuitEmpleado =
            this.reports.cambiosEstadoInforme[0].employee.cuit;

          //console.log("aca trae", response.data.cambiosEstadoInforme);
          // console.log(this.report);
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
            //console.log("aca lee jonaaaaaaaaa", response.data.suggestions);
            this.idIssuesSelect =
              response.data.suggestions[0].problemasugerencia_id;
            /* console.log(response.data.suggestions); */
            //this.sugerencias = response.data.suggestions;
          }
        })
        .catch((error) => {
          console.log("Error: " + error);
        });
    },
    obtenerEtapas(query) {
      axios
        .get("/api/stages", { params: query })
        .then((response) => {
          /* console.log(response.data.sectors); */
          this.sectoresADerivar = response.data.stages;
          //this.usersDerivar = response.data.users;
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
      this.actualizarCambioEstadoAnterior(data);
      this.registrarCambioEstado(data);
      this.registrarComentario(data);
      this.registrarSugerencia(data);
    },
    actualizarCambioEstadoAnterior(data) {
      axios
        .post(`/api/informeempleadoestados/editInformeempleadoestados`, data, {
          headers: { "X-Requested-With": "XMLHttpRequest" },
        })
        .then((response) => {
          // Redirect on success
          //console.log(response);
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
          //console.log(this.comentarioEmpleado);
          if (response.data.success) {
            data +=
              "&idComentarioEmpleado=" + response.data.idComentarioEmpleado;
            //this.actualizarIdComentario(response.data.idComentarioEmpleado);
            //this.registrarComentario2(data);
            axios
              .post(`/api/informeempleadocomentarios/save`, data, {
                headers: { "X-Requested-With": "XMLHttpRequest" },
              })
              .then((response) => {
                //console.log(response);
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
    registrarSugerencia(data) {
      axios
        .post(`/api/problemasugerencias/edit`, data, {
          headers: { "X-Requested-With": "XMLHttpRequest" },
        })
        .then((response) => {
          this.$router.push("/reports");
          console.log(response);
          if (response.data.success) {
          }
        });
    },
  },
};
</script>

