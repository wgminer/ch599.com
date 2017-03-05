// Requirements

var gulp = require('gulp'); 
var clean = require('gulp-clean');
var sass = require('gulp-sass');
var postcss = require('gulp-postcss');
var jshint = require('gulp-jshint');
var livereload = require('gulp-livereload');

var rev = require('gulp-rev');
var ngAnnotate = require('gulp-ng-annotate');
var jsmin = require('gulp-jsmin');
var concat = require('gulp-concat');

var ftp = require('vinyl-ftp');
var gutil = require('gulp-util');
var secrets = require('./secrets.json');

gulp.task('styles', function () {

    var plugins = [
        require('autoprefixer'),
        require('cssnano')
    ];

    return gulp.src('./src/scss/**/*.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(postcss(plugins))
        .pipe(gulp.dest('./public/css'))
        .pipe(rev())
        .pipe(livereload());
});

gulp.task('scripts', function () {

    var site = [
        './libs/jquery/dist/jquery.js',
        './libs/typed.js/dist/typed.min.js',
        './libs/jquery_lazyload/jquery.lazyload.js',
        './src/js/599/player.js',
        './src/js/599/playlist.js',
        './src/js/599/search.js',
        './src/js/599/setup.js'
    ];

    var admin = [
        './libs/angular/angular.js',
        './libs/angular-route/angular-route.js',
        './src/js/admin/app.js',
        './src/js/admin/controllers.js',
        './src/js/admin/directives.js',
        './src/js/admin/services.js'
    ];

    // Site scripts
    gulp.src(site)
        // .pipe(jshint())
        // .pipe(jshint.reporter('default'))
        .pipe(jsmin())
        .pipe(concat('599.js'))
        .pipe(gulp.dest('./public/js'))
        .pipe(livereload());

    gulp.src(admin)
        // .pipe(jshint())
        // .pipe(jshint.reporter('default'))
        .pipe(ngAnnotate())
        .pipe(jsmin())
        .pipe(concat('admin.js'))
        .pipe(gulp.dest('./public/js'))
        .pipe(livereload());

    return;
});

gulp.task('partials', function () {
    return gulp.src('./src/partials/**/*.html')
        .pipe(gulp.dest('./public/partials'))
        .pipe(livereload());
});

gulp.task('images', function () {
    return gulp.src('./src/img/**/*')
        .pipe(gulp.dest('./public/img'))
        .pipe(livereload());
});

gulp.task('php', function () {
    return gulp.src('./application/views/**/*.php')
        .pipe(livereload());
});

gulp.task('serve', ['styles', 'images', 'partials', 'scripts'], function () {
    livereload.listen();
    gulp.watch('views/**/*.php', {cwd: './application'}, ['php']);
    gulp.watch('scss/**/*.scss', {cwd: './src'}, ['styles']);
    gulp.watch('js/**/*.js', {cwd: './src'}, ['scripts']);
    gulp.watch('partials/**/*.html', {cwd: './src'}, ['partials']);
    gulp.watch('images/**/*', {cwd: './src'}, ['images']);
});

gulp.task('deploy', ['styles', 'images', 'partials', 'scripts'], function () {

    var conn = ftp.create({
        host: secrets.production.host,
        user: secrets.production.user,
        password: secrets.production.password,
        parallel: 3,
        maxConnections: 5,
        log: gutil.log
    }); 

    var globs = [
        './application/**',
        './system/**',
        './public/**',
        './.htaccess',
        './index.php',
        './robots.txt',
        './favicon.ico',
        './apple-touch-icon.png'
    ]

    return gulp.src(globs, {base: './', buffer: false})
        .pipe(conn.newer(secrets.production.path))
        .pipe(conn.dest(secrets.production.path));

});