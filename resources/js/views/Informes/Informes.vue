<template>
  <div>
    <ul>
      <div class="posts view large-10 medium-8 columns contenido-central">
        <h1>Listado de informes</h1>
        <table class="table table-striped">
          <thead class="table-dark">
            <tr class="cabecera-table">
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
              <!-- report.employee.user.sector.stage.stage_id -->
            <tr
              v-for="report in reports" :v-bind="report.report.report_id" v-if="report.sector_id == empleado_sector_id"
            >
              <td>{{ report.report.report_id }}</td>
              <td>{{ report.report.created }}</td>
              <td>{{ report.report.created }}</td>
              <td>{{ report.report.product.tipo }}</td>
              <td>{{ report.report.product.motivo }}</td>
              <td>en {{ report.state.nombre_estado }}</td>
              <td>
                  <!-- idInforme="idInforme" -->
                <router-link
                  :to="{ path: `/detalleInforme/` + report.report.report_id }"
                  :idInforme="2"
                  ><button class="btn btn-outline-info btn-sm">
                    +
                  </button></router-link
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
        nombre_sector: "",
        empleado_sector_id: null,
        };
    },
    mounted() {
        this.$emit("nombreHijo", this.nombre);
        this.currentRoute = this.$router.currentRoute.name;
        // this.envioEmail(this.$route.query);

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
                    this.reports = response.data.reports;
                    console.log("lee aca maxiiii",this.reports);
                    this.queryParams = response.data.query;
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
    },
    created() {
        if (!this.$session.exists()) {
            this.nombre_sector = "asdasd";
            this.$router.push("/login");
            console.log("saaale", nombre_sector);
        }
        if (this.$session.exists()) {
            this.nombre_sector = this.$session.get("nombre_sector");
            this.empleado_stage_id = this.$session.get("etapa_id");
            this.empleado_sector_id = this.$session.get("sector_id");
        }
    },
};
</script>



