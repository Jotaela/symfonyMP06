var Encore = require('@symfony/webpack-encore');

const VuetifyLoaderPlugin = require('vuetify-loader/lib/plugin')
// Manually configure the runtime environment if not already configured yet by the "encore" command.
// It's useful when you use tools that rely on webpack.config.js file.
if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}

Encore
    .setOutputPath('public/build/')
    .setPublicPath('/build')
    .enableVueLoader()

    .addEntry('js/app', './assets/js/app.js')
    .addEntry('css/app', './assets/css/app.scss')

    .autoProvidejQuery()
    .splitEntryChunks()
    .enableSingleRuntimeChunk()
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(Encore.isProduction())
    .configureBabel(() => {}, {
        useBuiltIns: 'usage',
        corejs: 3
    })
    // add VuetifyLoaderPlugin: THIS loads all of the Vuetify components
    .addPlugin(new VuetifyLoaderPlugin())
    // enables Sass/SCSS support
    .enableSassLoader(options => {
        options.implementation = require('sass')
        options.fiber = require('fibers')
    })
;

module.exports = Encore.getWebpackConfig();
