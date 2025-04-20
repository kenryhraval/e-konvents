/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],
  theme: {
    extend: {
      colors: {
        // how does this work
        primary: '#ffffff',
        secondary: {
          500:rgb(2, 113, 72),
          600: rgb(1, 89, 57), 
          700: rgb(1, 72, 46), 
        },
      },
    },
  },
  plugins: [],
};
