const fs = require('fs')
const { promisify } = require('util')
const { npmToYarn, yarnToNpm } = require('synp')
const exec = promisify(require('child_process').exec)

const syncLock = async lockFile => {
  console.log('\x1b[1m\x1b[32mSyncing lock files\x1b[0m')
  if (fs.existsSync(lockFile)) {
    fs.unlinkSync(lockFile)
  }
  const stringifiedLock = lockFile === 'yarn.lock' ? await npmToYarn('./') : await yarnToNpm('./')
  const writeStream = fs.createWriteStream(lockFile).on('error', err => console.trace(err))
  writeStream.write(stringifiedLock)
  writeStream.end()
}

const lockFileStaged = async lockFile => {
  const { stdout } = await exec('git diff --cached --name-only --diff-filter=ACM')
  return stdout.includes(lockFile)
}

(async () => {
  if (await lockFileStaged('package-lock.json') && await lockFileStaged('yarn.lock')) {
    console.log('\x1b[1m\x1b[32mNo need to update both lock files, but thank you anyways! :)\x1b[0m')
  } else if (await lockFileStaged('yarn.lock')) {
    await syncLock('package-lock.json')
  } else if (await lockFileStaged('package-lock.json')) {
    await syncLock('yarn.lock')
  }
})()
