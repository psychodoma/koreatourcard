<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 

$url = '';
if ($g5['https_url']) {
    if (preg_match("/^\./", $urlencode))
        $url = $g5[url];
    else
        $url = $g5[url].$urlencode;
} else {
    $url = $urlencode;
}
?>

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
<input type="hidden" name="url" value="<?php echo $url?>">

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="sideTable">
<tr> 
    <td width="100%" height="25" colspan="2" class="sideTitle">&nbsp;<b><?php echo _t('로그인'); ?> | <?php echo _t('로그아웃'); ?></b></td>
</tr>

<tr> 
    <td width="5"></td>
    <td width="">
       <table border="0" cellspacing="0" cellpadding="0" style="padding-top:3px">
       <tr>
          <td>
             <table width=100% height="46" border="0" cellspacing="0" cellpadding="0">
               <tr>
               <td><img src="<?php echo $outlogin_skin_url?>/img/login_id.gif" width="35" height="23"></td>
               <td width="3"></td>
               <td><input name="mb_id" type="text" class=ed style="width:90px;" maxlength="20" required itemname="<?php echo _t('아이디'); ?>" value='<?php echo _t('아이디'); ?>' onMouseOver='chkReset(this.form);' onFocus='chkReset(this.form);'></td>
               </tr>
               <tr>
               <td><img src="<?php echo $outlogin_skin_url?>/img/login_pw.gif" width="35" height="23"></td>
               <td width="3"></td>
               <td id=pw1><input type="text" class=ed style="width:90px;" maxlength="20" required itemname="<?php echo _t('패스워드'); ?>" value='<?php echo _t('패스워드'); ?>' onMouseOver='chkReset(this.form);' onfocus='chkReset(this.form);'></td>
               <td id=pw2 style="display:none"><input name="mb_password" id="outlogin_mb_password" type="password" class=ed style="width:90px" maxlength="20" itemname="<?php echo _t('패스워드'); ?>" onMouseOver='chkReset(this.form);' onfocus='chkReset(this.form);' onKeyPress="check_capslock(event, 'outlogin_mb_password');"></td>
               </tr>
             </table>
          </td>
          <td width=52>
             <input type="image" src="<?php echo $outlogin_skin_url?>/img/btn_login.gif" width="52" height="46" style="margin-left:3px;">
          </td>
       </tr>
       <tr><td colspan="2">
           <div style="clear:both; padding:0px 0 0 5px;">
              <input type="checkbox" style="vertical-align:middle;" name="auto_login" value="1" onclick="if (this.checked) { if (confirm('<?php echo _t('자동로그인을 사용하시면 다음부터 회원아이디와 패스워드를 입력하실 필요가 없습니다.'); ?>\n\n<?php echo _t('공공장소에서는 개인정보가 유출될 수 있으니 사용을 자제하여 주십시오.'); ?>\n\n<?php echo _t('자동로그인을 사용하시겠습니까?'); ?>')) { this.checked = true; } else { this.checked = false; } }">
              <img src="<?php echo $outlogin_skin_url?>/img/login_auto.gif" align="absmiddle" border=0>
           </div>
       </td></tr>
       <tr><td colspan="2">
           <div style="clear:both; padding:3px 0 0 10px;">
              <!-- <a href="javascript:win_password_forget();"><img src="<?php echo $outlogin_skin_url?>/img/btn_password_forget.gif" border=0></a> -->
              <a href="javascript:win_password_lost('<?php echo G5_BBS_URL ?>/password_lost.php');"><img src="<?php echo $outlogin_skin_url?>/img/btn_password_forget.gif" border=0></a>
              <a href="<?php echo $g5[bbs_url]?>/register.php"><img src="<?php echo $outlogin_skin_url?>/img/btn_register.gif" border=0></a>
           </div>
           <div style="clear:both;"></div>
          </td>
       </tr>
       </table>
    </td>
</tr>
</table>
</form>

<script language="JavaScript">
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
