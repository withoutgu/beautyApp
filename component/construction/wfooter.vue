<template>
    <mu-paper class="footWrap">
        <mu-bottom-nav :value="bottomNav" shift @change="handleChange">
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
                bottomNav: 'movies',
                bottomNavColor: 'movies'
            }
        },
        methods: {
            handleChange (val) {
                this.bottomNav = val
                console.log(val);
                switch(val){
                    case 'pictures':
                        window.location.href = '#/index/pictures';
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

        }
    }
</script>
<style scoped>
    .footWrap{
        position: absolute;
        bottom:0;
        width: 100%;
    }
</style>