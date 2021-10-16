<template>
    <nav class="large-3 columns">
        <ul class="side-nav bg-dark">
            <li>
                <router-link to="/home">Home</router-link>
            </li>
            <li>
                <router-link to="/posts">Post</router-link>
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
