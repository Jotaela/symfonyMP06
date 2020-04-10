{
    "private": true,
    "scripts": {
        "dev": "npm run development",
        "development": "",
        "watch": "npm run development -- --watch",
        "watch-poll": "npm run watch -- --watch-poll",
        "lint": "eslint --ext .js,.vue --ignore-path .gitignore .",
        "lint-fix": "eslint --fix --ext .js,.vue --ignore-path .gitignore .",
        "hot": "cross-env NODE_ENV=development node_modules/webpack-dev-server/bin/webpack-dev-server.js --inline --hot --config=node_modules/laravel-mix/setup/webpack.config.js",
        "prod": "npm run production",
        "production": "cross-env NODE_ENV=production node_modules/webpack/bin/webpack.js --no-progress --hide-modules --config=node_modules/laravel-mix/setup/webpack.config.js"
    },
    "devDependencies": {
        "@nuxtjs/eslint-config": "^1.0.1",
        "@nuxtjs/eslint-module": "^1.0.0",
        "axios": "^0.19.1",
        "babel-eslint": "^10.0.1",
        "bootstrap": "^4.4.1",
        "cross-env": "^5.1",
        "eslint": "^6.8.0",
        "eslint-plugin-nuxt": ">=0.4.2",
        "jquery": "^3.2",
        "lodash": "^4.17.13",
        "popper.js": "^1.12",
        "resolve-url-loader": "^2.3.1",
        "sass": "^1.24.4",
        "sass-loader": "7.*",
        "vue": "^2.6.11",
        "vue-template-compiler": "^2.6.11"
    },
    "dependencies": {
        "material-design-icons-iconfont": "^5.0.1",
        "vue-router": "^3.1.4",
        "vuetify": "^2.2.4",
        "vuex": "^3.1.2"
    }
}
