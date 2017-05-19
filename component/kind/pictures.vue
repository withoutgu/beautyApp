<template>
    <div class="picWrap">
        <mu-drawer :open="open" :docked="docked" @close="toggle()" class="sideBarList">
            <div class="sideBarHead">
                <img src="../../img/lip.png">
            </div>
            <mu-list @itemClick="docked ? '' : toggle()" style="height: 100%;">
                <mu-list class="sideBarListWrap">
                    <mu-list-item title="大胸妹" href="#/index/pictures/daxiongmei" @click="toggle (flag)">
                        <mu-icon slot="left" value="favorite" color="pink"/>
                    </mu-list-item>
                    <mu-list-item title="小清新" href="#/index/pictures/xiaoqingxin" @click="toggle (flag)">
                        <mu-icon slot="left" value="loyalty" color="pink"/>
                    </mu-list-item>
                    <mu-list-item title="文艺范" href="#/index/pictures/wenyifan" @click="toggle (flag)">
                        <mu-icon slot="left" value="thumb_up" color="pink"/>
                    </mu-list-item>
                    <mu-list-item title="性感妹" href="#/index/pictures/xingganmei" @click="toggle (flag)">
                        <mu-icon slot="left" value="visibility" color="pink"/>
                    </mu-list-item>
                    <mu-list-item title="大长腿" href="#/index/pictures/dachangtui" @click="toggle (flag)">
                        <mu-icon slot="left" value="touch_app" color="pink"/>
                    </mu-list-item>
                    <mu-list-item title="黑丝袜" href="#/index/pictures/heisiwa" @click="toggle (flag)">
                        <mu-icon slot="left" value="hd" color="pink"/>
                    </mu-list-item>
                    <mu-list-item title="小翘臀" href="#/index/pictures/xiaoqiaotun" @click="toggle (flag)">
                        <mu-icon slot="left" value="bubble_chart" color="pink"/>
                    </mu-list-item>
                </mu-list>
                <mu-list-item v-if="docked" @click.native="open = false" title="Close"/>
            </mu-list>
        </mu-drawer>
        <mu-tabs :value="activeTab" @change="handleTabChange" class="picTab">
            <mu-tab value="tab1" title="全部"/>
            <mu-tab value="tab2" title="我的"/>
        </mu-tabs>
        <div v-if="activeTab === 'tab1'">
            <mu-float-button icon="list" mini class="demo-float-button sideBarBtn" @click="toggle(true)"/>

            <router-view></router-view>


            <div class="lodingWrap">
                <mu-circular-progress :size="40" class="loading1" color="yellow"/>
                <mu-circular-progress :size="60" class="loading2" color="orange"/>
                <mu-circular-progress :size="90" class="loading3" />
            </div>
        </div>
        <div v-if="activeTab === 'tab2'">
            <h2>Tab Two</h2>
            <p>
                这是第二个 tab
            </p>
        </div>
    </div>
</template>

<script>
    export default {
        data () {
            return {

                activeTab: 'tab1',
                open: false,
                docked: true
            }
        },
        mounted () {
            var headHight = $('#head').height();
            console.log(headHight);
            var footHeight = $('.footWrap').innerHeight();
            console.log(footHeight);
            var h = window.innerHeight-headHight-footHeight;
            console.log(h);
            $('.picWrap').css({"height":h,"top":headHight,"margin-left":-($('.picWrap').width()/2),"padding-top":$('.picTab').innerHeight()});
            $('.picList li').css({"margin-left":-$('.picList li').innerWidth()/2});
            $('.loading1').css({"margin-left":-$('.loading1').innerWidth()/2,"margin-top":-$('.loading1').innerHeight()/2});
            $('.loading2').css({"margin-left":-$('.loading2').innerWidth()/2,"margin-top":-$('.loading2').innerHeight()/2});
            $('.loading3').css({"margin-left":-$('.loading3').innerWidth()/2,"margin-top":-$('.loading3').innerHeight()/2});
            $('.picTab').css({top:headHight});
            $('.sideBarHead').height(headHight+$('.picTab').innerHeight());
//            $('.sideBarList').height(window.innerHeight-$('.sideBarHead').innerHeight())
            $('.sideBarListWrap').height($('.sideBarList').innerHeight()-$('.sideBarHead').innerHeight());
            $('.sideBarListWrap').css({"padding-top":$('.sideBarHead').innerHeight()})


        },
        methods: {

            handleTabChange (val) {
                this.activeTab = val
            },
            handleActive () {
                window.alert('tab active')
            },

            toggle (flag) {
                this.open = !this.open
                this.docked = !flag
            }
        }
    }
</script>

<style lang="css">
    ul{
        list-style: none;
        margin: 0;
        padding: 0 0 0 10px;
    }
    a{text-decoration: none;}
    .picWrap{
        width: 100%;
        position: absolute;
        right:0;
        overflow: auto;
    }
    .picList li{
        border-radius: 5px;
        box-shadow: 5px 5px 5px #bbb;
        width: 95%;
        position: relative;
        /*left: 50%;*/
        /*padding-left: 5%;*/
    }
    .picList li p{
        text-align: center;
        height: 10%;
        color: #999;
    }
    .picList li img{
        width: 95%;
        margin-bottom: 2%;
        margin-left: 2.5%;
    }
    #shade{
        background: rgba(0,0,0,0.4);
        width: 100%;
        position: absolute;
        bottom:0;
        height: 20%;
        left:0;
        color: #fff;
        font-size: 1.5rem;
    }
    #shade p{
        height: 100%;
        margin: 0;
    }
    .demo-float-button {
        margin-right: 12px;
        position: absolute;
        right:2%;
        bottom: 10%;
    }
    .lodingWrap{
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.4);
        position: fixed;
        z-index: 999;
        top:0;
        display: none;
    }
    .loading1,.loading2,.loading3{
        position: fixed;
        left:50%;
        top:50%;
    }
    .picTab{
        position: fixed;
    }
    .sideBarBtn{
        position: fixed;
        z-index: 2;
        left:5%;
        top:0;
        border-radius: 50%;
        color: #fff;
        box-shadow: none;
    }
    .sideBarList{
        width: 50%;
    }
    .sideBarListWrap{
        /*height: 100%;*/
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    .sideBarHead{
        background: #7E57C2;
        width: 100%;
        position: fixed;
    }
    .sideBarHead img{
        width: 20%;
        position: relative;
        top:50%;
        left:10%;
    }
</style>