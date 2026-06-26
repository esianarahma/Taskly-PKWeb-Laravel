import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                brand: {
                    DEFAULT: '#D4537E',
                    hover: '#993556',
                    light: '#FBEAF0',
                    border: '#F4C0D1',
                    dark: '#72243E',
                    darker: '#4B1528',
                },
            },
        },
    },
    plugins: [forms],
};