export default {
    state: {
        arrayShtraf: []
    },

    getters: {
        getArrayShtraf(state) {
            return state.arrayShtraf;
        }
    },

    mutations: {
        setArrayShtraf(state, payload) {
            state.arrayShtraf = payload;
        }
    },

    actions: {
        setArrayShtraf({commit}, payload) {
            commit('setArrayShtraf', payload);
        }
    }
}
