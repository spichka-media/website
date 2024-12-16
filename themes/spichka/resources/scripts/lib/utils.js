export function isDeviceHoverable() {
  return window.matchMedia('(hover: hover) and (pointer: fine)')?.matches;
}
