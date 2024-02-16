const gulp = require('gulp');
const sass = require('gulp-sass');
const autoprefixer = require('gulp-autoprefixer');
const browserSync = require('browser-sync').create();
const concat = require('gulp-concat');
const terser = require('gulp-terser');

// Percorso dei file SCSS
const scssFiles = './src/styles/**/*.scss';

// Percorso del file JavaScript principale
const jsFiles = './src/scripts/main.js';

// Compila i file SCSS in CSS
function compileSCSS() {
    return gulp.src(scssFiles)
        .pipe(sass().on('error', sass.logError))
        .pipe(autoprefixer())
        .pipe(gulp.dest('./dist/css'))
        .pipe(browserSync.stream());
}

// Compila e minifica il file JavaScript
function compileJS() {
    return gulp.src(jsFiles)
        .pipe(concat('main.min.js'))
        .pipe(terser())
        .pipe(gulp.dest('./dist/js'))
        .pipe(browserSync.stream());
}

// Inizializza il server di sviluppo locale e abilita l'hot reload
function serve() {
    browserSync.init({
        proxy: 'localhost:8000', // Indirizzo del server WordPress Docker
        files: ['./dist/**/*'],
        open: false
    });

    gulp.watch(scssFiles, compileSCSS);
    gulp.watch(jsFiles, compileJS);
    gulp.watch('./dist/**/*').on('change', browserSync.reload);
}

// Compila i file SCSS e JavaScript e avvia il server di sviluppo locale con l'hot reload
exports.default = gulp.series(gulp.parallel(compileSCSS, compileJS), serve);
