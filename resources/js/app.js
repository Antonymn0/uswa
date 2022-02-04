require("./bootstrap");
import { createApp, h } from "vue";

import axios from "axios";

// import moment from "moment";
window.axios.defaults.headers.common = {
    "X-Requested-With": "XMLHttpRequest",
    "X-CSRF-TOKEN": document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content"),
};


import App from "./App.vue";

import router from "./app/Router/index.js";
import store from "./app/Store/store.js";

const app = createApp({});
app.component("App", App).use(router).use(store).mount("#app");
app.config.globalProperties.axios = axios;
