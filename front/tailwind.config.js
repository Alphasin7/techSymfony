/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './index.html',
    './src/components/login/*.{vue,js,ts,jsx,tsx}',
    './src/components/register/*.{vue,js,ts,jsx,tsx}',
    './src/views/Login.vue',
    './src/views/Register.vue'
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}

