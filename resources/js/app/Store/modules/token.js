export const token = {
    state: () => ({
        token: localStorage.getItem('uswa_token') || null,        
    }),

    actions: {},

    mutations: {
        setToken(state, token) {
            state.token = token;
            localStorage.setItem('uswa_token', token);
            console.log("token set..")
        },
        unsetToken(state, token=null) {
            state.token = null;
            localStorage.removeItem('uswa_token');
            console.log('Token unset...');
        },
    },

    getters: {},
};
