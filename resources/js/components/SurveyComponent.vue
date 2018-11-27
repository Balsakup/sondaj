<template>
    <div>
        <div class="jumbotron">
            <h1>{{ name }}</h1>
            <p class="lead">{{ description }}</p>
        </div>

        <router-link to="" class="btn btn-block btn-lg btn-primary" @click="start">Démarrer</router-link>
        <router-view></router-view>
    </div>
</template>

<script>
    export default {

        props: [ 'json' ],

        data() {
            return {
                name       : null,
                description: null
            };
        },

        mounted() {
            this.name        = this.json.name;
            this.description = this.json.description;
        },

        methods: {
            start() {
                console.log('START')
            }
        }
    }
</script>
