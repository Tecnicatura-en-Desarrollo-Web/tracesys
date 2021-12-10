<template>
<div>
            <h5 class="text-start">Elegir sugerencias:</h5>
            <p class="colorp" style="font-size:15px;">Sugerencias ordenadas
                por la mas aplicada , selecionar una o varias</p>
            <select v-model='sugerenciasSeleccionadas'
                    class="form-select"  multiple
                    name="selectSugerencia">
                <option
                v-for="(sugerencia, itemObjKey) in arraysugerencias"
                :key="sugerencia.suggestion.suggestion_id"
                v-bind:value="sugerencia.suggestion.suggestion_id"
                v-if='sugerencia.suggestion.sector_id==primerSelect'
                :content="'Esta sugerencia fue aplicada '+sugerencia.suggestion.puntaje+' veces con exito'"
                v-tippy="{ animation : 'shift-away' , placement : 'top-start' , flip:true , arrow : true}"
                :disabled='sugerencia.cantStock==0 ? true : false'
                >
                    <p>▸ </p> {{sugerencia.suggestion.nombre_sugerencia}}
                    <p v-if="sugerencia.cantStock==0">【sin stock】</p>

                </option>

            </select>


</div>
</template>

<script>
export default {
    props:['arraysugerencias','primerSelect'],
    data(){
        return{
            sugerenciasSeleccionadas:[],

        };
    },

    updated(){
            this.$emit('sugerenciasSeleccionadas',this.sugerenciasSeleccionadas);
    },

    methods: {
        registrarSugerencia: function(data) {
            data += "&sugerenciasSeleccionadas=" + this.sugerenciasSeleccionadas;
            axios
                .post(`/api/problemasugerencias/edit`, data, {
                headers: { "X-Requested-With": "XMLHttpRequest" },
                })
                .then((response) => {

                });
        },
        enviarPresupuesto: function(data) {
            data += "&sugerenciasSeleccionadas=" + this.sugerenciasSeleccionadas;
            axios
                .post(`/api/problemasugerencias/enviarPresupuesto`, data, {
                headers: { "X-Requested-With": "XMLHttpRequest" },
                })
                .then((response) => {
                    window.location = "http://localhost:8765/reports";

                });
        }
    }
}
</script>

<style src="../../../../node_modules/vue-multiselect/dist/vue-multiselect.min.css">

</style>



