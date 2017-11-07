<?php // 굿빌더 ?>
<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 

include_once(G5_LIB_PATH.'/thumbnail.lib.php');

/// $gr = get_group($gr_id);
if($cols == "") $cols=2; //  이미지 가로갯수

if(gettype($options) == 'string') $options = explode('|', $options);
$img_width  = $options[0];
$img_height = $options[1];
///if(!$img_width) $img_width = 100; //이미지 가로 크기
///if(!$img_height) $img_height = 80; //이미지 세로 크기
if(!$img_width) $img_width = 65; //이미지 가로 크기
if(!$img_height) $img_height = 45; //이미지 세로 크기

$subject_len = 24;
?>
<link href="<?php echo $latest_skin_url?>/style.css" rel="stylesheet" type="text/css">

<table width="100%" height="28" cellpadding="0" cellspacing="0" bgcolor=#eeeeee><tr><td>
    &nbsp;&nbsp;<strong><a href='<?php echo $g5[bbs_url]?>/good_group.php?gr_id=<?php echo $gr_id?>'><?php echo _t($gr_subject)?> <?php echo _t('그룹'); ?></a></strong>
</td></tr></table>

<div style="padding:5px"></div>

<table width=95% cellpadding=0 cellspacing=0>
   <?php for ($i=0; $i<count($list); $i++) { 

	if($i % $cols == 0 || $i==0){echo "<tr>";} //테이블 열바꿈 관련?> 
	<td>
        <?php
	echo "<div class=\"latestThumbIMG3\">";
        echo "<a href='{$list[$i][href]}'>";
             $image = urlencode($list[$i][file][0][file]); // 첫번째 파일이 이미지라면
             if (preg_match("/\.(gif|jpg|png)$/i", $image)) {
        echo "<img src='$g5[url]/data/file/{$list[$i][bo_table]}/$image' width='$img_width' height='$img_height' border=0 style='margin:3px'>"; // 이미지크기 
             } else
        echo "<img src='$latest_skin_url/img/no_image.gif' width='$img_width' height='$img_height' border=0 style='margin:3px'>"; 
	echo "</a>";
	echo "</div>";

	echo "<div style='padding:5px'>";
        echo "[<a href='{$list[$i][href]}'>"._t($list[$i][wr_subject])."</a>]";
	echo "<br/>";
	echo "<div style='margin:0;padding:5px 0 0 0'></div>";
        echo "<a href='{$list[$i][href]}'>".cut_str(strip_tags(_t($list[$i][wr_content])), $subject_len, ' ...')."</a>";
	echo "</div>";
        ?>
        </td>
<?php
        if($i%$cols == ($cols-1)&& $i>0){ echo "</tr>";} //테이블 열바꿈 관련
} ?>

</table>
