<template>

    <div class="card">
        <div class="card-body border-1">

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

            <sugerenciasAplicadasTesteo
            :arraysugerencias="arraysugerencias" :idInforme="idInforme"
            ref="sugerenciasAplicadasTesteo"
            v-if='EmpleadoEtapa==4'>
            </sugerenciasAplicadasTesteo>
        </div>
    </div>


</template>

<script>
import sugerenciasAplicadasReparacion from "../Informes/SugerenciasAplicadasReparacion.vue";
import elegirSugerencias from "../Informes/ElegirSugerencias.vue";
import sugerenciasAplicadasTesteo from "../Informes/SugerenciasAplicadasTesteo.vue";

export default {

    props:{
        arraysugerencias:{type:Array,required: true},
        primerSelect: Number,
        idInforme:String
    },
    components: {
        sugerenciasAplicadasReparacion: sugerenciasAplicadasReparacion,
        sugerenciasAplicadasTesteo: sugerenciasAplicadasTesteo,
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
        enviarPresupuesto: function(data) {
        this.$refs.elegirSugerencias.enviarPresupuesto(data);
        },
        registrarSugerenciasAplicadas: function(data) {
        this.$refs.sugerenciasAplicadasReparacion.registrarSugerenciasAplicadas(data);
        },
        subirValoracionSugerencias: function(data) {
        this.$refs.sugerenciasAplicadasTesteo.subirValoracionSugerencias(data);
        },
    }

}
</script>
