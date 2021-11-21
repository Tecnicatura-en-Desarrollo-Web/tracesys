<template>
<div>

  <nav class="shadow top-bar expanded border border-1 border-muted border-end-0 border-top-0" data-topbar role="navigation">
    <div class="top-bar-section">
      <ul class="right">
        <li class="header-menu">
          <router-link :to="{ name: 'profile' }" class="nav-link"
            >Profile
            <!-- <b-icon-file-person-fill></b-icon-file-person-fill> -->
            <icon class="iconosHeader" name="user-cog" width="13px" height="13px" />
              </router-link
          >
        </li class="header-menu">
        <li><a class="nav-link" @click="logout()">Logout
            <!-- <b-icon-box-arrow-right></b-icon-box-arrow-right> -->
            <icon class="iconosHeader" name="door-open" width="15px" height="15px" />
            </a></li>
      </ul>
    </div>
  </nav>
  </div>
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
      this.$swal({
        title: "Sesion cerrada. Hasta pronto",
        type: "success",
        timer: 1500,
      }).then((result) => {
        window.location.href = "http://localhost:8765/login";
      });
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
<style>
.iconosHeader{
    margin-bottom: 3px;
}
</style>
