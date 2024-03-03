const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const browserSync = require('browser-sync').create();
const concat = require('gulp-concat');
const terser = require('gulp-terser');
const dotenv = require('dotenv').config();

// Funzione per compilare i file SCSS in CSS
function styles() {
    return gulp.src('./src/styles/**/*.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest('./dist/styles'))
        .pipe(browserSync.stream());
}

// Funzione per compilare e minificare i file JavaScript
function scripts() {
    return gulp.src('./src/scripts/main.js')
        .pipe(concat('main.js'))
        .pipe(terser())
        .pipe(gulp.dest('./dist/scripts'))
        .pipe(browserSync.stream());
}

// Funzione per inizializzare il server di sviluppo locale e abilitare l'hot reload
function serve() {
    browserSync.init({
        proxy: process.env.SERVER_NAME+':'+process.env.SERVER_PORT, // Indirizzo del server WordPress Docker
        files: ['./dist/**/*'],
        open: false
    });

    gulp.watch('./src/styles/**/*.scss', styles);
    gulp.watch('./src/scripts/main.js', scripts);
    gulp.watch(['*.php', './dist/**/*']).on('change', browserSync.reload);
}

// Compila i file SCSS e JavaScript e avvia il server di sviluppo locale con l'hot reload
exports['styles'] = styles;
exports['scripts'] = scripts;
exports['build'] = gulp.parallel(styles, scripts);

exports.default = gulp.series(gulp.parallel(styles, scripts), serve);