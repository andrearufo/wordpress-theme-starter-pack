'use strict';

var gulp 			= require('gulp');

var sass 			= require('gulp-sass');
var sourcemaps      = require('gulp-sourcemaps');
var postcss 		= require('gulp-postcss');
var autoprefixer 	= require('autoprefixer');

var jshint 			= require('gulp-jshint');
var uglify 			= require('gulp-uglify'); 

gulp.task('styles', function () {

	var processors = [
        autoprefixer({browsers: ['last 2 versions']})
    ];

	return gulp.src('dev/styles/*.scss')
		.pipe(sourcemaps.init())
		.pipe(sass().on('error', sass.logError))
		.pipe(postcss(processors))
		.pipe(sourcemaps.write('.'))
		.pipe(gulp.dest('dis/styles'));

});

gulp.task('scripts', function () {

	return gulp.src('dev/scripts/*.js')
        .pipe(jshint())
        .pipe(jshint.reporter('default'))
        .pipe(uglify())
        .pipe(gulp.dest( 'dis/scripts'))

});

gulp.task('watch', function () {

	gulp.watch('dev/styles/*.scss', ['styles']);
	gulp.watch('dev/scripts/*.js', ['scripts']);

});

gulp.task('default', ['watch']);