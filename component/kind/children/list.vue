<template>
    <div>
        <ul class="picList">
            <li v-for="img in picArr" >
                <p>{{img.title}}</p>
                <img :src="img.thumb" alt="" @click="toDetail(img.title,img.thumb)">
                <div id="shade">
                    <p>description</p>
                    <mu-float-button icon="star"  mini class="demo-float-button"
                                     @click="hint(img.thumb,img.title)"/>
                    <mu-toast v-if="toast" :message="tips?'收藏成功':'已在收藏列表中'" @close="hideToast"/>
                </div>
            </li>
        </ul>
        <mu-dialog :open="dialog" title="提示">
            收藏请先登录
            <mu-flat-button label="确定" slot="actions" primary @click="close"/>
        </mu-dialog>
    </div>
</template>

<script>
    export default{
        data(){
            return{
                toast: false,
                open: false,
                docked: true,
                cookies:'',
                dialog: false,
                username:'',
                tips:true
            }
        },
        computed:{
            picArr(){
                return this.$store.getters.getArr;
            }
        },
        mounted(){
            this.cookies = document.cookie.split('; ');
        },
        methods:{
            toDetail(t,u){
                window.location.href = "#/detail?title="+t+"&url="+u;
            },
            status() {
                this.dialog = true
            },
            close() {
                this.dialog = false
            },
            hint(url,title){
                var self = this;
                if(self.cookies.length!=0){
                    for(var i=0;i<self.cookies.length;i++){
                        var arr = self.cookies[i].split('=');
                        if(arr[0] == 'userInfo'){
                            self.username = JSON.parse(arr[1]).username;
                            $.post(
                                'http://1.beauty.applinzi.com/api/collect.php',
                                {
                                    username:self.username,
                                    url:url,
                                    title:title
                                },
                                function(data){
                                    if(data == 'false'){
                                        self.showToast();
                                        self.tips = false;
                                        return;
                                    }else{
                                        self.tips = true;
                                        self.showToast();
                                    }
                                }
                            )
                        }else{
                            self.status();
                        };
                    }
                }else{
                    self.status();
                }
            },
            showToast () {
                this.toast = true
                if (this.toastTimer) clearTimeout(this.toastTimer)
                this.toastTimer = setTimeout(() => { this.toast = false }, 2000)
            },
            hideToast () {
                this.toast = false;
                if (this.toastTimer) clearTimeout(this.toastTimer)
            },
            toggle (flag) {
                this.open = !this.open;
                this.docked = !flag;
            }

        }
    }
</script>

<style scoped>

</style>