
//========================================================================
// @ html
//========================================================================

var gulp        = require('gulp');
var $           = require('gulp-load-plugins')({
  pattern: ['gulp-*', 'gulp.*'],
  replaceString: /\bgulp[\-.]/
});

if(config.mode.static) {
  gulp.task('copy.html', function () {
    if (config.mode.html === true) {
      var distDir = config.path.dist;
      //html
      gulp.src([config.path.source + config.path.html + '**/*.html', config.path.source + config.path.html + '!/' + 'node_modules/**/*.html', config.path.source + config.path.html + '!/' + 'vendor/**/*.html', config.path.source + config.path.html + '!/' + 'hologram/**/*.html', , config.path.source + config.path.html + '!/' + 'ejs/**/*.html', config.path.source + config.path.html + '!/' + 'assets/**/*.html'])
        .pipe(gulp.dest(distDir))
        .pipe(browserSync.stream());
    }
  });
}