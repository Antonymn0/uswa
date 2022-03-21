export const signupProcess_about = {
    state: () => ({
        about: {
            first_name: null,
            middle_name: null,
            last_name: null,
            country: null,
            city: null,
            timezone: null,
            currency: null,
            language: null,
            level: null,
            subject: null,
            subject_level: null,
            phone: null,
            over18: null,
            description:null
        },
    }),

    getters: {},
    mutations: {
        set_first_name(state, payload) {
            state.about.first_name = payload;
        },
        set_middle_name(state, payload) {
            state.about.middle_name = payload;
        },
        set_last_name(state, payload) {
            state.about.last_name = payload;
        },
        set_country(state, payload) {
            state.about.country = payload;
        },
        set_city(state, payload) {
            state.about.city = payload;
        },
        set_timezone(state, payload) {
            state.about.timezone = payload;
        },
        set_currency(state, payload) {
            state.about.currency = payload;
        },
        set_language(state, payload) {
            state.about.language = payload;
        },
        set_level(state, payload) {
            state.about.level = payload;
        },
        set_subject(state, payload) {
            state.about.subject = payload;
        },
        set_subject_level(state, payload) {
            state.about.subject_level = payload;
        },
        set_phone(state, payload) {
            state.about.phone = payload;
        },
        set_over18(state, payload) {
            state.about.over18 = payload;
        },
        set_description_about(state, payload) {
            state.about.description = payload;
        },
    },
};
