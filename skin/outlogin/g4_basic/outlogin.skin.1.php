<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

if ($g5['https_url']) {
    $outlogin_url = $_GET['url'];
    if ($outlogin_url) {
        if (preg_match("/^\.\.\//", $outlogin_url)) {
            $outlogin_url = urlencode($g5[url]."/".preg_replace("/^\.\.\//", "", $outlogin_url));
        }
        else {
            $purl = parse_url($g5[url]);
            if ($purl[path]) {
                $path = urlencode($purl[path]);
                $urlencode = preg_replace("/".$path."/", "", $urlencode);
            }
            $outlogin_url = $g5[url].$urlencode;
        }
    }
    else {
        $outlogin_url = $g5[url];
    }
}
else {
    $outlogin_url = $urlencode;
}
?>

<script type="text/javascript" src="<?php echo $g5['legacy_url']?>/js/common.js"></script>
<script type="text/javascript" src="<?php echo $g5['legacy_url']?>/js/capslock.js"></script>
<script type="text/javascript">
// 엠파스 로긴 참고
var bReset = true;
function chkReset(f)
{
    if (bReset) { if ( f.mb_id.value == '<?php echo _t('아이디'); ?>' ) f.mb_id.value = ''; bReset = false; }
    document.getElementById("pw1").style.display = "none";
    document.getElementById("pw2").style.display = "";
}
</script>


<!-- 로그인 전 외부로그인 시작 -->
<form name="fhead" method="post" onsubmit="return fhead_submit(this);" autocomplete="off" style="margin:0px;">
<input type="hidden" name="url" value="<?php echo $outlogin_url?>">
<div style="width:220px;">
    <div style="clear:both;"><img src="<?php echo $outlogin_skin_url?>/img/login_top.gif" width="220" height="42"></div>
    <div style="clear:both; float:left; width:5px; height:115px; background:#F8F8F8;"></div>
    <div style="width:210px; float:left; margin-top:10px;">
        <table width="210" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td width="141">
                <table width="141" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td width="35" height="23"><img src="<?php echo $outlogin_skin_url?>/img/login_id.gif" width="35" height="23"></td>
                    <td width="106" height="23" colspan="2" align="center"><input name="mb_id" type="text" class=ed size="12" maxlength="20" required itemname="<?php echo _t('아이디'); ?>" value='<?php echo _t('아이디'); ?>' onMouseOver='chkReset(this.form);' onFocus='chkReset(this.form);'></td>
                </tr>
                <tr>
                    <td width="35" height="23"><img src="<?php echo $outlogin_skin_url?>/img/login_pw.gif" width="35" height="23"></td>
                    <td id=pw1 width="106" height="23" colspan="2" align="center"><input type="text" class=ed size="12" maxlength="20" required itemname="<?php echo _t('패스워드'); ?>" value='<?php echo _t('패스워드'); ?>' onMouseOver='chkReset(this.form);' onfocus='chkReset(this.form);'></td>
                    <td id=pw2 style='display:none;' width="106" height="23" colspan="2" align="center"><input name="mb_password" id="outlogin_mb_password" type="password" class=ed size="12" maxlength="20" itemname="<?php echo _t('패스워드'); ?>" onMouseOver='chkReset(this.form);' onfocus='chkReset(this.form);' onKeyPress="check_capslock(event, 'outlogin_mb_password');"></td>
                </tr>
                </table>
            </td>
            <td width="69" height="46" rowspan="2" align="center"><input type="image" src="<?php echo $outlogin_skin_url?>/img/login_button.gif" width="52" height="46"></td>
        </tr>
        </table>
        <div style="clear:both; padding:2px 0 0 42px;">
            <div style="float:left;"><input type="checkbox" name="auto_login" value="1" onclick="if (this.checked) { if (confirm('<?php echo _t('자동로그인을 사용하시면 다음부터 회원아이디와 패스워드를 입력하실 필요가 없습니다.'); ?>\n\n<?php echo _t('공공장소에서는 개인정보가 유출될 수 있으니 사용을 자제하여 주십시오.'); ?>\n\n<?php echo _t('자동로그인을 사용하시겠습니까?'); ?>')) { this.checked = true; } else { this.checked = false; } }"></div>
            <div style="float:left; padding-left:5px;"><img src="<?php echo $outlogin_skin_url?>/img/login_auto.gif" width="46" height="28"></div>
        </div>
        <div style="clear:both; padding:0 0 0 42px;">
            <!-- <a href="javascript:win_password_forget();"><img src="<?php echo $outlogin_skin_url?>/img/login_pw_find_button.gif" width="90" height="20" border="0"></a> -->
            <a href="javascript:win_password_lost('<?php echo G5_BBS_URL ?>/password_lost.php');"><img src="<?php echo $outlogin_skin_url?>/img/login_pw_find_button.gif" width="90" height="20" border="0"></a>
            <a href="<?php echo $g5[bbs_url]?>/register.php"><img src="<?php echo $outlogin_skin_url?>/img/login_join_button.gif" width="69" height="20" border="0"></a>
        </div>
    </div>
    <div style="float:left; width:5px; height:115px; background:#F8F8F8;"></div>
    <div style="clear:both;"><img src="<?php echo $outlogin_skin_url?>/img/login_down.gif" width="220" height="14"></div>
</div>
</form>

<script type="text/javascript">
function fhead_submit(f)
{
    if (!f.mb_id.value) {
        alert("<?php echo _t('회원아이디를 입력하십시오.'); ?>");
        f.mb_id.focus();
        return false;
    }

    if (document.getElementById('pw2').style.display!='none' && !f.mb_password.value) {
        alert("<?php echo _t('패스워드를 입력하십시오.'); ?>");
        f.mb_password.focus();
        return false;
    }

    <?php
    if ($g5[https_url])
        echo "f.action = '$g5[https_url]/$g5[bbs]/login_check.php';";
    else
        echo "f.action = '$g5[bbs_url]/login_check.php';";
    ?>

    return true;
}
</script>
<!-- 로그인 전 외부로그인 끝 -->
