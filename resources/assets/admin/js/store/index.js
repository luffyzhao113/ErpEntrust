import Vue from 'vue'
import Vuex from 'vuex'

import App from './modules/admin'
import Messages from './modules/messages'
import Role from './modules/roles'
import Auth from './modules/auth'

Vue.use(Vuex)

const store = new Vuex.Store({
    state: {},
    mutations: {},
    actions: {},
    modules: {
        App,
        Messages,
        Role,
        Auth
    }
})

export default store
