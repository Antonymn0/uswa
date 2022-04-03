export const signupProcess_education = {
    state: () => ({
        education: {
            institution: null,
            level: null,
            // type: null,
            specialty: null,
            study_from: null,
            study_to: null,
            i_dont_have_certificate: false,
            img_preview: null,
            image: null,
        },
    }),

    getters: {},
    mutations: {
        set_education_img_preview(state, payload) {
            state.education.img_preview = payload;
        },
        set_education_image(state, payload) {
            state.education.image = payload;
        },
        set_institution(state, payload) {
            state.education.institution = payload;
        },
        set_education_level(state, payload) {
            state.education.level = payload;
        },
        // set_type(state, payload) {
        //     state.education.type = payload;
        // },
        set_specialty(state, payload) {
            state.education.specialty = payload;
        },
        set_education_study_from(state, payload) {
            state.education.study_from = payload;
        },
        set_education_study_to(state, payload) {
            state.education.study_to = payload;
        },
        set_i_dont_have_certificate(state, payload) {
            state.education.i_dont_have_certificate = payload;
        },
    },
};
