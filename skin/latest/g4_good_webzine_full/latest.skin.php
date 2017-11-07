<?php // 굿빌더 ?>
<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

global $is_admin, $config2w; /// config2w 2012.09.08

if($config2w['cf_head_long'] == "checked" or $config2w['cf_tail_long'] == "checked") { /// 임시 변수
   $image_width = $config2w[cf_width_main_total];
   /// $image_height = intval($image_width / 3);
   $image_height = "";
   $image_div_width = $image_width + 0;
} else {
   $image_width = $config2w[cf_width_main_total] / 2 - 1;
   /// $image_height = intval($image_width / 3);
   $image_height = "";
   $image_div_width = $image_width + 0;
}
?>
<!-- 최신글용 스타일시트 -->
<link href="<?php echo $latest_skin_url?>/style.css" rel="stylesheet" type="text/css">

<!-- 최신글 시작 -->
<div class="latestThumbF">
<div class="sideTable">
    <table width=100% border=0 cellspacing=0 cellpadding=0 style="margin:0px">
        <tr><td>
<?php
for ($i=0; $i<count($list); $i++) {
    /// $org_img = "$g5[path]/data/file/$bo_table/".urlencode($list[$i][file][0][file]);
    $org_img = "$g5[path]/data/file/$bo_table/".$list[$i][file][0][file];
    $org_img_url = "$g5[url]/data/file/$bo_table/".$list[$i][file][0][file];
    /// $img[$i] = "$g5[path]/data/file/$bo_table/thumb/".$list[$i][wr_id];
    /// $img[$i] = $org_img;
    $img[$i] = "$g5[path]/data/file/$bo_table/".$list[$i][file][0][file];
    $img_url[$i] = "$g5[url]/data/file/$bo_table/".$list[$i][file][0][file];
    $href = "$g5[bbs_url]/board.php?bo_table=$bo_table&wr_id={$list[$i][wr_id]}";

    if(!file_exists( $img[$i]) )
        $img[$i]=$org_img;

    if (!file_exists( $img[$i]) || !$list[$i][file][0][file])
    $img_url[$i] = "$latest_skin_url/img/no_image.gif";
?>
	<center><div class="latestIMG">
		<div style="width:<?php echo $image_div_width?>; overflow:hidden"><!-- New -->
		<?php if($is_admin == "super") { ?><a href="<?php echo $href?>"><?php } ?>
		<?php if(preg_match("/\.(swf|wmv|asf|flv)$/i", $img_url[$i])) { ?>
		<script>doc_write(flash_movie('<?php echo $img_url[$i]?>', 'flash<?php echo $i?>', '<?php echo $image_width?>', '<?php echo $image_height?>', 'transparent'));</script>
		<?php } else { ?>
		<img src="<?php echo $img_url[$i]?>" width="<?php echo $image_width?>" border="0" style="vertical-align:middle">
		<?php } ?>
		<?php if($is_admin == "super") { ?></a><?php } ?>
		</div>
        </div></center>
<?php } ?>
<?php if (count($list) == 0) { ?>
        <div align=center><font color=#6a6a6a><?php echo _t('게시물이 없습니다.'); ?></font></div>
<?php } ?>
        </td></tr>
    </table>
</div>
</div>
<!-- 최신글 끝 -->
