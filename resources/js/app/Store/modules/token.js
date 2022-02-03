export const token = {
    state: () => ({
        token: localStorage.getItem('uswa_token'),
        
    }),

    actions: {},

    mutations: {
        setToken(state, token) {
            state.token = token;
            localStorage.setItem('uswa_token', token);
        },
    },

    getters: {},
};
