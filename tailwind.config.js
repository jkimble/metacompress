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
    daisyui: {
        themes: [
            {
                kimbcode: {
                    primary: "#1EB8A1",
                    "primary-focus": "#1E82B8",
                    "primary-content": "#ffffff",

                    secondary: "#20d55f",
                    "secondary-focus": "#18aa4b",
                    "secondary-content": "#ffffff",

                    accent: "#d99330",
                    "accent-focus": "#b57721",
                    "accent-content": "#ffffff",

                    neutral: "#110e0e",
                    "neutral-focus": "#060404",
                    "neutral-content": "#ffffff",

                    "base-100": "#171212",
                    "base-200": "#110e0e",
                    "base-300": "#060404",
                    "base-content": "#ffffff",

                    info: "#66c7ff",
                    success: "#87cf3a",
                    warning: "#e1d460",
                    error: "#ff6b6b",

                    "--rounded-box": "1rem",
                    "--rounded-btn": "0.5rem",
                    "--rounded-badge": "1.9rem",

                    "--animation-btn": "0.25s",
                    "--animation-input": "0.2s",

                    "--btn-text-case": "uppercase",
                    "--navbar-padding": "0.5rem",
                    "--border-btn": "1px",
                },
            },
        ],
    },

    plugins: [require("daisyui")],
};
