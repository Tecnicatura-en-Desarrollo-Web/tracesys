<template>
  <div>
    <div class="d-flex justify-content-center mt-5">
      <div>
        <div class="mb-5">
          <img src="../../../img/LogoTracesys.png" alt="Logo del sistema" />
        </div>
        <div class="card shadow-lg p-3 bg-white rounded" style="width: 18rem">
          <div class="columns align-content-end">
            <h1>Cuenta activada. Gracias!</h1>
            <router-link to="/login">
              <div class="d-flex justify-content-center">
                <button class="boton-classic">Ir login</button>
              </div></router-link
            >
            <div></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import formSerialize from "form-serialize";
import Errors from "../../helpers/FormErrors.js";

export default {
  data() {
    return {
      user_id: "",
      mensaje: "",
      errors: new Errors(),
    };
  },
  created() {
    this.user_id = this.$route.params.user_id;
  },
  mounted() {
    this.envioActivacion();
  },
  methods: {
    envioActivacion() {
      let data = "user_id=" + this.user_id;
      /* data = formSerialize(data, {
        hash: false,
        empty: true,
      }); */
      console.log(data);
      axios
        .post("/api/users/activacionEmail", data, {
          headers: { "X-Requested-With": "XMLHttpRequest" },
        })
        .then((response) => {
          console.log(response);
        });
    },
  },
};
</script>
