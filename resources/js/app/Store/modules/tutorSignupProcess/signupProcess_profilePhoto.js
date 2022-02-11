export const signupProcess_profilePhoto = {
    state: () => ({
        profilePhoto: {
            img_preview: null,
            image: null,            
        },
    }),

    getters: {},
    mutations: {
        set_profile_img_preview(state, payload) {
            state.profilePhoto.img_preview = payload;
        },
        set_profile_image(state, payload) {
            state.profilePhoto.image = payload;
        },
        
    },
};
