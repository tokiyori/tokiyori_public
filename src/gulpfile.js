// @ 設定ファイル読み込み
// ------------------------------------------------------------
var conf = require('./config');
var requireDir = require('require-dir');
var dir = requireDir('./gulpfile');

//========================================================================
// @ require
//========================================================================

var gulp        = require('gulp');
var runSequence = require('run-sequence');
var browserSync = require('browser-sync');
var $           = require('gulp-load-plugins')({
                    pattern: ['gulp-*', 'gulp.*'],
                    replaceString: /\bgulp[\-.]/
                  });

//========================================================================
// @ ローカルサーバー起動 監視タスクON
//========================================================================

gulp.task('run', function (callback) {
    runSequence(
        'bs',
        'watch',
        callback);
});

//========================================================================
// @ 全タスク実行
//========================================================================

gulp.task('build', function (callback) {
  if(config.mode.static === true && config.mode.ejs === false) {
    return runSequence(
        'clean',
        ['scss', 'hologram', 'js', 'copy.html', 'copy.assets'],
        'imagemin',
        callback
    );
  }else if(config.mode.static === true && config.mode.ejs === true){
    return runSequence(
        'clean',
        ['scss', 'hologram', 'js', 'ejs.html', 'copy.html', 'copy.assets'],
        'imagemin',
        callback
    );
  }
  if(config.mode.cms === true && config.mode.cmstype === "wordpress") {
    return runSequence(
        'clean',
        ['scss', 'hologram', 'js','wp.assets','php', 'copy.assets'],
        'imagemin',
        callback
    );
  }
  if(config.mode.cms === true && config.mode.cmstype === "acms") {
    return runSequence(
        'clean',
        ['scss', 'hologram', 'js', 'copy.assets'],
        'imagemin',
        callback
    );
  }
});