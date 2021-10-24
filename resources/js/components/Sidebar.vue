<template>
  <div class="page-wrapper chiller-theme toggled">
    <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
      <i class="fas fa-bars"></i>
    </a>
    <nav id="sidebar" class="sidebar-wrapper">
      <div class="sidebar-content">
        <div class="sidebar-header">
          <div class="user-pic">
            <img
              class="img-responsive img-rounded"
              src="../../img/NicePng_usuario-png_2022264.png"
              alt="User picture"
            />
          </div>
          <div class="user-info">
            <span class="user-name"
              >Maxi
              <strong>Villalba</strong>
            </span>
            <span class="user-role">Administrador</span>
          </div>
        </div>
        <div class="sidebar-menu">
          <ul>
            <li class="header-menu">
              <router-link to="/home" class="nav-link">Home</router-link>
            </li>
            <li class="header-menu">
              <router-link to="/reports">Informes</router-link>
            </li>
            <li>
              <router-link to="/informes/crear">Cargar informe</router-link>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </div>
  <!--   <div class="page-wrapper chiller-theme toggled">
    <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
      <i class="fas fa-bars"></i>
    </a>
    <nav id="sidebar" class="sidebar-wrapper">
      <div class="sidebar-content">
        <div class="sidebar-header">
          <div class="user-pic">
            <img
              class="img-responsive img-rounded"
              src="../../img/NicePng_usuario-png_2022264.png"
              alt="User picture"
            />
          </div>
          <div class="user-info">
            <span class="user-name"
              >Jhon
              <strong>Smith</strong>
            </span>
            <span class="user-role">Administrator</span>
          </div>
        </div>
        <div class="sidebar-menu">
          <ul>
            <li class="header-menu">
              <span>General</span>
            </li>
            <li class="sidebar-dropdown">
              <router-link to="/reports">Informes</router-link>
            </li>
            <li class="sidebar-dropdown">
              <router-link to="/informes/crear">Cargar informe</router-link>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </div> -->
</template>

<script>
export default {
  name: "header2",
  data() {
    return {
      actions: [],
    };
  },
  mounted() {
    axios
      .get("/api/routes/get-sidebar")
      .then((response) => {
        console.log(this.actions.routeName);
        this.actions = response.data;
      })
      .catch((error) => {
        console.log("Error: " + error);
      });
  },
};
</script>
