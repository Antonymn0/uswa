export const signupProcess_certification = {
    state: () => ({
        certification: {
            subject: null,
            certificate: null,
            issued_by: null,
            description: null,
            img_preview: null,
            study_from: null,
            study_to: null,
            i_dont_have_certificate: false,
            image: null,
            img_preview: null,
        },
    }),

    getters: {},
    mutations: {
        set_certificate_img_preview(state, payload) {
            state.certification.img_preview = payload;
        },
        set_certificate_image(state, payload) {
            state.certification.image = payload;
        },
        set_subject_cert(state, payload) {
            state.certification.subject = payload;
        },
        set_certificate(state, payload) {
            state.certification.certificate = payload;
        },
        set_issued_by(state, payload) {
            state.certification.issued_by = payload;
        },
        set_description_certification(state, payload) {
            state.certification.description = payload;
        },
        set_study_from(state, payload) {
            state.certification.study_from = payload;
        },
        set_study_to(state, payload) {
            state.certification.study_to = payload;
        },
        set_i_dont_have_certificate(state, payload) {
            state.certification.i_dont_have_certificate = payload;
        },
    },
};
