<template>
    <div>
        <ul class="picList">
            <li v-for="img in picArr">
                <a href="javascript:(0)">
                    <p>{{img.title}}</p>
                    <img :src="img.thumb" alt="">
                </a>
                <div id="shade">
                    <p>description</p>
                    <mu-float-button icon="star"  mini class="demo-float-button" @click="showToast"/>
                    <mu-toast v-if="toast" message="收藏成功" @close="hideToast"/>
                </div>
            </li>
        </ul>
        <mu-raised-button label="加载更多" fullWidth @click="loadMore()"/>
    </div>
</template>

<script>
    export default{
        data(){
            return{
                page:1,
                picArr:[],
                toast: false,
                open: false,
                docked: true
            }
        },
        mounted(){
            this.loadMore();
        },
        methods:{
            load () {
                var self = this;
                $('.lodingWrap').show();
                $.ajax({
                    url: 'http://route.showapi.com/819-1',
                    type: 'GET',
                    data: {
                        showapi_appid: 36276,
                        showapi_sign: 'a5c104b7ad0447b180f1a89a6eb2c60c',
                        type: 35,
                        num: 5,
                        page: self.page
                    },
                    success: function (data) {
                        var imgs = data.showapi_res_body;
                        for (var key in imgs) {
                            if (key != 'ret_code') {
//                                console.log(imgs[key]);
                                self.picArr.push(imgs[key]);
                            }
                        }
//                        console.log(self.picArr);
                        self.page++;
                        $('.lodingWrap').hide();
                    }
                })
            },
            loadMore(){
                this.load ();
            },
            showToast () {
                this.toast = true
                if (this.toastTimer) clearTimeout(this.toastTimer)
                this.toastTimer = setTimeout(() => { this.toast = false }, 2000)
            },
            hideToast () {
                this.toast = false
                if (this.toastTimer) clearTimeout(this.toastTimer)
            },
            toggle (flag) {
                this.open = !this.open
                this.docked = !flag
            }
        }
    }
</script>

<style scoped>

</style>