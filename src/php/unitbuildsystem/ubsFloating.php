<?php if(get_row_layout() == 'ubs_floating') {

  // @ フィールド値
  // ------------------------------
  // ファイールドタイプ :

  //vars
  $settingsId = get_sub_field('ubs_unit_setting_floating_fld_id');
  $settingsClass = get_sub_field('ubs_unit_setting_floating_fld_class');
  $settingsMargin = get_sub_field('ubs_unit_setting_floating_fld_margin');

  //vars
  $ubsFloatingType = get_sub_field('ubs_floating_type');

  //vars group
  $ubsFloatingEdit = get_sub_field('ubs_floating_edit');
  $ubsFloatingImg = $ubsFloatingEdit['ubs_floating_edit_img'];
  $ubsFloatingContent = $ubsFloatingEdit['ubs_floating_edit_text'];

  // vars 詳細設定
  $ubsImgSetSize = $ubsFloatingEdit["ubs_img_settings_floating_fld_img_size"];
  $ubsImgSetType = $ubsFloatingEdit["ubs_img_settings_floating_fld_img_style"];
  $ubsImgSetRsp = $ubsFloatingEdit["ubs_img_settings_floating_fld_img_responsive"];
  $ubsImgSetLink = $ubsFloatingEdit["ubs_img_settings_floating_fld_img_link"];
  $ubsImgSetTarget = $ubsFloatingEdit["ubs_img_settings_floating_fld_img_target"];
  $ubsImgSetCaption = $ubsFloatingEdit["ubs_img_settings_floating_fld_img_caption"];

// @ コンテンツスタート
// ------------------------------
?>
<div<?php echo ' id="' . $settingsId . '"' ?> class="ubs-floating-unit<?php echo ' ' . $settingsClass . ' ' . $settingsMargin ?>">
   <div class="column__img column__img--<?php echo $ubsFloatingType?> <?php echo ' img-size--' . $ubsImgSetSize  . '--' . $ubsImgSetRsp ?>">
     <figure class="column__img__item ubs-img-item">
      <?php if($ubsImgSetLink){ ?><a href="<?php echo $ubsImgSetLink ?>" <?php if($ubsImgSetTarget === true){?>target="_blank"<?php } ?>><?php } ?>
      <img class="ubs-img img-responsive<?php echo ' img--' . $ubsImgSetType?>" src="<?php echo $ubsFloatingImg['url'] ?>" alt="<?php echo $ubsFloatingImg['alt'] ?>" title="<?php echo $ubsFloatingImg['title'] ?>">
       <?php if($ubsImgSetCaption){?><figcaption class="ubs-figcaption"><?php echo $ubsFloatingImg['caption'] ?></figcaption><?php } ?>
       <?php if($ubsImgSetLink){ ?> </a> <?php } ?>
     </figure>
   </div>
  <?php echo $ubsFloatingContent ?>
</div>
<?php } ?>