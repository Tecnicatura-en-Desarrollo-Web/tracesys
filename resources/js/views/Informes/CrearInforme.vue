<template>
  <div class="large-10 medium-8 columns">
    <h1>Cargar Informe</h1>
    <form @submit.prevent="onSubmit" novalidate="novalidate">
      <div class="row callout callout-danger bg-light">
        <h5>Datos del cliente</h5>
        <div class="col-lg-6 col-12">
          <div class="form-group">
            <label for="product_name"
              >Denominacion<small
                class="font-weight-bold text-primary"
                id="obligatory_field"
                >*</small
              ></label
            >
            <input
              type="text"
              class="form-control"
              name="denominacion"
              v-model="denominacion"
              required
            />
            {{ denominacion }}
          </div>
        </div>
      </div>
      <div class="col-12 d-flex justify-content-center mt-3">
        <button
          type="submit"
          class="btn btn-success text-uppercase"
          id="button_submit"
        >
          Crear
        </button>
      </div>
    </form>
  </div>
</template>

<script>
import formSerialize from "form-serialize";
import Errors from "../../helpers/FormErrors.js";

export default {
  data() {
    return {
      denominacion: "",
    };
  },
  methods: {
    onSubmit(event) {
      let data = formSerialize(event.target, {
        hash: false,
        empty: true,
      });
      console.log(data);

      axios
        .post("/api/reports/save", data, {
          headers: { "X-Requested-With": "XMLHttpRequest" },
        })
        .then((response) => {
          // Redirect on success
          console.log(response.data);
          if (response.data.success) {
            this.$notify({
              group: "default",
              type: "success",
              text: response.data.message,
            });

            this.$router.push({ path: response.data.url });
          }
        })
        .catch((error) => {
          this.$notify({
            group: "default",
            type: "error",
            text: error.response.data.message,
          });
        });
    },
  },
};
</script>