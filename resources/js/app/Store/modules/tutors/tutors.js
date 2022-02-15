export const tutors = {
    state: () => ({
       tutors:{}
    }),

    actions: {},

    mutations: {
        set_tutors(state, tutors) {
            state.tutors = tutors;
        },
        unset_tutors(state, tutors = null) {
            state.tutors = tutors;            
        },
    },

    getters: {},
};
