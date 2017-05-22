<template>
    <div id="head">
        <table>
            <tr>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td class="left"><img src="../../img/logo.png" alt=""></td>
                <td colspan="2" class="right">{{name}}</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </table>
        <!--<p><span><img src="../../img/logo.png"></span>{{name}}</p>-->
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
//            var h = parseInt(window.innerHeight*0.08);
//            console.log(h);
//            var h = $(window).innerHeight();
//            console.log(h)
//            var head = document.getElementById('head');
//            head.style.cssText = `line-height:${h}px;`;
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
        top:0;
        height:10%;
    }
    #head img{
        width: 3rem;
        height: 3rem;
    }
    /*#head p{*/
        /*position: absolute;*/
        /*padding: 0;*/
        /*margin: 0;*/
        /*top:30%;*/
        /*width: 100%;*/
        /*text-align: center;*/
        /*font-size: 1.5rem;*/

    /*}*/
    #head table{
        /*border:1px solid #fff;*/
        height:100%;
        border-collapse: collapse;
        width:100%;
    }
    #head table td{
        /*border:1px solid #fff;*/
    }
    .left{
        text-align: right;
        width: 40%;
    }
    .right{
        text-align: left;
        font-size: 2rem;
        width: 60%;
        padding-left:5%;
    }

</style>