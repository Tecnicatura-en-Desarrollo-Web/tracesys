<template>
  <div>
    <div class="d-flex justify-content-center mt-5">
      <div>
        <div class="mb-5">
          <img src="../../../img/LogoTracesys.png" alt="Logo del sistema" />
        </div>
        <div
          class="card p-3 shadow-lg p-3 mb-5 bg-white rounded"
          style="width: 18rem"
        >
          <div class="columns align-content-end">
            <form method="POST" @submit.prevent="iniciarSesion">
              <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input
                  type="email"
                  class="form-control"
                  id="username2"
                  name="email"
                  placeholder="Ingrese email"
                />
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input
                  type="password"
                  class="form-control"
                  id="password2"
                  name="contrasena"
                  placeholder="Ingrese Password"
                />
              </div>
              <div class="d-flex justify-content-center">
                <button
                  type="submit"
                  class="boton-classic"
                  @click="mostrarMensaje()"
                >
                  Iniciar Sesion
                </button>
              </div>
            </form>
            <div>
              <hr />
              <!-- <div v-show="!login" class="alert alert-danger" :class="colorAlerta" role="alert">
                        {{mensaje}}
                    </div> -->
            </div>
          </div>
        </div>
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
      // email:'',
      // contrasena:'',
      login: false,
      mensaje: "",
      errors: new Errors(),
    };
  },
  methods: {
    showAlert() {
      // Use sweetalert2
      /*  this.$swal("Inicio de sesion verificado!"); */
      /* this.Swal.fire("Any fool can use a computer"); */
    },
    iniciarSesion(event) {
      let data = formSerialize(event.target, {
        hash: false,
        empty: true,
      });
      axios
        .post("/api/users/login", data, {
          headers: { "X-Requested-With": "XMLHttpRequest" },
        })
        .then((response) => {
          if (response.data.message) {
            //***Mensaje de notificacion si llego una respuesta******//
            this.$swal({
              title: "Inicio de sesion verificado",
              type: "success",
              timer: 1500,
            }).then((result) => {
              //***Seteo true en la variable login******//
              this.login = true;
              //***Se inicia session******//
              this.$session.start();
              //***Seteo el nombre del usuario logueado en la variable sesion para mostrar su nombre en su home******
              this.$session.set("nombreDeUsuario", response.data.user);
              this.$session.set("user_id", response.data.user_id);
              this.$session.set("cuit", response.data.cuit);
              this.$session.set("nombre_sector", response.data.nombre_sector);
              this.$session.set("nombre_etapa", response.data.nombre_etapa);
              this.$session.set("sector_id", response.data.sector_id);
              this.$session.set("etapa_id", response.data.etapa_id);
              //***Redirigimos al usuario a su lista de informes******//
              window.location.href = "http://localhost:8765/home";
            });
          } else {
            this.$swal({
              title: "Datos incorrectos. Recuerde activar la cuenta",
              type: "error",
              timer: 1500,
            });
          }
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
    mostrarMensaje() {
      if (!this.$session.exists()) {
        this.mensaje = "Datos incorrectos , intente nuevamente";
      } else {
        this.mensaje = "Sesion iniciada correctamente";
      }
    },
  },

  created() {
    if (this.$session.exists()) {
      this.$router.push("/");
    }
  },
};
</script>
