<template>
    <div class="col col-lg-6">
        <div class="card2 p-0 shadow-sm p-3 mb-5 bg-body rounded">
            <h3 class="card-title text-center">Cantidad de informes por sector</h3>
            <p class="colorp" style="font-size:15px;">Se muestran la cantidad de informes presentes en cada sector</p>
            <div class="card-body table-full-width">
                <div class="chart">
                    <apexcharts  ref="metrica" width="410" type="donut" :options="chartOptions" :series="series"></apexcharts>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import VueApexCharts from 'vue-apexcharts';

export default {
    components: {
        apexcharts: VueApexCharts,
    },
    data(){
        return{
            //series: [],
            // series: [{
            //     data: [1,2,3]
            // }],
            chartOptions : {
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
            },
            series: [{
                data: []
            }],
        };
    },
    created(){
        this.obtenerCantInformesPorSector();
    },
    methods:{
        obtenerCantInformesPorSector(){
            axios
                .get(`/api/informeempleadoestados/cantInformesPorSector`,{
                    headers: { "X-Requested-With": "XMLHttpRequest" },
                    })
                    .then((response) => {
                        console.log("Hola jonaa llegamos al componente",response);

                        // this.series = [
                        // {
                        //     data: response.data.data
                        // },
                        // ];
                        this.chartOptions = {
                            labels:response.data.labels,
                            series:response.data.data
                        };
                        this.$refs.metrica.updateOptions(this.chartOptions, false ,true);

                        })

        }
    }
}
</script>
