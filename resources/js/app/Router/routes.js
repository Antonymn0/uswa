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
        component: require("../components/Home/HomePage.vue").default,
    },

    // student routes
    {
        name: "student-dashboard",
        path: "/dashboard/student",
        component: require("../components/Student/Dashboard.vue").default,
    },
    // Tutor routes
    {
        name: "tutor-dashboard",
        path: "/dashboar/tutor",
        component: require("../components/Tutor/Dashboard.vue").default,
    },

    //fallback route
    {
        name: "404",
        path: "/:catchAll(.*)",
        component: require("../components/Errors/404.vue").default,
    },
];

export default routes;
