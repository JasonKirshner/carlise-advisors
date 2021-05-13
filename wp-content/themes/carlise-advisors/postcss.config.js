module.exports = {
  plugins: [
    require('./tasks/postcss-modular-css'),
    require('postcss-mixins'),
    require('postcss-custom-media'),
    require('postcss-nested'),
    require('postcss-extend'),
    require('postcss-for'),
    require('postcss-preset-env')({
      browsers: [
        'last 3 versions',
        'iOS >= 8',
        'ie 11'
      ],
      autoprefixer: {
        grid: 'autoplace'
      }
    }),
    require('postcss-critical-split')({
      output: process.env.ENV === 'production' ? 'rest' : 'input',
      startTag: 'defer:start',
      endTag: 'defer:end',
      blockTag: 'defer'
    }),
    require('postcss-automath'),
    require('cssnano')
  ]
}
