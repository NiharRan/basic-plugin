let mix = require('laravel-mix');
const path = require("path");

mix.webpackConfig({
    module: {
      rules: [
        {
          enforce: 'pre',
          test: /\.(js|vue)$/,
          loader: 'eslint-loader',
          exclude: /node_modules/
        }
      ]
    },
    output: {
        publicPath: Mix.isUsing('hmr') ? '/' : '/wp-content/plugins/basic-plugin/assets/',
        chunkFilename: 'js/[name].js'
    },
    plugins: [

    ],
    resolve: {
        extensions: ['.js', '.vue', '.json'],
        alias: {
            '@': path.resolve(__dirname, 'resources/js/src')
        }
    }
});

mix.options({ processCssUrls: false });

mix
    .js('resources/js/app.js', 'js/app.js').vue({ version: 2 })
    .js('resources/js/bootstrap.js', 'js/bootstrap.js').vue({ version: 2 })
    .sass('resources/scss/app.scss', 'css/app.css')
    .setPublicPath('assets')
    .disableNotifications();
