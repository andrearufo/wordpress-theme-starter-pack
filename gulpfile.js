var paths = {
    sync: {
        proxy: 'wordpress.test',
        delay: 2000
    },
    styles: {
        src: 'dev/styles/**/*.scss',
        dest: 'dist/styles'
    },
    scripts: {
        src: 'dev/scripts/**/*.js',
        dest: 'dist/scripts'
    },
    icons: {
        src: 'assets/icons/*.svg',
        template: 'dev/templates/icons.css',
        dest: 'dist/icons/'
    }
};

var gulp = require('gulp');
var log = require('fancy-log');
var sourcemaps = require('gulp-sourcemaps');
var sass = require('gulp-sass');
var postcss = require('gulp-postcss');
var autoprefixer = require('autoprefixer');
var cssnano = require('cssnano');
var uglify = require('gulp-uglify');
var eslint = require('gulp-eslint');
var iconfont = require('gulp-iconfont');
var iconfontCss = require('gulp-iconfont-css');
var notify = require('gulp-notify');
var browserSync = require('browser-sync').create();
var clear = require('console-clear');

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

function icons(done) {
    clear(true);
    log.info('Starting icons!');
    return (
        gulp
            .src(paths.icons.src)
            .pipe( iconfontCss({
    			fontName: 'icons',
    			path: paths.icons.template,
    			targetPath: 'icons.css',
    			fontPath: ''
    		}) )
    		.pipe( iconfont({
    			fontName: 'icons',
    			normalize: true,
    			fontHeight: 1001,
    			prependUnicode: true,
    			formats: ['ttf', 'eot', 'woff'],
    			timestamp: Math.round(Date.now()/1000)
    		}) )
    		.pipe( gulp.dest(paths.icons.dest) )
            .pipe(browserSync.stream())
            .pipe(notify('Complete icons!'))
    );
	done();
}
exports.icons = icons;

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
    gulp.watch(paths.icons.src, gulp.series('icons'));
}
exports.watch = watch;

exports.build = gulp.parallel(scripts, styles, icons);

function start(){
    serve();
}
exports.default = start;
