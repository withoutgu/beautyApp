<template>
    <div class="wrap">
        <mu-paper class="demo-paper" circle :zDepth="2" />
        <mu-auto-complete  label="用户名" labelFloat :dataSource="dataSource" v-model="text" @keyup="test()"/> <br/>
        <mu-auto-complete  label="密码" labelFloat :dataSource="dataSource"/>
        <!--<mu-auto-complete filter="noFilter" label="在 focus 的时候显示补全信息" openOnFocus labelFloat :dataSource="focusData"/>-->
    </div>
</template>

<script>
    export default {
        data () {
            return {
                dataSource: [{
                    value: 't1',
                    text: '第一个Icon',
                    rightIcon: 'inbox'
                }, {
                    value: 't2',
                    text: '第二个Icon',
                    rightIcon: 'info'
                }, {
                    value: 't3',
                    text: '第三个Icon',
                    rightIcon: 'search'
                }],
                focusData: ['123456', '789723', '775873'],
                text:''
            }
        },
        mounted () {
            var headHight = $('#head').height()*3;
            console.log(headHight);
            var footHeight = $('.footWrap').innerHeight();
            console.log(footHeight);
            var h = window.innerHeight-headHight-footHeight;
            console.log(h);
            $('.wrap').css({"height":h,"top":headHight,"margin-left":-($('.wrap').width()/2)});
            $('.demo-paper').css({"margin-left":-50});
        },
        motheds:{
            test:function(){
                console.log(this.text)
            }
        }
    }
</script>

<style scoped>
    .wrap{
        position: fixed;
        height: 400px;
        left: 50%;
    }
    .demo-paper {
        /*display: inline-block;*/
        height: 100px;
        width: 100px;
        /*margin: 20px;*/
        text-align: center;
        position: relative;
        left:50%;
    }
</style>