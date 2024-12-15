import { createReservoirRandomizer } from './randomizer.js';

/**
 * @typedef {Object} ExtraImageWrapper
 * @property {string} extra_image - URL дополнительного изображения
 *
 * @typedef {Object} QuoteWrapper
 * @property {string} quote - Текст цитаты
 *
 * @typedef {Object} ThemePortrait
 * @property {string} static_image - URL дефолтного изображения
 * @property {?ExtraImageWrapper[]} extra_images - Массив дополнительных изображений
 * @property {?QuoteWrapper[]} quotes - Массив цитат
 */

/**
 * Создаёт контроллер для управления списком хэдлайнеров.
 *
 * @param {ThemePortrait[]} headlinersData - Массив данных о хэдлайнерах.
 * @returns {Object} Контроллер хэдлайнеров.
 * @returns {function(): void} changeHeadliner - Меняет текущего хэдлайнера на случайного.
 * @returns {function(): string} getHeadlinerPortraitURL - Возвращает URL текущего портрета хэдлайнера.
 * @returns {function(): string|null} getHeadlinerQuote - Возвращает случайную цитату текущего хэдлайнера или `null`, если цитат нет.
 */
export function createHeadlinerListController(headlinersData) {
  let currentHeadliner = 0;
  const randomizeHeadliner = createReservoirRandomizer(headlinersData.length, 0);
  const headliners = headlinersData.map(createHeadlinerController);

  return {
    changeHeadliner: () => {
      currentHeadliner = randomizeHeadliner();
    },
    getHeadlinerPortraitURL: () => headliners[currentHeadliner].getHeadlinerPortraitURL(),
    getHeadlinerQuote: () => headliners[currentHeadliner].getHeadlinerQuote(),
  };
}

/**
 * Создаёт контроллер для управления данными одного хэдлайнера.
 *
 * @param {ThemePortrait} headlinerData - Данные о хэдлайнере.
 * @returns {Object} Контроллер хэдлайнера.
 * @returns {function(): string} getHeadlinerPortraitURL - Возвращает случайный URL портрета хэдлайнера.
 * @returns {function(): string|null} getHeadlinerQuote - Возвращает случайную цитату хэдлайнера или `null`, если цитат нет.
 */
function createHeadlinerController({ static_image, extra_images = [], quotes = [] }) {
  const portraits = [static_image, ...extra_images.map(({ extra_image }) => extra_image)];
  const getRandomPortraitIndex = createReservoirRandomizer(portraits.length);

  const quoteTexts = quotes.map(({ quote }) => quote);
  const getRandomQuoteIndex = quoteTexts.length ? createReservoirRandomizer(quoteTexts.length) : null;

  return {
    getHeadlinerPortraitURL: () => portraits[getRandomPortraitIndex()],
    getHeadlinerQuote: () => getRandomQuoteIndex ? quoteTexts[getRandomQuoteIndex()] : null,
  };
}
