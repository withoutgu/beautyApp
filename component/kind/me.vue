<template>
    <div class="meWrap">
        <div class="menu">
            <mu-icon-menu icon="more_vert" :anchorOrigin="rightTop" :targetOrigin="rightTop">
                <mu-menu-item title="退出登录" @click="logout()"/>
            </mu-icon-menu>
        </div>
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
        <div data-v-4a7b7e9c="" class="mu-paper demo-paper mu-paper-circle mu-paper-round mu-paper-2"
             default="default" style="margin-left: -50px;border-radius: 50%">
            <img :src="setUrl?setUrl:oldUrl" style="width: 70px;height: 70px;border-radius: 50%" @click="pop()">
        </div>
        <div id="personInfo">
            <p>用户名：{{username}}</p>
            <p>注册时间：{{regTime}}</p>
            <!--<span>生日:</span><mu-date-picker hintText="你的生日" class="briDate" underlineShow="false"/> <br/>-->
        </div>
        <mu-sub-header class="myPicTitle">我的照片</mu-sub-header>
        <div class="gridlist-demo-container">
            <mu-grid-list class="gridlist-demo">
                <mu-grid-tile v-for="tile,index in list" :key="'tile' + index" titlePosition="top" actionPosition="left" :rows="tile.featured ? 2 : 1" :cols="tile.featured ? 2 : 1">
                    <img :src="tile.image"/>
                    <span slot="title">{{tile.title}}</span>
                    <span slot="subTitle">by <b>{{tile.author}}</b></span>
                    <mu-icon-button icon="star_border" slot="action"/>
                </mu-grid-tile>
            </mu-grid-list>
        </div>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                userInfo:{},
                rightTop: {horizontal: 'right', vertical: 'top'},
                username:'',
                password:'',
                regTime:'',
                previewUrl:'',
                setUrl:'',
                oldUrl:'http://beauty-pic.stor.sinaapp.com/user.png',
                isShowPop:false,
                list: [{
                    image: 'https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1495770907&di=414f4a0b2145dfc795990730bf2e3adb&imgtype=jpg&er=1&src=http%3A%2F%2Fi2.hoopchina.com.cn%2Fblogfile%2F201306%2F12%2F137100348279236.jpg',
                    title: 'Breakfast',
                    author: 'Myron',
                    featured: true
                }, {
                    image: 'https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1495176253468&di=056767ad8a5ad510251ac59bbd4be960&imgtype=0&src=http%3A%2F%2Fimg01.9yaocn.com%2F2016-07%2F22%2F578e3448%2F578e3448d2d3e6e80c546466%2F1469184821158_806624.jpg',
                    title: 'Burger',
                    author: 'Linyu'
                }, {
                    image: 'https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1495176253468&di=04c064148804f92be5bcc662f64c447b&imgtype=0&src=http%3A%2F%2F01.imgmini.eastday.com%2Fmobile%2F20170119%2F20170119154244_b28c5c55af1e4a1680e663170c4b54d2_1.jpeg',
                    title: 'Camera',
                    author: 'ruolin'
                }, {
                    image: 'https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1495176253466&di=0796b371820a253863b9386b5c8681a5&imgtype=0&src=http%3A%2F%2Fin.3b2o.com%2Fimg%2Fshow%2Fsid%2FO4EcMw922Yw%2Fw%2F500%2Fh%2F500%2Ft%2F0%2Fshow.jpg',
                    title: 'Hats',
                    author: 'kakali'
                }, {
                    image: 'https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1495176253467&di=e9fdc738ea0b734f13c2a0d233d967b5&imgtype=0&src=http%3A%2F%2Feasyread.ph.126.net%2F2nrujyg8odb9_EonmNfcgQ%3D%3D%2F7916876245640307855.jpg',
                    title: 'Honey',
                    author: 'yuyang'
                }, {
                    image: 'https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1495176253467&di=aff3284f8cd20e06e9d76e251589593e&imgtype=0&src=http%3A%2F%2Fimg.mp.itc.cn%2Fupload%2F20170130%2F9057b0471dd9475591ac0233f49550a1_th.jpg',
                    title: 'Morning',
                    author: 'mokayi',
                    featured: true
                }, {
                    image: 'https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1495176253466&di=4ca1ffa645c8724ef396ba613bb72f4e&imgtype=0&src=http%3A%2F%2Ftc.sinaimg.cn%2Fmaxwidth.2048%2Ftc.service.weibo.com%2Fimg1_gtimg_com%2Ff7abdba85b94b44fdcc3861d6823b14e.jpg',
                    title: 'Vegetables',
                    author: 'NUyyyyyyy'
                }, {
                    image: 'https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1495176253465&di=c1665f3efea461ab6c17433de793c903&imgtype=0&src=http%3A%2F%2Fwww.zhibo11.com%2Fuploads%2Fallimg%2F161205%2F113455I15-5.jpg',
                    title: 'water',
                    author: 'TDDyyyyyyy'
                }]
            }
        },
        mounted () {
            var headHight = $('#head').height();
//            console.log(headHight);
            var footHeight = $('.footWrap').innerHeight();
//            console.log(footHeight);
            var h = window.innerHeight-headHight-footHeight;
//            console.log(h);
            $('.meWrap').css({"height":h,"top":headHight,"margin-left":-($('.meWrap').width()/2)});
//            $('.demo-paper').css({"margin-left":-50});

            var cookies = document.cookie.split('; ');
            var selft = this;
            if(cookies.length!=0) {
//                console.log(cookies);
                for (var i = 0; i < cookies.length; i++) {
                    var arr = cookies[i].split('=');
                    if (arr[0] === 'userInfo') {
                        selft.userInfo = JSON.parse(arr[1]);
                        selft.username = selft.userInfo.username;
                        selft.setUrl = selft.userInfo.headIconUrl;
                        var dateS = Number(JSON.parse(selft.userInfo.createTime));
                        console.log(dateS);
                        var date = new Date(dateS).toLocaleDateString();
                        console.log(date);
                        selft.regTime = date;
//                        console.log(self.regTime);
                    }
                }
            }
        },
        methods:{
            pop(){
                this.isShowPop = !this.isShowPop;
            },
            imgPreview(){
                console.log($('#headIcon')[0].files[0]);
                var imgurl = window.URL.createObjectURL($('#headIcon')[0].files[0]);
//                console.log(imgurl);
                this.previewUrl = imgurl;
            },
            setHeadIcon(){
                this.setUrl = this.previewUrl;
                this.pop();
            },
            logout(){
                var now = new Date();
                now.setDate(now.getDate()-7);
                document.cookie = 'userInfo=' + JSON.stringify(this.userInfo) + ';expires='+now+';path=/';
                window.location.href = '#/index/login';
                window.location.reload();
            }
        }
    }
</script>

<style scoped>
    .menu{
        position: absolute;
        top:0%;
        right:0%;
        z-index: 2;
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
    #pop .demo-raised-button{
        position: absolute;
        bottom:0;
        width:100%;
    }
    .meWrap{
        position: fixed;
        height: 400px;
        left: 50%;
        width:100%;
    }
    .meWrap .demo-paper {
        /*display: inline-block;*/
        height: 70px;
        width: 70px;
        /*margin: 20px;*/
        text-align: center;
        position: relative;
        left:70px;
        top:10px;
    }
    #personInfo{
        position: absolute;
        right: 0;
        top:20px;
        display: inline-block;
        width: 60%;
        color: #999;
        font-size: 1.4rem;
    }
    #personInfo p{
        width: 100%;
        margin: 5px 0;
    }
    .gridlist-demo-container{
        display: flex;
        flex-wrap: wrap;
        justify-content: space-around;
        position: relative;
        top:20px;
        height:100%;
    }

    .gridlist-demo{
        width: 500px;
        height: 450px;
        overflow-y: auto;
    }
    .myPicTitle{
        text-align: center;
        position: relative;
        top:20px;
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
</style>