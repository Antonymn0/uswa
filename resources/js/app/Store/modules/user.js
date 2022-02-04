export const user = {
    state: () => ({
        user:  null,
        is_logedin:false,
    }),

    actions: {},

    mutations: {
        setUser(state, user) {
            state.user = user;           
            state.is_logedin = true;
            console.log('User set...');
            console.log(state.is_logedin);
        },
        unsetUser(state,user) {
            state.user = null;           
            state.is_logedin = false;
            console.log('User Unset...');
        }
    },

    getters: {
        isLogedIn(state) {
            return state.is_logedin;
        }
    },
};
