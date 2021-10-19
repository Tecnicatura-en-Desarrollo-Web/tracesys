<template>
<div class="d-flex justify-content-center mt-5">
    <div class="card p-3" style="width: 30rem;">
        <h3 class="text-center">Registro de usuario</h3>
        <form class="row g-3" novalidate="novalidate" @submit.prevent="onSubmit" >
            <div class="col-md-6">
                <label for="validationDefault01" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre" value="Jona" v-model="nombre">
                {{nombre}}
            </div>
            <div class="col-md-6">
                <label for="validationDefault02" class="form-label">Apellido</label>
                <input type="text" class="form-control" name="apellido" value="Rios" v-model="apellido">
                {{apellido}}
            </div>
            <div class="col-md-6">
                <label for="validationDefaultUsername" class="form-label">Domicilio</label>
                <input type="text" class="form-control" name="domicilio" value="Neuquen" v-model="domicilio">
                {{domicilio}}
            </div>
            <div class="col-md-6">
                <label for="validationDefault03" class="form-label">Telefono</label>
                <input type="number" class="form-control" name="telefono" v-model="telefono">
                {{telefono}}
            </div>
            <div class="col-md-12">
                <label for="validationDefault04" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" v-model="email">
                {{email}}
            </div>
            <div class="col-md-12">
                <label for="validationDefault05" class="form-label">Contraseña</label>
                <input type="password" class="form-control" name="contrasena" v-model="contraseña">
                {{contraseña}}
            </div>
            <div class="col-12">
                <button class="btn btn-primary" type="submit">Registrarse</button>
            </div>
        </form>
    </div>
</div>
        <!-- <form method="post" novalidate="novalidate" @submit.prevent="onSubmit" >
            <fieldset>
                <legend>Add Post</legend>
                <div class="input text required">
                    <label for="title">Fecha</label>
                    <input type="text" name="fecha" v-model="fecha">
                    <h1>{{fecha}}</h1>
                </div>
                <div class="input text required">
                    <label for="title">Hora</label>
                    <input type="text" name="hora" v-model="hora">
                    <h1>{{hora}}</h1>
                </div>
                <div class="input text required">
                    <label for="title">Motivo</label>
                    <input type="text" name="motivo" v-model="motivo">
                    <h1>{{motivo}}</h1>
                </div>
                <div class="input text required">
                    <label for="title">Estado</label>
                    <input type="text" name="estado" v-model="estado">
                    <h1>{{estado}}</h1>
                </div>
                <button type="submit" class="button radius shadow primary" >Submit</button>

            </fieldset>
        </form> -->

</template>

<script>
    import formSerialize from 'form-serialize';
    import Errors from '../../helpers/FormErrors.js';

    export default {
        data() {
            return {
                nombre: '',
                apellido: '',
                domicilio: '',
                telefono: '',
                email: '',
                contraseña: '',
                errors: new Errors()
            };
        },
        methods: {
            onSubmit(event) {
                let data = formSerialize(event.target, {
                    hash: false,
                    empty: true
                });
                console.log(data);

                axios.post('/api/users/save', data, {
                        headers: {'X-Requested-With': 'XMLHttpRequest'}
                    })
                    .then(response => {
                        // Redirect on success
                        console.log(response.data);
                        if (response.data.success) {
                            this.$notify({
                                group: 'default',
                                type: 'success',
                                text: response.data.message
                            });

                            this.$router.push({ path: response.data.url });
                        }
                    })
                    .catch(error => {
                        this.$notify({
                            group: 'default',
                            type: 'error',
                            text: error.response.data.message
                        });

                        this.errors.add(error.response.data.errors);
                    });
            }
        },
    }
</script>

