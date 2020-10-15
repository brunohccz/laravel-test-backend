import AuthService from "@/services/AuthService";

export default {
    namespaced: true,

    state: {
        authenticated: false,
        user: null
    },

    getters: {
        authenticated(state) {
            return state.authenticated;
        },

        user(state) {
            return state.user;
        }
    },

    mutations: {
        SET_AUTHENTICATED(state, value) {
            state.authenticated = value;
        },

        SET_USER(state, value) {
            state.user = value;
        }
    },

    actions: {
        async login({ dispatch }, form) {
            await AuthService.login(form);

            return dispatch("me");
        },

        async logout({ dispatch }) {
            await AuthService.logout();

            return dispatch("me");
        },

        me({ commit }) {
            return AuthService.me()
                .then(response => {
                    commit("SET_AUTHENTICATED", true);
                    commit("SET_USER", response.data);
                })
                .catch(() => {
                    commit("SET_AUTHENTICATED", false);
                    commit("SET_USER", null);
                });
        }
    }
};
