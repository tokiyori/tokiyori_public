<?php if(get_row_layout() == 'ubs_code') {

  // @ フィールド値
  // ------------------------------
  // ファイールドタイプ :
  
  //vars
  $settingsId = get_sub_field('ubs_unit_setting_code_fld_id');
  $settingsClass = get_sub_field('ubs_unit_setting_code_fld_class');
  $settingsMargin = get_sub_field('ubs_unit_setting_code_fld_margin');

  //vars
  $ubsCodeEdit = get_sub_field('ubs_code_edit');

  // @ HTML
  // ------------------------------
  ?>
  <div<?php echo ' id="' . $settingsId . '"' ?> class="ubs-code-unit <?php echo  $settingsMargin . ' ' . $settingsClass?>">
    <?php echo $ubsCodeEdit ?>
  </div>
  <?php
}