export const user = {
    state: () => ({
        user: JSON.parse(localStorage.getItem("uswa_user")) || null,
    }),

    actions: {},

    mutations: {
        setUser(state, user) {
            state.user = user;
            localStorage.setItem("uswa_user", JSON.stringify(user));
        },
    },

    getters: {},
};
