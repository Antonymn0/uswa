require("./bootstrap");
import { createApp, h } from "vue"
    ;
import moment from "moment";
window.axios = require("axios");

import router from "./app/Router/index.js";
import store from "./app/Store/store.js";

import App from "./App.vue";

axios.defaults.headers.common["Authorization"] = "Bearer " + store.getters.getToken;
// axios.defaults.baseURL = 'https://uswa-app.herokuapp.com';
axios.interceptors.request.use(
            (config) => {
                let token = store.getters.getToken;
                if (token) config.headers["Authorization"] = `Bearer ${token}`;        
                return config;
            },
            (error) => { return Promise.reject(error); }
        );

const app = createApp({});

app.component("App", App).use(router).use(store).mount("#app");

