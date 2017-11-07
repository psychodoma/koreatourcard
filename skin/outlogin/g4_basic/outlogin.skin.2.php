<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
?>

<!-- 로그인 후 외부로그인 시작 -->
<table width="220" border="0" cellspacing="0" cellpadding="0">
<tr> 
    <td width="220" colspan="5"><img src="<?php echo $outlogin_skin_url?>/img/login_ing_top.gif" width="220" height="42"></td>
</tr>
<tr> 
    <td width="5" rowspan="4" background="<?php echo $outlogin_skin_url?>/img/login_left_bg.gif"></td>
    <td width="210" colspan="3"></td>
    <td width="5" rowspan="4" background="<?php echo $outlogin_skin_url?>/img/login_right_bg.gif"></td>
</tr>
<tr> 
    <td colspan="3">
        <table width="210" height="27" border="0" cellpadding="0" cellspacing="0">
        <tr> 
            <td width="25" height="27"><img src="<?php echo $outlogin_skin_url?>/img/login_ing_icon.gif" width="25" height="27"></td>
            <td width="139" height="27"><span class='member'><strong><?php echo $nick?></strong></span><?php echo _t('님'); ?></td>
            <td width="46" height="27"><?php if ($is_admin == "super" || $is_auth) { ?><a href="<?php echo $g5['admin_url']?>/"><img src="<?php echo $outlogin_skin_url?>/img/admin.gif" width="33" height="15" border="0" align="absmiddle"></a><?php } ?></td>
        </tr>
      </table></td>
</tr>
<tr> 
    <td width="25"></td>
    <td width="160" height="25" align="center" bgcolor="#F9F9F9"><a href="javascript:win_point('<?php echo G5_BBS_URL ?>/point.php');"><font color="#737373"><?php echo _t('포인트'); ?> : <?php echo $point?><?php echo _t('점'); ?></font></a></td>
    <td width="25"></td>
</tr>
<tr> 
    <td colspan="3">
        <table width="210" border="0" cellspacing="0" cellpadding="0">
        <tr> 
            <td>
                <table width="210" height="50" border="0" cellpadding="0" cellspacing="0">
                <tr> 
                    <td width="25"></td>
                    <td width="82"><a href="<?php echo $g5['bbs_url']?>/logout.php"><img src="<?php echo $outlogin_skin_url?>/img/logout_button.gif" width="78" height="20" border="0"></a></td>
                    <td width="78"><a href="<?php echo $g5['bbs_url']?>/member_confirm.php?url=register_form.php"><img src="<?php echo $outlogin_skin_url?>/img/login_modify.gif" width="78" height="20" border="0"></a></td>
                    <td width="25"></td>
                </tr>
                <tr> 
                    <td></td>
                    <td align="center"><a href="javascript:win_memo('<?php echo G5_BBS_URL ?>/memo.php');"><FONT color="#ff8871;"><B><?php echo _t('쪽지'); ?> (<?php echo $memo_not_read?>)</B></FONT></a></td>
                    <td><a href="javascript:win_scrap('<?php echo G5_BBS_URL ?>/scrap.php');"><img src="<?php echo $outlogin_skin_url?>/img/scrap_button.gif" width="78" height="20" border="0"></a></td>
                    <td></td>
                </tr>
                </table></td>
        </tr>
        </table></td>
</tr>
<tr> 
    <td colspan="5"><img src="<?php echo $outlogin_skin_url?>/img/login_down.gif" width="220" height="14"></td>
</tr>
</table>

<script type="text/javascript" src="<?php echo $g5['legacy_url']?>/js/common.js"></script>
<script type="text/javascript">
// 탈퇴의 경우 아래 코드를 연동하시면 됩니다.
function member_leave() 
{
    if (confirm("<?php echo _t('정말 회원에서 탈퇴 하시겠습니까?'); ?>")) 
            location.href = "<?php echo $g5['bbs_url']?>/member_confirm.php?url=member_leave.php";
}
</script>
<!-- 로그인 후 외부로그인 끝 -->
