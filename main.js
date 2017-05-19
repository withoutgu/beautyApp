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

var router = new VueRouter({
    routes:[{
        path:'/index',
        component:index,
        children:[{
            path:'pictures',
            component:pictures
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
        redirect:'/index/pictures',
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