import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import daisyui from "daisyui"

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        "./resources/**/*.js",
        "./resources/**/*.css",
    ],

    theme: {
        extend: {
            fontFamily: {
                montserrat: "Montserrat, serif",
                merriweather: "Merriweather, serif",
                icon: "'Font Awesome 6 Free'",
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            margin: {
                escape: "calc(-50vw + 50%)",
            },
            container: {
                screens: {
                    sm: "640px",
                    md: "768px",
                    lg: "1024px",
                    xl: "1024px",
                },
            },
            screens: {
                sm: "640px",
                md: "768px",
                lg: "1024px",
                xl: "1280px",
            },
        },
    },

    plugins: [
        forms,
        daisyui
    ],
};
