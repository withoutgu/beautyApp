<template>
    <div class="wrap">
        <div id="pop" v-show="isShowPop">
            <div class="demo-flat-button-container">
                <mu-flat-button label="选择文件" class="demo-flat-button" icon="touch_app">
                    <input type="file" class="file-button" @change="imgPreview()" id="headIcon" name="headIcon">
                </mu-flat-button>
            </div>
            <div id="previewArea">
                <img :src="previewUrl" style="width: 100%;height: 100%;">
            </div>
            <mu-raised-button class="demo-raised-button" label="确定设置" labelPosition="before" icon="cloud_upload" secondary @click="setHeadIcon()"
            />
        </div>
        <div id="popShade" v-show="isShowPop" @click="pop()"></div>
        <div data-v-4a7b7e9c="" class="mu-paper demo-paper mu-paper-circle mu-paper-round mu-paper-2" default="default">
            <img :src="setUrl?setUrl:oldUrl" style="width: 100px;height: 100px;border-radius: 50%" @click="pop()">
            <p>设置头像</p>
        </div>
        <div class="inputWrap">
            <mu-text-field label="用户名" hintText="6-12位数字字母组合" labelFloat v-model="username" style="width: 100%;" @input="checkUsername()"
                @blur="cantReg()" :errorText="isUsernameErr?errText:''" :errorColor="canReg?'green':'red'" /><br/>
            <mu-text-field label="密码" hintText="6-18位不含空格的密码" type="password" labelFloat v-model="password" style="width: 100%;" @input="checkPassword()"
                :errorText="isPasswordErr?passErrText:''" :errorColor="canPassReg?'green':'red'" /><br/>
            <mu-text-field label="确认密码" hintText="再次输入密码" type="password" labelFloat v-model="confirmPassword" style="width: 100%;" @input="checkConfirm()"
                :errorText="isConfirmErr?conErrText:''" :errorColor="canConReg?'green':'red'" @blur="disable()" /><br/><br/>
            <mu-raised-button label="注册" class="demo-raised-button logBtn" primary @click="register()" :disabled="isDisabled" /><br><br>
            <mu-raised-button label="已经注册,马上登录" class="demo-raised-button regBtn" secondary @click="LinkTo()" />
            <mu-dialog :open="dialog" title="注册成功" @close="close">
                是否马上登录?
                <mu-flat-button slot="actions" @click="close" primary label="取消" />
                <mu-flat-button slot="actions" primary @click="LinkTo()" label="确定" />
            </mu-dialog>
        </div>

    </div>
</template>

