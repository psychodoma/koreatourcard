<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
?>

<!-- 로그인 후 외부로그인 시작 -->
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="sideTable">
<tr> 
    <td width="100%" height="25" colspan="2" class="sideTitle">&nbsp;<b><?php echo _t('로그인'); ?> | <?php echo _t('로그아웃'); ?></b></td>
</tr>
<tr><td height="5" colspan="2"></td></tr>
<tr> 
    <td width="10%"></td>
    <td width="90%">
    <span class='member'><font color="#aa0000"><?php echo $nick?></font></span><?php echo _t('님'); ?>
    &nbsp;
    <?php if ($is_admin == "super" || $is_auth) { ?><a href="<?php echo $g5['admin_url']?>/" target="_new"><img src="<?php echo $outlogin_skin_url?>/img/admin.gif" width="33" height="15" border="0" align="absmiddle"></a><?php } ?>
    </td>
</tr>
<tr> 
    <td width="100%" height="3" colspan="2"></td>
</tr>
<tr>
    <td width="10%"></td>
    <td width="90%">
    <table border="0" cellspacing="0" cellpadding="0" style="margin-left:0px;"><tr><td>
    <a href="<?php echo $g5['bbs_url']?>/logout.php" class="login"><?php echo _t('로그아웃'); ?></a> |
    <a href="<?php echo $g5['bbs_url']?>/member_confirm.php?url=register_form.php"><?php echo _t('정보수정'); ?></a> |
    <a href="javascript:win_point('<?php echo G5_BBS_URL ?>/point.php');"><?php echo _t('포인트'); ?> : <?php echo $point?><?php echo _t('점'); ?></a> |
    <a href="javascript:win_memo('<?php echo G5_BBS_URL ?>/memo.php');"><?php echo _t('쪽지'); ?> (<?php echo $memo_not_read?>)</a> |
    <a href="javascript:win_scrap('<?php echo G5_BBS_URL ?>/scrap.php');"><?php echo _t('스크랩'); ?></a>
    </td></tr></table>
    </td>
</tr>
<tr><td height="5" colspan="2"></td></tr>
</table>

<script language="JavaScript">
// 탈퇴의 경우 아래 코드를 연동하시면 됩니다.
function member_leave() 
{
    if (confirm("<?php echo _t('정말 회원에서 탈퇴 하시겠습니까?'); ?>")) 
            location.href = "<?php echo $g5['bbs_url']?>/member_confirm.php?url=member_leave.php";
}
</script>
<!-- 로그인 후 외부로그인 끝 -->
