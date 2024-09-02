import purgeCssWordPress from 'purgecss-with-wordpress';

/**
 * Compiler configuration
 *
 * @see {@link https://roots.io/docs/sage sage documentation}
 * @see {@link https://bud.js.org/guides/configure bud.js configuration guide}
 *
 * @type {import('@roots/bud').Config}
 */
export default async (app) => {
  /**
   * Application assets & entrypoints
   *
   * @see {@link https://bud.js.org/docs/bud.entry}
   * @see {@link https://bud.js.org/docs/bud.assets}
   */
  app
    .entry('app', ['@scripts/app'])
    .entry({
      'front-page': {
        import: ['@scripts/front-page', '@styles/front-page'],
        dependOn: ['app'],
      },
    })
    .entry({
      'single-post': {
        import: ['@scripts/single-post', '@styles/single-post'],
        dependOn: ['app'],
      },
    })
    .entry({
      'about-us': {
        import: ['@scripts/about-us', '@styles/about-us'],
        dependOn: ['app'],
      },
    })
    .entry({
      404: {
        import: ['@styles/404'],
        dependOn: ['app'],
      },
    })
    .entry({
      archive: {
        import: ['@styles/archive'],
        dependOn: ['app'],
      },
    })
    .entry('editor', ['@scripts/editor', '@styles/editor'])
    .assets(['images', 'fonts']);

  /**
   * Set public path
   *
   * @see {@link https://bud.js.org/docs/bud.setPublicPath}
   */
  app.setPublicPath('/app/themes/sage/public/');

  app.purgecss({
    content: [
      app.path(`resources/views/**`),
      app.path(`index.php`),
      app.path(`app/lib/pagination.php`),
    ],
    safelist: {
      ...purgeCssWordPress.safelist,
      standard: ['img', 'iframe', 'blockquote', 'figure', 'screen-reader-text'],
      deep: [
        /^ez-toc-/,
        /^offcanvas(-.*)?$/,
        /^nav-/,
        /^modern-footnotes-/,
        /^swiper-/,
        /^pp-multiple-authors-/,
        /^article/,
      ],
    },
  });

  /**
   * Development server settings
   *
   * @see {@link https://bud.js.org/docs/bud.setUrl}
   * @see {@link https://bud.js.org/docs/bud.setProxyUrl}
   * @see {@link https://bud.js.org/docs/bud.watch}
   */
  app
    .setUrl('http://localhost:8001')
    .setProxyUrl('http://localhost:8000')
    .watch(['resources/views', 'app']);
};
