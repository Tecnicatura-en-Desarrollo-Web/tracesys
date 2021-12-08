<template>
  <div class="page-wrapper chiller-theme toggled">
    <!-- <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
        <i class="fas fa-bars">GHFGHFGHFGH</i>
        </a> -->
    <nav id="sidebar" class="sidebar-wrapper shadow-sm">
      <div class="sidebar-content">
        <div class="sidebar-header">
          <div class="user-pic">
            <icon
              class="iconoUser"
              name="user-circle"
              width="40px"
              height="40px"
            />
            <!-- <img
                    class="img-responsive img-rounded"
                    src="../../img/NicePng_usuario-png_2022264.png"
                    alt="User picture"
                    /> -->
          </div>
          <div class="user-info">
            <span class="user-name">
              <strong>{{ nombreUsuario }}</strong>
            </span>
            <span class="user-role">{{ sector }}</span>
          </div>
        </div>
        <div class="noScroll sidebar-menu">
          <ul>
            <li id="1" class="header-menu" v-on:click="focus(1)">
              <router-link to="/home" class-active="nav-link">
                <icon
                  class="icono"
                  name="home-fill"
                  width="25px"
                  height="25px"
                />
                Home</router-link
              >
            </li>
            <li id="2" class="header-menu" v-on:click="focus(2)">
              <router-link to="/reports" class="jona">
                <icon
                  class="icono"
                  name="clipboard-list"
                  width="25px"
                  height="25px"
                />
                Informes</router-link
              >
            </li>
            <li
              id="3"
              class="header-menu"
              v-on:click="focus(3)"
              v-if="empleadoEtapa == 1"
            >
              <router-link to="/informes/crear" class="jona">
                <icon
                  class="icono"
                  name="file-signature"
                  width="25px"
                  height="25px"
                />
                Cargar informe</router-link
              >
            </li>
            <li
              id="4"
              class="header-menu"
              v-on:click="focus(4)"
              v-if="empleadoEtapa == 1"
            >
              <router-link to="/sector/crear" class="jona">
                <icon
                  class="icono"
                  name="file-signature"
                  width="25px"
                  height="25px"
                />
                Registrar sector</router-link
              >
            </li>
            <li
              id="5"
              class="header-menu"
              v-on:click="focus(5)"
              v-if="empleadoEtapa == 1"
            >
              <router-link to="/sector/ver" class="jona">
                <icon class="icono" name="list-ol" width="25px" height="25px" />
                Ver sectores</router-link
              >
            </li>
            <li
              id="6"
              class="header-menu"
              v-on:click="focus(6)"
              v-if="empleadoEtapa == 2"
            >
              <router-link to="/suggestion/crear" class="jona">
                <icon
                  class="icono"
                  name="file-signature"
                  width="25px"
                  height="25px"
                />
                Crear sugerencia</router-link
              >
            </li>
            <li
              id="7"
              class="header-menu"
              v-on:click="focus(7)"
              v-if="empleadoEtapa == 1"
            >
              <router-link to="/proveedor/crear"
                ><b-icon-bookmark
                  class="icono"
                  style="width: 25px; height: 25px"
                ></b-icon-bookmark
                >Cargar Proveedor</router-link
              >
            </li>
            <li
              id="8"
              class="header-menu"
              v-on:click="focus(8)"
              v-if="empleadoEtapa == 1"
            >
              <router-link to="/proveedor/solicitud">
                <b-icon-tools
                  class="icono"
                  style="width: 25px; height: 25px"
                ></b-icon-tools
                >Solicitar Repuesto</router-link
              >
            </li>
            <li
              id="9"
              class="header-menu"
              v-on:click="focus(9)"
              v-if="empleadoEtapa == 1"
            >
              <router-link to="/replacement/replacements">
                <b-icon-tools
                  class="icono"
                  style="width: 25px; height: 25px"
                ></b-icon-tools
                >Repuestos</router-link
              >
            </li>
            <li
              id="10"
              class="header-menu"
              v-on:click="focus(10)"
              v-if="empleadoEtapa == 2"
            >
              <router-link to="/suggestion/suggestions">
                <b-icon-tools
                  class="icono"
                  style="width: 25px; height: 25px"
                ></b-icon-tools
                >Sugerencias</router-link
              >
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </div>
</template>

<script>
export default {
  name: "header2",
  data() {
    return {
      actions: [],
      nombreUsuario: "",
      sector: "",
      idPresionado: null,
      empleadoEtapa: null,
    };
  },

  created() {
    this.nombreUsuario = this.$session.get("nombreDeUsuario");
    this.sector = this.$session.get("nombre_sector");
    this.empleadoEtapa = this.$session.get("etapa_id");
  },
  computed: {},
  methods: {
    // focusItem(id){
    //     let item=document.getElementById(id);
    //     item.style.backgroundColor="white";
    //     this.idPresionado=id;
    // },
    focus(id) {
      if (id != this.idPresionado) {
        let item = document.getElementById(id);
        item.firstChild.setAttribute("class", "text-dark");
        item.setAttribute(
          "style",
          "background-color:white;margin:3px 5px 5px 3px;border-radius:5px;width: 250px"
        );
        if (this.idPresionado != null) {
          let item2 = document.getElementById(this.idPresionado);
          item2.style.backgroundColor = "#212121";
          item2.firstChild.setAttribute("class", "colorText");
        }
        this.idPresionado = id;
      }
    },
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
    //         });s
  },
};
</script>
<style>
.chiller-theme .sidebar-wrapper .sidebar-menu ul li a {
  margin: 5px;
  border-radius: 5px;
  display: block;
}

.chiller-theme .sidebar-wrapper .sidebar-menu ul li a:hover {
  background-color: rgba(65, 56, 56, 0.116);
  border-radius: 5px;
  margin: 5px;
  width: 250px;
}
.jona .chiller-theme .sidebar-wrapper .sidebar-menu ul li a:focus {
  background-color: rgba(65, 56, 56, 0.116);
  border-radius: 5px;
  margin: 5px;
  width: 250px;
}

/* .chiller-theme .sidebar-wrapper .sidebar-menu ul li a:focus{
                background-color: rgb(233, 233, 233);
                color: #212121;
                display: block;
    } */
/* .chiller-theme .sidebar-wrapper .sidebar-menu ul li a:focus.active{
                background-color: rgba(233, 233, 233, 0.116);
    } */
/* nav li:hover,
    nav li.router-link-focus{
        background-color: rgb(233, 233, 233);
        color: #212121;
        display: block;
    } */
.user-info {
  margin-top: 1px;
  margin-left: 3px;
}
.icono {
  margin-right: 15px;
  margin-bottom: 5px;
  font-weight: normal;
}
.iconoUser {
  color: rgb(233, 233, 233);
}
.focusedInput {
  border-color: rgba(22, 235, 68, 0.8);
  outline: 0;
  outline: thin dotted \9;
  -moz-box-shadow: 0 0 8px rgba(22, 235, 68, 0.8);
  box-shadow: 0 0 8px rgba(22, 235, 68, 0.8) !important;
}
.noScroll {
  overflow-x: hidden;
}
.colorText {
  color: #818896 !important;
}
</style>
