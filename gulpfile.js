'use strict';

var gulp 			= require('gulp'),
	notify 			= require('gulp-notify'),
	sass 			= require('gulp-sass'),
	sourcemaps      = require('gulp-sourcemaps'),
	postcss 		= require('gulp-postcss'),
	autoprefixer 	= require('autoprefixer'),
	plumber 		= require('gulp-plumber'),
	eslint 			= require('gulp-eslint'),
	uglify 			= require('gulp-uglify'),
	iconfont 		= require('gulp-iconfont'),
	iconfontCss 	= require('gulp-iconfont-css');

var onError = function(err) {
	notify.onError({
		title:    'Gulp',
		subtitle: 'Failure!',
		message:  'Error: <%= error.message %>',
		sound:    'Basso'
	})(err);

	this.emit('end');
};

/* Styles */
gulp.task('styles', function(){
	return gulp.src('dev/styles/*.scss')
		.pipe(plumber({errorHandler: onError}))
		.pipe( sourcemaps.init() )
		.pipe(sass({ style: 'expanded' }))
		.pipe( postcss([autoprefixer({browsers: ['last 1 version']})]) )
		.pipe( sourcemaps.write('.') )
		.pipe( gulp.dest('dist/styles') )
		.pipe(notify({
			title: 'Gulp',
			subtitle: 'Success!',
			message: 'Styles compiled',
			sound: 'Pop',
			onLast: true
		}));
});

/* Scripts */
gulp.task('scripts', function() {
	return gulp.src('dev/scripts/*.js')
		.pipe(plumber({errorHandler: onError}))
		.pipe( sourcemaps.init() )
        .pipe(eslint({
			'rules':{
				'quotes': [1, 'single'],
				'semi': [1, 'always']
			}
		}))
        .pipe(eslint.format())
        .pipe(eslint.failAfterError())
		.pipe( uglify() )
		.pipe( sourcemaps.write('.') )
		.pipe( gulp.dest('dist/scripts') )
		.pipe(notify({
			title: 'Gulp',
			subtitle: 'Success!',
			message: 'Scripts compiled',
			sound: 'Pop',
			onLast: true
		}));

});

/* Icon font */
gulp.task('icons', function(){
  	return gulp.src(['assets/icons/*.svg'])
		.pipe(plumber({errorHandler: onError}))
		.pipe( iconfontCss({
			fontName: 'icons',
			path: 'dev/templates/icons.css',
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
		.pipe( gulp.dest('dist/icons/') )
		.pipe(notify({
			title: 'Gulp',
			subtitle: 'Success!',
			message: 'Icons compiled',
			sound: 'Pop',
			onLast: true
		}));
});

/* Whatch and default */
gulp.task('watch', function () {
	gulp.watch('dev/styles/*.scss', ['styles']);
	gulp.watch('dev/scripts/*.js', ['scripts']);
	gulp.watch('assets/icons/*.svg', ['icons']);
});

gulp.task('watch scripts', function () {
	gulp.watch('dev/scripts/*.js', ['scripts']);
});

gulp.task('watch styles', function () {
	gulp.watch('dev/styles/*.js', ['styles']);
});

gulp.task('default', ['icons', 'styles', 'scripts', 'watch']);
