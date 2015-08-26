/* jshint node:true */
'use strict';

var gulp = require('gulp');
var karma = require('karma').server;
var argv = require('yargs').argv;
var $ = require('gulp-load-plugins')();

gulp.task('styles', function() {
  return gulp.src('resources/assets/styles/main.less')
    .pipe($.plumber())
    .pipe($.less())
    .pipe($.autoprefixer({browsers: ['last 1 version']}))
    .pipe(gulp.dest('.tmp/styles'));
});

gulp.task('jshint', function() {
  return gulp.src('resources/assets/scripts/**/*.js')
    .pipe($.jshint())
    //.pipe($.jshint.reporter('jshint-stylish'))
    //.pipe($.jshint.reporter('fail'));
});

gulp.task('jscs', function() {
  return gulp.src('resources/assets/scripts/**/*.js')
    .pipe($.jscs());
});

gulp.task('html', ['styles'], function() {
  var lazypipe = require('lazypipe');
  var cssChannel = lazypipe()
    .pipe($.csso)
    .pipe($.replace, 'bower_components/bootstrap/fonts', 'fonts');

  var assets = $.useref.assets({searchPath: '{.tmp,resources/assets}'});

  return gulp.src('resources/assets/**/*.html')
    .pipe(assets)
    .pipe($.if('*.js', $.ngAnnotate()))
    .pipe($.if('*.js', $.uglify()))
    .pipe($.if('*.css', cssChannel()))
    .pipe(assets.restore())
    .pipe($.useref())
    .pipe($.if('*.html', $.minifyHtml({conditionals: true, loose: true})))
    .pipe(gulp.dest('public'));
});

gulp.task('images', function() {
  return gulp.src('resources/assets/images/**/*')
    // .pipe($.cache($.imagemin({
    //   progressive: true,
    //   interlaced: true
    // })))
    .pipe(gulp.dest('public/images'));
});

gulp.task('fonts', function() {
  return gulp.src(require('main-bower-files')().concat('resources/assets/fonts/**/*')
    .concat('bower_components/bootstrap/fonts/*'))
    .pipe($.filter('**/*.{eot,svg,ttf,woff,woff2}'))
    .pipe($.flatten())
    .pipe(gulp.dest('public/fonts'))
    .pipe(gulp.dest('.tmp/fonts'));
});

gulp.task('extras', function() {
  return gulp.src([
    'resources/assets/*.*',
    '!resources/assets/*.html'
  ], {
    dot: true
  }).pipe(gulp.dest('public'));
});

gulp.task('clean', require('del').bind(null, ['.tmp', 'public']));

gulp.task('test', function(done) {
  karma.start({
    configFile: __dirname + '/js-test/karma.conf.js',
    singleRun: true
  }, done);
});

// inject bower components
gulp.task('wiredep', function() {
  var wiredep = require('wiredep').stream;
  var exclude = [
    'bootstrap',
    'jquery',
    'es5-shim',
    'json3',
    'angular-scenario'
  ];

  gulp.src('resources/assets/styles/*.less')
    .pipe(wiredep())
    .pipe(gulp.dest('resources/assets/styles'));

  gulp.src('resources/assets/*.html')
    .pipe(wiredep({exclude: exclude}))
    .pipe(gulp.dest('app'));

  gulp.src('js-test/*.js')
    .pipe(wiredep({exclude: exclude, devDependencies: true}))
    .pipe(gulp.dest('js-test'));
});

gulp.task('watch', [], function() {
  $.livereload.listen();

  // watch for changes
  gulp.watch([
    'resources/assets/**/*.html',
    '.tmp/styles/**/*.css',
    'resources/assets/scripts/**/*.js',
    'resources/assets/images/**/*'
  ]).on('change', $.livereload.changed);

  gulp.watch('resources/assets/styles/**/*.less', ['styles']);
  gulp.watch('bower.json', ['wiredep']);
});

gulp.task('buildpublic', ['jshint', 'jscs', 'html', 'images', 'fonts', 'extras'],
  function() {
    return gulp.src('public/**/*').pipe($.size({title: 'default', gzip: true}));
  }
);

gulp.task('default', ['clean'], function() {
  gulp.start('buildpublic');
});

gulp.task('docs', [], function() {
  return gulp.src('resources/assets/scripts/**/**')
    .pipe($.ngdocs.process())
    .pipe(gulp.dest('./docs'));
});
