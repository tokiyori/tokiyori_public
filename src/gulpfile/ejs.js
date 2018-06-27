
//========================================================================
// ejs | テンプレートエンジン
//========================================================================

var gulp        = require('gulp');
var ejs = require("gulp-ejs");
var $           = require('gulp-load-plugins')({
  pattern: ['gulp-*', 'gulp.*'],
  replaceString: /\bgulp[\-.]/
});

// @ 関数化
// ------------------------------

function ejsFunction(distDir,fileType) {
  gulp.src([config.path.source + config.path.ejs + "/**/*.ejs",config.path.source + config.path.ejs + '!' + "/**/_*.ejs"])
    .pipe($.plumber())
    .pipe($.ejs())
    .pipe($.rename({extname: fileType}))
    .pipe(gulp.dest(distDir))
}

// @ 静的用
// ------------------------------
// mytodo : 構造見直し
// ./src/php/ ディレクトリに書き出す様に一旦指定

gulp.task("ejs.html", function () {
  if(config.mode.cms === true && config.mode.cmstype === "wordpress"){
    ejsFunction(config.path.source + config.path.php,'.php');
  }else{
    ejsFunction(config.path.dist,'.html');
  }
});

if(config.mode.static){
  gulp.task("ejs.php", function () {
    ejsFunction(config.path.source + config.path.php,'.php');
  });
}else if(config.mode.cms){
  gulp.task("ejs.html", function () {
    ejsFunction(config.path.cms + config.path.cms_dir + config.path.cms_theme,'.html');
  });
}
