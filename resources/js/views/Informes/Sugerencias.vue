<template>
    <div>
        <elegirSugerencias :arraysugerencias="arraysugerencias" :primerSelect="primerSelect"
        @sugerenciasSeleccionadas="sugerenciasSeleccionadas = $event" ref="elegirSugerencias"
        v-if='EmpleadoEtapa==2'>
        </elegirSugerencias>

        <sugerenciasAplicadasReparacion
        :arraysugerencias="arraysugerencias" :idInforme="idInforme"
        @sugerenciasAplicadas="sugerenciasAplicadas = $event" ref="sugerenciasAplicadasReparacion"
        v-if='EmpleadoEtapa==3'
        >
        </sugerenciasAplicadasReparacion>

    </div>
</template>

<script>
import sugerenciasAplicadasReparacion from "../Informes/SugerenciasAplicadasReparacion.vue";
import elegirSugerencias from "../Informes/ElegirSugerencias.vue";

export default {

    props:['arraysugerencias','primerSelect','idInforme'],
    components: {
        sugerenciasAplicadasReparacion: sugerenciasAplicadasReparacion,
        elegirSugerencias: elegirSugerencias,
        },
    data(){
        return{
            sugerenciasAplicadas:[],
            sugerenciasSeleccionadas:[],
            mensajeQueFunciono:"",
            EmpleadoEtapa:'',
            // idInformeVista:null,
        };
    },
    created(){
        // this.idInformeVista=this.$props.idInforme;
        this.EmpleadoEtapa=this.$session.get("etapa_id");
    },
    methods:{
        registrarSugerencia: function(data) {
        this.$refs.elegirSugerencias.registrarSugerencia(data);
        },
        registrarSugerenciasAplicadas: function(data) {
        this.$refs.sugerenciasAplicadasReparacion.registrarSugerenciasAplicadas(data);
        },
    }

}
</script>
