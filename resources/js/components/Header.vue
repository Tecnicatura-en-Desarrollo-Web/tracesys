<template>
  <nav class="top-bar expanded" data-topbar role="navigation">
    <ul class="title-area large-2 medium-4 columns">
      <li class="name">
        <h1 id="nombre-etapa">{{ nombre_etapa }}</h1>
      </li>
    </ul>
    <div class="top-bar-section">
      <ul class="right">
        <li><router-link :to="{ name: 'profile' }">Profile</router-link></li>
        <li><a class="text-white" @click="logout()">Logout</a></li>
      </ul>
    </div>
  </nav>
</template>

<script>
export default {
  data() {
    return {
      title: "CakeVue",
      title_url: "root",
      usuario: "",
      nombre_etapa: "",
    };
  },
  methods: {
    logout() {
      this.$session.destroy();
      window.location.href = "http://localhost:8765/home";
    },
  },
  created() {
    if (this.$session.exists()) {
      this.usuario = this.$session.get(this.$session.id());
      this.nombre_etapa = this.$session.get("nombre_etapa");
      // this.$router.push('login');
    }
  },
};
</script>
