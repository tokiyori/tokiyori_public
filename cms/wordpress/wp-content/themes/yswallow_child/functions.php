<?php

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
  wp_enqueue_style( 'style', get_template_directory_uri() . '/style.css' );
  wp_enqueue_style( 'child-style',
    get_stylesheet_directory_uri() . '/style.css',
    array('style')
  );
}

// ============================================================
// @ 親テーマのfuncitonを上書き
// ============================================================

// include SCRIPTS

if (!is_admin()) {
  function register_script_child(){
    wp_deregister_script( 'jquery' );
    wp_register_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js', array(), '1.12.2' );
    wp_register_script( 'slick', get_bloginfo('template_directory'). '/library/js/slick.min.js', array('jquery'), '1.5.9', true );
    wp_register_script( 'remodal', get_bloginfo('template_directory'). '/library/js/remodal.js', array('jquery'), '1.0.0', true );
    wp_register_script( 'css-modernizr', get_bloginfo('template_directory'). '/library/js/modernizr.custom.min.js', array(), '2.5.3', true );
    wp_register_script( 'wow', get_bloginfo('template_directory'). '/library/js/wow.min.js', array('jquery'), '', true );
    wp_register_script( 'main-js', get_bloginfo('template_directory'). '/library/js/scripts.js', array( 'jquery' ), '', true );
    //
    wp_register_script( 'index_js', get_stylesheet_directory_uri().'/assets/js/index.js', array( 'jquery' ), '', true );
    wp_register_script( 'common_js', get_stylesheet_directory_uri().'/assets/js/common.js', array( 'jquery' ), '', true );
    wp_register_script( 'form_js', get_stylesheet_directory_uri().'/assets/js/form.js', array( 'jquery' ), '', true );
  }
  function add_script_child() {
    register_script_child();
    wp_enqueue_script('jquery');
    wp_enqueue_script( 'remodal' );
    wp_enqueue_script( 'main-js' );
    wp_enqueue_script( 'css-modernizr' );
    wp_enqueue_script( 'common_js' );
    if(!wp_is_mobile() && !strstr($_SERVER['HTTP_USER_AGENT'], 'Trident') && !strstr($_SERVER['HTTP_USER_AGENT'], 'MSIE') && (get_option('side_options_animatenone') == "ani_on")){
      wp_enqueue_script( 'wow' );
    }
    if(is_front_page() || is_home()) {
      wp_enqueue_script( 'slick' );
      wp_enqueue_script( 'index_js' );
    }
    if(is_page('contact')){
      wp_enqueue_script('jquery');
      wp_enqueue_script( 'remodal' );
      wp_enqueue_script( 'main-js' );
      wp_enqueue_script( 'css-modernizr' );
      wp_enqueue_script( 'common_js' );
      wp_enqueue_script( 'form_js');
    }
  }
  add_action('wp_enqueue_scripts', 'add_script');
}


// include CSS
function register_style_child() {
  wp_register_style('style', get_bloginfo('template_directory').'/style.css');
  wp_register_style('fontawesome', get_bloginfo('template_directory').'/library/css/font-awesome.min.css');
  wp_register_style('gf_Notojp', '//fonts.googleapis.com/earlyaccess/notosansjapanese.css');
  wp_register_style('slick', get_bloginfo('template_directory').'/library/css/slick.css');
  wp_register_style('remodal', get_bloginfo('template_directory').'/library/css/remodal.css');
  wp_register_style('animate', get_bloginfo('template_directory').'/library/css/animate.min.css');
  wp_register_style('customize_css',get_stylesheet_directory_uri().'/assets/css/customize.css');
}
function add_stylesheet_child() {
  register_style_child();
  wp_enqueue_style('style');
  wp_enqueue_style('customize_css');
  if((get_option('side_options_gfnotojp') !== "notojp_off")){
    wp_enqueue_style('gf_Notojp');
  }
  wp_enqueue_style('fontawesome');
  if((get_option('side_options_animatenone', 'ani_on') == "ani_on")){
    wp_enqueue_style('animate');
  }
  if(is_front_page() || is_home()){
    wp_enqueue_style('slick');
  }
  wp_enqueue_style('remodal');
}
add_action('wp_enqueue_scripts', 'add_stylesheet');

