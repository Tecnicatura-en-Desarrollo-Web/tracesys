<template>
  <div>
    <ul>
      <div class="posts view large-10 medium-8 columns contenido-central">
        <!-- <h1>Listado de informes</h1> -->
        <div class="card2 p-0 shadow-sm p-3 mb-5 bg-body rounded">
          <h3 class="card-title">Listado de informes</h3>
          <p class="colorp" style="font-size: 15px">
            Se muestra el listado de informes correspondientes a su sector
          </p>

          <div class="card-body table-full-width">
            <div class="row px-4">
              <div class="col col-lg-3">
                <input
                  type="text"
                  class="botonFiltro"
                  name="filtroFecha"
                  v-model="filtroPorFecha"
                  placeholder="Filtrar por fecha"
                />
              </div>
              <div class="col col-lg-3">
                <input
                  type="text"
                  class="botonFiltro"
                  name="filtroProducto"
                  v-model="filtroPorProducto"
                  placeholder="Filtrar por producto"
                />
              </div>
              <div class="col col-lg-3">
                <input
                  type="text"
                  class="botonFiltro"
                  name="filtroMotivo"
                  v-model="filtroPorMotivo"
                  placeholder="Filtrar por motivo de reparacion"
                />
              </div>
            </div>

            <table class="table-striped p-4">
              <thead>
                <tr class="">
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
                  v-if="
                    (report.sector_id == empleado_sector_id ||
                      empleado_sector_id == 1) &&
                    report.ultimoEstado == 1 &&
                    report.report.product.motivo
                      .toLowerCase()
                      .includes(filtroPorMotivo.toLowerCase()) &&
                    report.fecha
                      .toLowerCase()
                      .includes(filtroPorFecha.toLowerCase()) &&
                    report.report.product.tipo
                      .toLowerCase()
                      .includes(filtroPorProducto.toLowerCase())
                  "
                >
                  <td>{{ report.report.report_id }}</td>

                  <td>{{ report.fecha }}</td>
                  <td>{{ report.hora }}</td>
                  <td>{{ report.report.product.tipo }}</td>
                  <td>{{ report.report.product.motivo }}</td>
                  <td>en {{ report.state.nombre_estado }}</td>
                  <td>
                    <router-link
                      :to="{
                        path: `/detalleInforme/` + report.report.report_id,
                      }"
                      :idInforme="2"
                    >
                      <b-icon-plus-circle-fill
                        class="iconoVerMas"
                        style="width: 20px; height: 20px"
                      >
                      </b-icon-plus-circle-fill>
                    </router-link>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <historialInformesDerivados
          :reports="reportsDerivadosEmpleado"
          ref="historialInformesDerivados"
        >
        </historialInformesDerivados>
      </div>
    </ul>
  </div>
</template>
<script>
import DetalleInforme from "../Informes/DetalleInforme.vue";
import historialInformesDerivados from "../Informes/HistorialInformesDerivados.vue";
import VueApexCharts from "vue-apexcharts";
export default {
  components: {
    DetalleInforme,
    historialInformesDerivados: historialInformesDerivados,
  },
  data() {
    return {
      reports: [],
      nombre_sector: "",
      empleado_sector_id: null,
      empleado_id: null,
      //para historial derivados
      reportsDerivadosEmpleado: [],
      //para filtrar busquedas
      filtroPorProducto: "",
      filtroPorFecha: "",
      filtroPorMotivo: "",
      //Para metricas
      chartOptions: {
        chart: {
          id: "vuechart-example",
        },
        xaxis: {
          categories: [1991, 1992],
        },
      },
      series: [
        {
          name: "series-1",
          data: [30, 40],
        },
      ],
    };
  },
  mounted() {
    // this.probandoApi();
    this.$emit("nombreHijo", this.nombre);
    this.currentRoute = this.$router.currentRoute.name;
    // this.envioEmail(this.$route.query);

    this.getPosts(this.$route.query);
    this.obtenerInformesDerivados();
  },
  methods: {
    // probandoApi(){
    //     axios
    //         .get(`http://sesat.fdi.ucm.es:8080/servicios/rest/sinonimos/json/mainboard`, {
    //         headers: { "X-Requested-With": "XMLHttpRequest" },
    //         })
    //         .then((response) => {
    //             console.log("respuestaApi",response);
    //         })
    //         // .catch((error) => {
    //         // console.log("Error: " + error);
    //         // });
    // },

    getPosts(query) {
      if (query.sort !== "undefined" && query.direction) {
        this.defaultClass[query.sort] = query.direction;
      }

      axios
        .get("api/informeempleadoestados", { params: query })
        .then((response) => {
          this.reports = response.data.reports;
          this.queryParams = response.data.query;
        })
        .catch((error) => {
          console.log("Error: " + error);
        });
    },
    obtenerInformesDerivados() {
      axios
        .get(
          `api/informeempleadoestados/obtenerInformesDerivados/${this.empleado_id}`
        )
        .then((response) => {
          this.reportsDerivadosEmpleado = response.data;
        });
    },
  },
  created() {
    if (!this.$session.exists()) {
      this.nombre_sector = "asdasd";
      this.$router.push("/login");
    }
    if (this.$session.exists()) {
      this.nombre_sector = this.$session.get("nombre_sector");
      this.empleado_stage_id = this.$session.get("etapa_id");
      this.empleado_sector_id = this.$session.get("sector_id");
      this.empleado_id = this.$session.get("user_id");
    }
  },
};
</script>
<style>
.card2 {
  margin-top: 40px;
  margin-left: 40px;
  margin-right: 60px;
}
.table-full-width {
  margin-left: -32px;
  margin-right: -32px;
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
  margin-top: 2px;
}
.iconoVerMas :hover {
  opacity: 1;
  color: #198754;
}

.slide-fade-enter-active {
  transition: all 0.5s ease;
}
.slide-fade-leave-active {
  transition: all 0.3s cubic-bezier(1, 0.5, 0.8, 1);
}
.slide-fade-enter, .slide-fade-leave-to
        /* .slide-fade-leave-active below version 2.1.8 */ {
  transform: translateX(10px);
  opacity: 0;
}
.botonFiltro:hover {
  border-color: #bdbdbd;
  box-shadow: none;
}
.botonFiltro:focus {
  outline: none !important;
  box-shadow: 0 0 2px #3b697885;
}
</style>



