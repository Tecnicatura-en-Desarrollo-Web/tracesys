<template>
  <div class="d-flex justify-content-center mt-5">
    <div
      class="card p-3 shadow-lg p-3 mb-5 bg-white rounded"
      style="width: 50rem"
    >
      <h2 class="text-center">Registro de usuario</h2>
      <form class="row g-3" @submit.prevent="onSubmit">
        <div class="col-md-6">
          <label for="validationDefault02" class="form-label">Nombre</label>
          <input
            type="text"
            class="form-control"
            name="nombre"
            v-model="nombre"
            required
          />
        </div>
        <div class="col-md-6">
          <label for="validationDefault03" class="form-label">Apellido</label>
          <input
            type="text"
            class="form-control"
            name="apellido"
            required
            v-model="apellido"
          />
        </div>
        <div class="col-md-3">
          <label for="validationDefault01" class="form-label">Cuit</label>
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
        <div class="col-md-3">
          <label for="validationDefault04" class="form-label">Telefono</label>
          <input
            type="number"
            class="form-control"
            name="telefono"
            v-model="telefono"
            required
          />
        </div>
        <div class="col-md-6">
          <label for="validationDefaultUsername" class="form-label"
            >Domicilio</label
          >
          <input
            type="text"
            class="form-control"
            name="domicilio"
            v-model="domicilio"
          />
        </div>
        <div class="col-md-12">
          <label for="validationDefault05" class="form-label">Email</label>
          <input
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
        <div class="col-md-6">
          <label for="validationDefault06" class="form-label">Usuario</label>
          <input
            type="text"
            class="form-control"
            name="usuario"
            v-model="usuario"
            required
          />
        </div>
        <div class="col-md-6">
          <label for="validationDefault07" class="form-label">Contraseña</label>
          <input
            type="password"
            class="form-control"
            name="password"
            v-model="password"
            required
          />
        </div>
        <div class="col-12 d-flex justify-content-center">
          <button class="boton-classic" type="submit" id="button_submit">
            Registrarse
          </button>
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
      cuit: "",
      nombre: "",
      apellido: "",
      domicilio: "",
      telefono: "",
      email: "",
      usuario: "",
      password: "",
      sector_id: 2,
      errors: new Errors(),
    };
  },
  methods: {
    onSubmit(event) {
      let data = formSerialize(event.target, {
        hash: false,
        empty: true,
      });
      console.log(data);
      data += "&sector_id=" + this.sector_id;
      axios
        .post("/api/users/save", data, {
          headers: { "X-Requested-With": "XMLHttpRequest" },
        })
        .then((response) => {
          // Redirect on success
          console.log(response.data);
          if (response.data.success) {
            this.$swal({
              title: "Usuario registrado con exito",
              type: "success",
              timer: 1500,
            }).then((resp) => {
              this.$router.push({ path: response.data.url });
            });
          } else {
            this.$swal({
              title:
                "Por favor verifica los datos y que haya cargado todos correctamente",
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
  created() {
    if (this.$session.exists()) {
      this.$router.push("/");
    }
  },
};
</script>

