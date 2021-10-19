<template>
    <div class="posts form large-9 medium-8 columns content">
        <form method="post" novalidate="novalidate" @submit.prevent="onSubmit" >
            <fieldset>
                <legend>Add Post</legend>
                <div class="input text required">
                    <label for="title">Title</label>
                    <input type="text" name="title" v-model="title">
                    <h1>{{title}}</h1>
                </div>
                <div class="input textarea required">
                    <label for="description">Description</label>
                    <textarea name="description" rows="5" v-model="description"></textarea>
                </div>
                <button type="submit" class="button radius shadow primary" >Submit</button>

            </fieldset>
        </form>
    </div>
</template>

<script>
    import formSerialize from 'form-serialize';
    import Errors from '../../helpers/FormErrors.js';

    export default {
        data() {
            return {
                title: '',
                description: '',
                errors: new Errors()
            };
        },
        methods: {
            onSubmit(event) {
                let data = formSerialize(event.target, {
                    hash: false,
                    empty: true
                });

                axios.post('/api/posts/save', data, {
                        headers: {'X-Requested-With': 'XMLHttpRequest'}
                    })
                    .then(response => {
                        // Redirect on success
                        console.log(response);
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
