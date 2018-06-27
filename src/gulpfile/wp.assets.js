
//========================================================================
// @ wp.assets | wordpress用テーマ作成時必要ファイル書き出し
//========================================================================

var gulp        = require('gulp');
var $           = require('gulp-load-plugins')({
  pattern: ['gulp-*', 'gulp.*'],
  replaceString: /\bgulp[\-.]/
});

if(config.mode.cms){
  gulp.task('wp.assets',function () {
    // wordpress用 style.css 書き出し
    if(config.mode.cmstype === "wordpress") {
      gulp.src(config.path.source + config.path.wp_assets + '**/*.scss')
        .pipe($.sass())
        .pipe($.rename('style.css'))
        .pipe(gulp.dest(config.path.cms + config.path.cms_dir + config.path.cms_theme))

      gulp.src(config.path.source + config.path.wp_assets + '**/*.png')
        .pipe(gulp.dest(config.path.cms + config.path.cms_dir + config.path.cms_theme))
    }
  });
}