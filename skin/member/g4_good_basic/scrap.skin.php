<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
?>

<table width="600" height="50" border="0" cellpadding="0" cellspacing="0">
<tr>
    <td align="center" valign="middle" bgcolor="#EBEBEB">
        <table width="590" height="40" border="0" cellspacing="0" cellpadding="0">
        <tr> 
            <td width="25" align="center" bgcolor="#FFFFFF" ><img src="<?php echo $member_skin_url?>/img/icon_01.gif" width="5" height="5"></td>
            <td width="75" align="left" bgcolor="#FFFFFF" ><font color="#666666"><b><?php echo _t('스크랩'); ?></b></font></td>
            <td width="490" bgcolor="#FFFFFF" ></td>
        </tr>
        </table></td>
</tr>
</table>

<table width="600" border="0" cellspacing="0" cellpadding="0">
<tr> 
    <td height="200" align="center" valign="top">
        <table width="540" border="0" cellspacing="0" cellpadding="0">
        <tr> 
            <td height="20"></td>
        </tr>
        <tr> 
            <td height="2" bgcolor="#808080"></td>
        </tr>
        <tr> 
            <td width="540" bgcolor="#FFFFFF">
                <table width=100% cellpadding=1 cellspacing=1 border=0>
                <tr bgcolor=#E1E1E1 align=center> 
                    <td width="10%" height="24"><b><?php echo _t('번호'); ?></b></td>
                    <td width="12%"><b><?php echo _t('게시판'); ?></b></td>
                    <td width="38%"><b><?php echo _t('제목'); ?></b></td>
                    <td width="25%"><b><?php echo _t('보관일시'); ?></b></td>
                    <td width="10%"><b><?php echo _t('삭제'); ?></b></td>
                </tr>

                <?php for ($i=0; $i<count($list); $i++) { ?>
                    <tr height=25 bgcolor="#F6F6F6" align="center"> 
                        <td height="24"><?php echo $list[$i][num]?></td>
                        <td><a href="javascript:;" onclick="opener.document.location.href='<?php echo $list[$i][opener_href]?>';"><?php echo $list[$i][bo_subject]?></a></td>
                        <td align="left" style='word-break:break-all;'>&nbsp;<a href="javascript:;" onclick="opener.document.location.href='<?php echo $list[$i][opener_href_wr_id]?>';"><?php echo $list[$i][subject]?></a></td>
                        <td><?php echo $list[$i][ms_datetime]?></td>
                        <td><a href="javascript:del('<?php echo $list[$i][del_href]?>');"><img src="<?php echo $member_skin_url?>/img/btn_comment_delete.gif" width="45" height="14" border="0"></a></td>
                    </tr>
                <?php } ?>

                <?php if ($i == 0) echo "<tr><td colspan=5 align=center height=100>"._t("자료가 없습니다.")."</td></tr>"; ?>
                </table></td>
        </tr>
        </table></td>
</tr>
<tr> 
    <td height="30" align="center"><?php echo get_paging($config[cf_write_pages], $page, $total_page, "?$qstr&page=");?></td>
</tr>
<tr> 
    <td height="2" align="center" valign="top" bgcolor="#D5D5D5"></td>
</tr>
<tr>
    <td height="2" align="center" valign="top" bgcolor="#E6E6E6"></td>
</tr>
<tr>
    <td height="40" align="center" valign="bottom"><a href="javascript:window.close();"><img src="<?php echo $member_skin_url?>/img/btn_close.gif" width="48" height="20" border="0"></a></td>
</tr>
</table>
<br>
