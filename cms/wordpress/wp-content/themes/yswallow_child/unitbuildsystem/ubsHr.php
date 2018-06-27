<?php if(get_row_layout() == 'ubs_hr') {

  // @ フィールド値
  // ------------------------------
  // ファイールドタイプ :
  
  //vars
  $settingsId = get_sub_field('ubs_unit_setting_hr_fld_id');
  $settingsClass = get_sub_field('ubs_unit_setting_hr_fld_class');
  $settingsMargin = get_sub_field('ubs_unit_setting_hr_fld_margin');

  //vars
  $ubsHrType = get_sub_field('ubs_hr_type');
?>

<div<?php echo ' id="' . $settingsId . '"' ?> class="ubs-hr-unit<?php echo ' ' . $settingsClass . ' ' . $settingsMargin ?>">
  <hr class="ubs-hr hr <?php echo $ubsHrType ?>">
</div>

<?php } ?>