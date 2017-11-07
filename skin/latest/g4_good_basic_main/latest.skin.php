<?php // 굿빌더 ?>
<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
?>
<!-- 최신글용 스타일시트 -->
<link href="<?php echo $latest_skin_url?>/style.css" rel="stylesheet" type="text/css">

<!-- 최신글 시작 -->
<div class="sideTable">
   <div class="sideTitle" style="height:25px;">
      <div style="float:left; vertical-align:middle; padding:5px 3px 5px 3px;">&nbsp;<strong><a href='<?php echo $g5[bbs_url]?>/board.php?bo_table=<?php echo $bo_table?>'><?php echo _t($bo_subject)?></a></strong></div>
      <!--<div style="float:right; vertical-align:middle; padding:3px 5px 3px 3px;"><a href="<?php echo $g5[bbs_url]?>/board.php?bo_table=<?php echo $bo_table?>"><img src="<?php echo $latest_skin_url?>/img/more_good.gif" alt="more" style="border:0; vertical-align:middle;"></a></div>-->
   </div>
<table width=99% border=0 cellspacing=0 cellpadding=0>
   <tr><td colspan=4 height=5px></td></tr>
<?php

for ($i=0; $i<count($list); $i++) {
	echo "
   <tr class=latestHeight valign=top>
   <td width=8></td>
   <td width='' style='font-size:11px;'>";

	echo "
   <img src='{$latest_skin_url}/img/latest_icon.gif' align=absmiddle>&nbsp;";
	echo $list[$i]['icon_reply'] . " ";
	echo "<a href='{$list[$i]['href']}'>";
	if ($list[$i]['is_notice'])
		echo "<span class='latestNotice'>"._t($list[$i]['subject'])."</span>";
	else
		echo _t($list[$i]['subject']);
	echo "</a>";

	if ($list[$i]['comment_cnt'])
	echo " <a href=\"{$list[$i]['comment_href']}\"><span class='latestComment'>{$list[$i]['comment_cnt']}</span></a>";

	echo " " . $list[$i]['icon_new'];
	echo " " . $list[$i]['icon_file'];
	echo " " . $list[$i]['icon_link'];
	echo " " . $list[$i]['icon_hot'];
	echo " " . $list[$i]['icon_secret'];

	echo "
   </td>
   <td width=40 style='font-size:11px;' align=right>";
	echo "
   <span class='latestDatetime'>{$list[$i][datetime2]}</span>&nbsp;"; 
	echo "
   </td>
   <td width=8></td>
   </tr>\n";
}

if (count($list) == 0) {
echo "
   <tr class=latestHeight><td colspan=4 align=center><font color=#6a6a6a>"._t("게시물이 없습니다.")."</font></td></tr>\n";
}

echo "
   <tr><td colspan=4 height=0px></td></tr>
   </table>
";

echo "
</div>
<!-- 최신글 끝 -->
";

?>
