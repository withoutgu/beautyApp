<template>
    <mu-paper class="footWrap">
        <mu-bottom-nav :value="bottomNav" shift @change="handleChange" class="footer">
            <mu-bottom-nav-item value="pictures" title="美图" icon="camera_enhance"/>
            <mu-bottom-nav-item value="collect" title="收藏" icon="favorite"/>
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
                bottomNavColor: 'pictures'
            }
        },
        methods: {
            handleChange (val) {
                this.bottomNav = val
                switch(val){
                    case 'pictures':
                        window.location.href = '#/index/pictures/list';
                        break;
                    case "collect":
                        window.location.href = '#/index/collect';
                        break;
                    case "me":
                        window.location.href = '#/index/login';
                        break;
//                    case "pictures":
//                        window.location.href = '#/index/pictures';
//                        break;

                }
            }
        },
        mounted(){
//            $('.footWrap').height(parseInt(window.innerHeight*0.1))
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