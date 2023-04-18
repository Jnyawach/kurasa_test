/** @type {import('tailwindcss').Config} */
module.exports = {
    darkMode: 'class',
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        fontFamily:{
            'spartan':['"League Spartan"','sans-serif'],
        },

        extend: {

        },
    },
    plugins: [],
}
