<?php if(get_row_layout() == 'ubs_list') {

  // @ フィールド値
  // ------------------------------
  // ファイールドタイプ : 通常 + リピート
  // リスト : ubs_list
  // - タイプ : ubs_list_type
  // - - リスト本文 : ubs_list_edit
  // - - - 本文  : ubs_list_edit_item
  
  //vars
  $settingsId = get_sub_field('ubs_unit_setting_list_fld_id');
  $settingsClass = get_sub_field('ubs_unit_setting_list_fld_class');
  $settingsMargin = get_sub_field('ubs_unit_setting_list_fld_margin');

  //vars
  $ubsListType = get_sub_field('ubs_list_type');
  if($ubsListType === 'num'){
    $ubsListUnitHtml = 'ol';
  }else{
    $ubsListUnitHtml = 'ul';
  }

  ?>
  <<?php echo $ubsListUnitHtml . ' id="' . $settingsId . '"'  ?> class="ubs-list-unit list-<?php echo $ubsListType . ' ' . $settingsMargin . ' ' . $settingsClass ?>">
    <?php
    if(have_rows('ubs_list_edit')){
      while (have_rows('ubs_list_edit')){
        the_row(); ?>
        <li><?php echo get_sub_field('ubs_list_edit_item'); ?></li><?php
      }
    }
    ?>
  </<?php echo $ubsListUnitHtml ?>>
<?php } ?>