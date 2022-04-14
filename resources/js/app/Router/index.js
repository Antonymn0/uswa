import { createRouter, createWebHistory } from "vue-router";
import routes from "./routes";

import store from "../Store/store";

const router = new createRouter({
    history: createWebHistory(),    
    routes, 
});

export default router;
