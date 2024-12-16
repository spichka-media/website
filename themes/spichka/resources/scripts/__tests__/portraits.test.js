import {describe, it, vi, expect, beforeEach, afterEach} from 'vitest';
import {initPortraits} from '../lib/portraits.js';
import {isDeviceHoverable} from '../lib/utils.js';

// Mock dependencies
vi.mock('../lib/utils.js', () => ({
  isDeviceHoverable: vi.fn(),
}));

vi.mock('lodash-es', () => ({
  ...vi.importActual('lodash-es'),
  shuffle: vi.fn((arr) => arr),
}));

const tooltipMock = {
  setContent: vi.fn(),
  show: vi.fn(),
  hide: vi.fn(),
};

vi.mock('bootstrap', () => ({
  Tooltip: vi.fn(() => tooltipMock),
}));

const mockData = {
  theme_portraits: [
    {
      static_image: 'static.jpg',
      extra_images: [{extra_image: 'extra.jpg'}],
      quotes: [{quote: 'Test quote'}],
      alt: 'Alt text',
    },
    {
      static_image: 'static1.jpg',
      extra_images: [{extra_image: 'extra1.jpg'}],
      quotes: [{quote: 'Test quote1'}],
      alt: 'Alt text1',
    },
  ],
};

describe('initPortraits', () => {
  let footerImage;

  beforeEach(() => {
    document.body.innerHTML = ''; // Reset DOM
    footerImage = document.createElement('img');
    footerImage.id = 'footer-image';
    footerImage.src = 'initial.jpg';
    document.body.appendChild(footerImage);
    globalThis.fetch = vi.fn();

    globalThis.fetch.mockResolvedValueOnce({
      json: () => Promise.resolve(mockData),
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
  });

  it('should change portrait to next combination on second click on touch screens', async () => {
    vi.mocked(isDeviceHoverable).mockReturnValue(false);

    await initPortraits();

    footerImage.dispatchEvent(new Event('click'));
    expect(footerImage.src).toContain('extra.jpg');

    footerImage.dispatchEvent(new Event('click'));
    expect(footerImage.src).toContain('static1.jpg');
  });
});
