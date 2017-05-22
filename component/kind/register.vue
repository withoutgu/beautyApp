<template>
    <div class="wrap">
        <div id="pop" v-show="isShowPop">
            <div class="demo-flat-button-container">
                <mu-flat-button label="选择文件" class="demo-flat-button" icon="touch_app">
                    <input type="file" class="file-button" @change="imgPreview()" id="headIcon">
                </mu-flat-button>
            </div>
            <div id="previewArea">
                <img :src="previewUrl" style="width: 100%;height: 100%;">
            </div>
            <mu-raised-button class="demo-raised-button" label="确定设置" labelPosition="before" icon="cloud_upload"
                              secondary @click="setHeadIcon()"/>
        </div>
        <div id="popShade" v-show="isShowPop" @click="pop()"></div>
        <div data-v-4a7b7e9c="" class="mu-paper demo-paper mu-paper-circle mu-paper-round mu-paper-2" default="default" >
            <img :src="setUrl?setUrl:oldUrl" style="width: 100px;height: 100px;border-radius: 50%" @click="pop()">
            <p>设置头像</p>
        </div>
        <div class="inputWrap">
            <mu-text-field label="用户名" hintText="6-12位数字字母组合" labelFloat v-model="username" style="width: 100%;"
                           @input="checkUsername()" @blur="cantReg()" :errorText="isUsernameErr?errText:''"
                           :errorColor="canReg?'green':'red'"/><br/>
            <mu-text-field label="密码" hintText="6-18位不含空格的密码" type="password" labelFloat v-model="password"
                           style="width: 100%;" @input="checkPassword()"
                           :errorText="isPasswordErr?'请输入6-18位不含空格的密码':''"/><br/>
            <mu-text-field label="确认密码" hintText="再次输入密码" type="password" labelFloat v-model="confirmPassword"
                           style="width: 100%;" @input="checkConfirm()" :errorText="isConfirmErr?'密码不一致':''"/><br/><br/>
            <mu-raised-button label="注册" class="demo-raised-button logBtn" primary @click="register()"/><br><br>
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
                isShowPop:false,
                previewUrl:'',
                setUrl:'',
                oldUrl:'http://beauty-pic.stor.sinaapp.com/user.png',
                username:'',
                password:'',
                confirmPassword:'',
                isUsernameErr:false,
                isPasswordErr:false,
                isConfirmErr:false,
                errText:'',
                canReg:false,
                createTime:''
            }
        },
        mounted () {
            var headHight = $('#head').height();
//            console.log(headHight);
            var footHeight = $('.footWrap').innerHeight();
//            console.log(footHeight);
            var h = window.innerHeight-headHight-footHeight;
//            console.log(h);
            $('.wrap').css({"height":h,"top":headHight,"margin-left":-($('.wrap').width()/2)});
            $('.demo-paper').css({"margin-left":-50});
        },
        methods:{
            //点马上登录跳转到登录页面,把用户名和密码传到登录页面
            LinkTo(){
                window.location.href='#/index/login';
                //通过vuex传用户名和密码
            },
            //显示隐藏上传图片弹窗
            pop(){
                this.isShowPop = !this.isShowPop
            },
            //获取上传的图片的URL赋值给this.previewUrl
            imgPreview(){
                console.log($('#headIcon')[0].files[0]);
                var imgurl = window.URL.createObjectURL($('#headIcon')[0].files[0]);
                console.log(imgurl)
                this.previewUrl = imgurl;
            },
            //点击提交按钮,赋值给this.setUrl,设置头像
            setHeadIcon(){
                this.setUrl = this.previewUrl;
                //隐藏弹窗
                this.pop();
            },
            //验证用户名是否合法
            checkUsername(){
                if(!/^[\dA-z]{6,12}$/.test(this.username)){
                    this.isUsernameErr = true;
                    this.errText = '请输入6-12位数字字母组合的用户名'
                }else{
                    this.isUsernameErr = false;
                    this.canReg = false;
                }

            },
            //验证用户名是否可用
            cantReg(){
                var self = this;
                $.post(
                    'cantReg.php',
                    {username:self.username},
                    function(data){
                        if(data==='true'){
                            self.canReg = true;
                            self.errText = '用户名可以使用'
                        }else if(data === 'false'){
                            self.canReg = false;
                            self.errText = '用户名已被注册'
                        }
                    }
                )
            },
            //验证密码是否合法
            checkPassword(){
                if(!/^[\S]{6,18}$/.test(this.password)){
                    this.isPasswordErr = true;
                }else{
                    this.isPasswordErr = false;
                }
            },
            //验证确认密码是否与密码一致
            checkConfirm(){
                if(this.confirmPassword != this.password){
                    this.isConfirmErr = true;
                }else{
                    this.isConfirmErr = false;
                }
            },
            //点击注册提交用户信息
            register(){
                var now = new Date();
                this.createTime = now.getTime();
                var self = this;
                $.post(
                    'register.php',
                    {
                        username:self.username,
                        password:self.password,
                        createTime:self.createTime,
                        headIconUrl:self.setUrl
                    },
                    function(data){
                        //弹出注册成功
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
        /*margin-bottom:5%*/
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
    .file-button{
        position: absolute;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
        opacity: 0;
    }

    .demo-flat-button-container{
        display: flex;
        flex-wrap: wrap;
        align-items: center;
    }
    .demo-flat-button {
        margin: 12px;
    }
    #previewArea{
        width: 300px;
        height:300px;
        border: 1px solid #ddd;
        position: absolute;
        left: 50%;
        margin-left:-150px;
    }
    #pop .demo-raised-button{
        position: absolute;
        bottom:0;
        width:100%;
    }
</style>