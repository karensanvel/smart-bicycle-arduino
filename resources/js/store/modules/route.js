/** VUEX module for route management */

export default {
  namespaced: true,
  state: {
    // initial state
    route: null,
  },
  getters: {
    // getters
    lastRoute: state => {
      return state.route;
    },
  },
  mutations: {
    // mutations
    SET_LAST_ROUTE: (state, route) => {
      state.route= route;
    },
  },
  actions: {
    // actions
    SET_LAST_ROUTE: ({ commit }, route) => {
      commit('SET_LAST_ROUTE', route);
    },
  },
};