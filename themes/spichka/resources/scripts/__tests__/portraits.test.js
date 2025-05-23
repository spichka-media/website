import {describe, it, vi, expect, beforeEach, afterEach} from 'vitest';
import {initPortraits} from '../lib/portraits.js';
import {isDeviceHoverable} from '../lib/utils.js';

vi.mock('../lib/utils.js', async () => {
  return {
    ...(await vi.importActual('../lib/utils.js')),
    isDeviceHoverable: vi.fn(),
  };
});

vi.mock('lodash-es/shuffle.js', async () => {
  return {
    default: vi.fn((arr) => arr),
  };
});

const tooltipMock = {
  setContent: vi.fn(),
  show: vi.fn(),
  hide: vi.fn(),
};

vi.mock('bootstrap/js/dist/tooltip', () => {
  return vi.fn(() => tooltipMock);
});

describe('initPortraits', () => {
  let footerImage;

  beforeEach(() => {
    document.body.innerHTML = '';
    footerImage = document.createElement('img');
    footerImage.id = 'footer-image';
    footerImage.src = 'initial.jpg';
    document.body.appendChild(footerImage);
    globalThis.fetch = vi.fn();

    globalThis.fetch.mockResolvedValueOnce({
      json: () =>
        Promise.resolve({
          theme_portraits: [
            {
              static_image: 'static.jpg',
              alt: 'Alt text',
              extra_image: 'extra.jpg',
              quotes: [{quote: 'Test quote'}, {quote: 'Test quote1'}],
            },
            {
              static_image: 'static1.jpg',
              alt: 'Alt text1',
              extra_image: 'extra2.jpg',
              quotes: [{quote: 'Test quote2'}, {quote: 'Test quote3'}],
            },
          ],
        }),
    });

    globalThis.IntersectionObserver = vi.fn((callback) => {
      return {
        observe: vi.fn((target) => {
          callback([{isIntersecting: true, target}]);
        }),
        disconnect: vi.fn(),
      };
    });
  });

  afterEach(() => {
    vi.restoreAllMocks();
    document.body.innerHTML = '';
  });

  it('should log an error if footer image is not found', () => {
    console.error = vi.fn();
    document.body.innerHTML = '';

    initPortraits();

    expect(console.error).toHaveBeenCalledWith(
      'Footer portrait element not found',
    );
  });

  it('should handle hover events', async () => {
    vi.mocked(isDeviceHoverable).mockReturnValue(true);
    await initPortraits();

    footerImage.dispatchEvent(new Event('mouseenter'));

    expect(footerImage.src).toContain('extra.jpg');

    expect(tooltipMock.setContent).toHaveBeenCalledWith({
      '.tooltip-inner': 'Test quote',
    });

    footerImage.dispatchEvent(new Event('mouseleave'));
    expect(footerImage.src).toContain('static.jpg');

    footerImage.dispatchEvent(new Event('mouseenter'));

    expect(footerImage.src).toContain('extra.jpg');

    expect(tooltipMock.setContent).toHaveBeenCalledWith({
      '.tooltip-inner': 'Test quote1',
    });

    footerImage.dispatchEvent(new Event('mouseleave'));
    expect(footerImage.src).toContain('static.jpg');

    footerImage.dispatchEvent(new Event('mouseenter'));

    expect(footerImage.src).toContain('extra.jpg');

    expect(tooltipMock.setContent).toHaveBeenCalledWith({
      '.tooltip-inner': 'Test quote',
    });

    footerImage.dispatchEvent(new Event('mouseleave'));
    expect(footerImage.src).toContain('static.jpg');
  });

  it('should handle click events on non-hoverable devices', async () => {
    vi.mocked(isDeviceHoverable).mockReturnValue(false);

    await initPortraits();

    footerImage.dispatchEvent(new Event('click'));
    expect(footerImage.src).toContain('extra.jpg');
  });

  it('should handle click events on hoverable devices', async () => {
    vi.mocked(isDeviceHoverable).mockReturnValue(true);

    await initPortraits();

    footerImage.dispatchEvent(new Event('click'));
    expect(footerImage.src).toContain('static1.jpg');
    expect(footerImage.alt).toContain('Alt text1');
  });

  it('check logic on touch screens', async () => {
    vi.mocked(isDeviceHoverable).mockReturnValue(false);

    await initPortraits();

    footerImage.dispatchEvent(new Event('click'));
    expect(footerImage.src).toContain('extra.jpg');

    expect(tooltipMock.setContent).toHaveBeenCalledWith({
      '.tooltip-inner': 'Test quote',
    });

    footerImage.dispatchEvent(new Event('click'));
    expect(footerImage.src).toContain('static1.jpg');
    expect(footerImage.alt).toContain('Alt text1');

    footerImage.dispatchEvent(new Event('click'));
    expect(footerImage.src).toContain('extra2.jpg');

    expect(tooltipMock.setContent).toHaveBeenCalledWith({
      '.tooltip-inner': 'Test quote2',
    });

    footerImage.dispatchEvent(new Event('click'));
    expect(footerImage.src).toContain('static.jpg');

    footerImage.dispatchEvent(new Event('click'));
    expect(footerImage.src).toContain('extra.jpg');

    expect(tooltipMock.setContent).toHaveBeenCalledWith({
      '.tooltip-inner': 'Test quote1',
    });
  });
});
