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
    },
    favicon: {
        dataFile: 'images/favicons/faviconData.json',
        masterPicture: 'images/logo.svg', // TODO: Path to your master picture
        dest: 'images/favicons/', //TODO: Path to the directory where to store the icons
        iconsPath: '/',
        backgroundColor: '#ffffff',
        themeColor: '#ffffff'
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
var realFavicon = require ('gulp-real-favicon');
var fs = require('fs');

function styles(done) {
    log.info('Starting styles!');
    return (
        gulp
            .src(paths.styles.src)
            // .pipe(sourcemaps.init())
            .pipe(sass())
            .on('error', notify.onError({
                message: 'Error: <%= error.message %>',
                title: 'Styles error!'
            }))
            .pipe(postcss([autoprefixer(), cssnano()]))
            // .pipe(sourcemaps.write('.'))
            .pipe( gulp.dest(paths.styles.dest) )
            .pipe(browserSync.stream())
            .pipe(notify('Complete styles!'))
    );
	done();
}
exports.styles = styles;

function scripts(done) {
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
            .on('error', notify.onError({
                message: 'Error: <%= error.message %>',
                title: 'Scripts error!'
            }))
    		.pipe( uglify() )
    		.pipe( gulp.dest(paths.scripts.dest) )
            .pipe(browserSync.stream())
            .pipe(notify('Complete scripts!'))
    );
	done();
}
exports.scripts = scripts;

function icons(done) {
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

// Generate the icons. This task takes a few seconds to complete.
// You should run it at least once to create the icons. Then,
// you should run it whenever RealFaviconGenerator updates its
// package (see the checkForFaviconUpdate task below).
function favicon(done) {
	realFavicon.generateFavicon({
		masterPicture: paths.favicon.masterPicture,
		dest: paths.favicon.dest,
		iconsPath: paths.favicon.iconsPath,

		design: {
			ios: {
				pictureAspect: 'noChange',
				assets: {
					ios6AndPriorIcons: false,
					ios7AndLaterIcons: false,
					precomposedIcons: false,
					declareOnlyDefaultIcon: true
				}
			},
			desktopBrowser: {},
			windows: {
				pictureAspect: 'noChange',
				backgroundColor: paths.favicon.backgroundColor,
				onConflict: 'override',
				assets: {
					windows80Ie10Tile: false,
					windows10Ie11EdgeTiles: {
						small: false,
						medium: true,
						big: false,
						rectangle: false
					}
				}
			},
			androidChrome: {
				pictureAspect: 'noChange',
				themeColor: paths.favicon.themeColor,
				manifest: {
					display: 'standalone',
					orientation: 'notSet',
					onConflict: 'override',
					declared: true
				},
				assets: {
					legacyIcon: false,
					lowResolutionIcons: false
				}
			}
		},
		settings: {
			scalingAlgorithm: 'Mitchell',
			errorOnImageTooSmall: false,
			readmeFile: false,
			htmlCodeFile: false,
			usePathAsIs: false
		},
		markupFile: f = paths.favicon.dataFile
	}, function() {
		done();
	});
};
exports.favicon = favicon;

// Inject the favicon markups in your HTML pages. You should run
// this task whenever you modify a page. You can keep this task
// as is or refactor your existing HTML pipeline.
function injectFaviconMarkups(done) {
	return(
        gulp
            .src([ 'header.php' ])
    		.pipe(realFavicon.injectFaviconMarkups(JSON.parse(fs.readFileSync(f = paths.favicon.dataFile)).favicon.html_code))
    		.pipe(gulp.dest('./'))
        );
    done();
};
exports.injectFaviconMarkups = injectFaviconMarkups;

// Check for updates on RealFaviconGenerator (think: Apple has just
// released a new Touch icon along with the latest version of iOS).
// Run this task from time to time. Ideally, make it part of your
// continuous integration system.
function checkForFaviconUpdate(done) {
	var currentVersion = JSON.parse(fs.readFileSync(f = paths.favicon.dataFile)).version;
	realFavicon.checkForUpdates(currentVersion, function(err) {
		if (err) {
			throw err;
		}else{
            done();
        }
	});
};
exports.checkForFaviconUpdate = checkForFaviconUpdate;

function serve(){
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
