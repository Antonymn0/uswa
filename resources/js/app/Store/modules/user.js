export const user = {
    state: () => ({
        user: JSON.parse(localStorage.getItem("uswa_user")) || null,
        loged_in:false,
    }),

    actions: {},

    mutations: {
        setUser(state, user) {
            state.user = user;
            localStorage.setItem("uswa_user", JSON.stringify(user));
            state.loged_in = true;
        },
        unsetUser(state,user) {
            state.user = null;
            localStorage.removeItem("uswa_user");
            state.loged_in = false;
        }
    },

    getters: {},
};
