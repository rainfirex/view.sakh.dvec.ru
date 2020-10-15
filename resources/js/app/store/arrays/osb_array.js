export default {
    state: {
        arrayOSB: []
    },

    getters: {
        getArrayOSB(state) {
            return state.arrayOSB;
        }
    },

    mutations: {
        setArrayOSB(state, payload) {
            state.arrayOSB = payload;
        }
    },

    actions: {
        setArrayOSB({commit}, payload) {
            commit('setArrayOSB', payload);
        }
    }
}
