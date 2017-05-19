<template>
    <div class="wrap">
        <div data-v-4a7b7e9c="" class="mu-paper demo-paper mu-paper-circle mu-paper-round mu-paper-2" default="default" style="margin-left: -50px;">
            <img src="../../img/user.png" style="width: 100px;height: 100px;">
        </div>
        <mu-text-field label="用户名" labelFloat v-model="username" @input="test()"/><br/>
        <mu-text-field label="密码" hintText="请输入密码" type="password" labelFloat v-model="password"/><br/><br/>
        <mu-raised-button label="登录" class="demo-raised-button logBtn" primary @click="LinkTo(1)"/><br><br>
        <mu-raised-button label="没有账号,马上注册" class="demo-raised-button regBtn" secondary @click="LinkTo(2)"/>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                username:'',
                password:''
            }
        },
        mounted () {
            var headHight = $('#head').height()+10;
            console.log(headHight);
            var footHeight = $('.footWrap').innerHeight();
            console.log(footHeight);
            var h = window.innerHeight-headHight-footHeight;
            console.log(h);
            $('.wrap').css({"height":h,"top":headHight,"margin-left":-($('.wrap').width()/2)});
            $('.demo-paper').css({"margin-left":-50});
        },
        methods:{
            LinkTo:function(n){
                if(n==1){
                    window.location.href = '#/index/me';
                }else if(n==2){
                    window.location.href = '#/index/register';
                }
            }
        }
    }
</script>

<style scoped>
    .wrap{
        position: fixed;
        height: 400px;
        left: 50%;
    }
    .demo-paper {
        /*display: inline-block;*/
        height: 100px;
        width: 100px;
        /*margin: 20px;*/
        text-align: center;
        position: relative;
        left:50%;
    }
    .logBtn,.regBtn{
        width: 100%;
    }
</style>