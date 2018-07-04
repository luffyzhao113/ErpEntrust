import Vue from 'vue'
import iView from 'iview'
import VueRouter from 'vue-router'
import App from './App.vue'
import store from './store'
import {router} from '../js/router/index'
import AjaxPlugin from '../js/plugins/ajax'
import CachePlugin from '../js/plugins/cache'

Vue.use(VueRouter);
Vue.use(iView);
Vue.use(AjaxPlugin)
Vue.use(CachePlugin)

const app = new Vue({
    el: '#app',
    store,
    router,
    mounted () {
        this.$nextTick(function () {
            this.$store.commit('init')
        });
    },
    render: h => h(App)
});
