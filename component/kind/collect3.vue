<template>
    <div id="colWrap">
        <div class="grid" v-for="img in list">
            <div class="shadeWrap">
                <img :src="img.url"/>
                <div class="shade">
                    <table>
                        <tr>
                            <td class="imgTitle">{{img.title}}</td>
                            <td style="width: 20%;"><mu-icon-button icon="clear" color="#fff" class="deleteBtn" @click="delImg(img.title)"/></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                username:'',
                list:[]
            }
        },
        mounted(){
            var cookies = document.cookie.split('; ');
            if(cookies.length!=0) {
//                console.log(cookies);
                for (var i = 0; i < cookies.length; i++) {
                    var arr = cookies[i].split('=');
                    if (arr[0] === 'userInfo') {
                        this.userInfo = JSON.parse(arr[1]);
                        this.username = this.userInfo.username;
                    }
                }
            }
            $('.shade').height($('#colWrap').innerHeight()*0.1);

            this.load(this.showPic);
        },
        methods:{
            load(callback){
                var self = this;
                $.post(
                    'http://1.beauty.applinzi.com/api/showCollect.php',
                    {
                        username:self.username
                    },
                    function(data){
//                        console.log(JSON.parse(data));
//                        self.list = data
                        self.list = JSON.parse(data);
                        console.log(data);
                    }
                )
                callback();

            },
            showPic(){
                var self = this;
                $(function(){
                    var imgWidth = $('#colWrap').innerWidth()*0.45;
                    var vgap = 5;
                    myCollect();
                    function myCollect(){
                        var cellNum = Math.floor($('#colWrap').innerWidth()/imgWidth);
                        var hgap = $('#colWrap').innerWidth()%imgWidth/(cellNum+1);
                        var arrPos = [];
                        var waterfall = document.querySelector('#colWrap');
                        console.log(waterfall)

                        var imglist = waterfall.children;
                        var imglist = $("#colWrap").children();
                        console.log(imglist)
                        for(var i=0;i<cellNum;i++){
                            arrPos.push({
                                left:(i+1)*hgap + i*imgWidth,
                                top:vgap
                            });
                        }
                        console.log(imglist.length);
                        for(let i=0;i<imglist.length;i++){
                            console.log(111)
                            // 并更新当前top值
                            var currentImg = imglist[i].querySelector('img');

                            // 图片加载完成
                            // complete属性为true
                            currentImg.onload = function(){
                                var minIdx = 0;
                                var min = arrPos[minIdx].top;

                                for(var j=1;j<arrPos.length;j++){
                                    if(arrPos[j].top < min){
                                        min = arrPos[j].top;

                                        // 得到最小值对应的索引值
                                        minIdx = j;
                                    }
                                }
                                // 定位图片
                                console.log($(imglist[i]))
                                console.log(parseInt(arrPos[minIdx].top))
                                $(imglist[i]).animate({left:parseInt(arrPos[minIdx].left),top:parseInt(arrPos[minIdx].top)});

                                // 并更新当前top值
                                console.log(arrPos[minIdx].top)
                                arrPos[minIdx].top += vgap + imglist[i].offsetHeight;
                                console.log(vgap + imglist[i].offsetHeight)
                                console.log(arrPos[minIdx].top)
                            }
                            if(currentImg.complete){
                                currentImg.onload();
                            }

                        }
                    }
                })
            },
            delImg(t){
                var self = this;
                console.log(t);
                $.post(
                    'http://1.beauty.applinzi.com/api/deleteCollect.php',
                    {
                        title:t,
                        username:self.username
                    },
                    function(data){
                        window.location.href = "#/index/blank";
//                        window.location.reload()
//                        self.load(self.showPic);
                    }
                )
            }
        }
    }
</script>

<style>
    p{
        margin: 0;
    }
    #colWrap{
        height: 80%;
        top:10%;
        width: 100%;
        position: fixed;
        z-index: -1;
        overflow: auto;
    }

    .grid{
        width: 47%;
        border-radius: 5px;
        border: 1px solid #ddd;
        box-shadow: 0 0 5px #000;
        /*min-height: 200px;*/
        position: absolute;
        float: left;
        left:0;
        top:0;
    }

    .shadeWrap{
        width: 100%;
        height: 100%;
        position: relative;
    }

    .grid img{
        width:100%;
    }
    .shade{
        width: 100%;
        background: rgba(0,0,0,.5);
        border-radius: 0 0 5px 5px;
        color: #fff;
        height:50px;
        max-height: 100px;
        position: absolute;
        bottom:0;
    }

    .shade table{
        width:100%;
        height:100%;
    }

    .imgTitle{
        max-width: 80px;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
    }

</style>