<?php if(get_row_layout() == 'ubs_img') {

  // @ フィールド値
  // ------------------------------
  //vars
  $settingsId = get_sub_field('ubs_unit_setting_img_fld_id');
  $settingsClass = get_sub_field('ubs_unit_setting_img_fld_class');
  $settingsMargin = get_sub_field('ubs_unit_setting_img_fld_margin');

  //レイアウト
  $ubsImgLayout  = get_sub_field('ubs_img_layout');

  //ラッパー要素
  $ubsImgWrapperStart = '<div id="' . $settingsId . '" class="ubs-img-unit ' . $ubsImgLayout . ' ' . $settingsClass . ' ' . $settingsMargin . '">';
  $ubsImgWrapperEnd   = '</div>';

  //繰り返しフィールド
  $ubsImgEdit = get_sub_field('ubs_img_edit');

  ?>
  <?php
  // @ コンテンツスタート
  // ------------------------------
  echo $ubsImgWrapperStart;
  if(have_rows('ubs_img_edit')){ ?>
    <?php while (have_rows('ubs_img_edit')){the_row();

      // vars Groupフィールド
      $ubsImgItem = get_sub_field('ubs_img_edit_item');
      $ubsImgItemImg = $ubsImgItem['ubs_img_edit_item_img'];

      // vars 詳細設定
      $ubsImgSetSize = $ubsImgItem["ubs_img_settings_img_fld_img_size"];
      $ubsImgSetType = $ubsImgItem["ubs_img_settings_img_fld_img_style"];
      $ubsImgSetRsp = $ubsImgItem["ubs_img_settings_img_fld_img_responsive"];
      $ubsImgSetLink = $ubsImgItem["ubs_img_settings_img_fld_img_link"];
      $ubsImgSetTarget = $ubsImgItem["ubs_img_settings_img_fld_img_target"];
      $ubsImgSetCaption = $ubsImgItem["ubs_img_settings_img_fld_img_caption"];


      ?>
      <figure class="ubs-img-item<?php echo ' img-size--' . $ubsImgSetSize . '--' .$ubsImgSetRsp?>">
        <?php if($ubsImgSetLink){ ?><a href="<?php echo $ubsImgSetLink ?>" <?php if($ubsImgSetTarget === true){?>target="_blank"<?php } ?>><?php } ?>
        <img class="ubs-img img-responsive<?php echo ' img--' . $ubsImgSetType?>" src="<?php echo $ubsImgItemImg['url'] ?>" alt="<?php echo $ubsImgItemImg['alt'] ?>" title="<?php echo $ubsImgItemImg['title'] ?>">
        <?php if($ubsImgSetLink){ ?> </a> <?php } ?>
        <?php if($ubsImgSetCaption){?><figcaption class="ubs-figcaption"><?php echo $ubsImgItemImg['caption'] ?></figcaption><?php } ?>
      </figure>
    <?php } ?>
  <?php }
  echo $ubsImgWrapperEnd; ?>
<?php }