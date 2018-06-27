<?php

// include functions file
require_once( 'library/customizer.php' );
require_once( 'library/shortcode.php' );
require_once( 'library/widget.php' );
require_once( 'library/admin.php' );


// title tags
function setup_theme() {
   add_theme_support( 'title-tag' );
}

add_action( 'after_setup_theme', 'setup_theme' );


function opencage_rss_version() {
	return '';
}
add_filter( 'the_generator', 'opencage_rss_version' );


function opencage_remove_wp_widget_recent_comments_style() {
	if ( has_filter( 'wp_head', 'wp_widget_recent_comments_style' ) ) {
		remove_filter( 'wp_head', 'wp_widget_recent_comments_style' );
	}
}
add_filter( 'wp_head', 'opencage_remove_wp_widget_recent_comments_style', 1 );


function opencage_remove_recent_comments_style() {
	global $wp_widget_factory;
	if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
		remove_action( 'wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style') );
	}
}
add_action( 'wp_head', 'opencage_remove_recent_comments_style', 1 );



// include SCRIPTS
if (!is_admin()) {
	function register_script(){
		wp_deregister_script( 'jquery' );
		wp_register_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js', array(), '1.12.2' );
		wp_register_script( 'slick', get_bloginfo('template_directory'). '/library/js/slick.min.js', array('jquery'), '1.5.9', true );
		wp_register_script( 'remodal', get_bloginfo('template_directory'). '/library/js/remodal.js', array('jquery'), '1.0.0', true );
		wp_register_script( 'css-modernizr', get_bloginfo('template_directory'). '/library/js/modernizr.custom.min.js', array(), '2.5.3', true );
		wp_register_script( 'wow', get_bloginfo('template_directory'). '/library/js/wow.min.js', array('jquery'), '', true );
		wp_register_script( 'main-js', get_bloginfo('template_directory'). '/library/js/scripts.js', array( 'jquery' ), '', true );
	}
	function add_script() {
		register_script();
			wp_enqueue_script('jquery');
			wp_enqueue_script( 'remodal' );
			wp_enqueue_script( 'main-js' );
			wp_enqueue_script( 'css-modernizr' );
		if(!wp_is_mobile() && !strstr($_SERVER['HTTP_USER_AGENT'], 'Trident') && !strstr($_SERVER['HTTP_USER_AGENT'], 'MSIE') && (get_option('side_options_animatenone') == "ani_on")){
			wp_enqueue_script( 'wow' );
		}
		if(is_front_page() || is_home()) {
			wp_enqueue_script( 'slick' );
		}
	}
	add_action('wp_enqueue_scripts', 'add_script');
}


// include CSS
function register_style() {
	wp_register_style('style', get_bloginfo('template_directory').'/style.css');
	wp_register_style('fontawesome', get_bloginfo('template_directory').'/library/css/font-awesome.min.css');
	wp_register_style('gf_Notojp', '//fonts.googleapis.com/earlyaccess/notosansjapanese.css');
	wp_register_style('slick', get_bloginfo('template_directory').'/library/css/slick.css');
	wp_register_style('remodal', get_bloginfo('template_directory').'/library/css/remodal.css');
	wp_register_style('animate', get_bloginfo('template_directory').'/library/css/animate.min.css');
}
	function add_stylesheet() {
		register_style();
			wp_enqueue_style('style');
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

// breadcrumb
if (!function_exists('breadcrumb')) {
	function breadcrumb($divOption = array("id" => "breadcrumb", "class" => "breadcrumb inner wrap animated fadeIn cf")){
	    global $post;
	    $str ='';
	    if(get_option('side_options_pannavi', 'pannavi_on') !== 'pannavi_off'){
		    if(!is_home()&&!is_front_page()&&!is_admin() ){
		        $tagAttribute = '';
		        foreach($divOption as $attrName => $attrValue){
		            $tagAttribute .= sprintf(' %s="%s"', $attrName, $attrValue);
		        }
		        $str.= '<div'. $tagAttribute .'>';
		        $str.= '<ul>';
		        $str.= '<li itemscope itemtype="//data-vocabulary.org/Breadcrumb"><a href="'. home_url() .'/" itemprop="url"><i class="fa fa-home"></i><span itemprop="title"> HOME</span></a></li>';
		 
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
		            $cat = $categories[0];
		            if($cat -> parent != 0){
		                $ancestors = array_reverse(get_ancestors( $cat -> cat_ID, 'category' ));
		                foreach($ancestors as $ancestor){
		                    $str.='<li itemscope itemtype="//data-vocabulary.org/Breadcrumb"><a href="'. get_category_link($ancestor).'" itemprop="url"><span itemprop="title">'. get_cat_name($ancestor). '</span></a></li>';
		                }
		            }
		            $str.='<li itemscope itemtype="//data-vocabulary.org/Breadcrumb"><a href="'. get_category_link($cat -> term_id). '" itemprop="url"><span itemprop="title">'. $cat-> cat_name . '</span></a></li>';
		            $str.= '<li class="bc_posttitle">'. $post -> post_title .'</li>';
		        } elseif(is_page()){
		            if($post -> post_parent != 0 ){
		                $ancestors = array_reverse(get_post_ancestors( $post->ID ));
		                foreach($ancestors as $ancestor){
		                    $str.='<li itemscope itemtype="//data-vocabulary.org/Breadcrumb"><a href="'. get_permalink($ancestor).'" itemprop="url"><span itemprop="title">'. get_the_title($ancestor) .'</span></a></li>';
		                }
		            }
		            $str.= '<li class="bc_posttitle">'. $post -> post_title .'</li>';
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
		            $str.= '<li><span itemprop="title">'. $post -> post_title .'</span></li>';
		        } elseif(is_404()){
		            $str.='<li>ページがみつかりません。</li>';
		        } else{
		            $str.='';
		        }
		        $str.='</ul>';
		        $str.='</div>';
		    }
		}
	    echo $str;
	}
}


