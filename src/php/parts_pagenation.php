<?php
// @ ページネイションを独自に追加
// @ tmp-aのコードを流用
// ------------------------------
?>
  <div class="np-post">
    <div class="navigation">
      <?php if (get_previous_post()): ?>
        <div class="prev"><?php previous_post_link('%link', '%title'); ?></div>
      <?php endif; ?>
      <?php if (get_next_post()): ?>
        <div class="next"><?php next_post_link('%link', '%title'); ?></div>
      <?php endif; ?>
    </div>
  </div>
<?php
// ------------------------------
?>