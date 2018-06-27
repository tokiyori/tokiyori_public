<?php if(get_row_layout() == 'ubs_text') {

  //vars
  $settingsId = get_sub_field('ubs_unit_setting_text_fld_id');
  $settingsClass = get_sub_field('ubs_unit_setting_text_fld_class');
  $settingsMargin = get_sub_field('ubs_unit_setting_text_fld_margin');

?>
  <div<?php echo ' id="' . $settingsId . '"'  ?> class="ubs-text-unit<?php echo ' ' . $settingsMargin . ' ' . $settingsClass ?>">
    <?php $content = the_sub_field('ubs_text_edit'); echo $content ?>
  </div>
<?php } ?>