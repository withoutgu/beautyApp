<template>
    <div id="head">
        <img src="../../img/logo.png">
        {{name}}
    </div>
</template>

<script>
    export default{
        data:function(){
            return{
                name:'花瓣图集'
            }
        },
        mounted:function(){
            var h = parseInt(window.innerHeight*0.08);
            console.log(h);
            var head = document.getElementById('head');
            head.style.cssText = `height:${h}px;line-height:${h}px;`;
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
        position: fixed;
        font-size: 1.5rem;
        top:0;
    }
    #head img{
        width: 3rem;
        height: 3rem;
        position: absolute;
        left:30%;
        top:20%
    }
</style>