const { promisify } = require('util')
const exec = promisify(require('child_process').exec)

const commitSyncedLock = async lockFile => {
  const { error } = await exec(`git add ${lockFile} && git commit -n -m "Synced ${lockFile}"`)
  error && console.error(`\x1b[41m\x1b[37m${error.code}`)
}

(async () => {
  const unstaged = await exec('git diff --name-only')

  const committed = await exec('git diff --name-only HEAD HEAD~1')

  if (unstaged.stdout.includes('yarn.lock') && committed.stdout.includes('package-lock.json')) {
    await commitSyncedLock('yarn.lock')
  } else if (unstaged.stdout.includes('package-lock.json') && committed.stdout.includes('yarn.lock')) {
    await commitSyncedLock('package-lock.json')
  }
})()
