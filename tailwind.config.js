/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./*.php", "./includes/*.php"],
  theme: {
    extend: {
      gridTemplateColumns: {
        'cards' : 'repeat(auto-fill,minmax(250px,1fr))',
        'cards2' : 'repeat(auto-fill,minmax(300px,1fr))'
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

