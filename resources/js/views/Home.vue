<template>
  <!-- <h1>Bienvenido {{usuario}}</h1> -->

        <!-- <div
        class="posts view large-10 medium-8 columns contenido-central"
        v-if="repuestos.length != 0"
        >
        <div class="card2 p-0 shadow-sm p-3 mb-5 bg-body rounded">
            <h3 class="card-title">Repuestos con bajo stock</h3>
            <div class="card-body table-full-width">
            <table class="table table-striped p-4">
                <thead>
                <tr class="">
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Cantidad</th>
                </tr>
                </thead>

                <tbody>
                <tr class="table-danger" v-for="repuesto in repuestos">
                    <td>{{ repuesto.replacement_id }}</td>
                    <td>{{ repuesto.descripcion }}</td>
                    <td>{{ repuesto.cantidad }}</td>
                </tr>
                </tbody>
            </table>
            </div>
        </div>
        </div>
    <div> -->
      <ul>
        <div class="posts view large-10 medium-8 columns contenido-central">
            <div class="row">
                <div class="col">
                    <div class="card2 p-0 shadow-sm p-3 mb-1 bg-body rounded">
            <h3 class="card-title">Repuestos con bajo stock</h3>
            <div class="card-body table-full-width">
            <table class="table table-striped p-4">
                <thead>
                <tr class="">
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Cantidad</th>
                </tr>
                </thead>

                <tbody>
                <tr class="table-danger" v-for="repuesto in repuestos">
                    <td>{{ repuesto.replacement_id }}</td>
                    <td>{{ repuesto.descripcion }}</td>
                    <td>{{ repuesto.cantidad }}</td>
                </tr>
                </tbody>
            </table>
            </div>
        </div>
                </div>
            </div>
          <div class="row">
            <div class="col col-lg-6">
              <div class="card2 p-0 shadow-sm p-3 mb-5 bg-body rounded">
                <h3 class="card-title text-center">
                  Informes derivados por mes
                </h3>
                <p class="colorp" style="font-size: 15px">
                  Se muestran los informes que derivó este mes y el mes anterior
                </p>
                <div class="card-body table-full-width">
                  <div class="chart">
                    <apexcharts
                      ref="metrica"
                      width="400"
                      type="bar"
                      :options="chartOptions"
                      :series="series"
                    ></apexcharts>
                  </div>
                </div>
              </div>
            </div>
            <informesPorSector ref="informesPorSector"> </informesPorSector>
          </div>
        </div>
      </ul>

</template>

<script>
import VueApexCharts from "vue-apexcharts";
import informesPorSector from "../views/Metricas/informesPorSector.vue";

export default {
  components: {
    apexcharts: VueApexCharts,
    informesPorSector: informesPorSector,
  },
  data() {
    return {
      usuario: "",
      cantInformesDerivado: [],
      empleado_id: null,
      chartOptions: {
        chart: {
          id: "vuechart-example",
        },
        xaxis: {
          categories: [],
        },
      },
      series: [
        {
          data: [],
        },
      ],
      repuestos: [],
    };
  },
  created() {
    if (this.$session.exists()) {
      this.usuario = this.nombreUsuario = this.$session.get("nombreDeUsuario");
      this.empleado_id = this.$session.get("user_id");
    } else {
      this.$router.push("/login");
    }

    // this.obtenerCantInformesPorSector();
    this.obtenerCantInformesPorEmpleado(this.empleado_id);
    this.obtenerRepuestosFaltantes();
  },
  mounted() {},
  methods: {
    obtenerCantInformesPorEmpleado(empleado_id) {
      axios
        .get(
          `/api/informeempleadoestados/cantInformesPorEmpleado/${empleado_id}`,
          {
            headers: { "X-Requested-With": "XMLHttpRequest" },
          }
        )
        .then((response) => {
          console.log(response);
          this.series = [
            {
              data: [response.data.data.mesPasado, response.data.data.esteMes],
            },
          ];
          this.chartOptions = {
            xaxis: {
              categories: response.data.options,
            },
          };
          this.$refs.metrica.updateSeries(this.series, true);
          this.$refs.metrica.updateOptions(this.chartOptions, false, true);
        });
    },
    obtenerRepuestosFaltantes() {
      axios
        .get(`/api/replacements/obtenerRepuestosStockBajo`)
        .then((response) => {
          console.log("aca salen los repuestos", response);
          this.repuestos = response.data;
        });
    },
  },
};
</script>
<style>
.card2 {
  margin-top: 40px;
  margin-left: 40px;
  margin-right: 60px;
}
/* .table-full-width{
        margin-left: 20px;
        margin-right: 20px;
    } */
.card-header {
  background-color: white;
}
.chart {
  margin-left: 40px;
}
</style>
