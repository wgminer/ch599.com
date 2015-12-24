// Requirements

var gulp = require('gulp'); 
var clean = require('gulp-clean');
var sass = require('gulp-sass');
var postcss = require('gulp-postcss');
var jshint = require('gulp-jshint');
var livereload = require('gulp-livereload');

// var usemin = require('gulp-jade-usemin');
// var uglify = require('gulp-uglify');
// var rev = require('gulp-rev');

// var ftp = require('vinyl-ftp');
// var gutil = require('gulp-util');
// var secrets = require('./secrets.json');

gulp.task('styles', function () {

    var plugins = [
        require('autoprefixer'),
        require('cssnano')
    ];

    return gulp.src('./src/scss/**/*.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(postcss(plugins))
        .pipe(gulp.dest('./public/css'))
        .pipe(livereload());
});

gulp.task('scripts', function () {
    return gulp.src('./src/js/**/*.js')
        .pipe(jshint())
        .pipe(jshint.reporter('default'))
        .pipe(gulp.dest('./public/js'))
        .pipe(livereload());
});

gulp.task('php', function () {
    return gulp.src('./application/views/**/*.php')
        .pipe(livereload());
});

gulp.task('serve', ['styles', 'scripts'], function () {
    livereload.listen();
    gulp.watch('views/**/*.php', {cwd: './application'}, ['php']);
    gulp.watch('scss/**/*.scss', {cwd: './src'}, ['styles']);
    gulp.watch('js/**/*.js', {cwd: './src'}, ['scripts']);
});