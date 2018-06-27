
//========================================================================
// @ Hologram | スタイルガイドジェネレーター
//========================================================================

// 参照、出力先は ./hologram/config.yml にて設定

var gulp        = require('gulp');
var $           = require('gulp-load-plugins')({
  pattern: ['gulp-*', 'gulp.*'],
  replaceString: /\bgulp[\-.]/
});

gulp.task('hologram', function() {
  return gulp.src('./hologram/config.yml')
    .pipe($.hologram());
});
