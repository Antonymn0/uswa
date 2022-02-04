require("./bootstrap");
import { createApp, h } from "vue";

import axios from "axios";

// import moment from "moment";

import App from "./App.vue";

import router from "./app/Router/index.js";
import store from "./app/Store/store.js";

const app = createApp({});
app.component("App", App).use(router).use(store).mount("#app");

