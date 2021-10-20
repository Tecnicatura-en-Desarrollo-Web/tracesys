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
              <th scope="col">Motivo</th>
              <th scope="col">Estado</th>
              <th scope="col">Ver</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="report in reports">
              <td>{{ report.id }}</td>
              <td>{{ report.fecha }}</td>
              <td>{{ report.hora }}</td>
              <td>{{ report.motivo }}</td>
              <td>{{ report.estado }}</td>
              <td>
                <router-link to="/detalleInforme" :numero="report.id"
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
      id: 0,
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
        .get("api/reports", { params: query })
        .then((response) => {
          console.log(response.data.reports);
          this.reports = response.data.reports;
          this.queryParams = response.data.query;
        })
        .catch((error) => {
          console.log("Error: " + error);
        });
    },
    capturarId(id) {
      this.id = id;
    },
  },
  //**Este metodo se ejecuta justo antes de cargar la vista , se cargan todos los datos pero todavia no se muestra la vista*/
  created() {
    if (!this.$session.exists()) {
      this.$router.push("/login");
    }
  },
};
</script>



