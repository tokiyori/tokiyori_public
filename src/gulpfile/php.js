
//========================================================================
// @ cms.php | wordpress用テーマ作成時必要ファイル書き出し
//========================================================================

var gulp        = require('gulp');
var $           = require('gulp-load-plugins')({
  pattern: ['gulp-*', 'gulp.*'],
  replaceString: /\bgulp[\-.]/
});

if(config.mode.cms) {
  gulp.task("php", function () {
    gulp.src(config.path.source + config.path.php + '/**/*')
      .pipe(gulp.dest(config.path.cms + config.path.cms_dir + config.path.cms_theme))
  });
}