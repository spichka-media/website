function getRandomInt(max) {
  return Math.floor(Math.random() * max);
}

/**
 * Создаёт генератор случайных чисел в диапазоне от 0 до `length - 1` без повторений.
 * После исчерпания всех чисел генератор автоматически сбрасывается.
 *
 * @param {number} length - Общее количество чисел в диапазоне.
 * @param {number|null} [exceptIndex=null] - Индекс, который будет исключён из первого прохода.
 * Если значение `null`, исключение не применяется.
 *
 * @returns {function(): number} Функция, которая возвращает случайное число из диапазона.
 * При каждом вызове возвращается новое число пока все числа из диапазона не будут использованы.
 * Затем массив чисел сбрасывается и генерация продолжается.
 */
export function createReservoirRandomizer(length, exceptIndex = null) {
  let reservoir = Array.from({ length }, (_, index) => index);

  if (exceptIndex !== null) {
    reservoir.splice(exceptIndex, 1);
  }

  return () => {
    if (!reservoir.length) {
      reservoir = Array.from({ length }, (_, index) => index);
    }
    const randomInt = getRandomInt(reservoir.length);
    return reservoir.splice(randomInt, 1)[0];
  };
}
