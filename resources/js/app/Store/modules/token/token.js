export const token = {
    state:  () => ({
        token: localStorage.getItem('uswa_token') || '',        
    }),

    actions: {},

    mutations: {
        setToken(state, token) {
            state.token = token;
            localStorage.setItem('uswa_token', token);
            console.log("Token successfuly set..")
        },
        unsetToken(state, token=null) {
            state.token = '';
            localStorage.removeItem('uswa_token');
            console.log('Token unset...');
        },
    },

    getters: {
        getToken(state) {
            return state.token;
        }
    },
};
