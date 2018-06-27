<?php if(get_row_layout() == 'ubs_heading') {

  // @ フィールド値
  // ------------------------------
  // ファイールドタイプ : Group
  // 見出し : ubs_heading_edit
  // - 見出しタイプ : ubs_heading_edit_type
  // - 見出し本文  : ubs_heading_edit_content

  //vars
  $settingsId = get_sub_field('ubs_unit_setting_heading_fld_id');
  $settingsClass = get_sub_field('ubs_unit_setting_heading_fld_class');
  $settingsMargin = get_sub_field('ubs_unit_setting_heading_fld_margin');

  //vars
  $ubsHeadingEdit = get_sub_field('ubs_heading_edit');
  $ubsHeadingEditType = $ubsHeadingEdit['ubs_heading_edit_type'];
  $ubsHeadingEditContent = $ubsHeadingEdit['ubs_heading_edit_content'];
  $ubsHeadingEditHtml = '<h' . $ubsHeadingEditType . ' class="ubs-heading0' . $ubsHeadingEditType . '"">' . $ubsHeadingEditContent . '</h' . $ubsHeadingEditType . '>';

  ?>
  <div<?php echo ' id="' . $settingsId . '"'  ?> class="ubs-heading-unit<?php echo ' ' . $settingsMargin . ' ' . $settingsClass ?>">
    <?php echo $ubsHeadingEditHtml ?>
  </div>
<?php } ?>