// pagination
if (!function_exists('pagination')) {
	function pagination($pages = '', $range = 2){
	     global $wp_query, $paged;
	
		$big = 999999999;
	
		echo "<nav class=\"pagination cf\">\n";
	 	echo paginate_links( array(
			'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'current' => max( 1, get_query_var('paged') ),
			'prev_text'    => __('<'),
			'next_text'    => __('>'),
			'type'    => 'list',
			'total' => $wp_query->max_num_pages
		) );
		echo "</nav>\n";
	}
}

// search form
if (!function_exists('my_search_form')) {
	function my_search_form( $form ) {
		$form = '<form role="search" method="get" id="searchform" class="searchform cf" action="' . home_url( '/' ) . '" >
		<input type="search" placeholder="キーワードを入力" value="' . get_search_query() . '" name="s" id="s" />
		<button type="submit" id="searchsubmit"></button>
		</form>';
		return $form;
	}
	add_filter( 'get_search_form', 'my_search_form' );
}


// original thumbnails
if (!function_exists('add_mythumbnail_size')) {
	function add_mythumbnail_size() {
	add_theme_support('post-thumbnails');
	add_image_size( 'home-thum', 486, 290, true );
	add_image_size( 'post-thum', 300, 200, true );
	}
	add_action( 'after_setup_theme', 'add_mythumbnail_size' );
}

// Google Analytics
if ( get_option( 'other_options_ga' ) ) {
function meta_analytics() {

$analyticstag = get_option( 'other_options_ga' );
$headanalytics = <<<EOM
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', '{$analyticstag}', 'auto');
  ga('send', 'pageview');
</script>
EOM;
echo $headanalytics;
}
add_action( 'wp_head', 'meta_analytics', 999);
}

// head tags
add_action( 'wp_head', 'meta_headtags' );
function meta_headtags() {
	$output = get_option( 'other_options_headcode' );
	echo $output;
}

// Child Category Accordion
if (!function_exists('cat_accordion') && (get_option('side_options_cataccordion', 'accordion_on') == "accordion_on" )) {
add_action( 'wp_footer', 'cat_accordion' );
function cat_accordion() {
$cat_accordion = <<< EOM
<script>
$(function(){
	$(".widget_categories li, .widget_nav_menu li").has("ul").toggleClass("accordionMenu");
	$(".widget ul.children , .widget ul.sub-menu").after("<span class='accordionBtn'></span>");
	$(".widget ul.children , .widget ul.sub-menu").hide();
	$("ul .accordionBtn").on("click", function() {
		$(this).prev("ul").slideToggle();
		$(this).toggleClass("active");
	});
});
</script>
EOM;
echo $cat_accordion;
}
}

// page tags
function add_tag_to_page() {
 register_taxonomy_for_object_type('post_tag', 'page');
}
add_action('init', 'add_tag_to_page');

// category HTML tags
remove_filter( 'pre_term_description', 'wp_filter_kses' );

// Update date
function get_mtime($format) {
    $mtime = get_the_modified_time('Ymd');
    $ptime = get_the_time('Ymd');
    if ($ptime > $mtime) {
        return get_the_time($format);
    } elseif ($ptime === $mtime) {
        return null;
    } else {
        return get_the_modified_time($format);
    }
}

// embedded content size
if ( ! isset( $content_width ) ) {
	$content_width = 800;
}

//iframe setting
function wrap_iframe_in_div($the_content) {
if ( is_singular() ) {
//YouTube
$the_content = preg_replace('/<iframe[^>]+?youtube\.com[^<]+?<\/iframe>/is', '<div class="youtube-container">${0}</div>', $the_content);
}
return $the_content;
}
add_filter('the_content','wrap_iframe_in_div');



// user page description html
remove_filter('pre_user_description', 'wp_filter_kses');

