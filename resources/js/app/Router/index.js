import { createRouter, createWebHistory } from "vue-router";
import routes from "./routes";
import student_routes from "./student/routes";
import store from "../Store/store";

const router = new createRouter({
    history: createWebHistory(),
    student_routes,
    routes,
});

export default router;
