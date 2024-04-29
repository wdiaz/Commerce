module.exports = {
    extends: ['eslint:recommended', 'plugin:react/recommended'],
    rules: {
        eqeqeq: "off",
        "no-unused-vars": "error",
        "prefer-const": ["error", { "ignoreReadBeforeAssign": true }]
    }

};