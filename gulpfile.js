var gulp = require('gulp');
var log = require('fancy-log');
var sourcemaps = require('gulp-sourcemaps');
var sass = require('gulp-dart-sass');
var postcss = require('gulp-postcss');
var autoprefixer = require('autoprefixer');
var cssnano = require('cssnano');
var uglify = require('gulp-uglify');
var eslint = require('gulp-eslint');
var notify = require('gulp-notify');
var browserSync = require('browser-sync').create();
var clear = require('console-clear');
var dotenv = require('dotenv').config();

var paths = {
    sync: {
        proxy: process.env.SERVER_NAME+':'+process.env.SERVER_PORT,
        delay: 2000
    },
    styles: {
        src: 'dev/styles/**/*.scss',
        dest: 'dist/styles'
    },
    scripts: {
        src: 'dev/scripts/**/*.js',
        dest: 'dist/scripts'
    }
};

function styles(done) {
    clear(true);
    log.info('Starting styles!');
    return (
        gulp
            .src(paths.styles.src)
            .pipe(sourcemaps.init())
            .pipe(sass())
            .on('error', notify.onError({
                message: 'Error: <%= error.message %>',
                title: 'Styles error!'
            }))
            .pipe(postcss([autoprefixer(), cssnano()]))
            .pipe(sourcemaps.write('.'))
            .pipe( gulp.dest(paths.styles.dest) )
            .pipe(browserSync.stream())
            .pipe(notify('Complete styles!'))
    );
	done();
}
exports.styles = styles;

function scripts(done) {
    clear(true);
    log.info('Starting scripts!');
    return (
        gulp
            .src(paths.scripts.src)
            .pipe(eslint({
                'rules':{
                    'quotes': [1, 'single'],
                    'semi': [1, 'always']
                }
            }))
            .pipe(eslint.format())
            .pipe(eslint.failAfterError())
            .on('error', function(){
				notify.onError({
					message: 'Error: <%= error.message %>',
					title: 'Scripts error!'
				});
				done();
            })
    		.pipe( uglify() )
    		.pipe( gulp.dest(paths.scripts.dest) )
            .pipe(browserSync.stream())
            .pipe(notify('Complete scripts!'))
    );
	done();
}
exports.scripts = scripts;

function serve(){
    clear(true);
    browserSync.init({
        proxy: paths.sync.proxy,
        reloadDelay: paths.sync.delay
    });

    watch();
    gulp.watch("*.php").on('change', browserSync.reload);
}
exports.serve = serve;

function watch(){
    log.info('Starting watch!');
    gulp.watch(paths.styles.src, gulp.series('styles'));
    gulp.watch(paths.scripts.src, gulp.series('scripts'));
}
exports.watch = watch;

exports.build = gulp.parallel(scripts, styles);

function start(){
    serve();
}
exports.default = start;
