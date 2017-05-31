<template>
    <div>
        <wheader></wheader>
        <router-view></router-view>
        <wfooter></wfooter>
    </div>
</template>
<script>
    import wheader from './construction/wheader.vue';
    import wfooter from './construction/wfooter.vue';
    export default{
        data(){
            return{}
        },
        components:{
            wheader,
            wfooter
        }
    }
</script>
<style scoped>

</style>