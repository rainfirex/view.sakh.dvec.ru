export default {
    state: {
        arrayCountError: []
    },

    getters: {
        getArrayCountError(state) {
            return state.arrayCountError;
        }
    },

    mutations: {
        setArrayCountError(state, payload) {
            state.arrayCountError = payload;
        }
    },

    actions: {
        setArrayCountError({commit}, payload) {
            commit('setArrayCountError', payload);
        }
    }
}
