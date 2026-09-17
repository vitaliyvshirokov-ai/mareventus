import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

export default {
    content: ['./resources/views/**/*.blade.php', './resources/js/**/*.js'],
    theme: {
        extend: {
            colors: { navy: '#0B3D66', ink: '#082E50', orange: '#E8542A', mist: '#F5F7FA' },
            fontFamily: { sans: ['Manrope', ...defaultTheme.fontFamily.sans] },
        },
    },
    plugins: [forms],
};
