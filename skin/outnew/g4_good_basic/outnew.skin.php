<?php // 굿빌더 ?>
<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
?>

<!-- 최근 게시물 현황 시작 -->
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="sideTable">
<tr> 
    <td width="100%" height="25" colspan="2" class="sideTitle">&nbsp;<b><?php echo _t('최근 게시물 현황'); ?></b> [<font color=#555555>admin</font>]</td>
</tr>
<tr><td height="5" colspan="2"></td></tr>
<tr> 
    <td width="10%"></td>
    <td width="90%">
       <table border="0" cellspacing="0" cellpadding="0">
          <tr><td><a href='<?php echo $g5['bbs_url']?>/new.php'><?php echo _t('최근 게시물'); ?></a></td></tr>
       </table>
    </td>
</tr>
<tr><td height="5" colspan="2"></td></tr>
</table>
<!-- 최근 게시물 현황 끝 -->
