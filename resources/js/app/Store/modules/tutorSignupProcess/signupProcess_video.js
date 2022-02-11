export const signupProcess_video = {
    state: () => ({
        video: {
           
            video_preview: null,
            video: null,
            video_url:null
        },
    }),

    getters: {},
    mutations: {
        set_video_preview(state, payload) {
            state.video.video_preview = payload;
        },
        set_video(state, payload) {
            state.video.video = payload;
        },
        set_video_url(state, payload) {
            state.video.video_url = payload;
        },
        
        
    },
};
