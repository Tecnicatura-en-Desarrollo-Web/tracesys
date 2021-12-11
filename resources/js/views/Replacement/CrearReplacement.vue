<template>
  <div class="d-flex justify-content-center mt-5 contenido-central">
    <div
      class="card p-3 shadow-lg p-3 mb-5 bg-white rounded"
      style="width: 50rem"
    >
      <h2 class="text-center">Cargar repuesto</h2>
      <form class="row g-3" @submit.prevent="onSubmit" novalidate="novalidate">
        <div class="col-md-6">
          <label for="validationDefault02" class="form-label">Nombre</label>
          <input type="text" class="form-control" name="descripcion" />
        </div>
        <div class="col-md-3">
          <label for="validationDefault02" class="form-label">Cantidad</label>
          <input type="number" class="form-control" name="cantidad" />
        </div>
        <div class="col-md-3">
          <label for="validationDefault02" class="form-label">Precio</label>
          <input type="number" class="form-control" name="valor" />
        </div>
        <div class="col-md-6">
          <label for="validationDefault02" class="form-label">Marca</label>
          <input type="text" class="form-control" name="marca" />
        </div>
        <div class="col-md-6">
          <label for="validationDefault02" class="form-label">Modelo</label>
          <input type="text" class="form-control" name="modelo" />
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

export default {
  data() {
    return {};
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
        .post("/api/replacements/add", data, {
          headers: { "X-Requested-With": "XMLHttpRequest" },
        })
        .then((response) => {
          console.log(response);
          if (response.data.message) {
            this.$swal({
              title: "Repuesto cargado correctamente",
              type: "success",
              timer: 1500,
            }).then((result) => {
              window.location.href =
                "http://localhost:8765/replacement/replacements";
            });
          }
        });
    },
  },
};
</script>
