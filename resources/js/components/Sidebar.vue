<template>
    <nav class="large-2 columns bg-dark ">
        <ul class="side-nav ">
            <li>
                <router-link to="/home">Home</router-link>
            </li>
            <li>
                <router-link to="/posts">Post</router-link>
            </li>
            <li>
                <router-link to="informes">Informes</router-link>
            </li>
        </ul>
    </nav>
</template>

<script>
    export default {
        data() {
            return {
                actions: []
            };
        },
        mounted() {
            axios.get('/api/routes/get-sidebar')
                .then(response => {
                    console.log(this.actions.routeName);
                    this.actions = response.data;
                })
                .catch(error => {
                    console.log('Error: ' + error);
                });
        }
    }
</script>
