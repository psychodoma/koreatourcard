<?php // 굿빌더 ?>
<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

include_once(G5_LIB_PATH.'/thumbnail.lib.php');

if(gettype($options) == 'string') $options = explode('|', $options);
$img_width  = $options[0];
$img_height = $options[1];
if(!$img_width) $img_width   = 130; //이미지 가로 크기
if(!$img_height) $img_height = 90; //이미지 세로 크기

$thumb_path=$g5[path]."/data/file/".$bo_table."/thumb";
?>
<!-- 최신글용 스타일시트 -->
<link href="<?php echo $latest_skin_url?>/style.css" rel="stylesheet" type="text/css">

<!-- 최신글 시작 -->
<div class="latestThumb">
<div class="sideTable">
   <div class="sideTitle" style="height:25px;">
      <div style="float:left; vertical-align:middle; padding:5px 3px 5px 3px;">&nbsp;<strong><a href='<?php echo $g5[bbs_url]?>/board.php?bo_table=<?php echo $bo_table?>'><?php echo _t($bo_subject)?></a></strong></div>
      <div style="float:right; vertical-align:middle; padding:3px 5px 3px 3px;"><a href="<?php echo $g5[bbs_url]?>/board.php?bo_table=<?php echo $bo_table?>"><img src="<?php echo $latest_skin_url?>/img/more_good.gif" alt="more" style="border:0; vertical-align:middle;"></a></div>
   </div>
   <div class="clear"></div>
   <ul>
<?php
for ($i=0; $i<count($list); $i++) {
	$org_img = "$g5[path]/data/file/$bo_table/".urlencode($list[$i][file][0][file]);
	$org_img_url = "$g5[url]/data/file/$bo_table/".urlencode($list[$i][file][0][file]);
	$img[$i] = "$g5[path]/data/file/$bo_table/thumb/".$list[$i][wr_id];
	$img_url[$i] = "$g5[url]/data/file/$bo_table/thumb/".$list[$i][wr_id];
	$href = "$g5[bbs_url]/board.php?bo_table=$bo_table&wr_id={$list[$i][wr_id]}";

	if(!file_exists( $img[$i]) )
    	$img[$i]=$org_img;

    	if (!file_exists( $img[$i]) || !$list[$i][file][0][file])
        	$img_url[$i] = "$latest_skin_url/img/no_image.gif";

        $href = $list[$i]['href']; 
        $img = get_list_thumbnail($bo_table, $list[$i]['wr_id'], $img_width, $img_height);
        $no_img = "$latest_skin_url/img/no_image.gif";

        if($img['src']) {
            $img_src = $img['src'];
        } else {
            $img_src = $no_img;
        }
?>
      <li>
      <div class="latestIMG">
      <?php if(0) { ?>
      <a href="<?php echo $href?>"><img src="<?php echo $img_url[$i]?>" alt="<?php echo $list[$i]['subject']?>" onmouseout="this.style.borderColor='#dddddd'" onmouseover="this.style.borderColor='#aa0000'"></a>
      <?php } ?>
      <a href="<?php echo $href?>"><img src="<?php echo $img_src?>" alt="<?php echo _t($list[$i]['subject'])?>" onmouseout="this.style.borderColor='#dddddd'" onmouseover="this.style.borderColor='#aa0000'"></a>
      </div>
      <?php if(0) { ?><a href="<?php echo $href?>"><?php echo  cut_str(stripslashes($list[$i][wr_content]), $subject_len, ' ...'); ?></a><?php } ?>
      <a href="<?php echo $href?>"><?php echo  cut_str(strip_tags(_t($list[$i][wr_content])), $subject_len, ' ...'); ?></a>
	<?php
	if ($list[$i]['comment_cnt'])
		echo " <a href=\"{$list[$i]['comment_href']}\"><span class='latestComment'>{$list[$i]['comment_cnt']}</span></a>";
	echo " " . $list[$i]['icon_new'];
	echo " " . $list[$i]['icon_file'];
	echo " " . $list[$i]['icon_link'];
	echo " " . $list[$i]['icon_hot'];
	echo " " . $list[$i]['icon_secret'];
	?>
      <br class="clear">
      </li>
<?php } ?>
<?php if (count($list) == 0) { ?>
      <li><div align=center><font color=#6a6a6a><?php echo _t('게시물이 없습니다.'); ?></font></div></li>
<?php } ?>
   </ul>
</div>
</div>
<!-- 최신글 끝 -->
