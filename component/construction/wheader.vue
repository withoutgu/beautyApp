<template>
    <div id="head">{{name}}</div>
</template>

<script>
    export default{
        data:function(){
            return{
                name:'花瓣美女'
            }
        },
        mounted:function(){
            var h = parseInt(window.innerHeight*0.1);
            console.log(h);
            var head = document.getElementById('head');
            head.style.cssText = `height:${h}px;line-height:${h}px;font-size:${h/2}px`;
//            $("#head").css({'height':h,'line-height':h});
        }
    }
</script>

<style scoped>
    #head{
        width: 100%;
        text-align: center;
        background: #7e57c2;
        color: #fff;
        font-size: 1rem;
        position: fixed;
        top:0;
    }
</style>