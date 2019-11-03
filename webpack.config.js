var Encore = require('@symfony/webpack-encore');

Encore
  .setOutputPath('public/build/')
  .setPublicPath('/build')
  .cleanupOutputBeforeBuild()
  .enableSourceMaps(!Encore.isProduction())
  .enableVersioning(Encore.isProduction())

  .addEntry('js/app', './assets/js/app.js') // your js entry file
  .addStyleEntry('css/app', './assets/scss/app.scss') // your less/scss entry file

  .enableSassLoader()
  .enablePostCssLoader()
;

module.exports = Encore.getWebpackConfig();
