<template>
  <div>
    <ul>
        <div class="posts view large-10 medium-8 columns contenido-central">
            <!-- <h1>Listado de informes</h1> -->

            <div class="card2 p-0 shadow-sm p-3 mb-5 bg-body rounded">

                <h3 class="card-title">Listado de informes</h3>
                <p class="colorp" style="font-size:15px;">Se muestra el listado de informes correspondientes a su sector</p>

            <div class="card-body table-full-width">

                <table class="table-striped p-4 ">
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
                    v-for="report in reports" :v-bind="report.report.report_id" v-if="report.sector_id == empleado_sector_id || empleado_sector_id==1"
                    >
                    <td>{{ report.report.report_id }}</td>
                    <td>{{ report.fecha }}</td>
                    <td>{{ report.hora }}</td>
                    <td>{{ report.report.created }}</td>
                    <td>{{ report.report.created }}</td>
                    <td>{{ report.report.product.tipo }}</td>
                    <td>{{ report.report.product.motivo }}</td>
                    <td>en {{ report.state.nombre_estado }}</td>
                    <td>
                        <router-link
                        :to="{ path: `/detalleInforme/` + report.report.report_id }"
                        :idInforme="2"
                        >
                            <b-icon-plus-circle-fill class="iconoVerMas" style="width: 20px; height: 20px;">
                                </b-icon-plus-circle-fill>



                        </router-link
                        >
                    </td>
                    </tr>
                </tbody>
            </table>
            </div>
            </div>

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
        // this.probandoApi();
        this.$emit("nombreHijo", this.nombre);
        this.currentRoute = this.$router.currentRoute.name;
        // this.envioEmail(this.$route.query);

    this.getPosts(this.$route.query);
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
                    console.log("aca lee jonita",response.data)
                    this.reports = response.data.reports;
                    console.log("lee aca maxiiii",this.reports);
                    this.queryParams = response.data.query;
                })
                .catch((error) => {
                console.log("Error: " + error);
                });
        },
        // obtenerSugerencias(query) {
        // axios
        //     .get(`/api/problemasugerencias/issuesByReport/${this.idInforme}`, {
        //     params: query,
        //     })
        //     .then((response) => {
        //     if (response.data.suggestions[0] != null) {
        //         console.log("entro jonaaaaaaaa");
        //         this.sugerencias = response.data.suggestions;
        //         this.idIssuesSelect =
        //         response.data.suggestions[0].problemasugerencia_id;

        //     }
        //     })
        //     .catch((error) => {
        //     console.log("Error: " + error);
        //     });
        // },
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
<style>
    .card2{
        margin-top:40px;
        margin-left: 40px;
        margin-right: 60px;
    }
    .table-full-width{
        margin-left: -32px;
        margin-right: -32px;
    }
    .card-header{
        background-color: white;
    }
    .colorp{
        color:rgb(90, 90, 90)
    }
    .iconoVerMas{
        opacity: .60;
        color:#303030;
        margin-top: 2px;
    }
    .iconoVerMas :hover{
        opacity: 1;
        color:#198754
    }
</style>



