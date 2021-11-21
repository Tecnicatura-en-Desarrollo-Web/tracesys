<template>
  <div class="d-flex justify-content-center mt-5 contenido-central">
    <div
      class="card p-3 shadow-lg p-3 mb-5 bg-white rounded"
      style="width: 50rem"
    >
      <h2 class="text-center">Solicitar repuesto a proveedor</h2>
      <form class="row g-3" @submit.prevent="onSubmit" novalidate="novalidate">
        <div class="col-md-12">
          <label for="validationDefault02" class="form-label"
            >Nombre Proveedor o repuesto</label
          >
          <input
            type="text"
            class="form-control"
            id="motivo"
            @input="debounceSearch"
            placeholder="Ingrese nombre del repuesto"
            autocomplete="off"
          />
          <transition name="slide-fade">
            <div v-if="existenProveedores" @keyup.13="ocultarCuadrito">
              <select
                name="proveedor"
                class="selectProveedor form-select"
                size="5"
              >
                <option
                  v-for="repuesto in repuestos"
                  v-bind:value="repuesto[0].provider.provider_id"
                >
                  {{ repuesto[0].provider.nombre }}
                </option>
              </select>
            </div>
          </transition>
          <div v-if="escribiendo && realizoBusqueda == false">
            <span class="visually-show">buscando proveedores...</span>
            <div
              class="colorSpinner spinner-border spinner-border-sm"
              role="status"
            ></div>
          </div>
        </div>
        <div class="col-lg-6 col-12">
          <div class="form-group">
            <label for="product_name"
              >Cantidad<small
                class="font-weight-bold text-primary"
                id="obligatory_field"
                >*</small
              ></label
            >
            <input type="text" class="form-control" name="cantidad" />
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
              name="mensaje"
            />
          </div>
        </div>
        <div class="col-12 d-flex justify-content-center">
          <button class="boton-classic" type="submit">Enviar solicitud</button>
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
      nombre_sector: "",
      etapa: 3,
      orden: 4,
      apellido: "",
      domicilio: "",
      repuestos: [],
      existenProveedores: false,
      escribiendo: false,
      realizoBusqueda: false,
    };
  },
  methods: {
    debounceSearch(event) {
      clearTimeout(this.debounce);
      this.debounce = setTimeout(() => {
        this.escribiendo = true;
        this.buscarProveedorDeRepuesto(event.target.value);
      }, 700);
    },
    ocultarCuadrito() {
      this.existenProveedores = false;
    },
    buscarProveedorDeRepuesto(repuesto) {
      //console.log(repuesto);

      axios
        .post(`/api/proveedorrepuestos/buscarSimilitud/${repuesto}`, {
          headers: { "X-Requested-With": "XMLHttpRequest" },
        })
        .then((response) => {
          this.realizoBusqueda = true;
          console.log(response.data[0]);
          this.repuestos = response.data[0];

          if (
            typeof this.repuestos === "undefined" ||
            this.repuestos.length == 0
          ) {
            this.existenProveedores = false;
            this.escribiendo = false;
          } else {
            this.existenProveedores = true;
          }
        });
    },
    onSubmit(event) {
      let query = this.$route.query;

      if (query.sort !== "undefined" && query.direction) {
        this.defaultClass[query.sort] = query.direction;
      }

      let data = formSerialize(event.target, {
        hash: false,
        empty: true,
      });
      axios
        .post("/api/providers/solicitarPresupuesto", data, {
          headers: { "X-Requested-With": "XMLHttpRequest" },
        })
        .then((response) => {
          if (response.data.message) {
            this.$swal({
              title: "Presupuesto enviado",
              type: "success",
              timer: 1500,
            });
          }
        });
    },
  },
};
</script>

<style scoped>
.selectProveedor {
  height: 80px;
}

.slide-fade-enter-active {
  transition: all 0.5s ease;
}
.slide-fade-leave-active {
  transition: all 0.3s cubic-bezier(1, 0.5, 0.8, 1);
}
.slide-fade-enter, .slide-fade-leave-to
/* .slide-fade-leave-active below version 2.1.8 */ {
  transform: translateX(10px);
  opacity: 0;
}
.colorSpinner {
  color: #6d9886;
}
</style>