/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.jsx',
    ],
    theme: {
        extend: {
            colors: {
                // Warm, calm, premium fashion-store palette
                accent: {
                    DEFAULT: '#B67D62', // dusty clay/terracotta — CTAs, active states, discount badges
                    light:   '#C79280',
                    pale:    '#F7EEE8',
                    dark:    '#8A5C46',
                },
                ink: {
                    DEFAULT: '#1F1D1B', // near-black charcoal — text, dark surfaces
                    2:       '#2B2825',
                },
                cream: {
                    DEFAULT: '#F5F1EA', // warm sand background
                    2:       '#EFE9DF',
                    3:       '#E4DCCC',
                },
                muted: '#8C8275', // secondary/stone text
            },
            fontFamily: {
                cairo: ['Cairo', 'sans-serif'],
            },
        },
    },
    plugins: [
        require('@tailwindcss/forms'),
    ],
};
