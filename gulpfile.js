/**
 * Gulpfile
 * Project configuration for gulp tasks.
 */

var pkg     = require('./package.json');
var project = pkg.name;
var slug    = pkg.slug;
var version = pkg.version;

// Version File
var filesversions = [
    'style.css',
    'readme.txt'
];

// Styles
var sitestylecss     = 'assets/css/website/site-style.css';
var styledestination = 'assets/css/website';

// Scripts
var pageloaderjs     = 'assets/js/page-loader.js';
var smoothscrollerjs = 'assets/js/smooth_scroll.js';
var tothetopjs       = 'assets/js/to_the_top.js';
var navigationjs     = 'assets/js/navigation.js';
var frontpagemediajs = 'assets/js/front-page-media.js';
var jsdestination    = 'assets/js';
var scriptsjs        = [
    pageloaderjs,
    smoothscrollerjs,
    tothetopjs,
    navigationjs,
    frontpagemediajs
];

// Build files.
var buildFiles         = [
    './**',
    '!node_modules/**',
    '!dist/',
    '!.vscode/',
    '!vendor/',
    '!composer.json',
    '!composer.lock',
    '!package.json',
    '!package-lock.json',
    '!gulpfile.js',
    '!LICENSE',
    '!README.md',
    '!.jshintignore',
    '!.jshintrc'
];
var buildDestination   = './dist/' + slug + '/';
var buildArtefact      = slug + '.zip';


// Load Plugins
var gulp     = require( 'gulp' );
var rename   = require( 'gulp-rename' );
var uglify   = require( 'gulp-uglify' );
var cleanCSS = require( 'gulp-clean-css' );
var zip      = require( 'gulp-zip' );
var cleaner  = require( 'gulp-clean' );
var copy     = require( 'gulp-copy' );
var notify   = require( 'gulp-notify' );
var jshint   = require( 'gulp-jshint' );
var replace  = require( 'gulp-replace-task' );


/**
 * Dev Tasks
 */

// Update Version
gulp.task( 'updateVersion', function() {
	return gulp.src( filesversions )
	.pipe( replace( {
		patterns: [
			{
				match: /Version: (\d+\.+\d+\.+\d)/,
				replacement: 'Version: ' + version
			},
            {
				match: /Stable tag: (\d+\.+\d+\.+\d)/,
				replacement: 'Stable tag: ' + version
			}
		],
		usePrefix: false
	} ) )
	.pipe( gulp.dest( './' ) );
});

// JS lint
gulp.task('jslint', function() {
    return gulp.src( scriptsjs )
      .pipe( jshint() )
      .pipe( jshint.reporter( 'default' ) );
});

// Minify Styles
gulp.task( 'minifycss', function () {
    return gulp.src( sitestylecss )
        .pipe( cleanCSS( { compatibility: 'ie8' } ) )
        .pipe( rename( { suffix: '.min' } ) )
        .pipe( gulp.dest( styledestination ) );
});

// Minify Scripts
gulp.task( 'minifyjs', function () {
    return gulp.src( scriptsjs )
		.pipe( uglify() )
		.pipe( rename( { suffix: '.min' } ) )
		.pipe( gulp.dest( jsdestination ) );
});

// Watch files
gulp.task( 'watch', function (){
    gulp.watch( sitestylecss , gulp.series( 'minifycss' ) ); 
    gulp.watch( scriptsjs, gulp.series( 'minifyjs' ) ); 
})

// Clean Build directory
gulp.task( 'build-clean', function () {
	return gulp.src( ['./dist/*'] , { read: false } )
	.pipe( cleaner() );
});

gulp.task( 'build-copy', function() {
    return gulp.src( buildFiles )
    .pipe( copy( buildDestination ) );
});

gulp.task( 'build-clean-and-copy', gulp.series( 'build-clean', 'build-copy' ), function () {});

gulp.task( 'build-zip', function() {
    return gulp.src( buildDestination + '/**' , { base: 'dist' } )
    .pipe( zip( buildArtefact ) )
    .pipe( gulp.dest( './dist/' ) );
});

gulp.task( 'build-clean-after-zip', function () {
	return gulp.src( [ buildDestination, '!/dist/' + slug + '.zip'] , { read: false } )
	.pipe( cleaner() );
});

gulp.task( 'build-zip-and-clean', gulp.series( 'build-zip', 'build-clean-after-zip' ), function () {});

gulp.task( 'build-notification', function () {
	return gulp.src( './' )
	.pipe( notify( { message: 'Your build ' + slug + '.zip is complete.', onLast: true } ) );
});

gulp.task('build', gulp.series( 
    'build-clean',
    'minifycss',
    'minifyjs',
    'updateVersion',
    'build-clean-and-copy',
    'build-zip-and-clean',
    'build-notification' ),
    function () {
});

// Minify all js and css files
gulp.task( 'all', gulp.parallel( 'minifyjs', 'minifycss' ) );

// Default Task
gulp.task( 'default', gulp.parallel( 'minifyjs', 'minifycss', 'watch' ) );