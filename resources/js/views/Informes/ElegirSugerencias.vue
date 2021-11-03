<template>
<div>
            <h5 class="text-start">Elegir sugerencias:</h5>
            <p class="colorp" style="font-size:15px;">Estas sugerencias estan ordenadas por la mas aplicada , selecionar una o varias</p>
            <select v-model='sugerenciasSeleccionadas'
                    class="form-select border-1"  multiple
                    name="selectSugerencia">
                <option
                v-for="(sugerencia, itemObjKey) in arraysugerencias"
                :key="sugerencia.suggestion.suggestion_id"
                v-bind:value="sugerencia.suggestion.suggestion_id"
                v-if='sugerencia.suggestion.sector_id==primerSelect'
                :content="'Esta sugerencia fue aplicada '+sugerencia.suggestion.puntaje+' veces con exito'"
                v-tippy="{ animation : 'shift-away' , placement : 'right-start' , flip:false , arrow : true}"
                >
                <p>▸ </p> {{sugerencia.suggestion.nombre_sugerencia}}
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
                    this.$router.push("/reports");
                    console.log("respuestade sugerencia",response.data);
                    if (response.data.success) {
                    }
                });
        },
        enviarPresupuesto: function(data) {
            data += "&sugerenciasSeleccionadas=" + this.sugerenciasSeleccionadas;
            axios
                .post(`/api/problemasugerencias/enviarPresupuesto`, data, {
                headers: { "X-Requested-With": "XMLHttpRequest" },
                })
                .then((response) => {
                    console.log("PRESUPUESTOOOO:",response.data);
                    // this.$router.push("/reports");

                });
        }
    }
}
</script>

