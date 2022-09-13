// eslint-disable-next-line no-undef
module.exports = {
    important: true,
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.tsx",
    ],
    theme: {
        extend: {
            colors: {
                brand: {
                    900: "#66060d",
                    800: "#8c0a0e",
                    700: "#b31515",
                    600: "#d92b25",
                    DEFAULT: "#ff4539",
                    400: "#ff7161",
                    300: "#ff998a",
                    200: "#ffbfb3",
                    100: "#ffe2db",
                }
            },
            height: {
                "112": "28rem",
                "128": "32rem",
                "144": "36rem",
                "160": "40rem",
            }
        },

    },
    plugins: [],
    corePlugins: {
        preflight: false
    }
};
