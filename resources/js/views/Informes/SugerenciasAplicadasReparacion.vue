<template>
    <div>
        <h5 class="text-center">Marque las sugerencias que aplicó</h5>
        <div class="Scroll" >
            <ul class="list-group">
            <li class="list-group-item align"

            v-for="sugerencia in sugerencias"
            :key="sugerencia.suggestion.suggestion_id"
            v-bind:value="sugerencia.suggestion.suggestion_id">
                <input class="form-check-input me-1" type="checkbox" name="3" v-bind:value="sugerencia.suggestion.suggestion_id"
                v-model='sugerenciasAplicadas'>
                {{ sugerencia.suggestion.nombre_sugerencia }}
            </li>
            </ul>
        </div>
    </div>
</template>

<script>

export default {
    props:['primerSelect','idInforme'],
    data(){
        return {
            sugerenciasAplicadas:[],
            idInformevista:null,
            sugerencias:[]
        };
    },
    created(){
        this.idInformevista=this.$props.idInforme;
        this.idSector=this.$session.get("sector_id");
    },
    mounted(){
        this.obtenerSugerenciasParaAplicar();
        // this.registrarSugerenciasAplicadas();
    },
    updated(){
        this.$emit('sugerenciasAplicadas',this.sugerenciasAplicadas);
    },
    methods:{
        obtenerSugerenciasParaAplicar(){
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
        registrarSugerenciasAplicadas: function(data){
            data += "&sugerenciasAplicadas=" + this.sugerenciasAplicadas;
            axios
                .post(`/api/problemasugerencias/editarSugerenciasAplicadas`, data, {
                headers: { "X-Requested-With": "XMLHttpRequest" },
                })
                .then((response) => {
                    this.registrarBajaStock(data);
                    window.location = "http://localhost:8765/reports";
                    // console.log("respuestade sugerencia",response.data);
                    // if (response.data.success) {
                    // }
                });
            },
        registrarBajaStock(data){
            axios
            .post(`/api/sugerenciarepuestos/registrarBajaStock`, data, {
            headers: { "X-Requested-With": "XMLHttpRequest" },
            })
            .then((response) => {
                // window.location = "http://localhost:8765/reports";
            })
        }

    }
}
</script>
<style>
.Scroll {
  height:200px;
  overflow-y: scroll;
}
.me-1 {
    margin-right: 0.30rem !important;
    margin-top: 0.30rem!important;
    margin-bottom: 0rem!important;
}
</style>

