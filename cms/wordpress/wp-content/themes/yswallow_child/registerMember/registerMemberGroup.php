<?php
if(get_field('regiserMemberGroup')){

  // @ フィールド値
  // ------------------------------
  // ファイールドタイプ :

  $regiserMemberGroup = get_field('regiserMemberGroup');
  $regiserMemberGroupName   = $regiserMemberGroup['regiserMemberGroup_name'];
  $regiserMemberGroupSex    = $regiserMemberGroup['regiserMemberGroup_sex'];
  $regiserMemberGroupType   = $regiserMemberGroup['regiserMemberGroup_type'];
  $regiserMemberGroupAge    = $regiserMemberGroup['regiserMemberGroup_age'];
  $regiserMemberGroupHope   = $regiserMemberGroup['regiserMemberGroup_hope'];
  $regiserMemberGroupHeight = $regiserMemberGroup['regiserMemberGroup_height'];
  $regiserMemberGroupWeight = $regiserMemberGroup['regiserMemberGroup_weight'];
  $regiserMemberGroupZip01  = $regiserMemberGroup['regiserMemberGroup_zip01'];
  $regiserMemberGroupZip02  = $regiserMemberGroup['regiserMemberGroup_zip02'];
  $regiserMemberGroupImg  = $regiserMemberGroup['regiserMemberGroup_img'];
  $regiserMemberGroupProfile  = $regiserMemberGroup['regiserMemberGroup_profile'];
  $regiserMemberGroupDefault = $regiserMemberGroupType . '_' . $regiserMemberGroupSex . '.png';

  ?>

  <div class="memberlist-container">
    <div class="memberlist-head-group">
      <div class="memberlist-head-item memberlist-head-img">
        <figure class="memberlist-head-img__item">
          <img class="img-responsive" src="<?php if($regiserMemberGroupImg){ echo $regiserMemberGroupImg['url']; } else { echo get_stylesheet_directory_uri() . '/assets/img/common/' . $regiserMemberGroupDefault;}?>" alt="">
        </figure>
      </div>
      <div class="memberlist-head-item memberlist-head-content">
        <table class="memberlist-head-content-table memberlist-head-content-table--<?php echo $regiserMemberGroupSex ?>">
          <tbody>
            <tr>
              <th>年代</th>
              <td><?php echo $regiserMemberGroupAge ?>代</td>
            </tr>
            <tr>
              <th>身長</th>
              <td><?php echo $regiserMemberGroupHeight ?>cm</td>
            </tr>
            <tr>
              <th>体型</th>
              <td><?php echo $regiserMemberGroupWeight ?></td>
            </tr>
            <tr>
              <th>都道府県</th>
              <td><?php echo $regiserMemberGroupZip01 ?></td>
            </tr>
            <tr>
              <th>地方</th>
              <td><?php echo $regiserMemberGroupZip02 ?></td>
            </tr>
            <tr>
              <th>希望年齢</th>
              <td><?php echo $regiserMemberGroupHope ?></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="memberlist-body-group">
      <div class="text-unit">
        <?php echo $regiserMemberGroupProfile ?>
      </div>
    </div>
  </div>

  <?php
} ?>
