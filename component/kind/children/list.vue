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

    </div>
</template>

<script>
    export default{
        data(){
            return{
                toast: false,
                open: false,
                docked: true
            }
        },
        computed:{
            picArr(){
                return this.$store.getters.getArr;
            }
        },
        mounted(){

        },
        methods:{

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