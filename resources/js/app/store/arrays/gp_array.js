export default {
    state: {
        arrayGP: []
    },

    getters: {
        getArrayGP(state) {
            return state.arrayGP;
        }
    },

    mutations: {
        setArrayGP(state, payload) {
            state.arrayGP = payload;
        }
    },

    actions: {
        setArrayGP({commit}, payload) {
            commit('setArrayGP', payload);
        }
    }
}
