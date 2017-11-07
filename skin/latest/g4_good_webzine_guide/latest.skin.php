<?php // 굿빌더 ?>
<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

include_once(G5_LIB_PATH.'/thumbnail.lib.php');

$thumb_path=$g5[path]."/data/file/".$bo_table."/thumb";

if(gettype($options) == 'string') $options = explode('|', $options);
$img_width  = $options[0];
$img_height = $options[1];
if(!$img_width) $img_width   = 210; //이미지 가로 크기
if(!$img_height) $img_height = 160; //이미지 세로 크기
?>
<!-- 최신글용 스타일시트 -->
<link href="<?php echo $latest_skin_url?>/style.css" rel="stylesheet" type="text/css">

<!-- 최신글 시작 -->
<div class="latestGuideAd">
<div class="sideTable">
   <div class="sideTitle" style="height:25px;">
      <div style="float:left; vertical-align:middle; padding:5px 3px 5px 3px;">&nbsp;<strong><a href='<?php echo $g5[bbs_url]?>/board.php?bo_table=<?php echo $bo_table?>'><?php echo _t($bo_subject)?></a></strong></div>
      <?php if(0) { ?>
      <div style="float:right; vertical-align:middle; padding:3px 5px 3px 3px;"><a href="<?php echo $g5[bbs_url]?>/board.php?bo_table=<?php echo $bo_table?>"><img src="<?php echo $latest_skin_url?>/img/more_good.gif" alt="more" style="border:0; vertical-align:middle;"></a></div>
      <?php } ?>
   </div>
   <div class="clear"></div>
   <ul>
<?php
for ($i=0; $i<count($list); $i++) {
        if(0) { ///
	$org_img = "$g5[path]/data/file/$bo_table/".urlencode($list[$i][file][0][file]); 
	$org_img_url = "$g5[url]/data/file/$bo_table/".urlencode($list[$i][file][0][file]); 
	$img[$i] = "$g5[path]/data/file/$bo_table/thumb/".$list[$i][wr_id];
	$img_url[$i] = "$g5[url]/data/file/$bo_table/thumb/".$list[$i][wr_id];
	/// $href = $list[$i][wr_content]; 
	$href = $list[$i]['href'];

	if(!file_exists( $img[$i]) ) {
    	    $img[$i]=$org_img;
    	    $img_url[$i]=$org_img_url;
        }

	if (!file_exists( $img[$i]) || !$list[$i][file][0][file])
        $img_url[$i] = "$latest_skin_url/img/no_image.gif";
        } ///

        $href = $list[$i]['href']; 
        $img = get_list_thumbnail($bo_table, $list[$i]['wr_id'], $img_width, $img_height);
        $no_img = "$latest_skin_url/img/no_image.gif";

        if($img['src']) {
            $img_src = $img['src'];
        } else {
            $img_src = $no_img;
        }
?>
      <?php if(0) { ?>
      <li><center><div class="latestIMG" style='border:0px solid #ffffff' onmouseover="this.style.borderColor='#aa0000'" onmouseout="this.style.borderColor='#ffffff'"><a href="<?php echo $href?>"><img src="<?php echo $img_url[$i]?>" border="0"></a></div></center></li>
      <?php } ?>
      <li><center><div class="latestIMG" style='border:0px solid #ffffff' onmouseover="this.style.borderColor='#aa0000'" onmouseout="this.style.borderColor='#ffffff'"><a href="<?php echo $href?>"><img src="<?php echo $img_src?>" border="0"></a></div></center></li>

      <div class="clear"></div>
      <?php if(0 and $i < count($list) -1) { ?>
      <div style="height:3px"></div>
      <?php } ?>
<?php } ?>
<?php if (0 and count($list) == 0) { ?>
      <li><div align=center><font color=#6a6a6a><?php echo _t('게시물이 없습니다.'); ?></font></div></li>
<?php } ?>
   </ul>
</div>
</div>
<!-- 최신글 끝 -->
