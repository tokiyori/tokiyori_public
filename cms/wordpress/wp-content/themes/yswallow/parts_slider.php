<?php if ( is_front_page() || is_home() ) :?>
<?php		  
$args = array(
    'posts_per_page' => 20,
    'offset' => 0,
    'tag' => 'pickup',
    'orderby' => 'post_date',
    'order' => 'DESC',
    'post_type' => array('post','page'),
    'post_status' => 'publish',
    'suppress_filters' => true,
    'ignore_sticky_posts' => true,
    'no_found_rows' => true
);
$the_query = new WP_Query( $args );
if ( $the_query->have_posts() ) {
	?>

<script type="text/javascript">
jQuery(function( $ ) {
	$('.slickcar').slick({
		lazyLoad: 'ondemand',
		centerMode: true,
		dots: true,
		autoplay: true,
		autoplaySpeed: 3000,
		speed: 260,
		centerPadding: '40px',
		slidesToShow: 5,
		swipeToSlide: true,
		responsive: [
		{
			breakpoint: 1900,
			settings: {
			centerPadding: '100px',
			slidesToShow: 3
		}
		},
		{
			breakpoint: 1100,
			settings: {
			centerPadding: '50px',
			slidesToShow: 3
		}
		},
		{
			breakpoint: 680,
			settings: {
			arrows: false,
			centerMode: true,
			centerPadding: '30px',
			slidesToShow: 1
		}
		}]
	});
});
</script>

<div id="top_carousel" class="carouselwrap cf">
<ul class="slider slickcar">

<?php while ( $the_query->have_posts() ) {
$the_query->the_post();
?>
<li><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">

<figure class="eyecatch<?php if (!has_post_thumbnail()):?> noimg<?php endif;?>">
<img data-lazy="<?php the_post_thumbnail_url('home-thum'); ?>" class="animated fadeIn">
<?php
	if(get_post_type() == 'post'):
	$cat = get_the_category();
	$cat = $cat[0];
	$catid = $cat->cat_ID;
	$catname = $cat->name;
	echo '<span class="osusume-label cat-name cat-id-' . $catid . '">' . $catname . '</span>';
	else:
	echo '<span class="osusume-label cat-name cat-id-page"></span>';
	endif;
?>
</figure>
<p class="h2 entry-title animated anidelayS fadeInUp"><?php the_title(); ?></p>
</a></li>
<?php } ; ?>
</ul>
</div>
<?php }
wp_reset_postdata();
?>
<?php endif;?>