<template>
  <div>
    <div class="d-flex justify-content-center mt-5">
      <div class="card p-3" style="width: 18rem">
        <div class="columns align-content-end">
          <form method="POST" @submit.prevent="iniciarSesion">
            <div class="form-group">
              <label for="exampleInputEmail1">Email address</label>
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
            <button
              type="submit"
              class="btn btn-primary"
              @click="mostrarMensaje()"
            >
              Inicar Sesion
            </button>
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
            this.$notify({
              group: "default",
              type: "success",
              text: response.data.message,
            });
            //***Seteo true en la variable login******//
            this.login = true;
            console.log(response.data);
            //***Se inicia session******//
            this.$session.start();
            //***Seteo el nombre del usuario logueado en la variable sesion para mostrar su nombre en su home******
            this.$session.set(this.$session.id(), response.data.user);
            this.$session.set("user_id", response.data.user_id);
            this.$session.set("nombre_etapa", response.data.nombre_etapa);
            //***Redirigimos al usuario a su lista de informes******//
            window.location.href = "http://localhost:8765/home";
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
      console.log("metodo mostrarmensaje");
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
