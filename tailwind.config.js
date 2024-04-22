/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./*.php", "./includes/*.php"],
  theme: {
    extend: {
      gridTemplateColumns: {
        'cards' : 'repeat(auto-fit,minmax(250px,1fr))'
      },
      flex : {
        '30': '1 1 30%',
        '70': '1 1 70%',
        '50': '1 1 50%',
        '40': '1 1 40%',
      }
    },
  },
  plugins: [],
}

