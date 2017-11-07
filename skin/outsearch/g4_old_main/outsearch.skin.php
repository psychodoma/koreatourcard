<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
?>

<form name="fsearchbox" method="get" onsubmit="return fsearchbox_submit(this);" style="margin:0px;">
<input type="hidden" name="ho_id" value="<?php echo $g5[host]?>">
<input type="hidden" name="sfl" value="wr_subject||wr_content">
<input type="hidden" name="sop" value="and">
<table width="100%" height="30" border="0" cellspacing="0" cellpadding="2" class="searchTable"><tr><td align="center">
<input name="stx" type="text" maxlength=20 style="width:400px; margin-left:10px;" onclick="javascript:this.focus();">
&nbsp; <input type="submit" value="<?php echo _t('검색'); ?>">
</td></tr></table>
</form>

<script language="JavaScript">
function fsearchbox_submit(f)
{
    if (f.stx.value.length < 2) {
        alert("<?php echo _t('검색어는 두글자 이상 입력하십시오.'); ?>");
       	f.stx.select();
        f.stx.focus();
        return false;
   	}

  	// 검색에 많은 부하가 걸리는 경우 이 주석을 제거하세요.
    var cnt = 0;
    for (var i=0; i<f.stx.value.length; i++) {
        if (f.stx.value.charAt(i) == ' ')
       	cnt++;
   	}

    if (cnt > 1) {
        alert("<?php echo _t('빠른 검색을 위하여 검색어에 공백은 한개만 입력할 수 있습니다.'); ?>");
       	f.stx.select();
	f.stx.focus();
       	return false;
    }

    f.action = "<?php echo $g5['bbs_url']?>/search.php";
    return true;
}
</script>
