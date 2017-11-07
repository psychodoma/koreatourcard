<?php // 굿빌더 ?>
<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
?>

<!-- 접속자 통계 시작 -->
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="sideTable">
<tr> 
    <td width="100%" height="25" colspan="2" class="sideTitle">&nbsp;<b><?php echo _t('최근 접속 현황'); ?></b> [<font color=#555555>admin</font>]</td>
</tr>
<tr><td height="5" colspan="2"></td></tr>
<tr> 
    <td width="10%"></td>
    <td width="90%">
       <table border="0" cellspacing="0" cellpadding="0">
          <tr><td><a href='<?php echo $g5['bbs_url']?>/current_connect.php'><?php echo _t('현재접속자'); ?> <?php echo $row['total_cnt']?> (<?php echo _t('회원'); ?> <?php echo $row['mb_cnt']?>)</a></td></tr>
       </table>
    </td>
</tr>
<tr><td height="5" colspan="2"></td></tr>
</table>
<!-- 접속자 통계 끝 -->
