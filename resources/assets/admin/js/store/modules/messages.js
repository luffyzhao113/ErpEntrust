import AjaxPlugin from '../../../js/plugins/ajax'
const app = {
  state: {
    total: 0
  },
  mutations: {
    getMessageNotReadTotal(state){
      AjaxPlugin.$http.get(`auth/message/not-read`).then((res) => {
        state.total = res.data.data.count
      })
    },
    decrement(state){
      state.total = state.total - 1
    }
  },
  actions: {
    getMessageNotReadTotal ({commit}) {
      commit('getMessageNotReadTotal')
      setInterval(() => {
        commit('getMessageNotReadTotal')
      }, 5 * 60 * 1000);
    }
  }
}

export default app
