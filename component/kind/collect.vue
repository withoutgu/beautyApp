<template>
    <div id="colWrap">
        <div class="mask" v-show="isBig" @click="isBig=!isBig">
            <img :src="viewImg" class="bigImg">
        </div>
        <p v-show="isEmpty" class="tips">还没有收藏哦~快去首页看看吧</p>
        <div class="grid" v-for="img in list">
            <div class="shadeWrap" >
                <img :src="img.url" @click="showBigImg(img.url)"/>
                <div class="shade">
                    <table>
                        <tr>
                            <td class="imgTitle">{{img.title}}</td>
                            <td style="width: 20%;">
                                <mu-icon-button icon="clear" color="#fff" class="deleteBtn" @click="delImg(img.title)" />
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                username: '',
                list: [],
                isEmpty: false,
                isBig:false,
                viewImg:''
            }
        },
        mounted() {
            var cookies = document.cookie.split('; ');
            if (cookies.length != 0) {
                //                console.log(cookies);
                for (var i = 0; i < cookies.length; i++) {
                    var arr = cookies[i].split('=');
                    if (arr[0] === 'userInfo') {
                        this.userInfo = JSON.parse(arr[1]);
                        this.username = this.userInfo.username;
                    }
                }
            }
            $('.shade').height($('#colWrap').innerHeight() * 0.1);

            this.load();
            this.checkEmpty();
        },
        methods: {
            showBigImg(u){
                this.isBig = true;
                this.viewImg = u;
            },
            load(callback) {
                if (this.list.length == 0) {
                    this.isEmpty = true;
                } else {
                    this.isEmpty = false;
                }
                console.log(this.isEmpty);
                var self = this;
                $.post(
                    'http://1.beauty.applinzi.com/api/showCollect.php', {
                        username: self.username
                    },
                    function (data) {
                        //                        console.log(JSON.parse(data));
                        //                        self.list = data
                        self.list = JSON.parse(data);
                        console.log(data);
                    }
                )
            },

            delImg(t) {
                var self = this;
                console.log(t);
                $.post(
                    'http://1.beauty.applinzi.com/api/deleteCollect.php', {
                        title: t,
                        username: self.username
                    },
                    function (data) {
                        self.load()
                        // window.location.href = "#/index/blank";
                        //                        window.location.reload()
                        //                        self.load(self.showPic);
                    }
                )
            },
            checkEmpty() {
                var self = this
                setInterval(function () {
                    if (self.list.length == 0) {
                        self.isEmpty = true;
                    } else {
                        self.isEmpty = false;
                    }
                }, 50)
            }
        }
    }
</script>

<style>
    .mask{
        height: 100%;
        width: 100%;
        background: rgba(0, 0, 0, .8);
        position: fixed;
        top:0;
        z-index: 3
    }
    .bigImg{
        width: auto;
        height: auto;
        max-width: 100%;
        max-height: 100%;
        position: absolute;
    }
    p {
        margin: 0;
    }

    .tips {
        padding: 10%;
        text-align: center;
        color: #999;
    }

    #colWrap {
        height: 80%;
        top: 10%;
        width: 100%;
        position: fixed;
        z-index: -1;
        overflow: auto;
        padding-right: 1%;
        box-sizing: border-box;
    }

    .grid {
        width: 47%;
        height: 50%;
        border-radius: 5px;
        border: 1px solid #ddd;
        box-shadow: 0 0 5px #000;
        /*min-height: 200px;*/
        /*position: absolute;*/
        float: left;
        margin-left: 2%;
    }

    .shadeWrap {
        width: 100%;
        height: 100%;
        position: relative;
    }

    .grid img {
        width: auto;
        height: auto;
        max-width: 100%;
        max-height: 100%;
    }

    .shade {
        width: 100%;
        background: rgba(0, 0, 0, .5);
        border-radius: 0 0 5px 5px;
        color: #fff;
        height: 20%;
        max-height: 100px;
        position: absolute;
        bottom: 0;
    }

    .shade table {
        width: 100%;
        height: 100%;
    }

    .imgTitle {
        max-width: 80px;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
    }
</style>