// user item delete & plus
if (!function_exists('update_profile_fields')) {
	function update_profile_fields( $contactmethods ) {
	    //delete
	    unset($contactmethods['aim']);
	    unset($contactmethods['jabber']);
	    unset($contactmethods['yim']);
	    //plus
	    $contactmethods['twitter'] = 'Twitter';
	    $contactmethods['facebook'] = 'Facebook';
	    $contactmethods['googleplus'] = 'Google+';
	    $contactmethods['instagram'] = 'Instagram';
	    $contactmethods['userposition'] = '肩書';
	     
	    return $contactmethods;
	}
	add_filter('user_contactmethods','update_profile_fields',10,1);
}

// Self pinback
function no_self_pingst( &$links ) {
    $home = home_url();
    foreach ( $links as $l => $link )
        if ( 0 === strpos( $link, $home ) )
            unset($links[$l]);
}
add_action( 'pre_ping', 'no_self_pingst' );


// archives ptags
function opencage_filter_ptags_on_images($content){
	return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}
add_filter( 'the_content', 'opencage_filter_ptags_on_images' );

// more
if (!function_exists('opencage_excerpt_more')) {
	function opencage_excerpt_more($more) {
		global $post;
		return '...';
	}
	add_filter( 'excerpt_more', 'opencage_excerpt_more' );
}


// is_mobile
function is_mobile(){
$useragents = array(
'iPhone',
'iPod',
'Android.*Mobile',
'Windows.*Phone',
'dream',
'CUPCAKE',
'blackberry9500',
'blackberry9530',
'blackberry9520',
'blackberry9550',
'blackberry9800',
'webOS',
'incognito',
'webmate'
);
$pattern = '/'.implode('|', $useragents).'/i';
return preg_match($pattern, $_SERVER['HTTP_USER_AGENT']);
}


// Home Widget
if (!function_exists('parts_add_top')) {
	function parts_add_top(){
		if ( is_front_page()&&!is_admin()){
			if ( is_active_sidebar( 'home-top_mobile' ) && is_mobile() ){
				echo '<div clss="homeadd_wrap homeaddtop mobile">';
				dynamic_sidebar( 'home-top_mobile' );
				echo '</div>';
			}
			if ( is_active_sidebar( 'home-top' ) && !is_mobile() ){
				echo '<div clss="homeadd_wrap homeaddtop">';
				dynamic_sidebar( 'home-top' );
				echo '</div>';
			}
		}
	}
}

if (!function_exists('parts_add_bottom')) {
	function parts_add_bottom(){
		if ( is_front_page()&&!is_admin()){
			if ( is_active_sidebar( 'home-bottom_mobile' ) && is_mobile() ){
				echo '<div clss="homeadd_wrap homeaddbottom mobile">';
				dynamic_sidebar( 'home-bottom_mobile' );
				echo '</div>';
			}
			if ( is_active_sidebar( 'home-bottom' ) && !is_mobile() ){
				echo '<div clss="homeadd_wrap homeaddbottom">';
				dynamic_sidebar( 'home-bottom' );
				echo '</div>';
			}
		}
	}
}


//UPDATE CHECK
require 'library/theme-update-checker.php';
$example_update_checker = new ThemeUpdateChecker(
'yswallow',
'http://open-cage.com/theme-update/swallow/update-info.json'
);

// LP CUSTOM POST
function custom_post_lp() { 
	register_post_type( 'post_lp',
		array( 'labels' => array(
			'name' => __( 'ランディングページ', 'opencagetheme' ),
			'singular_name' => __( 'ランディングページ', 'opencagetheme' ),
			'all_items' => __( 'すべてのランディングページ', 'opencagetheme' ),
			'add_new' => __( '新規作成', 'opencagetheme' ),
			'add_new_item' => __( 'ランディングページをつくる', 'opencagetheme' ),
			'edit' => __( '編集', 'opencagetheme' ),
			'edit_item' => __( 'ランディングページを編集', 'opencagetheme' ),
			'new_item' => __( 'New Post Type', 'opencagetheme' ),
			'view_item' => __( 'ランディングページを表示', 'opencagetheme' ),
			'search_items' => __( 'ランディングページを検索', 'opencagetheme' ),
			'not_found' =>  __( 'Nothing found in the Database.', 'opencagetheme' ),
			'not_found_in_trash' => __( 'Nothing found in Trash', 'opencagetheme' ),
			'parent_item_colon' => ''
			),
			'description' => __( 'ランディングページをつくれます。', 'opencagetheme' ),
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8,
			'menu_icon' => get_bloginfo('template_directory') . '/library/images/custom-post-icon.png',
			'rewrite'	=> array( 'slug' => 'post_lp', 'with_front' => false ),
			'has_archive' => 'post_lp',
			'capability_type' => 'page',
			'hierarchical' => true,
			'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'page-attributes')
		)
	);
}
add_action( 'init', 'custom_post_lp');