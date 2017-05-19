<template>
    <div class="picWrap">

    </div>
</template>

<script>
    export default {
        data () {
            return {}
        },
        mounted () {
            var headHight = $('#head').height()+10;
            console.log(headHight);
            var footHeight = $('.footWrap').innerHeight();
            console.log(footHeight);
            var h = window.innerHeight-headHight-footHeight;
            console.log(h);
            $('.picWrap').css({"height":h,"top":headHight,"margin-left":-($('.picWrap').width()/2)});
        },
        methods: {

        }
    }
</script>

<style lang="css">
    .picWrap{
        width: 100%;
    }
</style>