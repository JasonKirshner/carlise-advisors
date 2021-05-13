const path = require('path')
const loaders = require('./webpack-loaders')
const plugins = require('./webpack-plugins')

module.exports = {
  entry: {
    main: [
      './src/js/main.js',
      './src/css/main.css'
    ]
  },
  output: {
    path: path.join(__dirname, 'assets'),
    filename: '[name].min.js'
  },
  module: {
    rules: [
      loaders.jsLoader,
      loaders.esLintLoader,
      loaders.cssLoader
    ]
  },
  resolve: {
    alias: {
      lib: path.resolve(__dirname, 'src/js/lib'),
      'modules-root': path.resolve(__dirname, 'modules')
    }
  },
  plugins: [
    plugins.StyleLintPlugin,
    plugins.MiniCssExtractPlugin
  ],
  performance: {
    hints: process.env.NODE_ENV === 'production' ? 'warning' : false
  }
}
