<template>
    <div class="wrap">
        <div data-v-4a7b7e9c="" class="mu-paper demo-paper mu-paper-circle mu-paper-round mu-paper-2" default="default" >
            <img :src="headIconUrl?headIconUrl:oldUrl" style="width: 100px;height: 100px;border-radius: 50%">
        </div>
        <div class="inputWrap">
            <mu-text-field label="用户名" labelFloat v-model="username" style="width: 100%;" @blur="checkLog()" :errorText="isUsernameFalse?'用户名不存在':''" :errorColor="isUsernameFalse?'red':''"/><br/>
            <mu-text-field label="密码" hintText="请输入密码" type="password" labelFloat v-model="password" :errorText="isPasswordFalse?'密码错误':''" :errorColor="isPasswordFalse?'red':''" style="width:100%;" @blur="checkPass()"/><br/><br/>
            <mu-raised-button label="登录" class="demo-raised-button logBtn" primary @click="LinkTo(1)"/><br><br>
            <mu-raised-button label="没有账号,马上注册" class="demo-raised-button regBtn" secondary @click="LinkTo(2)"/>
        </div>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                username:'',
                password:'',
                isUsernameFalse:false,
                isPasswordFalse:false,
                headIconUrl:'',
                oldUrl:'http://beauty-pic.stor.sinaapp.com/user.png',
                createTime:'',
                userInfo:{}
            }
        },
        mounted () {

            var headHight = $('#head').height()+10;
//            console.log(headHight);
            var footHeight = $('.footWrap').innerHeight();
//            console.log(footHeight);
            var h = window.innerHeight-headHight-footHeight;
//            console.log(h);
            $('.wrap').css({"height":h,"top":headHight,"margin-left":-($('.wrap').width()/2)});
            $('.demo-paper').css({"margin-left":-50});
            this.username = this.logInfo.username;
            this.password = this.logInfo.password;
            this.headIconUrl = this.logInfo.headIcon;
        },
        computed:{
            logInfo(){
                return this.$store.getters.getLogInfo;
            }
        },
        methods:{
            reset(){
                this.isUsernameFalse = false;
            },
            LinkTo(n){
                if(n==1){
                    var self = this;
                    $.post(
                        'http://1.beauty.applinzi.com/api/login.php',
                        {
                            username:self.username,
                            password:self.password
                        },
                        function(data){
                            if(data == 'false'){
                                self.isPasswordFalse = true;
                            }else if(data != 'false'){
                                self.createTime = data;
                                self.userInfo = {username:self.username,createTime:self.createTime,headIconUrl:self.headIconUrl}
                                var now = new Date();
                                now.setDate(now.getDate() + 7);
                                document.cookie =
                                    'userInfo=' + JSON.stringify(self.userInfo) + ';expires='+now+';path=/';
                                window.location.href = '#/index/me';
                                window.location.reload();
                            }
                        }
                    )
                }else if(n==2){
                    window.location.href = '#/index/register';
                }
            },
            checkLog(){
                var self = this;
                if(self.username == ''){
                    self.isUsernameFalse = false;
                    return;
                }
                $.post(
                    'http://1.beauty.applinzi.com/api/getHeadIcon.php',
                    {
                        username:self.username,
                        password:self.password
                    },
                    function(data){
                        if(data == 'usernamefalse'){
                            self.isUsernameFalse = true;
                        }else if(data != 'usernamefalse'){
                            self.isUsernameFalse = false;
                            self.headIconUrl = data;
                            console.log(self.headIconUrl);
                        }
                    }
                )
            },
            checkPass(){
                var self = this;
                if(self.username == ''){
                    self.isUsernameFalse = false;
                    return;
                }
                $.post(
                    'http://1.beauty.applinzi.com/api/login.php',
                    {
                        username:self.username,
                        password:self.password
                    },
                    function(data){
                        if(data == 'false'){
                            self.isPasswordFalse = true;
                        }else if(data != 'false'){
                            self.isPasswordFalse = false;
                        }

                    }
                )
            }
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
    .inputWrap{
        width:80%;
        height:80%;
        position: absolute;
        left: 10%;
        top:30%
    }
    .demo-paper {
        height: 100px;
        width: 100px;
        /*margin-top: 10px;*/
        text-align: center;
        position: relative;
        left:50%;
        /*margin-bottom:5%*/
    }
    .logBtn,.regBtn{
        width: 100%;
    }
</style>