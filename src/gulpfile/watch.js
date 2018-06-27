//========================================================================
// @ $watch
//========================================================================

var gulp        = require('gulp');
var runSequence = require('run-sequence');
var $           = require('gulp-load-plugins')({
  pattern: ['gulp-*', 'gulp.*'],
  replaceString: /\bgulp[\-.]/
});

gulp.task('watch', function () {

  // @ 静的モードがtureの場合、以下のタスクを実行
  // ------------------------------------------------------------

  if(config.mode.static === true) {
    // ------------------------------
    gulp.watch(config.path.source + config.path.sass + '/**/*.scss', ['scss','hologram','bs-reload']);
    gulp.watch(config.path.source + config.path.js + '/**/*.js', ['js','bs-reload']);
    // ------------------------------
    gulp.watch(config.path.source + config.path.img + '/**/*.jpg', ['imagemin', 'bs-reload']);
    gulp.watch(config.path.source + config.path.img + '/**/*.png', ['imagemin', 'bs-reload']);
    if(config.mode.html === true) {
      gulp.watch(config.path.source + config.path.html + '/**/*.html', ['copy.html', 'bs-reload']);
    }
    // ------------------------------
    gulp.watch(config.path.source + config.path.fonts + '/**/*.html', ['copy.assets', 'bs-reload']);
    gulp.watch(config.path.source + config.path.js + '/lib/**/*', ['copy.assets', 'bs-reload']);
    gulp.watch(config.path.source + config.path.svg + '/**/*', ['copy.assets', 'bs-reload']);
    gulp.watch(config.path.source + config.path.file + '/**/*', ['copy.assets', 'bs-reload']);
    // ------------------------------
    if(config.mode.ejs === true) { // ejsモードがtureの場合
      gulp.watch(config.path.source + config.path.ejs + '/**/*.ejs', ['ejs.html', 'bs-reload']);
    }
  }

  // @ CMSモードがtrueの場合
  // ------------------------------------------------------------

  if(config.mode.cms === true) {
    // ------------------------------
    gulp.watch(config.path.source + config.path.sass + '/**/*.scss', ['scss','hologram','bs-reload']);
    gulp.watch(config.path.source + config.path.js + '/**/*.js', ['js','bs-reload']);
    // ------------------------------
    gulp.watch(config.path.source + config.path.img + '/**/*.jpg', ['imagemin', 'bs-reload']);
    gulp.watch(config.path.source + config.path.img + '/**/*.png', ['imagemin', 'bs-reload']);
    gulp.watch(config.path.source + config.path.php + '/**/*.php', ['php', 'bs-reload']);
    // ------------------------------
    gulp.watch(config.path.source + config.path.js + '/lib/**/*', ['copy.assets', 'bs-reload']);
    gulp.watch(config.path.source + config.path.svg + '/**/*', ['copy.assets', 'bs-reload']);
    gulp.watch(config.path.source + config.path.file + '/**/*', ['copy.assets', 'bs-reload']);
    // ------------------------------
    if(config.mode.ejs === true) { // ejsモードがtureの場合
      if(config.mode.cmstype === "wordpress"){
        gulp.watch(config.path.source + config.path.ejs + '/**/*.ejs', ['ejs.php', 'bs-reload']);
      }
    }
  }
});