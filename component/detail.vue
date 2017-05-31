<template>
    <div>
        <p>{{title}}</p>
        <img :src="url">
    </div>
</template>
<script>
    export default {
        data(){
            return {
                title:'',
                url:''
            }
        },
        mounted(){
            var data = window.location.hash.replace('#/detail?','').split('&');
            console.log(data)
            var title = data[0].split('=')[1];
            console.log(decodeURI(title));
            this.title = decodeURI(title);
            this.url = data[1].split('=')[1];
            console.log(this.url);
        },
        methods:{
            
        }
    }
</script>
<style scoped>

</style>