<?php // 굿빌더 ?>
<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="sideTable">
<tr> 
<td width="100%" height="25" colspan="2" class="sideTitle">&nbsp;<a href="<?php echo $menu_list[$main_index][1]?>" onClick="<?php echo $target_link?>"><b><?php echo _t($menu_list[$main_index][0])?></b></a></td>
</tr>

<tr> 
<td width="10%"></td>
<td width="90%" style="padding:3px 0 3px 0;">
   <table width="100%">
<?php
for($i=0; $i<count($menu[$main_index]); $i++) {
	if($i==$side_index) {
		$side_class="sublocalActive";
	}
	else {
		$side_class="sublocalNormal";
	}

	if($menu[$main_index][$i][2]) {
		$target_link="window.open(this.href, '{$menu[$main_index][$i][2]}'); return false;";
	}
?>
       <tr><td width="100%" class="<?php echo $side_class?>"><a href="<?php echo $menu[$main_index][$i][1]?>" class="<?php echo $side_class?>" onClick="<?php echo $target_link?>"><?php echo _t($menu[$main_index][$i][0])?></a></td></tr>
<?php } ?>
   </table>
</td>
</tr>
</table>
