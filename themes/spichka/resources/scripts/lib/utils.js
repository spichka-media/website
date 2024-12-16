export function isDeviceHoverable() {
  return window.matchMedia('(hover: hover) and (pointer: fine)')?.matches;
}

// https://bost.ocks.org/mike/shuffle/
export function shuffle(array) {
  const newArray = [...array];

  var m = newArray.length,
    t,
    i;

  // While there remain elements to shuffle…
  while (m) {
    // Pick a remaining element…
    i = Math.floor(Math.random() * m--);

    // And swap it with the current element.
    t = newArray[m];
    newArray[m] = newArray[i];
    newArray[i] = t;
  }

  return newArray;
}
