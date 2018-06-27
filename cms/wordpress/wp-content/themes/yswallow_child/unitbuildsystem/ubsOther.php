<?php if (get_row_layout() == 'ubs_other') {

  if (have_rows('ubs_other_menu')) {
    while (have_rows('ubs_other_menu')) {
      the_row();
      // ------------------------------------------------------------
      // @ よくある質問
      // ------------------------------------------------------------
      if (get_row_layout() == 'ubs_other_menu_faq') {

        // グループ取得
          $ubsOtherMenuFaq = get_sub_field('ubs_other_menu_faq_item');
        // グループ内の各フィールド情報
        $ubsOtherMenuFaqCat = $ubsOtherMenuFaq["ubs_other_menu_faq_item_category"];
        $ubsOtherMenuFaqCatName = "";
        $ubsOtherMenuFaqQ = $ubsOtherMenuFaq["ubs_other_menu_faq_item_question"];
        $ubsOtherMenuFaqA = $ubsOtherMenuFaq["ubs_other_menu_faq_item_answer"];
        // カテゴリーの名称
        if($ubsOtherMenuFaqCat === 'mens'){
          $ubsOtherMenuFaqCatName = "男性";
        }elseif($ubsOtherMenuFaqCat === 'ladies'){
          $ubsOtherMenuFaqCatName = "女性";
        }else{
          $ubsOtherMenuFaqCatName = "共通";
        }

        //詳細設定
        $settingOtherFaqId = $ubsOtherMenuFaq['ubs_unit_setting_other_faq_fld_id'];
        $settingOtherFaqClass = $ubsOtherMenuFaq['ubs_unit_setting_other_faq_fld_class'];
        $settingOtherFaqMargin = $ubsOtherMenuFaq['ubs_unit_setting_other_faq_fld_margin'];

        // @ HTML
        // ------------------------------
        ?>
        <article<?php echo ' id="' . $settingOtherFaqId . '"' ?> class="faq-item is-<?php echo $ubsOtherMenuFaqCat . ' ' . $settingOtherFaqMargin . ' ' . $settingOtherFaqClass?>">
          <header class="faq-item-header">
            <div class="faq-item-header__th"><span class="faq-item-header__th__icon">Q</span></div>
            <div class="faq-item-header__td">
              <span class="faq-item-header__td__label"><?php echo $ubsOtherMenuFaqCatName ?></span>
              <p class="faq-item-header__td__title"><?php echo $ubsOtherMenuFaqQ ?></p>
            </div>
          </header>
          <div class="faq-item-body">
            <div class="faq-item-body__th"><span class="faq-item-body__th__icon">A</span></div>
            <div class="faq-item-body__td text-unit"><?php echo $ubsOtherMenuFaqA ?></div>
          </div>
        </article>
        <?php

      }
    }
  }

}
