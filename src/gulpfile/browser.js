
//========================================================================
// @ $browser-sync | ローカルサーバー起動
//========================================================================

var gulp        = require('gulp');
var browserSync = require('browser-sync');
var $           = require('gulp-load-plugins')({
  pattern: ['gulp-*', 'gulp.*'],
  replaceString: /\bgulp[\-.]/
});

// @ 関数化
// ------------------------------

function bsFunction(distDir,proxy) {
  if(proxy){
    browserSync({
      server: {
        baseDir: distDir
      }
    });
  }else{
    console.log("OFF");
    return browserSync({
      proxy: config.proxy
    });
  }
}

if(config.mode.static){
  gulp.task('bs', function() {
    bsFunction(config.path.dist,config.proxy);
  });
}else if(config.mode.cms){
  gulp.task('bs', function() {
    bsFunction(config.path.dist,config.proxy);
  });
}

//========================================================================
// @ $bs-reload | オートリロード
//========================================================================

gulp.task('bs-reload', function () {
  browserSync.reload();
});