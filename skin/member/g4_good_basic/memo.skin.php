<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
?>

<table width="600" height="50" border="0" cellpadding="0" cellspacing="0">
<tr>
    <td align="center" valign="middle" bgcolor="#EBEBEB">
        <table width="590" height="40" border="0" cellspacing="0" cellpadding="0">
        <tr> 
            <td width="25" align="center" bgcolor="#FFFFFF" ><img src="<?php echo $member_skin_url?>/img/icon_01.gif" width="5" height="5"></td>
            <td width="65" align="left" bgcolor="#FFFFFF" ><font color="#666666"><b><?php echo $g5[title]?></b></font></td>
            <td width="500" bgcolor="#FFFFFF" ></td>
        </tr>
        </table></td>
</tr>
</table>

<table width="600" border="0" cellspacing="0" cellpadding="0">
<tr> 
    <td width="600" height="20" colspan="14"></td>
</tr>
<tr> 
    <td width="30" height="24"></td>
    <td width="99" align="center" valign="middle"><a href="./memo.php?kind=recv"><img src="<?php echo $member_skin_url?>/img/btn_recv_paper_<?php echo $recv_img?>.gif" width="99" height="24" border="0"></a></td>
    <td width="2" align="center" valign="middle">&nbsp;</td>
    <td width="99" align="center" valign="middle"><a href="./memo.php?kind=send"><img src="<?php echo $member_skin_url?>/img/btn_send_paper_<?php echo $send_img?>.gif" width="99" height="24" border="0"></a></td>
    <td width="2" align="center" valign="middle">&nbsp;</td>
    <td width="99" align="center" valign="middle"><a href="./memo_form.php"><img src="<?php echo $member_skin_url?>/img/btn_write_paper_off.gif" width="99" height="24" border="0"></a></td>
    <td width="2" align="center" valign="middle">&nbsp;</td>
    <td width="60" valign="middle" bgcolor="#EFEFEF">&nbsp;</td>
    <td width="4" align="center" valign="middle"><img src="<?php echo $member_skin_url?>/img/left_img.gif" width="4" height="24"></td>
    <td width="18" align="center" valign="middle" background="<?php echo $member_skin_url?>/img/bar_bg_img.gif"><img src="<?php echo $member_skin_url?>/img/arrow_01.gif" width="7" height="5"></td>
    <td width="148" align="left" valign="middle" background="<?php echo $member_skin_url?>/img/bar_bg_img.gif"><?php echo _t('전체'); ?> <?php echo $kind_title?> <?php echo _t('쪽지'); ?> [ <B><?php echo $total_count?></B> ]<?php echo _t('통'); ?></td>
    <td width="4"><img src="<?php echo $member_skin_url?>/img/right_img.gif" width="4" height="24"></td>
    <td width="3" bgcolor="#EFEFEF"></td>
    <td width="30" height="24"></td>
</tr>
</table>

<table width="600" border="0" cellspacing="0" cellpadding="0">
<tr> 
    <td height="200" align="center" valign="top">
        <table width="540" border="0" cellspacing="0" cellpadding="0">
        <tr> 
            <td height="30">* <?php echo _t('쪽지 보관일수는 최장'); ?> <?php echo $config[cf_memo_del]?><?php echo _t('일 입니다.'); ?></td>
        </tr>
        <tr> 
            <td height="2" bgcolor="#808080"></td>
        </tr>
        <tr> 
            <td width="540" bgcolor="#FFFFFF">
                <table width=100% cellpadding=1 cellspacing=1 border=0>
                <tr bgcolor=#E1E1E1 align=center> 
                    <td width="30%" height="24"><b><?php echo  ($kind == "recv") ? _t("보낸사람") : _t("받는사람"); ?></b></td>
                    <td width=25%><b><?php echo _t('보낸시간'); ?></b></td>
                    <td width=25%><b><?php echo _t('읽은시간'); ?></b></td>
                    <td width=20%><b><?php echo _t('쪽지삭제'); ?></b></td>
                </tr>

                <?php for ($i=0; $i<count($list); $i++) { ?>
                <tr height=25 bgcolor=#F6F6F6 align=center> 
                    <td width="30%"><?php echo $list[$i][name]?></td>
                    <td width="25%"><a href="<?php echo $list[$i][view_href]?>"><?php echo $list[$i][send_datetime]?></font></td>
                    <td width="25%"><a href="<?php echo $list[$i][view_href]?>"><?php echo $list[$i][read_datetime]?></font></td>
                    <td width="20%"><a href="javascript:del('<?php echo $list[$i][del_href]?>');"><img src="<?php echo $member_skin_url?>/img/btn_comment_delete.gif" width="45" height="14" border="0"></a></td>
                </tr>
                <?php } ?>

                <?php if ($i==0) { echo "<tr><td height=100 align=center colspan=4>"._t("자료가 없습니다.")."</td></tr>"; } ?>
                </table></td>
        </tr>
        </table></td>
</tr>
<tr> 
    <td height="2" align="center" valign="top" bgcolor="#D5D5D5"></td>
</tr>
<tr>
    <td height="2" align="center" valign="top" bgcolor="#E6E6E6"></td>
</tr>
<tr>
    <td height="40" align="center" valign="bottom"><a href="javascript:window.close();"><img src="<?php echo $member_skin_url?>/img/btn_close.gif" width="48" height="20" border="0"></a><br><br></td>
</tr>
</table>

