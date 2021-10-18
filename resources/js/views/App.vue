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

export default {
  components: {
    sidebar: Sidebar,
    header2: Header2
  },
  data(){
      return {
      login: true
    }
  }
};
</script>
