<template>
    <mu-paper class="footWrap">
        <mu-bottom-nav :value="bottomNav" shift @change="handleChange" class="footer">
            <mu-bottom-nav-item value="pictures" title="美图" icon="camera_enhance" />
            <mu-bottom-nav-item value="collect" title="收藏" icon="favorite" />
            <mu-bottom-nav-item value="me" title="我的" icon="face" />
            <!--<mu-bottom-nav-item value="pictures" title="Pictures" icon="photo" />-->
        </mu-bottom-nav>
    </mu-paper>

</template>

<script>
    export default {
        data () {
            return {
                bottomNav: 'pictures',
                bottomNavColor: 'pictures',
                cookies:''
            }
        },
        mounted(){
            this.cookies = document.cookie.split('; ');
        },
        methods: {
            handleChange (val) {
                this.bottomNav = val;
                var self = this;
                switch(val){
                    case 'pictures':
                        window.location.href = '#/index/pictures/list';
                        break;
                    case "collect":
                        window.location.href = '#/index/collect';
                        self.bottomNav = 'collect';
                        break;
                    case "me":
                        if(self.cookies.length!=0){
                            for(var i=0;i<self.cookies.length;i++){
                                var arr = self.cookies[i].split('=');
                                if(arr[0] == 'userInfo'){
                                    console.log(111)
                                    window.location.href = '#/index/me';
                                }else{
                                    window.location.href = '#/index/login';
                                }
                            }
                        }else{
                            window.location.href = '#/index/login';
                        }

                        break;
                }
            }
        }
    }
</script>
<style scoped>
    .footWrap{
        position: fixed;
        bottom:0;
        width: 100%;
        height:10%;
    }
    .footer{
        height:100%;
    }
</style>