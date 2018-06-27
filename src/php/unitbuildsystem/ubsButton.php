<?php if(get_row_layout() == 'ubs_btn') {

  // @ フィールド値
  // ------------------------------
  // ファイールドタイプ :
  
  //vars
  $settingsId = get_sub_field('ubs_unit_setting_btn_fld_id');
  $settingsClass = get_sub_field('ubs_unit_setting_btn_fld_class');
  $settingsMargin = get_sub_field('ubs_unit_setting_btn_fld_margin');

  // vars
  $ubsBtnLayout = get_sub_field('ubs_btn_layout');
  $ubsBtnType = get_sub_field('ubs_btn_type');

  // vars 繰り返しフィールド
  $ubsBtnEdit = get_sub_field('ubs_btn_edit');

  ?>
  <div<?php echo ' id="' . $settingsId . '"' ?> class="ubs-btn-container btn-group--<?php echo $ubsBtnLayout . ' ' . $settingsMargin . ' ' . $settingsClass ?>">
      <?php if(have_rows('ubs_btn_edit')){
        while (have_rows('ubs_btn_edit')){
          the_row();
          // vars Groupフィールド
          $ubsBtnItem = get_sub_field('ubs_btn_edit_item');
          $ubsBtnItemStyle = $ubsBtnItem['ubs_btn_edit_item_style'];
          $ubsBtnItemLink = $ubsBtnItem['ubs_btn_edit_item_link'];
          $ubsBtnItemContent = $ubsBtnItem['ubs_btn_edit_item_content']; ?>
          <a href="<?php echo $ubsBtnItemLink ?>" class="btn btn<?php echo $ubsBtnType ?> btn<?php echo $ubsBtnType ?>--<?php echo $ubsBtnItemStyle ?> ubs-btn"><?php echo $ubsBtnItemContent ?></a>
        <?php }
      }?>
  </div>
<?php }