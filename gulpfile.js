/**
 * Configuration.
 *
 * Project Configuration for gulp tasks.
 *
 */

// Project related.
var buildFOLDER = '/Users/gianlucatortorella/Sites/alf/wp-content/themes/alf';
var buildURL = buildFOLDER + '/**/*'; // Theme/Plugin URL. Leave it like it is, since our gulpfile.scripts lives in the root folder.

/**
 *
 *  CSS.
 *
 */

// SASS Style custom src.
var styleCustomSRC = [
    'src/assets/scss/*.scss'
];

// Style vendor src.
var styleVendorSRC = [
    'src/assets/scss/vendors/*.css',
    'node_modules/bootstrap/dist/css/bootstrap.min.css',
    'node_modules/bootstrap/dist/css/bootstrap.min.css.map',
    'node_modules/animate.css/animate.min.css',
    'node_modules/owl.carousel/dist/assets/*.*',
    'node_modules/aos/dist/aos.css',
    'node_modules/lightbox2/dist/css/lightbox.min.css',
    'node_modules/lightbox2/dist/css/lightbox.min.css.map',
];

// Paths & names
var styleCustomDestination = buildFOLDER + '/assets/styles'; // Path to place the compiled SASS custom file.
var styleVendorDestination = buildFOLDER + '/assets/styles/vendors'; // Path to place the compiled CSS vendors files.
var styleCustomFile = 'style'; // Compiled CSS file name.

/**
 *
 *  Javascript.
 *
 */

// JS Custom related.
var jsCustomSRC = 'src/assets/scripts/*.js'; // Path to JS custom scripts folder.

// JS Vendor related.
var jsVendorSRC = [
    'src/assets/scripts/vendors/**/*.js',
    'node_modules/jquery/dist/jquery.min.js',
    'node_modules/bootstrap/dist/js/bootstrap.bundle.min.js',
    'node_modules/owl.carousel/dist/owl.carousel.min.js',
    'node_modules/aos/dist/aos.js',
    'node_modules/waypoints/lib/jquery.waypoints.min.js',
    'node_modules/jquery.counterup/jquery.counterup.min.js',
    'node_modules/jquery-countdown/dist/jquery.countdown.min.js',
    'node_modules/masonry-layout/dist/masonry.pkgd.min.js',
    'node_modules/imagesloaded/imagesloaded.pkgd.min.js',
    'node_modules/desandro-classie/classie.js',
    'node_modules/lightbox2/dist/js/lightbox.min.js',
];

// Paths & names
var jsCustomDestination = buildFOLDER + '/assets/scripts'; // Path to place the compiled JS custom scripts file.
var jsVendorDestination = buildFOLDER + '/assets/scripts/vendors'; // Path to place the compiled JS vendors file.
var jsCustomFile = 'actions'; // Compiled JS custom file name.

/**
 *
 *  Images.
 *
 */

// Images related.
var imagesSRC = [
    'src/assets/images/**/*.{png,jpg,gif,svg,ico}',
    'node_modules/lightbox2/dist/images/*.{png,jpg,gif,svg,cur}'
]; // Source folder of images which should be optimized.

// Paths & names
var imagesDestination = buildFOLDER + '/assets/images'; // Destination folder of optimized images. Must be different from the imagesSRC folder.

/**
 *
 *  Fonts.
 *
 */

// Fonts related.
var fontsSRC = [
    'src/assets/fonts/*.{ttf,eot,svg,woff,woff2}'
    /* 'node_modules/font-awesome/fonts/*.{ttf,eot,svg,woff,woff2}',
     'node_modules/pixeden-stroke-7-icon/pe-icon-7-stroke/fonts/Pe-icon-7-stroke.*' */
];

// Paths & names
var fontsDestination = buildFOLDER + '/assets/fonts'; // Destination folder of fonts. Must be different from the fontsSRC folder.

/**
 *
 *  Watches.
 *
 */

// Watch files paths.
var styleWatchFiles = 'src/assets/scss/**/*.*'; // Path to all *.css files inside css folder and inside them.
var customJSWatchFiles = 'src/assets/scripts/**/*.js'; // Path to all custom JS files.
var imageWatchFiles = 'src/assets/images/**/*.*'; // Path to all images files.
var projectTHEMEWatchFiles = 'src/theme/**/*.*'; // Path to all THEME files.
// STOP Editing Project Variables.

