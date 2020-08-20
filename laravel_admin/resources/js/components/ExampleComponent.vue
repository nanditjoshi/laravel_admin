<template>
    <div>{{name}}</div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.', this)
        },
        props: {
            name: String
        }
    }
</script>
