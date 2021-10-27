<template>
<div class="columns contenido-central-detalleInforme">

    <h1>Bienvenido {{usuario}}</h1>

</div>

</template>

<script>
export default {
  data() {
    return {
      usuario: "",
    };
  },
  created() {
    if (this.$session.exists()) {
      this.usuario = this.nombreUsuario=this.$session.get("nombreDeUsuario");;

    } else {
      this.$router.push("/login");
    }
  },
};
</script>
