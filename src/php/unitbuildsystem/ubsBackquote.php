<?php if(get_row_layout() == 'ubs_backquote') {

  // @ フィールド値
  // ------------------------------
  // ファイールドタイプ :
  
  //vars
  $settingsId = get_sub_field('ubs_unit_setting_backquote_fld_id');
  $settingsClass = get_sub_field('ubs_unit_setting_backquote_fld_class');
  $settingsMargin = get_sub_field('ubs_unit_setting_backquote_fld_margin');

  //vars
  $ubsBackquoteContent = get_sub_field('ubs_backquote_content');
  $ubsBackquoteName = get_sub_field('ubs_backquote_cite_name');
  $ubsBackquoteLink = get_sub_field('ubs_backquote_cite_url');

  if($ubsBackquoteLink){
    $ubsCiteHtml = '<a' . ' href="' . $ubsBackquoteLink . '">' . $ubsBackquoteName . '</a>';
  }else{
    $ubsCiteHtml = $ubsBackquoteName;
  }
  ?>
  <blockquote<?php echo ' id="' . $settingsId . '"' ?> class="ubs-blockquote blockquote<?php echo ' ' . $settingsMargin . ' ' . $settingsClass ?>" <?php echo 'title="' . $ubsBackquoteName . '"' ?>>
    <div class="text-unit">
      <?php echo $ubsBackquoteContent ?>
    </div>
    <cite class="ubsd-cite"><?php echo $ubsCiteHtml ?></cite>
  </blockquote>
<?php
  
}