<?php // 굿빌더 ?>
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

<!-- 설문 조사 시작 -->
<form name="fpoll" method="post" action="<?php echo $g5[bbs_url]?>/poll_update.php" onsubmit="return fpoll_submit(this);">
<input type="hidden" name="po_id" value="<?php echo $po_id?>">
<input type="hidden" name="skin_dir" value="<?php echo $skin_dir?>">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="sideTable">
<tr> 
    <td width="100%" height="25" colspan="2" class="sideTitle">&nbsp;<b><?php echo _t('설문조사'); ?></b></td>
</tr>
<tr><td height="5" colspan="2"></td></tr>
<tr> 
    <td width="10%"></td>
    <td width="90%">
       <table border="0" cellspacing="0" cellpadding="0">
          <tr><td><font color="#000000"><?php echo _t($po[po_subject])?></font>
          <?php if ($is_admin == "super") { ?><a href="<?php echo $g5[admin_url]?>/poll_form.php?w=u&po_id=<?php echo $po_id?>"><img src="<?php echo $poll_skin_url?>/img/admin.gif" width="33" height="15" border=0 align=absmiddle></a></center><?php } ?></td></tr>
          <tr><td height="5"></td></tr>
          <tr>
             <td>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <?php for ($i=1; $i<=9 && $po["po_poll{$i}"]; $i++) { ?>
                   <tr>
                      <td width="25" height="" align="left"><input style="margin-left:0;" type="radio" name="gb_poll" value="<?php echo $i?>" id='gb_poll_<?php echo $i?>'></td>
                      <td width="" align="left"><font color="#000000"><label for='gb_poll_<?php echo $i?>'><?php echo _t($po['po_poll'.$i])?></label></font></td>
                   </tr>
                <?php } ?>
                </table>
             </td>
          </tr>
          <tr><td height="5"></td></tr>
          <tr><td align="center">
             <input type="image" src="<?php echo $poll_skin_url?>/img/poll_button.gif" width="70" height="25" border="0">
             <a href="javascript:;" onclick="poll_result('<?php echo $po_id?>');"><img src="<?php echo $poll_skin_url?>/img/poll_view.gif" width="70" height="25" border="0"></a>
          </td></tr>
       </table>
    </td>
</tr>
</table>
</form>
<!-- 설문 조사 끝 -->

<script language='JavaScript'>
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
