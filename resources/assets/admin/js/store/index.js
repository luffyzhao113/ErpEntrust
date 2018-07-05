import Vue from 'vue'
import Vuex from 'vuex'

import App from './modules/layout'
import Messages from './modules/messages'
import Role from './modules/roles'
import Auth from './modules/auth'
import Admin from './modules/admin'

Vue.use(Vuex)

const store = new Vuex.Store({
    state: {},
    mutations: {},
    actions: {},
    modules: {
        App,
        Messages,
        Role,
        Auth,
        Admin
    }
})

export default store
