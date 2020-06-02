// Method that adds and removes items from an array based on drag and drop
// functionality. Taken from https://github.com/kutlugsahin/vue-smooth-dnd/blob/master/demo/src/utils/helpers.js.
export function applyDrag(arr, { removedIndex, addedIndex, payload }) {
  if (removedIndex === null && addedIndex === null) return arr

  const result = [...arr]
  let itemToAdd = payload

  if (removedIndex !== null) {
    itemToAdd = result.splice(removedIndex, 1)[0]
  }

  if (addedIndex !== null) {
    result.splice(addedIndex, 0, itemToAdd)
  }

  return result
}
