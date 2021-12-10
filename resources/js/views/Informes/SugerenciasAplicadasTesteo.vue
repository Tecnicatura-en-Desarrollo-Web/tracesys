<template>
    <div>
        <h5 class="text-center">Sugerencias aplicadas por reparacion</h5>
        <div class="Scroll" >
            <ul class="list-group">
            <li class="list-group-item align"

            v-for="sugerencia in sugerencias"
            :key="sugerencia.suggestion.suggestion_id"
            v-bind:value="sugerencia.suggestion.suggestion_id">
                <!-- <div v-if="sugerencia.suggestion==sugerenciaAplicada.suggestion">
                    <del>
                    {{ sugerencia.suggestion.nombre_sugerencia }}
                    </del>
                </div> -->
                <div>
                    <b-icon icon="check-square" scale="2" variant="success"></b-icon> {{sugerencia.suggestion.nombre_sugerencia }}
                </div>

            </li>
            </ul>
        </div>
    </div>
</template>
<script>
export default {
    props:{
            arraysugerencias:{type:Array,required:true},
            primerSelect: Number,
            idInforme:String
        },
    data(){
        return{
            sugerencias:[],
            sugerenciasAplicadas:'',
            idInformevista:null,
        }
    },
    created(){
            this.idInformevista=this.$props.idInforme;
            this.sugerenciasAplicadas=this.$props.arraysugerencias;
            // console.log("del props",this.$props.arraysugerencias);
        },
    mounted(){
    this.obtenerSugerenciasAplicadas();
    //   this.sugerenciasFiltradas();
    },
    methods:{
        obtenerSugerenciasAplicadas(){
            axios
                    .get(`/api/problemasugerencias/sugerenciasParaAplicar/${this.idInformevista}`, {
                        headers: { "X-Requested-With": "XMLHttpRequest" },
                    })
                    .then((response) => {
                    if (response.data.suggestions[0] != null) {
                        this.sugerencias = response.data.suggestions;
                        //console.log("aca lee jonaaaaaaaaa", response.data.suggestions);
                        // this.idIssuesSelect =
                        // response.data.suggestions[0].problemasugerencia_id;
                        /* console.log(response.data.suggestions); */
                        //this.sugerencias = response.data.suggestions;
                    }
                    })
                    .catch((error) => {
                    console.log("Error: " + error);
                    });
        },
        subirValoracionSugerencias: function(){
            axios
                .post(`/api/problemasugerencias/subirValoracion/${this.idInformevista}`, {
                headers: { "X-Requested-With": "XMLHttpRequest" },
                })
                .then((response) => {

                });
            },
        enviarFacturaFinal: function (){
            axios
                .post(`/api/problemasugerencias/enviarFacturaFinal/${this.idInformevista}`, {
                headers: { "X-Requested-With": "XMLHttpRequest" },
                })
                .then((response) => {
                    window.location = "http://localhost:8765/reports";

                });
            }

    }
}
</script>
