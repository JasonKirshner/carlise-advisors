const path = require('path')
const postcss = require('postcss')
const postcssImport = require('postcss-import')
const globby = require('globby')
const fs = require('fs')

const getModuleStyleSheets = () => {
  const modulesPath = process.cwd() + '/modules/**/*.css'
  return globby(modulesPath).then(files => {
    return files.map(file => path.normalize(file))
  })
}

const getImportedFile = (id, base) => {
  const parsed = path.parse(id)
  const formats = [
    '%', // full file path
    '%.scss', // SCSS
    '_%.scss', // SCSS partial
    '%.css', // CSS
    '%.json', // JSON data (Sass variables)
    '%/style.scss' // Folder containing SCSS
  ]

  let out = []
  let file = ''
  formats.forEach(format => {
    let unresolved = path.join(parsed.dir, format.replace('%', parsed.base))
    out.push(path.join(base, unresolved))
    file = out.reduce((a, b) => {
      return fs.existsSync(a) ? a : b
    })
  })

  return Promise.resolve(file)
}

const resolve = (id, basedir, importOptions) => {
  if (/<ModuleStyles>/.test(id)) {
    return getModuleStyleSheets()
  } else {
    return getImportedFile(id, basedir)
  }
}

const init = (opts = {}) => {
  opts.resolve = resolve
  return postcss([postcssImport(opts)])
}

module.exports = postcss.plugin('postcss-modular-css', init)
