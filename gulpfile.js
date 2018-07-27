'use strict';

var gulp 			= require('gulp');
var notify 			= require("gulp-notify");

/* Styles */

var sass 			= require('gulp-sass'),
	sourcemaps      = require('gulp-sourcemaps'),
	postcss 		= require('gulp-postcss'),
	autoprefixer 	= require('autoprefixer');

gulp.task('styles', function(){
	gulp.src('dev/styles/*.scss')
		.pipe( sourcemaps.init() )
		.pipe( sass().on('error', function(err) {
				return notify().write(err);
			})
		)
		.pipe( postcss([autoprefixer({browsers: ['last 1 version']})]) )
		.pipe( sourcemaps.write('.') )
		.pipe( gulp.dest('dist/styles') )
		.pipe( notify("Styles compiled!") );
});

/* Scripts */

var jshint 			= require('gulp-jshint'),
	uglify 			= require('gulp-uglify');

gulp.task('scripts', function() {
	gulp.src('dev/scripts/*.js')
		.pipe( jshint() )
		.pipe( jshint.reporter('jshint-stylish') )
		.pipe( uglify() )
		.pipe( gulp.dest('dist/scripts') )
		.pipe( notify("Scripts compiled!") );
});

/* Icon font */
var iconfont 		= require('gulp-iconfont'),
	iconfontCss 	= require('gulp-iconfont-css');

gulp.task('icons', function(){
  	gulp.src(['assets/icons/*.svg'])
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
		.pipe( notify("Icons compiled!") );
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

gulp.task('default', ['styles', 'scripts', 'watch']);
