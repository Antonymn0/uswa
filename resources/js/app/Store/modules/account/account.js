export const account = {
    state: () => ({
        account: {available:0},
    }),

    actions: {},

    mutations: {
        set_account(state, account) {
            state.account = account;
        },
        unset_account(state, account = null) {
            state.account = {};
        },
    },

    getters: {
        getAccount(state) {
            return state.account;
        },
    },

    actions: {
        fetchLocalAccount(context) {
            axios.get("/api/local-account/balance")
            .then((response) => {
                context.commit("set_account", response.data.data);
            })
            .catch((error) => {
                console.log(error.response);
            });
        }
    }
};
