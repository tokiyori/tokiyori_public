
//========================================================================
// scss コンパイルタスク
//========================================================================

var gulp        = require('gulp');
var $           = require('gulp-load-plugins')({
  pattern: ['gulp-*', 'gulp.*'],
  replaceString: /\bgulp[\-.]/
});

var browsers = [
    '> 3%'
];


var bourbon    = require("bourbon").includePaths,
    neat       = require("bourbon-neat").includePaths;

// @ Sassコンパイルタスクを関数化
// ------------------------------

function scssCompile(distDir) {
  gulp.src(config.path.source + config.path.sass + '/**/*.scss')
      .pipe($.plumber({
        errorHandler: $.notify.onError("Error: <%= error.message %>")
      }))
      .pipe($.sourcemaps.init())
      .pipe($.sass({
        includePaths: [bourbon, neat]
      }))
      .pipe($.postcss([
        // require('doiuse')({browsers: browsers}),
        // todo:ignoreする https://liginc.co.jp/206518
        require('autoprefixer')({browsers: browsers}),
        require('css-mqpacker')
      ]))
      // ▼ 出力CSSを難読化させる場合はコメントアウトを外す
      .pipe($.csso())
      .pipe($.sourcemaps.write('./'))
      .pipe(gulp.dest(distDir))
}

if(config.mode.cms){
  gulp.task('scss', function(){
    scssCompile(config.path.cms + config.path.cms_dir + config.path.cms_theme + config.path.css);
    scssCompile(config.path.cms + config.path.cms_dir  + config.path.cms_theme + config.path.styleguile_cms + config.path.css);
  });
}else if(config.mode.static){
  gulp.task('scss', function(){
    scssCompile(config.path.dist + config.path.css);
  });
}