<script>
    export default {
        data() {
            return {
                isShowPop: false,
                previewUrl: '',
                setUrl: '',
                oldUrl: 'http://beauty-pic.stor.sinaapp.com/user.png',
                username: '',
                password: '',
                confirmPassword: '',
                isUsernameErr: false,
                isPasswordErr: false,
                isConfirmErr: false,
                errText: '',
                passErrText: '',
                canReg: false,
                canPassReg: false,
                canConReg: false,
                createTime: '',
                dialog: false,
                isDisabled: true,
            }
        },
        mounted() {
            var headHight = $('#head').height();
            //            console.log(headHight);
            var footHeight = $('.footWrap').innerHeight();
            //            console.log(footHeight);
            var h = window.innerHeight - headHight - footHeight;
            //            console.log(h);
            $('.wrap').css({
                "height": h,
                "top": headHight,
                "margin-left": -($('.wrap').width() / 2)
            });
            $('.demo-paper').css({
                "margin-left": -50
            });
        },
        methods: {
            //点马上登录跳转到登录页面,把用户名和密码传到登录页面
            LinkTo() {
                window.location.href = '#/index/login';
                //通过vuex传用户名和密码
                this.$store.commit("setLogInfo", {
                    username: this.username,
                    password: this.password,
                    headIcon: this.setUrl.replace('blob:', '')
                });
            },
            //显示隐藏上传图片弹窗
            pop() {
                this.isShowPop = !this.isShowPop
            },
            //获取上传的图片的URL赋值给this.previewUrl
            imgPreview() {
                console.log($('#headIcon')[0].files[0]);
                var imgurl = window.URL.createObjectURL($('#headIcon')[0].files[0]);
                console.log(imgurl)
                this.previewUrl = imgurl;
            },
            //点击提交按钮,赋值给this.setUrl,设置头像
            setHeadIcon() {
                this.setUrl = this.previewUrl;
                console.log(this.setUrl)
                //隐藏弹窗
                this.pop();
            },
            //验证用户名是否合法
            checkUsername() {
                if (!/^[\dA-z]{6,12}$/.test(this.username)) {
                    this.isUsernameErr = true;
                    this.errText = '请输入6-12位数字字母组合的用户名'
                    this.canReg = false;
                } else {
                    this.isUsernameErr = false;
                }

            },
            //验证用户名是否可用
            cantReg() {
                var self = this;
                if (self.username == '') {
                    this.isUsernameErr = true;
                    this.errText = '用户名不能为空'
                    return false;
                }
                $.post(
                    'http://1.beauty.applinzi.com/api/cantReg.php', {
                        username: self.username
                    },
                    function (data) {
                        if (data === 'true' && /^[\dA-z]{6,12}$/.test(self.username)) {
                            self.isUsernameErr = true;
                            self.canReg = true;
                            self.errText = '用户名可以使用'
                        } else if (data === 'false') {
                            self.isUsernameErr = true;
                            self.canReg = false;
                            self.errText = '用户名已被注册'
                        }
                    }
                )
            },
            //验证密码是否合法
            checkPassword() {
                if (!/^[\S]{6,18}$/.test(this.password)) {
                    this.isPasswordErr = true;
                    this.canPassReg = false;
                    this.passErrText = '请输入6-18位不含空格的密码';
                } else {
                    this.isPasswordErr = true;
                    this.canPassReg = true;
                    this.passErrText = '密码有效';
                }
            },
            //验证确认密码是否与密码一致
            checkConfirm() {
                if (this.confirmPassword != this.password) {
                    this.isConfirmErr = true;
                    this.canConReg = false;
                    this.conErrText = '密码不一致';
                } else {
                    this.isConfirmErr = true;
                    this.canConReg = true;
                    this.conErrText = '密码一致';
                }
            },
            //点击注册提交用户信息
            register() {




                var now = new Date();
                this.createTime = now.getTime();
                var self = this;
                if (self.confirmPassword === self.password) {
                    self.isDisabled = false;

                    $.post(
                        'http://1.beauty.applinzi.com/api/register.php', {
                            username: self.username,
                            password: self.password,
                            createTime: self.createTime,
                            headIconUrl: self.setUrl.replace('blob:', '')
                        },
                        function (data) {
                            console.log(data);
                            if (data == 'true') {
                                //弹出注册成功
                                self.open();
                            } else {
                                self.isDisabled = true;
                            }
                        }
                    )
                }

            },
            disable() {
                if (this.username != '' && this.password != '' && this.confirmPassword != '' && this.password === this.confirmPassword &&
                    this.canReg == true) {
                    this.isDisabled = false;
                } else {
                    this.isDisabled = true;
                }
            },
            //注册成功弹窗效果
            open() {
                this.dialog = true
            },
            close() {
                this.dialog = false
            }
        }
    }
</script>

<style scoped>
    .wrap {
        position: fixed;
        height: 400px;
        left: 50%;
        width: 100%;
    }

    #pop {
        width: 80%;
        height: 80%;
        border-radius: 5px;
        border: 1px solid #ddd;
        position: absolute;
        left: 10%;
        top: 10%;
        background: #fff;
        z-index: 3;
    }

    #popShade {
        width: 200%;
        height: 200%;
        z-index: 2;
        background: rgba(0, 0, 0, 0.4);
        position: absolute;
    }

    .demo-paper {
        /*display: inline-block;*/
        height: 100px;
        width: 100px;
        margin-top: 10px;
        text-align: center;
        position: relative;
        left: 50%;
        /*margin-bottom:5%*/
    }

    .inputWrap {
        width: 80%;
        height: 80%;
        position: absolute;
        left: 10%;
        top: 30%
    }

    .demo-paper p {
        padding: 0;
        margin: 0;
        color: #999;
    }

    .logBtn,
    .regBtn {
        width: 100%;
    }

    .file-button {
        position: absolute;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
        opacity: 0;
    }

    .demo-flat-button-container {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
    }

    .demo-flat-button {
        margin: 12px;
    }

    #previewArea {
        width: 300px;
        height: 300px;
        border: 1px solid #ddd;
        position: absolute;
        left: 50%;
        margin-left: -150px;
    }

    #pop .demo-raised-button {
        position: absolute;
        bottom: 0;
        width: 100%;
    }
</style>