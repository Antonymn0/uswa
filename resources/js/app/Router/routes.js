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
        path: "/student/find-tutors",
        component: require("../components/Student/FindTutors/FindTutors.vue").default,
    },
    // Tutor routes
    {
        name: "tutor-dashboard",
        path: "/dashboar/tutor",
        component: require("../components/Tutor/Dashboard.vue").default,
    },
    {
        name: "register-tutor",
        path: "/register/tutor",
        component: require("../components/Auth/RegisterTutor/RegisterTutor.vue").default,
    },
    {
        name: "register-tutor-signup",
        path: "/register/tutor-signup",
        component: require("../components/Auth/RegisterTutor/TutorSignUpProcess.vue").default,
    },
    {
        name: "tutor-signup-about",
        path: "/register/tutor-about",
        component: require("../components/Auth/RegisterTutor/TutorSignUpProcess.vue").default,
    },

    //fallback route
    {
        name: "404",
        path: "/:catchAll(.*)",
        component: require("../components/Errors/404.vue").default,
    },
];

export default routes;
