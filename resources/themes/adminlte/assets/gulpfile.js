var gulp = require('gulp');
var sass = require('gulp-sass');
var minifycss = require('gulp-minify-css');
var bower = require('gulp-bower');
var rev = require('gulp-rev');
var rename = require("gulp-rename");


var config = {
	revision: './rev',
	css: './css',
	sass: './sass'
};

/**
 * Compile SASS files.
 */
gulp.task('sass', ['bower'], function () {

	gulp.src(config.sass + '/*.scss')
		.pipe(sass({paths: [config.sass]}))
		.pipe(minifycss())
		.pipe(rev())
		.pipe(gulp.dest(config.css))
		.pipe(rev.manifest())
		.pipe(rename('css.manifest.json'))
		.pipe(gulp.dest(config.revision));

});

/**
 * Install bower dependencies.
 */
gulp.task('bower', [], function () {

	return bower({
		directory: 'bower',
		cwd: '.'
	});

});

/**
 * Help, commands list.
 */
gulp.task('default', function () {

	console.log("\nGulp Command List \n");
	console.log("----------------------------\n");

	console.log("gulp bower : install bower dependencies");
	console.log("gulp sass : compile SASS files\n");

	console.log("----------------------------\n");

});
