const path = require('path');
const { CleanWebpackPlugin } = require('clean-webpack-plugin');
const webpack = require('webpack');
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const { VueLoaderPlugin } = require("vue-loader");
const Dotenv = require('dotenv-webpack');

module.exports = {
    mode: "development",
    entry: {
        content: path.resolve(__dirname, './frontend/content.js'),
        install: path.resolve(__dirname, './frontend/install.js'),
    },
    output: {
        path: path.resolve(__dirname, './app/dist'),
        filename: '[name].bundle.js',
    },
    plugins: [
        new CleanWebpackPlugin(),
        new webpack.DefinePlugin({
            __VUE_OPTIONS_API__: true,
            __VUE_PROD_DEVTOOLS__: true,
        }),
        new MiniCssExtractPlugin({
            filename: '[name].bundle.css'
        }),
        new VueLoaderPlugin(),
        new Dotenv()
    ],
    module: {
        rules: [
            {
                test: /\.vue$/,
                loader: 'vue-loader'
            },
            {
                test: /\.css$/i,
                use: [MiniCssExtractPlugin.loader, "css-loader"],
            },
            {
                test: /\.(png|jpe?g|gif)$/i,
                type: 'asset/resource'
            }
        ],
    },
    resolve: {
        alias: {
            vue: 'vue/dist/vue.esm-bundler.js',
        }
    }
}