<template>
    <div>
        <router-view></router-view>
        <wheader></wheader>
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