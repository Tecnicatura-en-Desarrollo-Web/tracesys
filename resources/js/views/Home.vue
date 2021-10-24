<template></template>

<script>
export default {
  data() {
    return {
      usuario: "",
    };
  },
  created() {
    if (this.$session.exists()) {
      this.usuario = this.$session.get(this.$session.id());
    } else {
      this.$router.push("/login");
    }
  },
};
</script>
