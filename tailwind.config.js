/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                "primary": "#2C3E50",
                "secondary": "#673AB7",
                "accent": "#FFD700",
                "gray": "#1f2937",
            },
        },

    },
    plugins: [
        require('@tailwindcss/forms'),
    ],
}
