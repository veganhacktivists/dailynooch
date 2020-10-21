const UnitFunctions = {
  minute: (msDiff) => Math.floor(msDiff / 1000 / 60),
  hour: (minDiff) => Math.floor(minDiff / 60),
  day: (hrDiff) => Math.floor(hrDiff / 24),
  month: (dayDiff) => Math.floor(dayDiff / (365 / 12)),
  year: (mthDiff) => Math.floor(mthDiff / 12),
}

/**
 * Creates "xx hours/days/etc ago..." string from a given date.
 *
 * @param {string} date target date to diff against
 * @returns {string} formatted time-ago string
 */
export function getTimeAgo(date) {
  const then = new Date(date)
  const now = new Date()

  let diff = now - then
  let agoString = ''

  for (const unitKey in UnitFunctions) {
    if (!UnitFunctions.hasOwnProperty(unitKey)) continue

    const newDiff = UnitFunctions[unitKey](diff)
    if (newDiff <= 0) break

    diff = newDiff
    agoString = `${diff} ${unitKey}${diff === 1 ? '' : 's'} ago`
  }

  return agoString
}
