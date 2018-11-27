<template>
    <h1>Page {{ num }}</h1>
</template>

<script>
    export default {

        data() {
            return {
                num: 0
            };
        },

        mounted() {
            this.num = this.$route.params.num;
        },

        watch: {
            '$route' (to, from) {
                this.num = to.params.num;
            }
        },

        beforeRouteUpdate (to, from, next) {
            console.log(this.num);
            next();
        }
    }
</script>
