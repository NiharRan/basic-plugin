module.exports = {
    "env": {
        "browser": true,
        "es2021": true
    },
    "extends": [
        "eslint:recommended",
        "plugin:vue/essential"
    ],
    "parserOptions": {
        "ecmaVersion": 12,
        "sourceType": "module"
    },
    "plugins": [
        "vue"
    ],
  "globals": {
    "jQuery": false,
    "wp": false,
  },
    "rules": {
      "vue/max-attributes-per-line": "off",
      "semi": "off",
      "object-curly-spacing": "off",
      "dot-notation": "off",
      "vue/no-use-v-if-with-v-for": "off",
      "no-trailing-spaces": "off",
      "no-new": "off",
      "space-before-function-paren": "off",
      "vue/script-indent": "off",
      "vue/no-textarea-mustache": "off",
      "vue/html-indent": "off",
      "no-prototype-builtins": "off",
      "eqeqeq": "off"
    },
  "overrides": [
    {
      "files": ["*.vue"],
      "rules": {
        "indent": "off"
      }
    }
  ]
};
