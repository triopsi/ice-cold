// Load Gulp
const gulp = require('gulp');

// Load Plugins
const rename = require( 'gulp-rename' );
const uglify = require( 'gulp-uglify' );
const cleanCSS = require('gulp-clean-css');
const concat  = require('gulp-concat');
const browserSync = require('browser-sync').create();

gulp.task('minifyjs', function() {
    return gulp.src( [
        'assets/js/page-loader.js',
        'assets/js/smooth_scroll.js',
        'assets/js/to_the_top.js',
        'assets/js/navigation.js',
        'assets/js/front-page-media.js'
    ] )
		.pipe( uglify() )
		.pipe( rename( { suffix: '.min' } ) )
		.pipe( gulp.dest('assets/js') );
});

gulp.task('minifysite', function() {
    return gulp.src( ['assets/css/website/site-style.css'] )
        .pipe( cleanCSS( { compatibility: 'ie8' } ) )
        .pipe( rename( { suffix: '.min' } ) )
        .pipe( gulp.dest('assets/css/website') );
});

gulp.task('minifyfont', function() {
    return gulp.src( ['assets/css/font-awesome/all.css'] )
        .pipe( cleanCSS( { compatibility: 'ie8' } ) )
        .pipe( rename( { suffix: '.min' } ) )
        .pipe( gulp.dest('assets/css/font-awesome') );
});

// Gulp watch syntax
gulp.task('watch', function(){
    gulp.watch('assets/css/website/site-style.css', gulp.series('minifysite')); 
    gulp.watch('assets/css/font-awesome/all.css', gulp.series('minifyfont')); 
    gulp.watch(['assets/js/page-loader.js','assets/js/smooth_scroll.js','assets/js/to_the_top.js','assets/js/navigation.js','assets/js/front-page-media.js'], gulp.series('minifyjs')); 
})

// minify all js and css Task
gulp.task('all', gulp.parallel('minifyjs', 'minifysite', 'minifyfont'));

// Default Task
gulp.task('default', gulp.parallel('minifyjs', 'minifysite', 'minifyfont', 'watch'));