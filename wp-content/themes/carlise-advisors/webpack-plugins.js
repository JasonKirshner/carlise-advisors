const path = require('path')
const _MiniCssExtractPlugin = require('mini-css-extract-plugin')
const _StyleLintPlugin = require('stylelint-webpack-plugin')

const StyleLintPlugin = new _StyleLintPlugin({
  context: path.resolve(__dirname),
  files: '**/*.css',
  failOnError: false,
  quiet: false
})

const MiniCssExtractPlugin = new _MiniCssExtractPlugin({
  filename: '[name].min.css',
  chunkFilename: '[id].css'
})

module.exports = {
  MiniCssExtractPlugin: MiniCssExtractPlugin,
  StyleLintPlugin: StyleLintPlugin
}
