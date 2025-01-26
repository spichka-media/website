module.exports = {
  root: true,
  extends: ['@roots/eslint-config/sage'],
  rules: {
    curly: 'error',
  },
  globals: {
    globalThis: 'readonly',
  },
};
