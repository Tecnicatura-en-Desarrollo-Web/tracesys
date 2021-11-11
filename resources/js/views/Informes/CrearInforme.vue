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
            <div class="col-lg-4 col-12">
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
            <div class="col-lg-1 col-12">
              <div class="form-group">
                <label for="product_name"
                  >C. Pais<small
                    class="font-weight-bold text-primary"
                    id="obligatory_field"
                    >*</small
                  ></label
                >
                <input type="number" class="form-control" name="codigo_pais" />
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
                <input type="number" class="form-control" name="codigo_area" />
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
                <input type="number" class="form-control" name="telefono" />
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
                  type="email"
                  class="form-control"
                  name="email"
                  v-model="email"
                  @change="validacionEmail($event)"
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
        .post("/api/reports/add", data, {
          headers: { "X-Requested-With": "XMLHttpRequest" },
        })
        .then((response) => {
          console.log("aca lee jonaaa", response.data);
          //******Guardamos en la data los datos necesarios para crear un nuevo estado */
          data += "&idInforme=" + response.data.idReporte;
          data += "&idEmpleado=" + response.data.idEmpleado;
          data += "&cuitEmpleado=" + response.data.cuitEmpleado;
          data += "&selectSector=" + 2;
          //****************************************************************************/
          console.log(response);
          this.$swal({
            title: "Informe cargado correctamente",
            type: "success",
            timer: 1500,
          }).then((result) => {
            /* this.registrarCambioEstado(data); */
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
          console.log(response);
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
          console.log(response.data);
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
      if (cantidad != 3 || cantidadCaracteres != 13) {
        mensaje.className = "validation d-block";
      } else {
        mensaje.className = "validation d-none";
      }
    },
    validacionEmail(event) {
      let email = event.target.value;
      let mensaje = document.getElementById("mensajeErrorEmail");
      if (
        (email.includes("@") && email.includes(".com")) ||
        (email.includes("@") && email.includes(".ar"))
      ) {
        mensaje.className = "validation d-none";
      } else {
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
</style>
