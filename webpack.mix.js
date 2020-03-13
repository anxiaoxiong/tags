let mix = require('laravel-mix')

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.setResourceRoot('../')

mix.options({
  extractVueStyles: true,
  processCssUrls: true,
  uglify: {},
  purifyCss: false,
  postCss: [require('autoprefixer')],
  clearConsole: false
})

mix.webpackConfig({
  output: {
    chunkFilename: 'js/iwrs.[name].js'
  }
})

mix.js('resources/assets/js/app.js', 'public/js')
  .sass('resources/assets/sass/app.scss', 'public/css')
  .extract(['vue', 'vue-router', 'vuex', 'axios', 'element-ui'])

mix.copy('resources/assets/images', 'public/images', false)

if (mix.config.inProduction) {
  mix.version()
  mix.disableNotifications()
}
