var paths = {
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

function styles(cb) {
    log.info('Starting styles!');
    return (
        gulp
            .src(paths.styles.src)
            .pipe(sourcemaps.init())
            .pipe(sass())
            .on('error', sass.logError)
            .pipe(postcss([autoprefixer(), cssnano()]))
            .pipe(sourcemaps.write('.'))
            .pipe( gulp.dest(paths.styles.dest) )
    );
	cb();
}
exports.styles = styles;

function scripts(cb) {
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
    		.pipe( uglify() )
    		.pipe( gulp.dest(paths.scripts.dest) )
    );
	cb();
}
exports.scripts = scripts;

function icons(cb) {
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
    );
	cb();
}
exports.icons = icons;

function watch(){
    log.info('Starting watch!');
    gulp.watch(paths.styles.src, gulp.series('styles'));
    gulp.watch(paths.scripts.src, gulp.series('scripts'));
    gulp.watch(paths.icons.src, gulp.series('icons'));
}
exports.watch = watch;

function start(){
    styles();
    scripts();
    icons();
    watch();
}
exports.default = start;
