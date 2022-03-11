export const account = {
    state: () => ({
        account: {
            'available': [  {'amount':0} ], // intialize account balance
        },
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
