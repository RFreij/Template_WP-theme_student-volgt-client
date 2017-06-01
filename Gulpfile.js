'use strict';

// General
const gulp =                				require('gulp');
const gulpif =                      		require('gulp-if');
const browserSync =         				require('browser-sync').create();
const notify =              				require('gulp-notify');

// CSS
const sass =                				require('gulp-sass');
const bourbonIncludePaths = 				require('bourbon').includePaths;
const neatIncludePaths =    				require('bourbon-neat').includePaths;

const cssnano =             				require('gulp-cssnano');
const autoprefixer =        				require('gulp-autoprefixer');

// JavaScript
const uglify =              				require('gulp-uglify');
const concat =              				require('gulp-concat');
const rename =              				require('gulp-rename');

function notifySuccess(message) {
	return notify({
		sound: false,
		title: 'Success',
		message: message
	});
}

function notifyFailure(message, error) {
	return notify.onError({
		sound: false,
		title: 'Failure',
		message: message + error
	})(error);
}

gulp.task('compile-css', function() {
	// Read SCSS.
	return gulp.src('media/css/style.scss')
		// Convert to CSS by applying SASS.
		.pipe(sass({
			// Set include paths for Bourbon and Neat.
			includePaths: [...bourbonIncludePaths, ...neatIncludePaths]
		})).on('error', sass.logError).on('error', function (error) {
			notifyFailure('Error compiling "style.scss"', error);
			this.emit('end');
		})
		// Autoprefix CSS
		.pipe(autoprefixer())
		// Compress CSS.
		.pipe(cssnano())
		// Destination name.
		.pipe(rename('style.min.css'))
		// Write CSS to output file.
		.pipe(gulp.dest('media/css/'))
		// Browsersync CSS injecting.
		.pipe(browserSync.stream())
		// Notify.
		.pipe(notifySuccess('Compiled "style.min.css"'));
});

gulp.task('compile-js', function() {
	return gulp.src([
		'media/scripts/polyfills/classList.js',
		'media/scripts/polyfills/closest.js',
		'media/scripts/vanilla/scripts.js'
	])
	.pipe(concat('scripts.min.js'))
	.pipe(uglify())
	.pipe(gulp.dest('media/scripts/'))
	.pipe(notifySuccess('Compiled "scripts.min.js"'));
});

gulp.task('default', function() {
	// Initialize Browsersync.
	browserSync.init({
		// proxy: hostName,
		server: {
            baseDir: "./"
        },
		notify: false
	});

	// Browsersync reload on changing HTML-files.
	gulp.watch(['**/*.html']).on('change', browserSync.reload);

	// Watch SCSS-file changes.
	gulp.watch('media/css/**/*.scss', ['compile-css']);

	// Watch JS-file changes.
	gulp.watch(['media/scripts/*/*.js'], ['compile-js']).on('change', browserSync.reload);
});
