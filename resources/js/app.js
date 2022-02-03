import { createApp, h } from "vue";

import App from './App.vue';

import router from './app/Router/index.js';
import store from './app/Store/store.js';


createApp({})
    .component("App", App)
    .use(router)
    .use(store)
    .mount("#app");