// @ 親テーマの関数を削除する
// ------------------------------------------------------------

function remove_parent_theme_actions(){
  remove_action('wp_enqueue_scripts', 'add_stylesheet');
  remove_action('wp_enqueue_scripts', 'add_script');
}
// 削除関数をinitに登録
add_action('init','remove_parent_theme_actions');

add_action('wp_enqueue_scripts', 'add_stylesheet_child');
add_action('wp_enqueue_scripts', 'add_script_child');

// ============================================================
// @ パンくずリスト上書き
// ============================================================

function breadcrumb($divOption = array("id" => "breadcrumb", "class" => "breadcrumb inner wrap cf")){
  global $post;
  $str ='';
  if(!is_home()&&!is_front_page()&&!is_admin()){
    $tagAttribute = '';
    foreach($divOption as $attrName => $attrValue){
      $tagAttribute .= sprintf(' %s="%s"', $attrName, $attrValue);
    }
    $str.= '<div'. $tagAttribute .'>';
    $str.= '<ul>';
    $str.= '<li itemscope itemtype="//data-vocabulary.org/Breadcrumb"><a href="'. home_url() .'/" itemprop="url"><i class="fa fa-home"></i><span itemprop="title"> ホーム</span></a></li>';

    if(is_category()) {
      $cat = get_queried_object();
      if($cat -> parent != 0){
        $ancestors = array_reverse(get_ancestors( $cat -> cat_ID, 'category' ));
        foreach($ancestors as $ancestor){
          $str.='<li itemscope itemtype="//data-vocabulary.org/Breadcrumb"><a href="'. get_category_link($ancestor) .'" itemprop="url"><span itemprop="title">'. get_cat_name($ancestor) .'</span></a></li>';
        }
      }
      $str.='<li itemscope itemtype="//data-vocabulary.org/Breadcrumb"><span itemprop="title">'. $cat -> name . '</span></li>';
    } elseif(is_single()){

      $categories = get_the_category($post->ID);

      // @ カスタム投稿の場合
      // ------------------------------
      if(!$categories){
        //変数定義
        $tarms ='';
        //タクソノミー名を取得
        $taxname = esc_html(get_post_type_object(get_post_type())->name);
        $taxlabel = esc_html(get_post_type_object(get_post_type())->label);
        $tarms = get_the_terms(  $post -> ID ,$taxname);
        $str.='<li itemscope itemtype="//data-vocabulary.org/Breadcrumb"><a href="'. get_post_type_archive_link( $taxname). '" itemprop="url"><span itemprop="title">'. $taxlabel . '</span></a></li>';
        $str.= '<li>'. $post -> post_title .'</li>';

        // @ 通常投稿の場合
        // ------------------------------
      }else{
        $cat = $categories[0];
        if($cat -> parent != 0){
          $ancestors = array_reverse(get_ancestors( $cat -> cat_ID, 'category' ));
          foreach($ancestors as $ancestor){
            $str.='<li itemscope itemtype="//data-vocabulary.org/Breadcrumb"><a href="'. get_category_link($ancestor).'" itemprop="url"><span itemprop="title">'. get_cat_name($ancestor). '</span></a></li>';
          }
        }
        $str.='<li itemscope itemtype="//data-vocabulary.org/Breadcrumb"><a href="'. get_category_link($cat -> term_id). '" itemprop="url"><span itemprop="title">'. $cat-> cat_name . '</span></a></li>';
        $str.= '<li>'. $post -> post_title .'</li>';
      }

    } elseif(is_page()){
      if($post -> post_parent != 0 ){
        $ancestors = array_reverse(get_post_ancestors( $post->ID ));
        foreach($ancestors as $ancestor){
          $str.='<li itemscope itemtype="//data-vocabulary.org/Breadcrumb"><a href="'. get_permalink($ancestor).'" itemprop="url"><span itemprop="title">'. get_the_title($ancestor) .'</span></a></li>';
        }
      }
      $str.= '<li itemscope itemtype="//data-vocabulary.org/Breadcrumb"><span itemprop="title">'. $post -> post_title .'</span></li>';
    } elseif(is_date()){
      if( is_year() ){
        $str.= '<li>' . get_the_time('Y') . '年</li>';
      } else if( is_month() ){
        $str.= '<li><a href="' . get_year_link(get_the_time('Y')) .'">' . get_the_time('Y') . '年</a></li>';
        $str.= '<li>' . get_the_time('n') . '月</li>';
      } else if( is_day() ){
        $str.= '<li><a href="' . get_year_link(get_the_time('Y')) .'">' . get_the_time('Y') . '年</a></li>';
        $str.= '<li><a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('n') . '月</a></li>';
        $str.= '<li>' . get_the_time('j') . '日</li>';
      }
      if(is_year() && is_month() && is_day() ){
        $str.= '<li>' . wp_title('', false) . '</li>';
      }
    } elseif(is_search()) {
      $str.='<li itemscope itemtype="//data-vocabulary.org/Breadcrumb"><span itemprop="title">「'. get_search_query() .'」で検索した結果</span></li>';
    } elseif(is_author()){
      $str .='<li itemscope itemtype="//data-vocabulary.org/Breadcrumb"><span itemprop="title">投稿者 : '. get_the_author_meta('display_name', get_query_var('author')).'</span></li>';
    } elseif(is_tag()){
      $str.='<li itemscope itemtype="//data-vocabulary.org/Breadcrumb"><span itemprop="title">タグ : '. single_tag_title( '' , false ). '</span></li>';
    } elseif(is_attachment()){
      $str.= '<li itemscope itemtype="//data-vocabulary.org/Breadcrumb"><span itemprop="title">'. $post -> post_title .'</span></li>';
    } elseif(is_404()){
      $str.='<li>ページがみつかりません。</li>';
    } elseif(get_post_type_object(get_post_type())) {
      $taxname = esc_html(get_post_type_object(get_post_type())->name);
      $taxlabel = esc_html(get_post_type_object(get_post_type())->label); ?>
      <?php $str.='<li>' . $taxlabel . '</li>';
    }else{
      $str.='<li></li>';
    }
    $str.='</ul>';
    $str.='</div>';
  }
  echo $str;
}
// ============================================================
// @ WordPress の投稿スラッグを自動的に生成する
// ============================================================
function auto_post_slug( $slug, $post_ID, $post_status, $post_type ) {
  if ( preg_match( '/(%[0-9a-f]{2})+/', $slug ) ) {
    $slug = utf8_uri_encode( $post_type ) . '-' . $post_ID;
  }
  return $slug;
}
add_filter( 'wp_unique_post_slug', 'auto_post_slug', 10, 4  );


// ============================================================
// @ カスタムフィールドグループを読み込み
// ============================================================

require(get_stylesheet_directory() . '/unitbuildsystem/customfiledgroup.php');

// ============================================================
// @ WYSIWYGを非表示に
// ============================================================

//add_action( 'init' , 'my_remove_post_editor_support' );
//
//function my_remove_post_editor_support() {
//  remove_post_type_support( 'post', 'editor' );
//}


// ============================================================
// @ 送信完了ページに遷移
// ============================================================

add_action( 'wp_footer', 'add_thanks_page' );
function add_thanks_page() {
  echo <<< EOD
<script>
document.addEventListener( 'wpcf7mailsent', function( event ) {
  location = 'http://tokiyori.jp/thanks/'; /* 遷移先のURL */
}, false );
</script>
EOD;
}