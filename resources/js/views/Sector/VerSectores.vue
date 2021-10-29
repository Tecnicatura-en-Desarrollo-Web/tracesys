<template>
  <div class="d-flex justify-content-center mt-5">
    <div
      class="card p-3 shadow-lg p-3 mb-5 bg-white rounded"
      style="width: 50rem"
    >
      <h2 class="text-center">Listado de sectores</h2>
      <form class="row g-3" @submit.prevent="onSubmit" novalidate="novalidate">
        <div class="col-md-6">
          <label for="validationDefault02" class="form-label"
            >Nombre Sector</label
          >
          <input type="text" class="form-control" v-model="nombre_sector" />
        </div>
        <div class="col-md-6">
          <label for="validationDefault06" class="form-label">Etapa</label>
          <input
            type="text"
            class="form-control"
            readonly
            value="Reparacion"
            placeholder="Reparacion"
          />
        </div>
        <div class="col-12 d-flex justify-content-center">
          <button class="boton-classic" type="submit">Registrarse</button>
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
      orden: [],
      etapa: 3,
      cantidadSectores: 0,
    };
  },
  mounted() {
    this.obtenerCantSectores(this.$route.query);
    console.log(cantidadSectores);
  },
  methods: {
    obtenerCantSectores(query) {
      var cantidadSectores = 0;

      if (query.sort !== "undefined" && query.direction) {
        this.defaultClass[query.sort] = query.direction;
      }
      axios
        .get("/api/sectors/obtenerEstadosDeEtapa/3", { params: query })
        .then((response) => {
          this.cantidadSectores = response.data.sectores.length;
        });
    },
  },
};
</script>
