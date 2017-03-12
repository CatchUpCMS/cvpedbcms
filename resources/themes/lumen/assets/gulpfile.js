var gulp = require('gulp');
var bower = require('gulp-bower');

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

	console.log("gulp bower : install bower dependencies\n");

	console.log("----------------------------\n");

});
