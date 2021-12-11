<template>
  <div>
    <ul>
      <div class="posts view large-10 medium-8 columns contenido-central">
        <!-- <h1>Listado de informes</h1> -->
        <div class="card2 p-0 shadow-sm p-3 mb-5 bg-body rounded">
          <h3 class="card-title">Listado de empleados</h3>
          <div class="card-body table-full-width">
            <div class="row px-4">
                <div class="col col-lg-3">
                    <input
                    type="text"
                    class="botonFiltro"
                    name="filtroCuit"
                    v-model="filtroPorCuit"
                    placeholder="Filtrar por cuit"
                    />
                </div>
                <div class="col col-lg-3">

                    <input
                    type="text"
                    class="botonFiltro"
                    name="filtroApellido"
                    v-model="filtroPorApellido"
                    placeholder="Filtrar por apellido"
                    />
                </div>
                <div class="col col-lg-3">
                    <input
                    type="text"
                    class="botonFiltro"
                    name="filtroNombre"
                    v-model="filtroPorNombre"
                    placeholder="Filtrar por nombre"
                    />
                </div>
                <div class="col col-lg-3">
                    <input
                    type="text"
                    class="botonFiltro"
                    name="filtroSector"
                    v-model="filtroPorSector"
                    placeholder="Filtrar por sector"
                    />
                </div>

            </div>

            <table class="table-striped p-4">
              <thead>
                <tr class="">
                  <th scope="col">#</th>
                  <th scope="col">Cuit</th>
                  <th scope="col">Apellido</th>
                  <th scope="col">Nombre</th>
                  <th scope="col">Perfil</th>
                  <th scope="col">Sector</th>
                  <th scope="col">Editar</th>
                </tr>
              </thead>
              <tbody>
                <tr
                  v-for="(empleado, index) in empleados"
                  :key="empleado.employee_id"
                  v-if="
                    empleado.user.nombre
                      .toLowerCase()
                      .includes(filtroPorNombre.toLowerCase()) &&
                    empleado.user.apellido
                      .toLowerCase()
                      .includes(filtroPorApellido.toLowerCase())&&
                    empleado.user.cuit
                      .toLowerCase()
                      .includes(filtroPorCuit.toLowerCase())&&
                    empleado.user.sector.nombre_sector
                      .toLowerCase()
                      .includes(filtroPorSector.toLowerCase())
                  "

                >
                  <td>{{ empleado.employee_id }}</td>
                  <td>{{ empleado.user.cuit }}</td>
                  <td>{{ empleado.user.apellido }}</td>
                  <td>{{ empleado.user.nombre }}</td>
                  <td>{{ empleado.profile.nombre_perfil }}</td>
                  <td>{{ empleado.user.sector.nombre_sector }}</td>
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
                                {{ empleado.user.apellido}} {{empleado.user.nombre }}
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
                                  <label for="product_name">Cambiar sector</label>
                                    <multiselect
                                    name="selectSector"
                                    :options="sectores"
                                    label="nombre_sector"
                                    v-model="selectSector"
                                    :searchable="false"
                                    open-direction="bottom"
                                    :close-on-select="true"
                                    :show-labels="false"
                                    :block-keys="['Tab', 'Enter']"
                                    :hide-selected="true"
                                    deselect-label="Can't remove this value"
                                    placeholder="Seleccione un sector"
                                    >
                                    </multiselect>
                                </div>
                                <input
                                    type="hidden"
                                    v-bind:value="empleado.employee_id"
                                    name="empleado_id"
                                  />
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
    data(){
        return{
            empleados:[],
            filtroPorNombre:'',
            filtroPorApellido:'',
            filtroPorSector:'',
            filtroPorCuit:'',
            sectores:[],
            selectSector:null

        }
    },
    created(){
        this.obtenerEmpleados();
        this.obtenerSectores();
    },
    methods: {
        obtenerSectores() {
      axios
        .get(
          `/api/sectors/obtenerSectoresPorEtapa/${this.$session.get(
            "etapa_id"
          )}`
        )
        .then((response) => {
          this.sectores = response.data.sectors;
          console.log(this.sectores);
        })
        .catch((error) => {
          console.log("Error: " + error);
        });
    },
        obtenerEmpleados(){
            axios.get("/api/employees").then((response) => {
                this.empleados = response.data;
                console.log(this.empleados);
      });
        },
    onSubmit(event) {
        let data = formSerialize(event.target, {
            hash: false,
            empty: true,
        });
        data += "&selectSector=" + this.selectSector.sector_id;
        axios
            .post(`/api/employees/edit`, data, {
            headers: { "X-Requested-With": "XMLHttpRequest" },
            })
            .then((response) => {
            if (response.data.message) {
                this.$swal({
                title: "El empleado se cambio de sector correctamente",
                type: "success",
                timer: 1500,
                }).then((result) => {
                window.location.href = "http://localhost:8765/empleados";
                });
            } else {
                this.$swal({
                title: "Ha ocurrido un error al intentar actualizar el sector",
                type: "error",
                timer: 1500,
                });
            }
            });
        },
    },
}
</script>
