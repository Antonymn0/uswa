require("./bootstrap");
import { createApp, h } from "vue"
    ;
import moment from "moment";
window.axios = require("axios");

import router from "./app/Router/index.js";
import store from "./app/Store/store.js";

import App from "./App.vue";


/* import the fontawesome core */
import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { far } from "@fortawesome/free-regular-svg-icons";
import { fas } from "@fortawesome/free-solid-svg-icons";
import { dom } from "@fortawesome/fontawesome-svg-core";

/* add icons to the library */
library.add(far, fas);
dom.watch();



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
app.component("font-awesome-icon", FontAwesomeIcon);
app.component("App", App).use(router).use(store).mount("#app");

