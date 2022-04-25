

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

    // ======================================================================================================================

    // STUDENT ROUTES
    {
        name: "find-tutor",
        path: "/student/find-tutors",
        component: require("../components/Student/FindTutors/FindTutors.vue")
            .default,
    },
    {
        name: "student-dashboard",
        path: "/dashboard/student",
        component: require("../components/Student/Dashboard.vue").default,
    },
    

    // ==================================================================================================================

    //TUTOR ROUTES
    {
        name: "tutor-dashboard",
        path: "/dashboard/tutor",
        component: require("../components/Tutor/Dashboard.vue").default,
    },
    {
        name: "register-tutor",
        path: "/register/tutor",
        component: require("../components/Auth/RegisterTutor/RegisterTutor.vue")
            .default,
    },
    {
        name: "register-tutor-signup",
        path: "/register/tutor-signup",
        component:
            require("../components/Auth/RegisterTutor/TutorSignUpProcess.vue")
                .default,
    },
    {
        name: "tutor-signup-about",
        path: "/register/tutor-about",
        component:
            require("../components/Auth/RegisterTutor/TutorSignUpProcess.vue")
                .default,
    },

    // ========================================================================================

    // ADMIN ROUTES
    {
        name: "admin-register",
        path: "/admin/register",
        component: require("../components/Admin/Register/Register.vue").default,
    },
    {
        name: "admin-dashboard",
        path: "/admin/dashboard",
        component: require("../components/Admin/Dashboard.vue").default,
    },
    {
        name: "all-users",
        path: "/admin/dashboard/users",
        component: require("../components/Admin/Users/AllUsers.vue").default,
    },
    {
        name: "all-lessons",
        path: "/admin/dashboard/lessons",
        component: require("../components/Admin/Lessons.vue").default,
    },
    {
        name: "tutor-review",
        path: "/admin/tutor/review",
        component: require("../components/Admin/Tutor/TutorReview.vue").default,
    },
    {
        name: "admin-account",
        path: "/admin/acount",
        component: require("../components/Admin/Account/Account.vue").default,
    },
    {
        name: "courses",
        path: "/admin/courses",
        component: require("../components/Admin/Courses/Courses.vue").default,
    },

    // =======================================================================
    // ACCOUNT ROUTES
    {
        name: "account",
        path: "/account",
        component: require("../components/LocalAccount/Account.vue").default,
    },

    // ------------------------------------------------------------------

    //fallback route
    {
        name: "404",
        path: "/:catchAll(.*)",
        component: require("../components/Errors/404.vue").default,
    },
];

export default routes;
