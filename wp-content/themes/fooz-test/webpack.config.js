const defaultConfig = require('@wordpress/scripts/config/webpack.config');
const path = require('path');
const CopyWebpackPlugin = require('copy-webpack-plugin');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');

module.exports = {
    ...defaultConfig,
    entry: {
        ...defaultConfig.entry(),
        'js/scripts': './src/js/scripts.js',
        'css/main': './src/scss/main.scss',
    },
    output: {
        path: path.resolve(process.cwd(), 'build'),
        filename: '[name].js',
    },
    plugins: [
        ...defaultConfig.plugins,

        new CopyWebpackPlugin({
            patterns: [
                { from: 'src/images', to: 'images', noErrorOnMissing: true },
                { from: 'src/fonts', to: 'fonts', noErrorOnMissing: true },
            ],
        }),

        new BrowserSyncPlugin({
            proxy: 'fooz.local',
            files: [
                './build/css/*.css',
                './build/js/*.js',
                './inc/**/*.php',
                './templates/**/*.html',
                './**/*.php'
            ],
            injectChanges: true,
            open: false,
        }, { reload: false }),
    ],
};