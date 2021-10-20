<template>
  <div class="d-flex justify-content-center mt-5">
    <div class="card p-3" style="width: 30rem">
      <h3 class="text-center">Registro de usuario</h3>
      <form class="row g-3" novalidate="novalidate" @submit.prevent="onSubmit">
        <div class="col-md-6">
          <label for="validationDefault01" class="form-label">Nombre</label>
          <input
            type="text"
            class="form-control"
            name="nombre"
            value="Jona"
            v-model="nombre"
          />
        </div>
        <div class="col-md-6">
          <label for="validationDefault02" class="form-label">Apellido</label>
          <input
            type="text"
            class="form-control"
            name="apellido"
            value="Rios"
            v-model="apellido"
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
            value="Neuquen"
            v-model="domicilio"
          />
        </div>
        <div class="col-md-6">
          <label for="validationDefault03" class="form-label">Telefono</label>
          <input
            type="number"
            class="form-control"
            name="telefono"
            v-model="telefono"
          />
        </div>
        <div class="col-md-12">
          <label for="validationDefault04" class="form-label">Email</label>
          <input
            type="email"
            class="form-control"
            name="email"
            v-model="email"
          />
        </div>
        <div class="col-md-12">
          <label for="validationDefault05" class="form-label">Contraseña</label>
          <input
            type="password"
            class="form-control"
            name="contrasena"
            v-model="contraseña"
          />
        </div>
        <div class="col-12">
          <button class="btn btn-primary" type="submit">Registrarse</button>
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
        nombre: "",
        apellido: "",
        domicilio: "",
        telefono: "",
        email: "",
        contraseña: "",
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

        axios
            .post("/api/users/save", data, {
            headers: { "X-Requested-With": "XMLHttpRequest" },
            })
            .then((response) => {
            // Redirect on success
            console.log(response.data);
            if (response.data.success) {
                this.$notify({
                group: "default",
                type: "success",
                text: response.data.message,
                });

                this.$router.push({ path: response.data.url });
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
    },
    created(){
        if(this.$session.exists()){
            this.$router.push('/');
        }
    }

};
</script>

