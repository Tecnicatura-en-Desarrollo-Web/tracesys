<template>
  <div class="d-flex justify-content-center mt-5 contenido-central">
    <div
      class="card p-3 shadow-lg p-3 mb-5 bg-white rounded"
      style="width: 50rem"
    >
      <h2 class="text-center">Crear sector nuevo en etapa de reparación</h2>
      <form class="row g-3" @submit.prevent="onSubmit" novalidate="novalidate">
        <div class="col-md-6">
          <label for="validationDefault02" class="form-label"
            >Nombre Sector</label
          >
          <input
            type="text"
            class="form-control"
            name="nombre_sector"
            v-model="nombre_sector"
          />
        </div>
        <div class="col-md-6">
          <label for="validationDefault06" class="form-label">Etapa</label>
          <input
            type="text"
            class="form-control"
            name="etapa"
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
      nombre_sector: "",
      etapa: 3,
      orden: 4,
      apellido: "",
      domicilio: "",
    };
  },
  methods: {
    onSubmit(event) {
      var cantidadSectores = 0;
      let query = this.$route.query;

      if (query.sort !== "undefined" && query.direction) {
        this.defaultClass[query.sort] = query.direction;
      }

      let data = formSerialize(event.target, {
        hash: false,
        empty: true,
      });
      axios
        .get("/api/sectors/obtenerEstadosDeEtapa/3", { params: query })
        .then((response) => {
          cantidadSectores = response.data.sectores.length;
          data += "&orden=" + (cantidadSectores + 1) + "&stage_id=3";
          axios
            .post("/api/sectors/save", data, {
              headers: { "X-Requested-With": "XMLHttpRequest" },
            })
            .then((response) => {
              if (response.data.message) {
                this.$swal({
                  title: "Sector creado",
                  type: "success",
                  timer: 1500,
                }).then((result) => {
                  window.location.href = "http://localhost:8765/sector/ver";
                });
              }
            });
        });
    },
  },
};
</script>
