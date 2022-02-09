
import { createApp } from 'vue';
import { createStore } from 'vuex';

import { token } from './modules/token.js';
import { user } from './modules/user.js';
import { tutorSignUpProcess } from "./modules/tutorSignUpProcess.js";

const store = createStore({
    modules: {
        token,
        user,
        tutorSignUpProcess,
    },
});

export default store;
