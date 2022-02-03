const routes = [
    {
        name: "register",
        path: "/register",
        component: require("../components/Auth/Register.vue").default,
    },
    {
        name: "login",
        path: "/login",
        component: require("../components/Auth/Login.vue").default,
    },
    {
        name: "home",
        path: "/home",
        component: require("../components/Home/Home.vue").default,
    },
    {
        name: "frontpage",
        path: "/front-page",
        component: require("../components/Home/FrontPage.vue").default,
    },

    // student routes
    {
        name: "student-dashboard",
        path: "/student/dashboard",
        component: require("../components/Student/Dashboard.vue").default,
    },

    //fallback route
    {
        name: "404",
        path: "/:catchAll(.*)",
        component: require("../components/Errors/404.vue").default,
    },
];

export default routes;
