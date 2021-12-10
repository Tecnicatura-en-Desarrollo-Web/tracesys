<template>
  <div class="posts view large-10 medium-8 columns contenido-central">
    <div class="card4 p-0 shadow-sm p-3 mb-5 bg-body rounded">
      <h3 class="card-title">Cargar Informe</h3>
      <div class="card-body">
        <!-- <div class="large-10 medium-8 columns contenido-central-crear"> -->
        <!-- <h1>Cargar Informe</h1> -->
        <form @submit.prevent="onSubmit">
          <div class="row callout callout-danger">
            <h5>Datos del cliente</h5>
            <div class="col-lg-2 col-12">
              <div class="form-group">
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
                  required
                />
                <div
                  class="validation d-none"
                  style="color: red; margin-bottom: 20px"
                  id="mensajeError"
                >
                  <small>Ingrese un cuit valido</small>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-12">
              <div class="form-group">
                <label for="product_name"
                  >Nombre y apellido o razon social<small
                    class="font-weight-bold text-primary"
                    id="obligatory_field"
                    >*</small
                  ></label
                >
                <input
                  id="denominacion"
                  type="text"
                  class="form-control"
                  name="denominacion"
                  required
                />
              </div>
            </div>
            <div class="col-lg-1 col-12">
              <div class="form-group">
                <label for="product_name"
                  >C. Pais<small
                    class="font-weight-bold text-primary"
                    id="obligatory_field"
                    >*</small
                  ></label
                >
                <input
                  id="codigo_pais"
                  type="number"
                  class="form-control"
                  name="codigo_pais"
                />
              </div>
            </div>
            <div class="col-lg-2 col-12">
              <div class="form-group">
                <label for="product_name"
                  >Codigo Area<small
                    class="font-weight-bold text-primary"
                    id="obligatory_field"
                    >*</small
                  ></label
                >
                <input
                  id="codigo_area"
                  type="number"
                  class="form-control"
                  name="codigo_area"
                  required
                />
              </div>
            </div>
            <div class="col-lg-3 col-12">
              <div class="form-group">
                <label for="product_name"
                  >Telefono<small
                    class="font-weight-bold text-primary"
                    id="obligatory_field"
                    >*</small
                  ></label
                >
                <input
                  id="telefono"
                  type="number"
                  class="form-control"
                  name="telefono"
                />
              </div>
            </div>
            <div class="col-lg-6 col-12">
              <div class="form-group">
                <label for="product_name"
                  >Email<small
                    class="font-weight-bold text-primary"
                    id="obligatory_field"
                    >*</small
                  ></label
                >
                <input
                  id="email"
                  type="email"
                  class="form-control"
                  name="email"
                  v-model="email"
                  @change="validacionEmail($event)"
                  required
                />
                <div
                  class="validation d-none"
                  style="color: red; margin-bottom: 20px"
                  id="mensajeErrorEmail"
                >
                  <small>Ingrese un email valido</small>
                </div>
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
                <input
                  id="direccion"
                  type="text"
                  class="form-control"
                  name="direccion"
                  required
                />
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
                <input type="text" class="form-control" name="tipo" required />
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
                <input type="text" class="form-control" name="marca" required />
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
                <input
                  type="text"
                  class="form-control"
                  name="modelo"
                  required
                />
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
                <input
                  type="text"
                  class="form-control"
                  name="motivo"
                  id="motivo"
                  @input="debounceSearch"
                  placeholder="Ingrese problema , por ejemplo Pantalla rota"
                  autocomplete="off"
                />

                <transition name="slide-fade">
                  <div v-if="existenProblemas" @keyup.13="ocultarCuadrito">
                    <select
                      name=""
                      class="selectSinonimos form-select"
                      size="5"
                      v-model="motivo"
                    >
                      <option
                        v-for="sinonimo in sinonimos"
                        :key="sinonimo.issue.issue_id"
                        v-bind:value="sinonimo.issue.titulo"
                      >
                        {{ sinonimo.issue.titulo }}
                      </option>
                    </select>

                    <div id="emailHelp" class="form-text">
                      Sugerencias existentes ordenadas por la mas acertada
                    </div>
                  </div>
                </transition>
                <div v-if="escribiendo && realizoBusqueda == false">
                  <span class="visually-show">buscando sugerencias...</span>
                  <div
                    class="colorSpinner spinner-border spinner-border-sm"
                    role="status"
                  ></div>
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
                    required
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
                    required
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
                  required
                />
              </div>
            </div>
          </div>
          <div class="col-12 d-flex justify-content-center mt-3">
            <button type="submit" class="boton-classic" id="button_submit">
              Crear
            </button>
          </div>
        </form>
        <!-- </div> -->
      </div>
    </div>
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
      motivo: null,
      cuit: "",
      email: "",
      sinonimos: [],
      existenProblemas: false,
      realizoBusqueda: false,
      detenerSpiner: false,
      escribiendo: false,
      message: null,
      typing: null,
      debounce: null,
      cliente: "",
    };
  },

  methods: {
    debounceSearch(event) {
      clearTimeout(this.debounce);
      this.debounce = setTimeout(() => {
        this.escribiendo = true;
        this.motivo = null;
        this.buscarProblemasSimilares(event.target.value);
      }, 700);
    },
    ocultarCuadrito() {
      this.existenProblemas = false;
    },
    buscarProblemasSimilares(stringMotivo) {
      axios
        .post(`/api/issues/verificarExistencia/${stringMotivo}`, {
          headers: { "X-Requested-With": "XMLHttpRequest" },
        })
        .then((response) => {
          this.realizoBusqueda = true;
          this.sinonimos = response.data.sinonimos;

          if (
            typeof this.sinonimos === "undefined" ||
            this.sinonimos.length == 0
          ) {
            this.existenProblemas = false;
            this.escribiendo = false;
          } else {
            this.existenProblemas = true;
          }
        });
    },
    onSubmit(event) {
      let data = formSerialize(event.target, {
        hash: false,
        empty: true,
      });
      if (this.motivo != null) {
        data += "&motivo=" + this.motivo;
      }
      data += "&user_id_loggin=" + this.user_id_loggin;
      axios
        .post("/api/reports/add", data, {
          headers: { "X-Requested-With": "XMLHttpRequest" },
        })
        .then((response) => {
          //******Guardamos en la data los datos necesarios para crear un nuevo estado */
          data += "&idInforme=" + response.data.idReporte;
          data += "&idEmpleado=" + response.data.idEmpleado;
          data += "&cuitEmpleado=" + response.data.cuitEmpleado;
          data += "&selectSector=" + 2;

          //****************************************************************************/
          this.$swal({
            title: "Informe cargado correctamente",
            type: "success",
            timer: 1500,
          }).then((result) => {
            this.registrarCambioEstado(data);
            window.location = "http://localhost:8765/reports";
          });
        })
        .catch((error) => {
          this.$swal({
            title: "Ha ocurrido un error al cargar el informe",
            type: "success",
            timer: 1500,
          });
        });
    },
    registrarCambioEstado(data) {
      axios
        .post(`/api/informeempleadoestados/save`, data, {
          headers: { "X-Requested-With": "XMLHttpRequest" },
        })
        .then((response) => {
          // Seteo el comentario default "se envia al diagnostico" en la data
          data += "&idComentarioEmpleado=" + 1;
          this.registrarComentarioDefault(data);
        })
        .catch((error) => {
          this.$notify({
            group: "default",
            type: "error",
            text: error.response.data.message,
          });
          this.errors.add(error.response.data.errors);
        });
    },
    registrarComentarioDefault(data) {
      axios
        .post("/api/informeempleadocomentarios/save", data, {
          headers: { "X-Requested-With": "XMLHttpRequest" },
        })
        .then((response) => {
          if (response.data.message) {
            this.$swal({
              title: "Informe creado",
              type: "success",
              timer: 1500,
            });
          }
        });
    },
    validacionCuit(event) {
      let valor = event.target.value;
      let cantidadCaracteres = valor.length;
      let cantidad = valor.split("-").length;
      let mensaje = document.getElementById("mensajeError");
      let botonSubmit = document.getElementById("button_submit");
      if (cantidad != 3 || cantidadCaracteres != 13) {
        botonSubmit.disabled = true;
        mensaje.className = "validation d-block";
      } else {
        /* Una vez ingresado correctamente el cuit busco la info si existe el cliente o no */
        axios
          .get("/api/clients/view/" + valor)
          .then((response) => {
            return response.data[0];
          })
          .then((cliente) => {
            if (cliente != null) {
              let telefono_completo = String(cliente.telefono);
              let longitud = telefono_completo.length;

              let codigo_pais = telefono_completo.substr(0, 2);
              let codigo_area = telefono_completo.substr(2, 3);
              let telefono = telefono_completo.substr(5, longitud);

              document.getElementById("denominacion").value =
                cliente.denominacion;
              document.getElementById("codigo_pais").value = codigo_pais;
              document.getElementById("codigo_area").value = codigo_area;
              document.getElementById("telefono").value = cliente.telefono;
              document.getElementById("email").value = cliente.email;
              document.getElementById("direccion").value = cliente.domicilio;
            }
          });
        botonSubmit.disabled = false;
        mensaje.className = "validation d-none";
      }
    },
    validacionEmail(event) {
      let email = event.target.value;
      let mensaje = document.getElementById("mensajeErrorEmail");
      let botonSubmit = document.getElementById("button_submit");
      if (
        (email.includes("@") && email.includes(".com")) ||
        (email.includes("@") && email.includes(".ar"))
      ) {
        botonSubmit.disabled = false;
        mensaje.className = "validation d-none";
      } else {
        botonSubmit.disabled = true;
        mensaje.className = "validation d-block";
      }
    },
  },
  /*   validacionCodigoPais(event) {
    let codigoPais = event.target.value;
  },
  validacionCodigoArea(event) {}, */
  created() {
    if (this.$session.exists()) {
      this.user_id_loggin = this.$session.get("user_id");
    }
  },
};
</script>
<style>
.card4 {
  margin-top: 40px;
  margin-right: 40px;
  margin-left: 80px;
}
.table-full-width2 {
  margin-left: -32px;
  margin-right: -32px;
}
.selectSinonimos {
  height: 80px;
}

/* *****animaciones para sugerencias de problemas****** */

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
