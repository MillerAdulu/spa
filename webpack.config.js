const path = require('path');
const webpack = require('webpack');

module.exports = {
    resolve: {
        alias: {
            '@': path.resolve('resources/js'),
            //'vue$': 'vue/dist/vue.esm.js' // 'vue/dist/vue.common.js' for webpack 1. Inertia squawked with this-attempting to solve devtools issue. Inertia wrapping must be making it into an inertia app? No, was visible in laracast tutorial.
        },
    },

    plugins: [
        new webpack.DefinePlugin({
          __VUE_OPTIONS_API__: true,
          __VUE_PROD_DEVTOOLS__: false,
          'process.env': {
            NODE_ENV: JSON.stringify('development')
          }
        }),
      ],
};
