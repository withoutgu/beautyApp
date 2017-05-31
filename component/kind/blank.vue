<template>

</template>

<script>
    export default{
        data(){

        },
        mounted(){
            this.jump()
//            window.location.reload();
//            window.location.href = '#/index/collect'
        },
        methods:{
            jump(){
                window.location.href = '#/index/collect'
                window.location.reload();
            }

        }
    }
</script>

<style scoped>

</style>