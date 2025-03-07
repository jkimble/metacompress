/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.css",
    ],

    theme: {
        extend: {
            fontFamily: {
                montserrat: "Montserrat, serif",
                merriweather: "Merriweather, serif",
                icon: "'Font Awesome 6 Free'",
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
                    primary: "#117768",
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
                deepocean: {
                    primary: "oklch(80% 0.105 251.813)",
                    "primary-focus": "oklch(80% 0.105 251.813)",
                    "primary-content": "oklch(28% 0.091 267.935)",

                    secondary: "oklch(84% 0.143 164.978)",
                    "secondary-focus": "oklch(84% 0.143 164.978)",
                    "secondary-content": "oklch(26% 0.051 172.552)",

                    accent: "oklch(85% 0.138 181.071)",
                    "accent-focus": "oklch(85% 0.138 181.071)",
                    "accent-content": "oklch(27% 0.046 192.524)",

                    neutral: "oklch(27% 0.041 260.031)",
                    "neutral-focus": "oklch(27% 0.041 260.031)",
                    "neutral-content": "oklch(98% 0.003 247.858)",

                    "base-100": "oklch(12% 0.042 264.695)",
                    "base-200": "oklch(20% 0.042 265.755)",
                    "base-300": "oklch(27% 0.041 260.031)",
                    "base-content": "oklch(96% 0.007 247.896)",

                    info: "oklch(60% 0.126 221.723)",
                    success: "oklch(59% 0.145 163.225)",
                    warning: "oklch(66% 0.179 58.318)",
                    error: "oklch(58% 0.253 17.585)",

                    "--rounded-box": "1rem",
                    "--rounded-btn": "0.5rem",
                    "--rounded-badge": "1.9rem",

                    "--animation-btn": "0.25s",
                    "--animation-input": "0.2s",

                    "--btn-text-case": "uppercase",
                    "--navbar-padding": "0.5rem",
                    "--border-btn": "1px",
                }
            },
        ],
    },

    plugins: [require("daisyui")],
};
