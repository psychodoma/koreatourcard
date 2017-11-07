<?php // 굿빌더 ?>
<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 

global $is_admin;
?>

<!-- 방문 통계 시작 -->
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="sideTable">
<tr> 
    <td width="100%" height="25" colspan="2" class="sideTitle">&nbsp;<b><?php echo _t('방문 현황'); ?></b></td>
</tr>
<tr><td height="5" colspan="2"></td></tr>
<tr> 
    <td width="10%"></td>
    <td width="90%">
       <table border="0" cellspacing="0" cellpadding="0">
          <tr><td width="30"><?php echo _t('오늘'); ?></td><td align="right"><?php echo number_format($visit[1])?></td><td>&nbsp;<?php if ($is_admin == "super") { ?><a href="<?php echo $g5['admin_url']?>/visit_list.php"><img src="<?php echo $visit_skin_url?>/img/admin.gif" width="33" height="15" border="0" align="absmiddle"></a><?php }?></td></tr>
          <tr><td width="30"><?php echo _t('어제'); ?></td><td align="right"><?php echo number_format($visit[2])?></td><td></td></tr>
          <tr><td width="30"><?php echo _t('최대'); ?></td><td align="right"><?php echo number_format($visit[3])?></td><td></td></tr>
          <tr><td width="30"><?php echo _t('전체'); ?></td><td align="right"><?php echo number_format($visit[4])?></td><td></td></tr>
       </table>
    </td>
</tr>
<tr><td height="5" colspan="2"></td></tr>
</table>
<!-- 방문 통계 끝 -->