/**
 * Load Plugins.
 *
 * Load gulp plugins and assing them semantic names.
 */
var gulp = require('gulp'),
    concat = require('gulp-concat'), // Concatenates JS files
    cleanCSS = require('gulp-clean-css'), // Clean CSS files.
    minifycss = require('gulp-uglifycss'), // Minifies CSS files.
    uglify = require('gulp-uglify'), // Minifies JS files
    del = require('del'),
    sass = require('gulp-sass'),
    autoprefixer = require('gulp-autoprefixer'),
    sourcemaps = require('gulp-sourcemaps'),
    // imagemin = require('gulp-imagemin'), // Minify PNG, JPEG, GIF and SVG images with imagemin.
    // pngquant = require('imagemin-pngquant'),
    rename = require('gulp-rename'),
    notify = require('gulp-notify');


// PULIZIA BUILD
gulp.task('clean', function () {
    return del(buildURL, {force: true});
});

// COPIA DEI FILE DEL TEMA
gulp.task('theme', function () {
    return gulp.src(projectTHEMEWatchFiles)
        .pipe(gulp.dest(buildFOLDER));
});

// COPIA DEI FOGLI DI STILE VENDORS
gulp.task('css', function () {
    return gulp.src(styleVendorSRC)
        .pipe(gulp.dest(styleVendorDestination))
    // .pipe(notify({message: 'TASK: "css" Completed! 💯', onLast: true}));
});

// UNIFICAZIONE E MINIFICAZIONE DEI FILE DI STILE CUSTOM
gulp.task('cssCustom', ['css'], function () {
    return (gulp.src(styleCustomSRC)
        .pipe(sourcemaps.init())
        .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
        .pipe(autoprefixer('last 2 version'))
        .pipe(sourcemaps.write('./'))
        .pipe(concat(styleCustomFile + '.css'))
        .pipe(cleanCSS())
        .pipe(rename({suffix: '.min'}))
        .pipe(minifycss({
            maxLineLen: 10
        }))
        .pipe(gulp.dest(styleCustomDestination)))
    // .pipe(notify({message: 'TASK: "cssCustom" Completed! 💯', onLast: true}));
});

// COPIA DELLE LIBRERIE JAVASCRIPT VENDORS
gulp.task('js', function () {
    return gulp.src(jsVendorSRC)
        .pipe(gulp.dest(jsVendorDestination))
    // .pipe(notify({message: 'TASK: "scripts" Completed! 💯', onLast: true}));
});

// UNIFICAZIONE E MINIFICAZIONE DEI FILE JAVASCRIPT
gulp.task('jsCustom', ['js'], function () {
    return (gulp.src(jsCustomSRC)
        .pipe(concat(jsCustomFile + '.js'))
        .pipe(uglify())
        .pipe(rename({
            basename: jsCustomFile,
            suffix: '.min'
        }))
        .pipe(gulp.dest(jsCustomDestination)))
    // .pipe(notify({message: 'TASK: "jsCustom" Completed! 💯', onLast: true}));
});

// COPIA DELLE IMMAGINI/ASSETS DEL SITO
gulp.task('image', function () {
    return gulp.src(imagesSRC)
        /*.pipe(imagemin({
            progressive: true,
            svgoPlugins: [{removeViewBox: false}],
            use: [pngquant()]
        })) */
        .pipe(gulp.dest(imagesDestination))
    // .pipe(notify({message: 'TASK: "image" Completed! 💯', onLast: true}));
});

// COPIA DEI FONTS
gulp.task('fonts', function () {
    return gulp.src(fontsSRC)
        .pipe(gulp.dest(fontsDestination))
    // .pipe(notify({message: 'TASK: "fonts" Completed! 💯', onLast: true}));
});

// TASK INIZIALE DI COMPILAZIONE
gulp.task('default', ['clean'], function () {
    gulp.start(['theme', 'cssCustom', 'jsCustom', 'image', 'fonts']);
    gulp.watch(projectTHEMEWatchFiles, ['theme']); // Reload on THEME file changes.
    gulp.watch(styleWatchFiles, ['cssCustom']); // Reload on CSS file changes.
    gulp.watch(customJSWatchFiles, ['jsCustom']); // Reload on customJS file changes
    gulp.watch(imageWatchFiles, ['image']); // Reload on images file changes
});
