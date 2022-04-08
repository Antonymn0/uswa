export const user = {
    state:  () => ({
        user:  {},
        is_logedin:false,
    }),

    actions: {},

    mutations: {
        setUser(state, user) {
            state.user = user;           
            state.is_logedin = true;
        },
        unsetUser(state, user=null) {
            state.user = {};           
            state.is_logedin = false;
        }
    },

    getters: {
        isLogedIn(state) {
            return state.is_logedin;
        },
        getUser(state) {
            return state.user;
        },
        
    },
};
