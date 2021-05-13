const MiniCssExtractPlugin = require('mini-css-extract-plugin')
const path = require('path')

const jsLoader = {
  test: /\.js$/,
  exclude: /node_modules/,
  loader: 'babel-loader',
  options: {
    presets: [
      ['@babel/preset-env',
        {
          useBuiltIns: 'usage',
          corejs: 3,
          targets: ['defaults', 'not ie < 11']
        }
      ]
    ]
  }
}

const esLintLoader = {
  test: /\.js$/,
  enforce: 'pre',
  exclude: /node_modules/,
  use: {
    loader: 'eslint-loader',
    options: {
      formatter: 'codeframe',
      configFile: path.join(__dirname, '.eslintrc')
    }
  }
}

const cssLoader = {
  test: /\.css$/,
  exclude: /node_modules/,
  use: [
    {
      loader: MiniCssExtractPlugin.loader,
      options: {
        publicPath: path.join(__dirname, '/../../public/css/')
      }
    },
    {
      loader: 'css-loader',
      options: { importLoaders: 1 }
    },
    {
      loader: 'postcss-loader',
      options: {
        postcssOptions: {
          config: path.join(__dirname, 'postcss.config.js')
        }
      }
    }
  ]
}

module.exports = {
  jsLoader: jsLoader,
  esLintLoader: esLintLoader,
  cssLoader: cssLoader
}
