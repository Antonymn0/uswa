
import { createApp } from 'vue';
import { createStore } from 'vuex';


import { token } from './modules/token.js';
import { user } from './modules/user.js';



const store = createStore({
    modules:{
        token,
        user
    }
});

export default store;
