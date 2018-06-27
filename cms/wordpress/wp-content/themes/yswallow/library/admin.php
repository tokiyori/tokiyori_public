<?php

//スマホの場合に管理バーを表示させない（表示崩れ回避のために使用）
if(is_mobile()){
add_filter( 'show_admin_bar', '__return_false' );
}

// 投稿ページ以外でhentryクラスを除去
function remove_hentry( $classes ) {
    if (!is_single()) $classes = array_diff($classes, array('hentry'));
    return $classes;
}
add_filter('post_class', 'remove_hentry');

// post_classにクラス追加
function add_class_article( $classes ) {
    $classes[] = 'article cf';
    return $classes;
}
add_filter('post_class', 'add_class_article');

// バージョン情報を削除
if (!function_exists('vc_remove_wp_ver_css_js')) {
	function vc_remove_wp_ver_css_js( $src ) {
	    if ( strpos( $src, 'ver=' ) )
	        $src = remove_query_arg( 'ver', $src );
	    return $src;
	}
	add_filter( 'style_loader_src', 'vc_remove_wp_ver_css_js', 9999 );
	add_filter( 'script_loader_src', 'vc_remove_wp_ver_css_js', 9999 );
}

// THEME CSS EDITOR INCLUDE
add_editor_style( 'library/css/editor-style.css' );


// ビジュアルエディタにclassを追加
add_filter( 'tiny_mce_before_init', 'custom_tiny_mce_body_class' );
function custom_tiny_mce_body_class( $settings ){
  $settings['body_class'] = 'entry-content';
  return $settings;
}
