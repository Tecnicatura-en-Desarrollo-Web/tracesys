<template>
            <div class="card2 p-0 shadow-sm p-3 mb-5 bg-body rounded">

                <h3 class="card-title">Historial informes derivados</h3>
                <p class="colorp" style="font-size:15px;">Se muestra el historial de informes derivados</p>

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
                    v-for="(report , index) in reports" :v-bind="report.report.report_id" v-if="report.employee_id == empleado_id"
                    >
                    <td>{{ report.report.report_id }}</td>
                    <td>{{ report.fecha }}</td>
                    <td>{{ report.hora }}</td>
                    <td>{{ report.report.product.tipo }}</td>
                    <td>{{ report.report.product.motivo }}</td>
                    <td>en {{ report.state.nombre_estado }}</td>
                        <td>
                        <!-- <button>
                            <b-icon-plus-circle-fill class="iconoVerMas" style="width: 20px; height: 20px;">
                            </b-icon-plus-circle-fill>
                        </button> -->
                        <b-icon-plus-circle-fill class="iconoVerMas" style="width: 20px; height: 20px;" data-bs-toggle="modal" :data-bs-target="`#demo${index}`" >
                        </b-icon-plus-circle-fill>

                        <div class="modal fade" :id="'demo'+index" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="false">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">{{report.report.product.tipo}}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <b>Derivado por:</b> {{ report.employee.user.nombre }} {{ report.employee.user.apellido }}
                                    <hr>
                                    <b>Fecha y hora derivacion:</b> {{ report.fecha }} - {{ report.hora }}
                                    <hr>
                                    <b>Producto:</b> {{ report.report.product.tipo }} {{ report.report.product.marca }} {{ report.report.product.modelo }}
                                    <hr>
                                    <b>Motivo de reparacion:</b> {{ report.report.product.motivo }}
                                    <hr>
                                    <b>Derivado al sector de:</b> {{ report.sector.nombre_sector }}
                                    <hr>
                                    <b>Comentario realizado:</b> {{ report.comentario.commentsemployee.descripcion }}
                                </div>

                                </div>
                            </div>
                        </div>




                        </td>
                    </tr>
                </tbody>
            </table>
            </div>
            </div>
</template>

<script>
export default {
    props:{
        reports:{type:Array,required: true}
    },
    data(){
        return{
            empleado_id:null
        };
    },
    created() {
        if (!this.$session.exists()) {
            this.nombre_sector = "asdasd";
            this.$router.push("/login");
            console.log("saaale", nombre_sector);
        }
        if (this.$session.exists()) {
            // this.nombre_sector = this.$session.get("nombre_sector");
            // this.empleado_stage_id = this.$session.get("etapa_id");
            this.empleado_id = this.$session.get("user_id");
        }
    },
}
</script>
<style>
    .iconoVerMas{
        cursor: pointer;
    }
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
