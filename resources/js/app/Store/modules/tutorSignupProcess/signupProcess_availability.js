import moment from "moment";

export const signupProcess_availability = {
    state: () => ({
        availability: {
            av_timezone: null,
            hourly_rate: 5,

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
        set_av_timezone(state, timezone) {
            state.availability.av_timezone = timezone;
        },
        set_hourly_rate(state, hourly_rate) {
            state.availability.hourly_rate = hourly_rate;
        },
        set_monday(state, is_available, from, to) {
            state.monday.is_available = is_available;
            state.monday.from = moment.utc(from, "HH:mm");
            state.monday.to = moment.utc(to, "HH:mm");
        },
        set_tuesday(state, is_available, from, to) {
            state.tuesday.is_available = is_available;
            state.tuesday.from = moment.utc(from, "HH:mm");
            state.tuesday.to = moment.utc(to, "HH:mm");
        },
        set_wedneday(state, is_available, from, to) {
            state.wedneday.is_available = is_available;
            state.wedneday.from = moment.utc(from, "HH:mm");
            state.wedneday.to = moment.utc(to, "HH:mm");
        },
        set_thursday(state, is_available, from, to) {
            state.thursday.is_available = is_available;
            state.thursday.from = moment.utc(from, "HH:mm");
            state.thursday.to = moment.utc(to, "HH:mm");
        },
        set_friday(state, is_available, from, to) {
            state.friday.is_available = is_available;
            state.friday.from = moment.utc(from, "HH:mm");
            state.friday.to = moment.utc(to, "HH:mm");
        },
        set_saturday(state, is_available, from, to) {
            state.saturday.is_available = is_available;
            state.saturday.from = moment.utc(from, "HH:mm");
            state.saturday.to = moment.utc(to, "HH:mm");
        },
        set_sunday(state, is_available, from, to) {
            state.sunday.is_available = is_available;
            state.sunday.from = moment.utc(from, "HH:mm");
            state.sunday.to = moment.utc(to, "HH:mm");
        },
        RESET_AVAILABILITY_STATE(state) {
            Object.assign(state, getDefaultState());
        },
    },
};
