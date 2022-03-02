module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./node_modules/@themesberg/flowbite/**/*.js",
  ],
  theme: {
    extend: {
      screens: {
        '3xl': '2000px'
      }
    },
  },
  plugins: [
    require('@themesberg/flowbite/plugin')
  ],
}
