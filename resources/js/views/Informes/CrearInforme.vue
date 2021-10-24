<template>
  <div class="large-10 medium-8 columns contenido-central-crear">
    <h1>Cargar Informe</h1>
    <form @submit.prevent="onSubmit">
      <div class="row callout callout-danger bg-light">
        <h5>Datos del cliente</h5>
        <div class="col-lg-6 col-12">
          <div class="form-group">
            <label for="product_name"
              >Nombre y apellido o razon social<small
                class="font-weight-bold text-primary"
                id="obligatory_field"
                >*</small
              ></label
            >
            <input type="text" class="form-control" name="denominacion" />
          </div>
        </div>
        <div class="col-lg-6 col-12">
          <div class="form-group">
            <label for="product_name"
              >CUIT<small
                class="font-weight-bold text-primary"
                id="obligatory_field"
                >*</small
              ></label
            >
            <input type="text" class="form-control" name="cuit" />
          </div>
        </div>
        <div class="col-lg-4 col-12">
          <div class="form-group">
            <label for="product_name"
              >Email<small
                class="font-weight-bold text-primary"
                id="obligatory_field"
                >*</small
              ></label
            >
            <input type="text" class="form-control" name="email" />
          </div>
        </div>
        <div class="col-lg-2 col-12">
          <div class="form-group">
            <label for="product_name"
              >Telefono<small
                class="font-weight-bold text-primary"
                id="obligatory_field"
                >*</small
              ></label
            >
            <input type="text" class="form-control" name="telefono" />
          </div>
        </div>
        <div class="col-lg-6 col-12">
          <div class="form-group">
            <label for="product_name"
              >Dirección<small
                class="font-weight-bold text-primary"
                id="obligatory_field"
                >*</small
              ></label
            >
            <input type="text" class="form-control" name="direccion" />
          </div>
        </div>
        <hr />
        <h5>Datos del producto</h5>
        <div class="col-lg-6 col-12">
          <div class="form-group">
            <label for="product_name"
              >Tipo<small
                class="font-weight-bold text-primary"
                id="obligatory_field"
                >*</small
              ></label
            >
            <input type="text" class="form-control" name="tipo" />
          </div>
        </div>
        <div class="col-lg-6 col-12">
          <div class="form-group">
            <label for="product_name"
              >Marca<small
                class="font-weight-bold text-primary"
                id="obligatory_field"
                >*</small
              ></label
            >
            <input type="text" class="form-control" name="marca" />
          </div>
        </div>
        <div class="col-lg-6 col-12">
          <div class="form-group">
            <label for="product_name"
              >Modelo<small
                class="font-weight-bold text-primary"
                id="obligatory_field"
                >*</small
              ></label
            >
            <input type="text" class="form-control" name="modelo" />
          </div>
        </div>
        <div class="col-lg-6 col-12">
          <div class="form-group">
            <label for="product_name"
              >Motivo de la reparación<small
                class="font-weight-bold text-primary"
                id="obligatory_field"
                >*</small
              ></label
            >
            <input type="text" class="form-control" name="motivo" />
            <div id="emailHelp" class="form-text">
              Debe agregar el problema en palabras claves, por ejemplo:
              "Pantalla negra"
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-12">
          <div class="form-group">
            <label for="product_name"
              >Seleccione prioridad<small
                class="font-weight-bold text-primary"
                id="obligatory_field"
                >*</small
              ></label
            >
            <div class="form-check">
              <input
                class="form-check-input"
                type="radio"
                name="prioridad"
                id="obligatory_field"
                value="alta"
              />
              <label class="form-check-label" for="obligatory_field">
                Alta
              </label>
            </div>
            <div class="form-check">
              <input
                class="form-check-input"
                type="radio"
                name="prioridad"
                id="obligatory_field"
                value="normal"
              />
              <label class="form-check-label" for="obligatory_field">
                Normal
              </label>
            </div>
          </div>
        </div>
        <div class="col-12">
          <div class="form-group">
            <label for="product_name"
              >Comentarios<small
                class="font-weight-bold text-primary"
                id="obligatory_field"
                >*</small
              ></label
            >
            <textarea
              class="form-control"
              style="height: 100px"
              name="descripcion"
            />
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
      user_id_loggin: "",
    };
  },
  methods: {
    onSubmit(event) {
      let data = formSerialize(event.target, {
        hash: false,
        empty: true,
      });
      data += "&user_id_loggin=" + this.user_id_loggin;
      axios
        .post("/api/reports/save", data, {
          headers: { "X-Requested-With": "XMLHttpRequest" },
        })
        .then((response) => {
          // Redirect on success
          console.log(response);
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
  created() {
    if (this.$session.exists()) {
      this.user_id_loggin = this.$session.get("user_id");
    }
  },
};
</script>
