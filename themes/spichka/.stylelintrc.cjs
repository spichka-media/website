module.exports = {
  extends: ['@roots/bud-sass/config/stylelint'],
  rules: {
    'import-notation': null,
    'no-empty-source': null,
    'color-function-notation': null,
  },
  overrides: [
    {
      files: ['resources/styles/plugins/*.scss'],
      rules: {
        'selector-class-pattern': null,
      },
    },
    {
      files: ['resources/styles/libs/bootstrap.scss'],
      rules: {
        'scss/load-no-partial-leading-underscore': null,
      },
    },
  ],
};
