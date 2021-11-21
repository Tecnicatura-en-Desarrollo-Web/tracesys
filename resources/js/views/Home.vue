<template>

    <!-- <h1>Bienvenido {{usuario}}</h1> -->

<ul>
    <div class="posts view large-10 medium-8 columns contenido-central">
        <div class="row">
            <div class="col col-lg-6">
                <div class="card2 p-0 shadow-sm p-3 mb-5 bg-body rounded">
                    <h3 class="card-title text-center">Informes derivados por mes</h3>
                    <p class="colorp" style="font-size:15px;">Se muestran los informes que derivó este mes y el mes anterior</p>
                    <div class="card-body table-full-width">
                        <div class="chart">
                            <apexcharts ref="metrica" width="400" type="bar" :options="chartOptions1" :series="series1"></apexcharts>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col col-lg-6">
                <div class="card2 p-0 shadow-sm p-3 mb-5 bg-body rounded">
                    <h3 class="card-title text-center">Cantidad de informes por sector</h3>
                    <p class="colorp" style="font-size:15px;">Se muestran la cantidad de informes presentes en cada sector</p>
                    <div class="card-body table-full-width">
                        <div class="chart">
                            <apexcharts  ref="metrica2" width="410" type="donut" :options="chartOptions2" :series="series"></apexcharts>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</ul>


</template>

<script>
import VueApexCharts from 'vue-apexcharts'

export default {
    components: {
        apexcharts: VueApexCharts
    },
    data() {
        return {
            usuario: "",
            cantInformesDerivado:[],
            empleado_id:null,
            chartOptions1: {
                chart: {
                id: 'vuechart-example',
                },
                xaxis: {
                    categories: [],
                },
            },
            series1: [{
                data: []
            }],

            chartOptions2 : {
                series: [],
                chart: {
                    type: "donut"
                },
                labels: [],
                responsive: [
                    {
                    breakpoint: 480,
                    options: {
                        chart: {
                        width: 200
                        },
                        legend: {
                        position: "bottom"
                        }
                    }
                    }
                ]
            }
        };
    },
    created() {

        if (this.$session.exists()) {
        this.usuario = this.nombreUsuario=this.$session.get("nombreDeUsuario");
        this.empleado_id=this.$session.get("user_id");

        } else {
        this.$router.push("/login");
        }

        this.obtenerCantInformesPorSector();
        this.obtenerCantInformesPorEmpleado(this.empleado_id);
    },
    mounted(){
    },
    methods:{
        obtenerCantInformesPorEmpleado(empleado_id){
            axios
                .get(`/api/informeempleadoestados/cantInformesPorEmpleado/${empleado_id}`,{
                    headers: { "X-Requested-With": "XMLHttpRequest" },
                    })
                    .then((response) => {
                        console.log(response);
                        this.series1 = [
                        {
                            data: [response.data.data.mesPasado,response.data.data.esteMes]
                        },
                        ];
                        this.chartOptions1 = {
                            xaxis: {
                                categories: response.data.options
                            }
                        };
                        this.$refs.metrica.updateSeries(this.series1, true);
                        this.$refs.metrica.updateOptions(this.chartOptions1, false ,true);

            })
        },
        obtenerCantInformesPorSector(){
            axios
                .get(`/api/informeempleadoestados/cantInformesPorSector`,{
                    headers: { "X-Requested-With": "XMLHttpRequest" },
                    })
                    .then((response) => {
                        console.log(response);

                        // this.series2 = {
                        //     series:response.data.data
                        // };
                        this.chartOptions2 = {
                            labels:response.data.labels,
                            series:response.data.data
                        };
                        // this.$refs.metrica.updateSeries(this.series2, true);
                        this.$refs.metrica2.updateOptions(this.chartOptions2, false ,true);

                        })

        }

    }
};
</script>
<style>
    .card2{
        margin-top:40px;
        margin-left: 40px;
        margin-right: 60px;
    }
    /* .table-full-width{
        margin-left: 20px;
        margin-right: 20px;
    } */
    .card-header{
        background-color: white;
    }
    .chart{
        margin-left: 40px;
    }


</style>
