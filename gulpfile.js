var gulp = require('gulp'),
    sass = require('gulp-ruby-sass'),
    autoprefixer = require('gulp-autoprefixer'),
    minifycss = require('gulp-minify-css'),
    rename = require('gulp-rename'),
    frontendPath = 'frontend/web';


    /*gulp.task('express', function() {
        var express = require('express');
        var app = express();
        app.use(require('connect-livereload')({port: 35729}));
        app.use(express.static(__dirname));
        app.listen(4000, '0.0.0.0');
    });

    var tinylr;
    gulp.task('livereload', function() {
        tinylr = require('tiny-lr')();
        tinylr.listen(35729);
    });

    function notifyLiveReload(event) {
        var fileName = require('path').relative(__dirname, event.path);

        tinylr.changed({
            body: {
                files: [fileName]
            }
        });
    }*/

    gulp.task('styles', function() {
        return sass(frontendPath+'/sass/main.scss', { style: 'expanded' })
            .pipe(gulp.dest(frontendPath+'/css'))
            .pipe(rename({suffix: '.min'}))
            .pipe(minifycss())
            .pipe(gulp.dest(frontendPath+'/css'));
    });

    //gulp.task('watch', function() {
    //    gulp.watch('assets/sass/*.scss', ['styles']);
    //});

    gulp.task('watch', function() {
        gulp.watch(frontendPath+'/sass/*.scss', ['styles']);
        //gulp.watch('*.html', notifyLiveReload);
        //gulp.watch('assets/sass/*.css', notifyLiveReload);
    });

    //gulp.task('default', ['styles', 'express', 'livereload', 'watch'], function() {});
    gulp.task('default', ['styles','watch'], function() {});