module.exports = {
    content: ["./assets/**/*.js", "./templates/**/*.html.twig"],
    theme: {
        extend: {},
    },
    plugins: [
        function ({ addUtilities }) {
            const newUtilities = {
                '.text-border-black': {
                    textShadow: '-1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000',
                },
            };

            addUtilities(newUtilities, ['responsive', 'hover']);
        },
    ],
};
