<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
?>

<table width="220" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="220" height="40" background="<?php echo $connect_skin_url?>/img/visit_bg.gif">
        <table width="220" border="0" cellspacing="0" cellpadding="0">
        <tr> 
            <td width="30" align="right"><img src="<?php echo $connect_skin_url?>/img/icon.gif" width="14" height="14"></td>
            <td width="190">&nbsp;&nbsp;<a href='<?php echo $g5['bbs_url']?>/current_connect.php'><strong><?php echo _t('현재접속자'); ?></strong> : <?php echo $row['total_cnt']?> (<?php echo _t('회원'); ?> <?php echo $row['mb_cnt']?>)</a></td>
        </tr>
        </table></td>
</tr>
</table>
