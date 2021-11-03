<template>
  <div class="d-flex justify-content-center mt-5">
    <div
      class="card p-3 shadow-lg p-3 mb-5 bg-white rounded"
      style="width: 50rem"
    >
      <h2 class="text-center">Crear sugerencia</h2>
      <form class="row g-3" @submit.prevent="onSubmit" novalidate="novalidate">
        <div class="col-md-6">
          <label for="validationDefault02" class="form-label"
            >Nombre Sugerencia</label
          >
          <input
            type="text"
            class="form-control"
            name="nombre_sugerencia"
            required
          />
        </div>
        <div class="col-md-3">
          <label for="validationDefault06" class="form-label">Valor</label>
          <input type="text" class="form-control" name="valorPrecio" required />
        </div>
        <div class="col-md-3">
          <label for="validationDefault06" class="form-label"
            >Sector al que pertenece</label
          >
          <select
            v-model="primerSelect"
            class="form-select form-select-sm"
            name="sector_id"
            required
          >
            <option
              v-for="sector in sectores"
              v-bind:value="sector.sector_id"
              v-on:click="obtenerProblemas"
            >
              {{ sector.nombre_sector }}
            </option>
          </select>
        </div>
        <div class="col-12">
          <label for="validationDefault06" class="form-label"
            >Descripcion</label
          >
          <textarea
            type="text"
            class="form-control"
            name="descripcion_sugerencia"
            required
          />
        </div>
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
      problemas: [],
      sectores: [],
      cantSectores: 0,
      primerSelect: 0,
    };
  },
  mounted() {
    /* this.obtenerProblemas(); */
    this.obtenerCantSectores();
  },
  methods: {
    obtenerProblemas() {
      console.log("hola perri");
      /* console.log("hola man");
      axios.get("/api/issues/obtenerProblemas").then((response) => {
        this.problemas = response.data.issues;
      }); */
    },
    obtenerCantSectores() {
      axios.get("/api/sectors/obtenerEstadosDeEtapa/3").then((response) => {
        this.sectores = response.data.sectores;
        this.cantSectores = response.data.sectores.length;
      });
    },
    onSubmit(event) {
      let data = formSerialize(event.target, {
        hash: false,
        empty: true,
      });

      axios
        .post("/api/suggestions/add", data, {
          headers: { "X-Requested-With": "XMLHttpRequest" },
        })
        .then((response) => {
          console.log(response);
          if (response.data.message) {
            this.$swal({
              title: "Sugerencia creada",
              type: "success",
              timer: 1500,
            }).then((result) => {
              window.location.href = "http://localhost:8765/home";
            });
          }
        });
    },
  },
};
</script>
