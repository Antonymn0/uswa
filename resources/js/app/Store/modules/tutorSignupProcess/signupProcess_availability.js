export const signupProcess_availability = {
    state: () => ({
        availability: {
            timezone: null,

            monday: {
                is_available: false,
                from: "00:00",
                to: "00:00",
            },
            tuesday: {
                is_available: false,
                from: "00:00",
                to: "00:00",
            },
            wednesday: {
                is_available: false,
                from: "00:00",
                to: "00:00",
            },
            thursday: {
                is_available: false,
                from: "00:00",
                to: "00:00",
            },
            friday: {
                is_available: false,
                from: "00:00",
                to: "00:00",
            },
            saturday: {
                is_available: false,
                from: "00:00",
                to: "00:00",
            },
            sunday: {
                is_available: false,
                from: "00:00",
                to: "00:00",
            },
        },
    }),

    getters: {},
    mutations: {
        set_timezone(state, timezone) {
            state.availability.timezone = timezone;
        },
        // set_monday(state, is_available, from, to) {
        //     state.monday.is_available = is_available;
        //     state.monday.from = from;
        //     state.monday.to = to;
        // },
        // set_tuesday(state, is_available, from, to) {
        //     state.tuesday.is_available = is_available;
        //     state.tuesday.from = from;
        //     state.tuesday.to = to;
        // },
        // set_wedneday(state, is_available, from, to) {
        //     state.wedneday.is_available = is_available;
        //     state.wedneday.from = from;
        //     state.wedneday.to = to;
        // },
        // set_thursday(state, is_available, from, to) {
        //     state.thursday.is_available = is_available;
        //     state.thursday.from = from;
        //     state.thursday.to = to;
        // },
        // set_friday(state, is_available, from, to) {
        //     state.friday.is_available = is_available;
        //     state.friday.from = from;
        //     state.friday.to = to;
        // },
        // set_saturday(state, is_available, from, to) {
        //     state.saturday.is_available = is_available;
        //     state.saturday.from = from;
        //     state.saturday.to = to;
        // },
        // set_sunday(state, is_available, from, to) {
        //     state.sunday.is_available = is_available;
        //     state.sunday.from = from;
        //     state.sunday.to = to;
        // },
        RESET_AVAILABILITY_STATE(state) {
            Object.assign(state, getDefaultState());
        },
    },
};
