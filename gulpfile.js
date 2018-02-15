/*

	npm i --save-dev autoprefixer bootstrap gulp gulp-autoprefixer gulp-concat gulp-jshint gulp-postcss gulp-sass gulp-sourcemaps gulp-uglify jshint-stylish
	
 */

'use strict';

var gulp 			= require('gulp');

/* Styles */

var sass 			= require('gulp-sass');
var sourcemaps      = require('gulp-sourcemaps');
var postcss 		= require('gulp-postcss');
var autoprefixer 	= require('autoprefixer');

gulp.task('styles', function(){
	gulp.src('dev/styles/*.scss')
		.pipe( sourcemaps.init() )
		.pipe( sass().on('error', sass.logError) )
		.pipe( postcss([autoprefixer({browsers: ['last 1 version']})]) )
		.pipe( sourcemaps.write('.') )
		.pipe( gulp.dest('dist/styles') );
});

/* Scripts */

var jshint 			= require('gulp-jshint');
var concat 			= require('gulp-concat');
var uglify 			= require('gulp-uglify');

gulp.task('scripts', function() {
	gulp.src('dev/scripts/*.js')
		.pipe( sourcemaps.init() )
		.pipe( jshint() )
		.pipe( jshint.reporter('jshint-stylish') )
		.pipe( concat('main.min.js') )
		.pipe( uglify() )
		.pipe( sourcemaps.write('.') )
		.pipe( gulp.dest('dist/scripts') );
});

/* Whatch and default */

gulp.task('watch', function () {
	gulp.watch('dev/styles/*.scss', ['styles']);
	gulp.watch('dev/scripts/*.js', ['scripts']);
});

gulp.task('default', ['styles', 'scripts', 'watch']);
