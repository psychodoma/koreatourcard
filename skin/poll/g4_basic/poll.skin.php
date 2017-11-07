<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 

global $is_admin;

// 투표번호가 넘어오지 않았다면 가장 큰(최근에 등록한) 투표번호를 얻는다
if (!$po_id) 
{
    $po_id = $config[cf_max_po_id];

    if (!$po_id) return;
}

$po = sql_fetch(" select * from $g5[poll_table] where po_id = '$po_id' ");
?>

<table width="220" border="0" cellspacing="0" cellpadding="0">
<form name="fpoll" method="post" action="<?php echo $g5[bbs_url]?>/poll_update.php" onsubmit="return fpoll_submit(this);">
<input type="hidden" name="po_id" value="<?php echo $po_id?>">
<input type="hidden" name="skin_dir" value="<?php echo $skin_dir?>">
<tr>
    <td width=7 height=7><img src="<?php echo $poll_skin_url?>/img/bg_tl.gif" width=7></td>
    <td background="<?php echo $poll_skin_url?>/img/bg_t.gif"></td>
    <td width=6><img src="<?php echo $poll_skin_url?>/img/bg_tr.gif" width=6></td>
</tr>
<tr>
    <td background="<?php echo $poll_skin_url?>/img/bg_ml.gif"></td>
    <td>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr><td height=5 colspan=5></td></tr>
        <tr>
            <td width="5"></td>
            <td align="center" colspan=3>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width=5><img src="<?php echo $poll_skin_url?>/img/bg_mcl.gif"></td>
                    <td align=center background="<?php echo $poll_skin_url?>/img/bg_mc.gif"><img src="<?php echo $poll_skin_url?>/img/title.gif"></td>
                    <td width=4><img src="<?php echo $poll_skin_url?>/img/bg_mcr.gif"></td>
                </tr>
                </table></td>
            <td width="5"></td>
        </tr>
        <tr><td height=10 colspan=4></td></tr>
        <tr>
            <td></td>
            <td width="25" align="center"><img src="<?php echo $poll_skin_url?>/img/q.gif" width="12" height="13"></td>
            <td height="20" style="text-align:justify;"><font color="#848484"><?php echo _t($po[po_subject])?></font>
                <?php if ($is_admin == "super") { ?><a href="<?php echo $g5[admin_url]?>/poll_form.php?w=u&po_id=<?php echo $po_id?>"><img src="<?php echo $poll_skin_url?>/img/admin.gif" width="33" height="15" border=0 align=absmiddle></a></center><?php } ?>
            </td>
            <td></td>
        </tr>
        <tr><td height=5 colspan=4></td></tr>

        <tr>
            <td></td>
            <td colspan=2>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <?php for ($i=1; $i<=9 && $po["po_poll{$i}"]; $i++) { ?>
                <tr>
                    <td width="25" align="center"><?php if ($i == 1) { echo "<img src='$poll_skin_url/img/a.gif' width='12' height='13'>"; } else { echo "&nbsp;"; } ?></td>
                    <td width="30" height="25" align="center"><input type="radio" name="gb_poll" value="<?php echo $i?>" id='gb_poll_<?php echo $i?>'></td>
                    <td width=""><font color="#848484"><label for='gb_poll_<?php echo $i?>'><?php echo _t($po['po_poll'.$i])?></label></font></td>
                </tr>
                <?php } ?>
                </table></td>
        </tr>
        <tr><td height=5 colspan=4></td></tr>
        <tr>
            <td></td>
            <td colspan="2" align=center>
                <input type="image" src="<?php echo $poll_skin_url?>/img/poll_button.gif" width="70" height="25" border="0">
                <a href="javascript:;" onclick="poll_result('<?php echo $po_id?>');"><img src="<?php echo $poll_skin_url?>/img/poll_view.gif" width="70" height="25" border="0"></td>
            <td></td>
        </tr>
        <tr><td height=5 colspan=5></td></tr>
        </table></td>
    <td background="<?php echo $poll_skin_url?>/img/bg_mr.gif"></td>
</tr>
<tr>
    <td height=7><img src="<?php echo $poll_skin_url?>/img/bg_bl.gif" width=7></td>
    <td background="<?php echo $poll_skin_url?>/img/bg_b.gif"></td>
    <td><img src="<?php echo $poll_skin_url?>/img/bg_br.gif" width=6></td>
</tr>
</form>
</table>

<script type='text/javascript'>
function fpoll_submit(f)
{
    var chk = false;
    for (i=0; i<f.gb_poll.length;i ++) {
        if (f.gb_poll[i].checked == true) {
            chk = f.gb_poll[i].value;
            break;
        }
    }

    <?php
    if ($member[mb_level] < $po[po_level])
        echo " alert('"._t("권한")." $po[po_level] "._t("이상의 회원만 투표에 참여하실 수 있습니다.")."'); return false; ";
    ?>

    if (!chk) {
        alert("<?php echo _t('항목을 선택하세요'); ?>");
        return false;
    }

    var new_win = window.open("about:blank", "win_poll", "width=616,height=500,scrollbars=yes,resizable=yes");
    f.target = "win_poll";
    return true;
}

function poll_result(po_id)
{
    <?php
    if ($member[mb_level] < $po[po_level])
        echo " alert('"._t("권한")." $po[po_level] "._t("이상의 회원만 결과를 보실 수 있습니다.")."'); return false; ";
    ?>

    win_poll("<?php echo $g5[bbs_url]?>/poll_result.php?po_id="+po_id+"&skin_dir="+document.fpoll.skin_dir.value);
}
</script>
