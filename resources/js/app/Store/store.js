
import { createStore } from 'vuex';
import { token } from './modules/token/token.js';
import { user } from './modules/user/user.js';
import { signupProcess_about } from "./modules/tutorSignupProcess/signupProcess_about.js";
import { signupProcess_profilePhoto } from "./modules/tutorSignupProcess/signupProcess_profilePhoto.js";
import { signupProcess_certification } from "./modules/tutorSignupProcess/signupProcess_certification.js";
import { signupProcess_education } from "./modules/tutorSignupProcess/signupProcess_education.js";
import { signupProcess_video } from "./modules/tutorSignupProcess/signupProcess_video.js";
import { signupProcess_availability } from "./modules/tutorSignupProcess/signupProcess_availability.js";
import { tutors} from "./modules/tutors/tutors.js";

const store = createStore({
    modules: {
        token,
        user,
        signupProcess_about,
        signupProcess_profilePhoto,
        signupProcess_certification,
        signupProcess_education,
        signupProcess_video,
        signupProcess_availability,
        tutors
    },

});

export default store;
