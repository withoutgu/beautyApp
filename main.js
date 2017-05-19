/**
 * Created by westbrook on 2017/5/10.
 */
import $ from 'jquery';
window.$ = $;
import Vue from 'vue';
import VueRouter from 'vue-router';
Vue.use(VueRouter);
import Vuex from 'Vuex';
Vue.use(Vuex);
import MuseUI from 'muse-ui';
import 'muse-ui/dist/muse-ui.css'
Vue.use(MuseUI);

var index = require("./component/index.vue");
var detail = require("./component/detail.vue");
var pictures = require('./component/kind/pictures.vue');
var collect = require('./component/kind/collect.vue');
var me = require('./component/kind/me.vue');
var login = require('./component/kind/login.vue');
var register = require('./component/kind/register.vue');
var daxiongmei = require('./component/kind/children/daxiongmei.vue');
var xiaoqingxin = require('./component/kind/children/xiaoqingxin.vue');
var wenyifan = require('./component/kind/children/wenyifan.vue');
var xingganmei = require('./component/kind/children/xingganmei.vue');
var dachangtui = require('./component/kind/children/dachangtui.vue');
var heisiwa = require('./component/kind/children/heisiwa.vue');
var xiaoqiaotun = require('./component/kind/children/xiaoqiaotun.vue');

var router = new VueRouter({
    routes:[{
        path:'/index',
        component:index,
        children:[{
            path:'pictures',
            component:pictures,
            children:[{
                path:'daxiongmei',
                component:daxiongmei
            },{
                path:'xiaoqingxin',
                component:xiaoqingxin
            },{
                path:'wenyifan',
                component:wenyifan
            },{
                path:'xingganmei',
                component:xingganmei
            },{
                path:'dachangtui',
                component:dachangtui
            },{
                path:'heisiwa',
                component:heisiwa
            },{
                path:'xiaoqiaotun',
                component:xiaoqiaotun
            },]
        },{
            path:'collect',
            component:collect
        },{
            path:'me',
            component:me,
        },{
            path:'login',
            component:login,
        },{
            path:'register',
            component:register,
        }]
    },{
        path:'/detail',
        component:detail
    },{
        path:'/',
        redirect:'/index/pictures/daxiongmei',
        component:index
    }]
});
var store = new Vuex.Store({
    state:{

    },
    mutations:{

    },
    getters:{

    }
})
new Vue({
    el:'#beautyApp',
    template:`
        <router-view></router-view>
    `,
    data:{},
    router,
    store

})