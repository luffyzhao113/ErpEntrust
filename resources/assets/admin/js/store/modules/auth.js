export default {
    state: {
        data: {},
        permissions: []
    },
    getters: {
        rules: state => {
            return state.permissions.filter(val => val.islink === 0)
        },
        menus: state => {
            return state.permissions.filter(val => val.islink === 1)
        },
        user: state => {
            return state.data
        }
    },
    mutations: {
        setAuthData(state, data){
            state.data = data
        },
        setAuthPerms(state, data){
            state.permissions = data
        },
    }
}
