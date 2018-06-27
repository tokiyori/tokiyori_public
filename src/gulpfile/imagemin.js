
//========================================================================
// @ $画像最適化
//========================================================================
var gulp        = require('gulp');
var $           = require('gulp-load-plugins')({
  pattern: ['gulp-*', 'gulp.*'],
  replaceString: /\bgulp[\-.]/
});

// @ 関数化
// ------------------------------------------------------------

function imagemin(distDir){
  gulp.src(config.path.source + config.path.img +  "/**/*.jpg")
    .pipe($.imagemin())
    .pipe(gulp.dest(distDir));
  gulp.src(config.path.source + config.path.img +  "/**/*.png")
    .pipe($.imagemin())
    .pipe(gulp.dest(distDir));
}

if(config.mode.static){
  gulp.task('imagemin', function(){
    imagemin(config.path.dist + config.path.img)
    imagemin(config.path.styleguile + config.path.img)
  });
}else if(config.mode.cms){
  gulp.task('imagemin', function(){
    imagemin(config.path.cms + config.path.cms_dir + config.path.cms_theme + config.path.img)
    imagemin(config.path.cms + config.path.cms_dir  + config.path.cms_theme + config.path.styleguile_cms + config.path.img)
  });
}