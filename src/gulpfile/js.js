var gulp        = require('gulp');
var $           = require('gulp-load-plugins')({
  pattern: ['gulp-*', 'gulp.*'],
  replaceString: /\bgulp[\-.]/
});

//========================================================================
// @ js結合・圧縮
//========================================================================

//@ 関数化
//------------------------------------------------------------

function jsCompile(distDir) {
  // jquery
  gulp.src(config.path.source + config.path.node + 'jquery/dist/jquery.js') //node_moduleからファイルを読み込み
  // .pipe($.uglify()) //難読化の場合はコメントアウトを外す
    .pipe(gulp.dest(distDir));

  // form.js | フォームバリデーション関係Js
  gulp.src([config.path.source + config.path.js + '/form/lib/*.js',config.path.source + config.path.js + '/form/form.js'])
    .pipe($.concat('form.js'))
    .pipe($.uglify())
    .pipe(gulp.dest(distDir));

  //vender | ブラウザ対応等のJs
  gulp.src(config.path.source + config.path.node + 'flexibility/flexibility.js') //node_moduleからファイルを読み込み
    .pipe($.concat('vender.js'))
    .pipe($.uglify())
    .pipe(gulp.dest(distDir));

  //通常
  gulp.src([config.path.source + config.path.js + '/!(_)*.js','!' + config.path.source + config.path.js + '/lib/*.js']) //パーシャルを除外
    .pipe($.uglify())
    .pipe(gulp.dest(distDir))
}

if(config.mode.cms){
  gulp.task('js',function(){
    jsCompile(config.path.cms + config.path.cms_dir + config.path.cms_theme + config.path.js);
    jsCompile(config.path.cms + config.path.cms_dir  + config.path.cms_theme + config.path.styleguile_cms + config.path.js);
  });
}else if(config.mode.static){
  gulp.task('js',function(){
    jsCompile(config.path.dist + config.path.js);
    jsCompile(config.path.styleguile + config.path.js);
  });
}

