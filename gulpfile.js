'use strict';

var gulp 			= require('gulp');

// Plugins

var pump 			= require('pump');

var sass 			= require('gulp-sass');
var sourcemaps      = require('gulp-sourcemaps');
var postcss 		= require('gulp-postcss');
var autoprefixer 	= require('autoprefixer');

var jshint 			= require('gulp-jshint');
var concat 			= require('gulp-concat');
var uglify 			= require('gulp-uglify');

// Tasks

gulp.task('styles', function (cb) {
	pump([
		gulp.src('dev/styles/*.scss'),
		sourcemaps.init(),
		sass().on('error', sass.logError),
		postcss([autoprefixer({browsers: ['last 1 version']})]),
		sourcemaps.write('.'),
		gulp.dest('dist/styles')
	], cb)
});

gulp.task('scripts', function (cb) {
	pump([
		gulp.src('dev/scripts/*.js'),
		sourcemaps.init(),
		jshint(),
		jshint.reporter('jshint-stylish'),
		concat('main.min.js'),
		uglify(),
		sourcemaps.write('.'),
		gulp.dest('dist/scripts')
	], cb)
});

gulp.task('watch', function () {

	gulp.watch('dev/styles/*.scss', ['styles']);
	gulp.watch('dev/scripts/*.js', ['scripts']);

});

gulp.task('default', ['styles', 'scripts', 'watch']);
