<template>
  <div>
    <ul>
      <div class="posts view large-10 medium-8 columns contenido-central">
        <!-- <h1>Listado de informes</h1> -->
        <div class="card2 p-0 shadow-sm p-3 mb-5 bg-body rounded">
          <h3 class="card-title">Listado de respuestos</h3>
          <div class="card-body table-full-width">
            <!--             <div class="row px-4">
              <div class="col col-lg-3">
                <input
                  type="text"
                  class="botonFiltro"
                  name="filtroFecha"
                  v-model="filtroPorFecha"
                  placeholder="Filtrar por fecha"
                />
              </div>
              <div class="col col-lg-3">
                <input
                  type="text"
                  class="botonFiltro"
                  name="filtroProducto"
                  v-model="filtroPorProducto"
                  placeholder="Filtrar por producto"
                />
              </div>
              <div class="col col-lg-3">
                <input
                  type="text"
                  class="botonFiltro"
                  name="filtroMotivo"
                  v-model="filtroPorMotivo"
                  placeholder="Filtrar por motivo de reparacion"
                />
              </div>
            </div> -->

            <table class="table-striped p-4">
              <thead>
                <tr class="">
                  <th scope="col">#</th>
                  <th scope="col">Nombre</th>
                  <th scope="col">Stock</th>
                  <th scope="col">Accion</th>
                </tr>
              </thead>
              <tbody>
                <tr
                  v-for="(repuesto, index) in repuestos"
                  :key="repuesto.replacement_id"
                >
                  <td>{{ repuesto.replacement_id }}</td>
                  <td>{{ repuesto.descripcion }}</td>
                  <td>{{ repuesto.cantidad }}</td>
                  <td>
                    <b-icon-plus-circle-fill
                      class="iconoVerMas"
                      style="width: 20px; height: 20px"
                      data-bs-toggle="modal"
                      :data-bs-target="`#demo${index}`"
                    ></b-icon-plus-circle-fill>
                    <form @submit.prevent="onSubmit">
                      <div
                        class="modal fade"
                        :id="'demo' + index"
                        tabindex="-1"
                        aria-labelledby="exampleModalLabel"
                        aria-hidden="false"
                      >
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">
                                {{ repuesto.descripcion }}
                              </h5>
                              <button
                                type="button"
                                class="btn-close"
                                data-bs-dismiss="modal"
                                aria-label="Close"
                              ></button>
                            </div>
                            <div class="modal-body">
                              <div class="col-12">
                                <div class="form-group">
                                  <label for="product_name">Stock</label>
                                  <input
                                    type="number"
                                    class="form-control"
                                    name="cantidad"
                                    placeholder="Ingrese el nuevo stock"
                                  />
                                  <input
                                    type="hidden"
                                    v-bind:value="repuesto.replacement_id"
                                    name="replacement_id"
                                  />
                                </div>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="submit" class="boton-classic">
                                Guardar
                              </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </ul>
  </div>
</template>
<script>
import formSerialize from "form-serialize";
export default {
  data() {
    return {
      repuestos: [],
    };
  },
  mounted() {
    this.obtenerRepuestos();
  },
  methods: {
    obtenerRepuestos() {
      axios.get("/api/replacements").then((response) => {
        this.repuestos = response.data;
      });
    },
    onSubmit(event) {
      let data = formSerialize(event.target, {
        hash: false,
        empty: true,
      });
      console.log(data);
      axios
        .post(`/api/replacements/edit`, data, {
          headers: { "X-Requested-With": "XMLHttpRequest" },
        })
        .then((response) => {
          if (response.data.message) {
            this.$swal({
              title: "Stock actualizado correctamente",
              type: "success",
              timer: 1500,
            }).then((result) => {
              window.location.href = "http://localhost:8765/home";
            });
          } else {
            this.$swal({
              title: "Ha ocurrido un error al intentar actualizar el stock",
              type: "error",
              timer: 1500,
            });
          }
        });
    },
  },
  created() {
    /*     if (!this.$session.exists()) {
      this.nombre_sector = "asdasd";
      this.$router.push("/login");
      console.log("saaale", nombre_sector);
    }
    if (this.$session.exists()) {
      this.nombre_sector = this.$session.get("nombre_sector");
      this.empleado_stage_id = this.$session.get("etapa_id");
      this.empleado_sector_id = this.$session.get("sector_id");
      this.empleado_id = this.$session.get("user_id");
    } */
  },
};
</script>
<style>
.card2 {
  margin-top: 40px;
  margin-left: 40px;
  margin-right: 60px;
}
.table-full-width {
  margin-left: -32px;
  margin-right: -32px;
}
.card-header {
  background-color: white;
}
.colorp {
  color: rgb(90, 90, 90);
}
.iconoVerMas {
  opacity: 0.6;
  color: #303030;
  margin-top: 2px;
}
.iconoVerMas :hover {
  opacity: 1;
  color: #198754;
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
.botonFiltro:hover {
  border-color: #bdbdbd;
  box-shadow: none;
}
.botonFiltro:focus {
  outline: none !important;
  box-shadow: 0 0 2px #3b697885;
}
</style>



