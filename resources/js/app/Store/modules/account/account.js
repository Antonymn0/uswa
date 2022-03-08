export const account = {
    state: () => ({
        account: {},
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
};
