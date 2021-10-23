<template>
  <div>
    <ul>
      <div class="posts view large-10 medium-8 columns">
        <h1>Listado de informes</h1>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Fecha</th>
              <th scope="col">Hora</th>
              <th scope="col">Producto</th>
              <th scope="col">Motivo</th>
              <th scope="col">Estado</th>
              <th scope="col">Ver</th>
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="report in reports"
              :v-bind="report.report.report_id"
              v-if="report.state_id == etapa_id"
            >
              <td>{{ report.report.report_id }}</td>
              <td>{{ report.report.created }}</td>
              <td>{{ report.report.created }}</td>
              <td>{{ report.report.product.tipo }}</td>
              <td>{{ report.report.product.motivo }}</td>
              <td>{{ report.state.nombre_estado }}</td>
              <td>
                <!-- <router-link :to="{ `/detalleInforme/${report.report_id}`}" idInforme='idInforme'>+</router-link -->
                <router-link
                  :to="{ path: `/detalleInforme/` + report.report.report_id }"
                  idInforme="idInforme"
                  >+</router-link
                >
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </ul>
  </div>
</template>
<script>
import DetalleInforme from "../Informes/DetalleInforme.vue";
export default {
  components: {
    DetalleInforme,
  },
  data() {
    return {
      reports: [],
      nombre_etapa: "",
      etapa_id: "",
    };
  },
  mounted() {
    this.$emit("nombreHijo", this.nombre);
    this.currentRoute = this.$router.currentRoute.name;

    this.getPosts(this.$route.query);
  },
  methods: {
    getPosts(query) {
      if (query.sort !== "undefined" && query.direction) {
        this.defaultClass[query.sort] = query.direction;
      }

      axios
        .get("api/informeempleadoestados", { params: query })
        .then((response) => {
          console.log(response.data);
          this.reports = response.data.reports;
          this.queryParams = response.data.query;
        })
        .catch((error) => {
          console.log("Error: " + error);
        });
    },
    //**Este metodo se ejecuta justo antes de cargar la vista , se cargan todos los datos pero todavia no se muestra la vista*/
    created() {
      if (!this.$session.exists()) {
        this.nombre_etapa = "asdasd";
        this.$router.push("/login");
        console.log("saaale", nombre_etapa);
      }
      if (this.$session.exists()) {
        this.nombre_etapa = this.$session.get("nombre_etapa");
        this.etapa_id = this.$session.get("etapa_id");
      }
    },
  },
};
</script>



