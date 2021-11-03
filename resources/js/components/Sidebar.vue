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
            <span class="user-name">
              <strong>{{ nombreUsuario }}</strong>
            </span>
            <span class="user-role">{{ sector }}</span>
          </div>
        </div>
        <div class="sidebar-menu">
          <ul>
            <li class="header-menu">
              <router-link to="/home" class="nav-link"
                ><b-icon-shop class="icono" style="width: 25px; height: 25px;"></b-icon-shop>Home</router-link>
            </li>
            <li class="header-menu">
              <router-link to="/reports"
                ><b-icon-file-text class="icono" style="width: 25px; height: 25px;"></b-icon-file-text>Informes</router-link>
            </li>
            <li class="header-menu">
              <router-link to="/informes/crear"
                ><b-icon-journal-arrow-up class="icono" style="width: 25px; height: 25px;"></b-icon-journal-arrow-up>Cargar informe</router-link>
            </li>
            <li class="header-menu">
              <router-link to="/sector/crear"
                ><b-icon-bookmark class="icono" style="width: 25px; height: 25px;"></b-icon-bookmark>Registrar sector</router-link>
            </li>
            <li class="header-menu">
              <router-link to="/sector/ver"
                ><b-icon-bookmark class="icono" style="width: 25px; height: 25px;"></b-icon-bookmark>Ver sectores</router-link>
            </li>
            <li class="header-menu">
              <router-link to="/suggestion/crear"
                >Crear sugerencia<b-icon-bookmark></b-icon-bookmark
              ></router-link>
            </li>
          </ul>
        </div>
      </div>
      <!--       <span class="user-name">
        <strong>TraceSys Web</strong>
      </span> -->
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
      nombreUsuario: "",
      sector: "",
    };
  },
  created() {
    this.nombreUsuario = this.$session.get("nombreDeUsuario");
    this.sector = this.$session.get("nombre_sector");
  },
  mounted() {
    // axios
    //     .get("/api/routes/get-sidebar")
    //     .then((response) => {
    //         console.log(this.actions.routeName);
    //         this.actions = response.data;
    //         })
    //         .catch((error) => {
    //         console.log("Error: " + error);
    //         });
  },
};
</script>
<style>
    .chiller-theme .sidebar-wrapper .sidebar-menu ul li a{
        margin:5px;
        border-radius: 5px;
        width: 250px;
    }
    .chiller-theme .sidebar-wrapper .sidebar-menu ul li a:hover{
        background-color: rgb(88, 88, 88);
    }
    .chiller-theme .sidebar-wrapper .sidebar-menu ul li a:focus{
                background-color: rgb(233, 233, 233);

    }
    .icono{
        margin-right:15px;
        margin-bottom: 10px;
        font-weight: normal;
    }
</style>
