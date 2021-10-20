<template>
  <div>
    <form @submit.prevent="onSubmit">
      <input v-model="email" type="text" placeholder="email" name="email" />
      <input type="password" placeholder="password" name="contrasena" />
      <br />
      <input type="submit" value="log in" />
    </form>
  </div>
</template>
<script>
import formSerialize from "form-serialize";
import Errors from "../../helpers/FormErrors.js";

export default {
  data() {
    return {
      email: "",
      contrasena: "",
      errors: new Errors(),
    };
  },
  methods: {
    onSubmit(event) {
      let data = formSerialize(event.target, {
        hash: false,
        empty: true,
      });
      axios
        .post("/api/users/login", data, {
          headers: { "X-Requested-With": "XMLHttpRequest" },
        })
        .then((response) => {
          console.log(response.data);
          if (response.data.message) {
            this.$notify({
              group: "default",
              type: "success",
              text: response.data.message,
            });
          }
        })
        .catch((error) => {
          this.$notify({
            group: "default",
            type: "error",
            text: error.response.data.message,
          });

          this.errors.add(error.response.data.errors);
        });
    },
  },
};
</script>
