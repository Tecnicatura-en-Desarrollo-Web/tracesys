<template>
  <div class="d-flex justify-content-center mt-5 contenido-central">
    <div
      class="card p-3 shadow-lg p-3 mb-5 bg-white rounded"
      style="width: 50rem"
    >
      <h2 class="text-center">Cargar proveedor</h2>
      <form class="row g-3" @submit.prevent="onSubmit" novalidate="novalidate">
        <div class="col-md-6">
          <label for="validationDefault02" class="form-label"
            >Nombre Proveedor</label
          >
          <input type="text" class="form-control" name="nombre" required />
        </div>
        <div class="col-md-6">
          <label for="validationDefault06" class="form-label">Email</label>
          <input type="email" class="form-control" name="email" required />
        </div>
        <div class="col-md-6">
          <label for="validationDefault06" class="form-label"
            >Seleccione los repuestos que provee</label
          >
          <select
            multiple
            class="select-proveedor form-select form-select-sm"
            aria-label=".form-select-sm example"
            name="repuestosSeleccionados[]"
            required
          >
            <option disabled>-</option>
            <option
              v-for="repuesto in repuestos"
              v-bind:value="repuesto.replacement_id"
            >
              {{ repuesto.descripcion }}
            </option>
          </select>
        </div>
        <div class="col-md-6">
          <label for="product_name"
            >CUIT<small
              class="font-weight-bold text-primary"
              id="obligatory_field"
              >*</small
            ></label
          >
          <input
            type="text"
            class="form-control"
            name="cuit"
            v-model="cuit"
            @change="validacionCuit($event)"
          />
          <div
            class="validation d-none"
            style="color: red; margin-bottom: 20px"
            id="mensajeError"
          >
            <small>Ingrese un cuit valido</small>
          </div>
        </div>
        <div class="col-lg-2 col-12"></div>
        <div class="col-12 d-flex justify-content-center">
          <button class="boton-classic" type="submit">Cargar</button>
        </div>
      </form>
    </div>
  </div>
</template>
<script>
import formSerialize from "form-serialize";
import Errors from "../../helpers/FormErrors.js";

export default {
  data() {
    return {
      cuit: "",
      repuestos: [],
      idProveedor: 0,
    };
  },
  mounted() {
    this.obtenerRepuestos(this.$route.query);
  },
  methods: {
    obtenerRepuestos(query) {
      axios.get("/api/replacements", { params: query }).then((response) => {
        this.repuestos = response.data;
      });
    },
    relacionarRepuestosProveedor(query, data) {
      console.log(data);
      /* axios
        .post("/api/replacements/add", data, {
          headers: { "X-Requested-With": "XMLHttpRequest" },
        })
        .then((response) => {
          console.log(response);
        }); */
    },
    onSubmit(event) {
      let data = formSerialize(event.target, {
        hash: false,
        empty: true,
      });

      axios
        .post("/api/providers/add", data, {
          headers: { "X-Requested-With": "XMLHttpRequest" },
        })
        .then((response) => {
          this.idProveedor = response.data.idProveedor;
          if (response.data.message) {
            data += "&idProveedor=" + this.idProveedor;
            console.log(data);
            axios
              .post("/api/proveedorrepuestos/add", data, {
                headers: { "X-Requested-With": "XMLHttpRequest" },
              })
              .then((response) => {
                if (response.data.message) {
                  this.$swal({
                    title: "Proveedor cargado correctamente",
                    type: "success",
                    timer: 1500,
                  }).then((result) => {
                    window.location.href = "http://localhost:8765/home";
                  });
                }
              });
            /* this.relacionarRepuestosProveedor(this.$route.query, data); */
            /* this.$swal({
              title: "Proveedor cargado correctamente",
              type: "success",
              timer: 1500,
            }).then((result) => {
              window.location.href = "http://localhost:8765/home";
            }); */
          }
        });
    },
    validacionCuit(event) {
      let valor = event.target.value;
      let cantidadCaracteres = valor.length;
      let cantidad = valor.split("-").length;
      let mensaje = document.getElementById("mensajeError");
      if (cantidad != 3 || cantidadCaracteres != 13) {
        mensaje.className = "validation d-block";
      } else {
        mensaje.className = "validation d-none";
      }
    },
  },
};
</script>
<style>
.select-proveedor {
  height: 80px;
}
</style>
