<?php // 굿빌더 ?>
<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

include_once(G5_LIB_PATH.'/thumbnail.lib.php');

global $is_admin; /// 2012.09.08

$thumb_path=$g5[path]."/data/file/".$bo_table."/thumb";

if(gettype($options) == 'string') $options = explode('|', $options);
$img_width  = $options[0];
$img_height = $options[1];
if(!$img_width) $img_width   = 200; //이미지 가로 크기
if(!$img_height) $img_height = 18; //이미지 세로 크기
?>
<!-- 최신글용 스타일시트 -->
<link href="<?php echo $latest_skin_path?>/style.css" rel="stylesheet" type="text/css">

<!-- 최신글 시작 -->
<div class="latestQmenuAd">
<div class="sideTable">
   <div class="sideTitle" style="height:40px;">
      <div style="vertical-align:middle; padding:15px 20px 5px 20px;"><strong><?php if($is_admin == "super") { ?><a href='<?php echo $g5[bbs_path]?>/board.php?bo_table=<?php echo $bo_table?>'><?php } ?><font class=large><?php echo _t($bo_subject)?></font><?php if($is_admin == "super") { ?></a><?php } ?></strong></div>
   </div>
   <div class="clear"></div>
   <ul>
<?php
for ($i=0; $i<count($list); $i++) {
        if(0) { ///
	$org_img = "$g5[path]/data/file/$bo_table/".urlencode($list[$i][file][0][file]); 
	$img[$i] = "$g5[path]/data/file/$bo_table/thumb/".$list[$i][wr_id];
	$href = $list[$i][wr_content]; 

	if(!file_exists( $img[$i]) )
    	$img[$i]=$org_img;

	if (!file_exists( $img[$i]) || !$list[$i][file][0][file])
        $img[$i] = "$latest_skin_path/img/no_image.gif";
        } ///

        ///$href = $list[$i]['href']; 
	$href = $list[$i][wr_content]; 
        $img = get_list_thumbnail($bo_table, $list[$i]['wr_id'], $img_width, $img_height);
        $no_img = "$latest_skin_url/img/no_image.gif";

        if($img['src']) {
            $img_src = $img['src'];
        } else {
            $img_src = $no_img;
        }
?>
	<?php if(file_exists( $img_src)) { ?>
	<li><div class="latestIMG"><a href="<?php echo $href?>"><img src="<?php echo $img_src?>" alt="<?php echo _t($list[$i][wr_subject])?>" onmouseout="this.style.borderColor='#ffffff'" onmouseover="this.style.borderColor='#aa0000'"></a></div></li>
	<div class="clear"></div>
	<?php } else { ?>
        <li><a href="<?php echo $href?>"><img src="<?php echo $g5[path]?>/img/icon_04_info.gif" style="border:0; vertical-align:middle;"> <b><?php echo _t($list[$i][wr_subject])?></b></a></li>
        <?php } ?>
        <?php if($i < count($list) -1) { ?>
        <center><hr size=1 width="97%" color="#eeeeee" style="padding:0; margin-top:2px; margin-bottom:2px"></center>
	<?php } ?>
<?php } ?>
<?php if (count($list) == 0) { ?>
      <li><div align=center><font color=#6a6a6a><?php echo _t('게시물이 없습니다.'); ?></font></div></li>
<?php } ?>
   </ul>
</div>
</div>
<!-- 최신글 끝 -->
