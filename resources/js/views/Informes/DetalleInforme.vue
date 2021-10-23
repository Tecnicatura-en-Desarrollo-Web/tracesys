<template>
    <div class="posts view large-10 medium-8 columns">
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
                <tr>
                    <td>{{report.created}}</td>
                    <td>{{report.employee.user.nombre}} {{report.employee.user.apellido}}</td>
                    <td>{{report.report.product.tipo}}</td>
                    <td>{{report.report.product.modelo}}</td>
                    <td>{{report.state.nombre_estado}}</td>
                    <td>{{report.report.product.motivo}}</td>
                    <td>{{report.report.product.motivo}}</td>
                </tr>
            </tbody>
        </table>
        <form @submit.prevent="onSubmit" novalidate="novalidate">
            <div class="row align-items-center">
                <div class="col col-lg-2">
                    <h5>Derivar a:</h5>
                </div>
                <div class="col col-lg-10">
                    <select class="custom-select" id="inputGroupSelect01" name="selectSector">
                        <option selected>Elija Sector...</option>
                            <option v-for="sectorADerivar in sectoresADerivar" v-if="sectorADerivar.sector_id != 1" :key="sectorADerivar.sector_id" v-bind:value="sectorADerivar.sector_id">
                                <text >{{sectorADerivar.nombre_sector}}</text>
                            </option>
                    </select>
                </div>
            </div>
            <div class="row align-items-center mt-2">
                <div class="col col-lg-2">
                    <h5>Sugerencias:</h5>
                </div>
                <div class="col col-lg-10">
                    <select class="custom-select" id="inputGroupSelect01" name="selectSugerencia">
                        <option selected>Asigne sugerencia...</option>
                            <option v-for="sugerencia in sugerencias" :key="sugerencia.suggestion.suggestion_id" v-bind:value="sugerencia.suggestion.suggestion_id">
                                {{sugerencia.suggestion.nombre_sugerencia}}
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
                        <textarea class="form-control" id="exampleFormControlTextarea1" name="comentarios" rows="3"></textarea>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col col-lg-2">
                    <button class="btn btn-primary" type="submit">Derivar</button>
                </div>
            </div>
        </form>
    </div>
</template>
<script>
import formSerialize from "form-serialize";
import Errors from "../../helpers/FormErrors.js";
export default {
    data(){
        return{
            idInforme:null,
            usuarioADerivarSeleccionado:'',
            sectoresADerivar:[],
            sugerencias:[],

            report:{
                employee:{
                    user:{
                        nombre:'',
                        apellido:''
                    }

                },
                report:{

                    product:{
                        tipo:'',
                        modelo:'',
                        motivo:''
                    }
                },
                state:{
                    nombre_estado:''
                }
            }
        }
    },
    created(){
        if(!this.$session.exists()){
                this.$router.push('/login');
        }
    },
    mounted() {
        this.idInforme = this.$route.params.id;
        this.verInforme(this.$route.query);
        this.obtenerSugerencias(this.$route.query);
        this.obtenerSectores(this.$route.query);
    },
    methods: {
        verInforme(query){
                axios.get(`/api/informeempleadoestados/informesCambiosEstados/${this.idInforme}`, { params: query })
                .then(response => {
                    //ver mas adelante mejorar la estructura del arreglo devuelto
                    this.report = response.data.cambiosEstadoInforme[0];
                    console.log(this.report);
                    // console.log(this.report);
                })
                .catch(error => {
                    console.log('Error: ' + error);
                });
        },
        obtenerSugerencias(query) {
            axios.get(`/api/problemasugerencias/issuesByReport/${this.idInforme}`, { params: query })
                .then(response => {
                    this.sugerencias=response.data.suggestions;
                    console.log(response.data.suggestions);
                    //this.sugerencias = response.data.suggestions;
                })
                .catch(error => {
                    console.log('Error: ' + error);
                });
        },
        obtenerSectores(query) {
            axios.get("/api/sectors", { params: query })
                .then(response => {
                    console.log(response.data.sectors);
                    this.sectoresADerivar=response.data.sectors;
                    //this.usersDerivar = response.data.users;
                })
                .catch(error => {
                    console.log('Error: ' + error);
                });
        },
        onSubmit(event) {
                let data = formSerialize(event.target, {
                    hash: false,
                    empty: true
                });
                data+='&idInforme='+this.idInforme;
                data+='&idEmpleado='+this.report.employee.employee_id;
                // console.log(data);
                axios.post(`/api/informeempleadoestados/save`, data, {
                        headers: {'X-Requested-With': 'XMLHttpRequest'}
                    })
                    .then(response => {
                        // Redirect on success
                        console.log(response);
                        if (response.data.success) {
                            this.$notify({
                                group: 'default',
                                type: 'success',
                                text: response.data.message
                            });

                            this.$router.push({ path: response.data.url });
                        }
                    })
                    .catch(error => {
                        this.$notify({
                            group: 'default',
                            type: 'error',
                            text: error.response.data.message
                        });

                        this.errors.add(error.response.data.errors);
                    });
            }
    },
}
</script>

