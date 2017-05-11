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
var router = new VueRouter({
    routes:[{
        path:'/index',
        component:index
    },{
        path:'/detail',
        component:detail
    },{
        path:'/',
        redirect:'/index',
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
    ele:'#beautyApp',
    data:{},
    router,
    store,
    components:{
        index,
        detail
    }
})