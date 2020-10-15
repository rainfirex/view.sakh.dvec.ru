export default {
    state: {
        arrayPeny: []
    },

    getters: {
        getArrayPeny(state) {
            return state.arrayPeny;
        }
    },

    mutations: {
        setArrayPeny(state, payload) {
            state.arrayPeny = payload;
        }
    },

    actions: {
        setArrayPeny({commit}, payload) {
            commit('setArrayPeny', payload);
        }
    }
}
