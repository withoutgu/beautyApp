<template>
    <div class="wrap">
        <div id="pop" v-show="isShowPop"></div>
        <div id="popShade" v-show="isShowPop" @click="pop()"></div>
        <div data-v-4a7b7e9c="" class="mu-paper demo-paper mu-paper-circle mu-paper-round mu-paper-2" default="default" style="margin-left: -50px;">
            <img src="../../img/user.png" style="width: 100px;height: 100px;" @click="pop()">
            <p>设置头像</p>
        </div>
        <div class="inputWrap">
            <mu-text-field label="用户名" labelFloat v-model="username"/><br/>
            <mu-text-field label="密码" hintText="请输入密码" type="password" labelFloat v-model="password"/><br/><br/>
            <mu-raised-button label="注册" class="demo-raised-button logBtn" primary/><br><br>
            <mu-raised-button label="已经注册,马上登录" class="demo-raised-button regBtn" secondary @click="LinkTo()"/>
        </div>

    </div>
</template>

<script>
    export default {
        data () {
            return {
                username:'',
                password:'',
                isShowPop:false
            }
        },
        mounted () {
            var headHight = $('#head').height();
            console.log(headHight);
            var footHeight = $('.footWrap').innerHeight();
            console.log(footHeight);
            var h = window.innerHeight-headHight-footHeight;
            console.log(h);
            $('.wrap').css({"height":h,"top":headHight,"margin-left":-($('.wrap').width()/2)});
            $('.demo-paper').css({"margin-left":-50});
        },
        methods:{
            LinkTo(){
                window.location.href='#/index/login';
            },
            pop(){
                this.isShowPop = !this.isShowPop
            },

        }
    }
</script>

<style scoped>
    .wrap{
        position: fixed;
        height: 400px;
        left: 50%;
        width: 100%;
    }
    #pop{
        width: 80%;
        height: 80%;
        border-radius: 5px;
        border:1px solid #ddd;
        position: absolute;
        left:10%;
        top:10%;
        background: #fff;
        z-index: 3;
    }
    #popShade{
        width: 200%;
        height:200%;
        z-index:2;
        background: rgba(0,0,0,0.4);
        position: absolute;
    }
    .demo-paper {
        /*display: inline-block;*/
        height: 100px;
        width: 100px;
        margin-top: 10px;
        text-align: center;
        position: relative;
        left:50%;
        margin-bottom:5%
    }
    .inputWrap{
        width:80%;
        height:80%;
        position: absolute;
        left: 10%;
        top:30%
    }
    .demo-paper p{
        padding: 0;
        margin: 0;
        color: #999;
    }
    .logBtn,.regBtn{
        width: 100%;
    }

</style>