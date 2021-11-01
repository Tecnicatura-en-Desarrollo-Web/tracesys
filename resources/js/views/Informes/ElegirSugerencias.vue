<template>
    <div>
        <h5 class="text-center">Elegir sugerencias:</h5>

        <select v-model='sugerenciasSeleccionadas'
                class="form-select"  multiple
                name="selectSugerencia">
            <option
            v-for="sugerencia in arraysugerencias"
            :key="sugerencia.suggestion.suggestion_id"
            v-bind:value="sugerencia.suggestion.suggestion_id"
            v-if='sugerencia.suggestion.sector_id==primerSelect'
            >
            {{ sugerencia.suggestion.nombre_sugerencia }}
            </option>
        </select>
        <!-- Sugerencias selecionadas: {{sugerenciasSeleccionadas}} -->
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
                this.$router.push("/reports");
                console.log("respuestade sugerencia",response.data);
                if (response.data.success) {
                }
            });
        }
    }
}
</script>
