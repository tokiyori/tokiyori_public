<?php
// カスタム投稿タイプの場合変数を定義する
$taxname = esc_html(get_post_type_object(get_post_type())->name);
$taxlabel = esc_html(get_post_type_object(get_post_type())->label);

// 会員情報のグループフィールド値を定義
$regiserMemberGroup = get_field('regiserMemberGroup');
$regiserMemberGroupSex    = $regiserMemberGroup['regiserMemberGroup_sex'];
if($regiserMemberGroupSex === 'mens'){
  $regiserMemberGroupSexStr = "男性";
}elseif($regiserMemberGroupSex === 'ladies'){
  $regiserMemberGroupSexStr = "女性";
}else{
  $regiserMemberGroupSexStr = "その他";
}
$regiserMemberGroupType   = $regiserMemberGroup['regiserMemberGroup_type'];
$regiserMemberGroupTypeStr = strtoupper($regiserMemberGroupType);

get_header();
?>

  <div id="content">
    <div id="inner-content" class="wrap cf">

      <div class="main-wrap">
        <main id="main" class="animated anidelayS fadeIn" role="main">

          <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article">
              <header
                class="article-header entry-header"<?php if (get_option('post_options_postdesign') == "pd_viral") : ?> style="background-image: url(<?php the_post_thumbnail_url('full'); ?>)"<?php endif; ?>>
                <div class="inner">
                  <h1 class="entry-title single-title" itemprop="headline" rel="bookmark"><?php the_title(); ?> <span class="register-member-headline-label register-member-headline-label--<?php echo $regiserMemberGroupSex ?>"><?php echo $regiserMemberGroupTypeStr . $regiserMemberGroupSexStr ?></span></h1>

                  <div class="byline entry-meta vcard cf">

                    <?php $post_options_date = get_option('post_options_date');
                    if ($post_options_date !== "date_off") : ?>
                      <time
                        class="date gf entry-date updated"<?php if (get_the_date('Ymd') >= get_the_modified_date('Ymd')) : ?>  datetime="<?php echo get_the_date('Y-m-d') ?>"<?php endif; ?>><?php echo get_the_date(); ?></time>
                      <?php if (get_the_date('Ymd') < get_the_modified_date('Ymd')) : ?>
                        <time class="date gf entry-date undo updated"
                              datetime="<?php echo get_the_modified_date('Y-m-d') ?>"><?php echo get_the_modified_date() ?></time><?php endif; ?>
                    <?php endif; ?>
                    <?php if (get_option('post_options_authordisplay', 'author_off') == 'author_on'): ?><span
                      class="writer name author"><?php echo get_avatar(get_the_author_meta('ID'), 50); ?><span
                        class="fn"><?php the_author(); ?></span></span><?php endif; ?>
                  </div>

                  <?php
                  if (get_option('post_options_postdesign') !== "pd_viral") :
                    if (has_post_thumbnail() && !get_option('post_options_eyecatch')) :?>
                      <figure class="eyecatch">
                        <?php
                        the_post_thumbnail();
                        if ($pt_caption = get_post(get_post_thumbnail_id())->post_excerpt) {//caption
                          echo '<figcaption class="eyecatch-caption-text">' . $pt_caption . '</figcaption>';
                        }
                        ?>

                        <?php
                        if (get_option('post_options_label', 'catlabeloff') == 'catlabelon' || is_singular('post')) {

                          $cat = get_the_category();
                          $cat = $cat[0];
                          $catid = $cat->cat_ID;
                          $catname = $cat->name;
                          echo '<span class="cat-name cat-id-' . $catid . '">' . $catname . '</span>';
                        }
                        ?>

                      </figure>
                    <?php endif;endif; ?>

                </div>
              </header>

              <?php if (!get_option('sns_options_hide')) : ?>
                <?php
                // @ TOBIRA_SW-94 NO Images画像が表示されるようカスタマイズ
                // ------------------------------
                //get_template_part('parts_sns'); ?>
              <?php endif; ?>

              <?php if (is_active_sidebar('addbanner-sp-titleunder') && is_mobile()) : ?>
                <div class="titleunder">
                  <?php dynamic_sidebar('addbanner-sp-titleunder'); ?>
                </div>
              <?php endif; ?>
              <?php if (is_active_sidebar('addbanner-pc-titleunder') && !is_mobile()) : ?>
                <div class="titleunder">
                  <?php dynamic_sidebar('addbanner-pc-titleunder'); ?>
                </div>
              <?php endif; ?>

              <section class="entry-content cf">


                <?php the_content();
                if(get_the_category()){
                  require_once(get_stylesheet_directory() . '/unitbuildsystem/setUnitBuildSystem.php');
                }elseif($taxname === 'members_list'){
                  require_once(get_stylesheet_directory() . '/registerMember/registerMember.php');
                }else{
                  require_once(get_stylesheet_directory() . '/unitbuildsystem/setUnitBuildSystem.php');
                }

                wp_link_pages( array(
                  'before'      => '<div class="page-links cf">',
                  'after'       => '</div>',
                  'link_before' => '<span>',
                  'link_after'  => '</span>',
                  'next_or_number'   => 'next',
                  'nextpagelink'     => __('次のページへ ≫'),
                  'previouspagelink' => __('≪ 前のページへ'),
                ) );
                ?>

                <?php if (is_active_sidebar('addbanner-pc-contentfoot') && !is_mobile()) : ?>
                  <?php dynamic_sidebar('addbanner-pc-contentfoot'); ?>
                <?php endif; ?>
                <?php if (is_active_sidebar('addbanner-sp-contentfoot') && is_mobile()) : ?>
                  <?php dynamic_sidebar('addbanner-sp-contentfoot'); ?>
                <?php endif; ?>
              </section>

              <?php if (is_singular('post')): ?>
                <footer class="article-footer">
                  <div class="footer-cat-tag">
                    <?php echo get_the_category_list(); ?>
                    <?php the_tags('<p class="tags">', '', '</p>'); ?>
                  </div>
                  <?php get_template_part('parts_singlefoot'); ?>
                </footer>
              <?php endif; ?>

            </article>

          <?php endwhile; ?>
          <?php endif; ?>
        </main>
      </div>

      <?php if (get_option('post_options_postdesign') !== "pd_viral" && get_option('post_options_postdesign') !== "pd_onecolumn") : ?>
        <div class="side-wrap">
          <?php get_sidebar(); ?>
        </div>
      <?php endif; ?>

    </div>
  </div>
<?php get_footer(); ?>