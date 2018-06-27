
//========================================================================
// コピーアセット
//========================================================================

var gulp        = require('gulp');
var browserSync = require('browser-sync');
var $           = require('gulp-load-plugins')({
  pattern: ['gulp-*', 'gulp.*'],
  replaceString: /\bgulp[\-.]/
});

// @ 関数化
// ------------------------------

function copyAssets(distDir) {
  //fonts
  gulp.src(config.path.source + config.path.fonts + '/**/*')
    .pipe(gulp.dest(distDir + config.path.fonts))
    .pipe(browserSync.stream());

  //js library
  gulp.src(config.path.source + config.path.js + '/lib/**/*')
    .pipe(gulp.dest(distDir + config.path.js + '/lib/'))
    .pipe(browserSync.stream());

  //svg
  gulp.src(config.path.source + config.path.svg + '/**/*')
    .pipe(gulp.dest(distDir + config.path.svg))
    .pipe(browserSync.stream());

  //file
  gulp.src(config.path.source + config.path.file + '/**/*')
    .pipe(gulp.dest(distDir + config.path.file))
    .pipe(browserSync.stream());
  //img *imageminでコピーできないgif画像をコピー
  gulp.src([config.path.source + config.path.img + '/**/*.gif',config.path.source + config.path.img + '/**/*.cur'])
    .pipe(gulp.dest(distDir + config.path.img))
    .pipe(browserSync.stream());
}

if(config.mode.static){
  gulp.task('copy.assets', function() {
    copyAssets(config.path.dist);
  });
}else if(config.mode.cms){
  gulp.task('copy.assets', function() {
    copyAssets(config.path.cms + config.path.cms_dir  + config.path.cms_theme);
    copyAssets(config.path.cms + config.path.cms_dir  + config.path.cms_theme + config.path.styleguile_cms);
  });
}