<template>
  <div>
    <notifications group="default" position="bottom right" :width="400" />

    <!-- Custom template example -->
    <!-- <notifications group="my-custom-notification"
            :duration="5000"
            :width="1200"
            position="top center">

            <template slot="body" slot-scope="props">
                <div class="my-custom-notification">
                    <div class="message success" @click="props.close" v-html="props.item.text"></div>
                </div>
            </template>
        </notifications> -->
    <header2 v-show="login"></header2>
    <sidebar v-show="login"></sidebar>

    <router-view></router-view>
  </div>
</template>

<script>
import Sidebar from "../components/Sidebar.vue";
import Header2 from "../components/Header.vue";
import Notificacion from "../components/Notificacion.vue";

export default {
  components: {
    sidebar: Sidebar,
    header2: Header2,
  },
  data() {
    return {
      login: false,
    };
  },
  created() {
    //console.log(this.$session.exists());
    if (this.$session.exists()) {
      this.login = true; //ESTO SIEMPRE VA EN TRUE
      //console.log("info sesion:",this.login);
    }
  },
  updated(){
    // this.$toast.error(Notificacion, {
    //     position: "top-right",
    //     timeout: 5000,
    //     closeOnClick: true,
    //     pauseOnFocusLoss: true,
    //     pauseOnHover: true,
    //     draggable: true,
    //     draggablePercent: 1.13,
    //     showCloseButtonOnHover: false,
    //     hideProgressBar: false,
    //     closeButton: "button",
    //     icon: true,
    //     rtl: false
    //     });
  }

};

</script>

<style>

/* @font-face {
  font-family: "futura";
  src: local("futura"),
    url("../../fonts/futura/Futura Heavy font.ttf") format("truetype");
} */

@font-face {
  font-family: "proxima";
  src: local("proxima"),
    url("../../fonts/proxima-nova/ProximaNova-Regular.ttf") format("truetype");
}

* {
  font-family: "proxima";
}


</style>
