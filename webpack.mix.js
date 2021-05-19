// webpack.mix.js

let mix = require('laravel-mix');

mix
    .js('dev/scripts/main.js', 'scripts')
    .autoload({
        jquery: ['$', 'window.jQuery']
    })
    .sass('dev/styles/main.scss', 'styles')
    .options({
        processCssUrls: false
    })
    .sourceMaps()
    .setPublicPath('dist')
    .browserSync({
        proxy: process.env.SERVER_NAME + ':' + process.env.SERVER_PORT,
        files: [
            "languages/**/*",
            "images/**/*",
            "dist/**/*",
            "**/*.php"
        ]
    });

if (mix.inProduction()) {
    mix.version();
}