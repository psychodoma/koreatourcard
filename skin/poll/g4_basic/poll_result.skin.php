<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
?>

<table width="600" border="0" cellspacing="0" cellpadding="0" align=center>
<tr>
    <td align="center">
        <table width="600" height="70" border="0" cellpadding="0" cellspacing="0">
        <tr> 
            <td align="center" valign="middle" bgcolor="#EBEBEB">
                <table width="590" height="60" border="0" cellspacing="0" cellpadding="0">
                <tr> 
                    <td width="30" align="center" bgcolor="#FFFFFF" ><img src="<?php echo $g5[bbs_img_url]?>/icon_01.gif" width="5" height="5"></td>
                    <td width="40" align="left" bgcolor="#FFFFFF" ><font color="#666666"><b><?php echo _t('질문'); ?></b></font></td>
                    <td width="20" align="left" bgcolor="#FFFFFF" >l</td>
                    <td width="500" bgcolor="#FFFFFF" ><font color="#666666"><b><?php echo _t($po_subject)?></b> (<?php echo _t('전체'); ?> <?php echo $nf_total_po_cnt?><?php echo _t('표'); ?>)</font></td>
                </tr>
                </table></td>
        </tr>
        </table>

        <table width="600" border="0" cellspacing="0" cellpadding="0">
        <tr> 
            <td height="10"></td>
        </tr>
        </table>

        <table width=600 bgcolor=#ffffff cellpadding=1 cellspacing=0>
        <tr> 
            <td> 
                <table width=100% cellpadding=6 cellspacing=1>
                <?php for ($i=1; $i<=count($list); $i++) { ?>
                <tr bgcolor=#FFFFFF>
                    <td width="258" bgcolor="#EBF1F5"><?php echo $list[$i][num]?>. <?php echo _t($list[$i][content])?></td>
                    <td width="175" bgcolor="#EBF1F5"><img src="<?php echo $g5[bbs_img_url]?>/poll_graph_y.gif" width="<?php echo (int)$list[$i][bar]?>" height="7"></td>
                    <td width="121" bgcolor="#A1C9E4"><font color="#ffffff"><?php echo $list[$i][cnt]?><?php echo _t('표'); ?> (<?php echo number_format($list[$i][rate], 1)?>%)</font></td>
                </tr>
                <?php } ?>
                </table></td>
        </tr>
        </table>

        <table width="570" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td height="15"></td>
            </tr>
        </table>

<?php if ($is_etc) { ?>

    <?php if ($member[mb_level] >= $po[po_level]) { ?>
        <form name="fpollresult" method="post" onsubmit="return fpollresult_submit(this);" autocomplete="off" style="margin:0px;">
        <table width=570 bgcolor=#D4D4D4 cellpadding=1 cellspacing=0>
        <input type=hidden name=po_id value="<?php echo $po_id?>">
        <input type=hidden name=w value="">
        <tr> 
            <td> 
                <table width=100% cellpadding=0 cellspacing=0 bgcolor=#FFFFFF>
                <tr> 
                    <td height=50 colspan=2>
                        <table width=100% cellpadding=4 bgcolor=#FFFFFF>    
                        <tr><td><?php echo $po_etc?></td></tr>
                        </table></td>
                </tr>
                <tr> 
                    <td height=35 width=150 align="center">
                        <?php if ($member[mb_id]) { ?>
                            <input type=hidden name=pc_name value="<?php echo cut_str($member[mb_nick],255)?>">
                            <b><?php echo $member[mb_nick]?></b> &nbsp;
                        <?php } else { ?>
                            <?php echo _t('이름'); ?> <input type='text' name='pc_name' size=10 class=input required itemname='<?php echo _t('이름'); ?>'> &nbsp;
                        <?php } ?>
                    </td>
                    <td>
                        <?php echo _t('의견'); ?> <input type='text' name='pc_idea' size=55 class=input required itemname='<?php echo _t('의견'); ?>' maxlength="100"> &nbsp;
                        <input name="image" type=image src='<?php echo $g5[bbs_img_url]?>/ok_btn.gif' align=absmiddle border=0></td>
                </tr>
                </table>
            </td>
        </tr>
        </table>
        </form>

        <script type="text/javascript">
        function fpollresult_submit(f)
        {
            f.action = "./poll_etc_update.php";
            return true;
        }
        </script>
    <?php } ?>

    <?php for ($i=0; $i<count($list2); $i++) { ?>
        <table width="570" border="0" cellspacing="0" cellpadding="0">
        <tr> 
            <td height="10" colspan="4"></td>
        </tr>
        <tr> 
            <td width="20" height="25" align="center" bgcolor="#FAFAFA"><img src="<?php echo $g5[bbs_img_url]?>/icon_03.gif" width="3" height="5"></td>
            <td width="350" bgcolor="#FAFAFA"><?php echo $list2[$i][name]?></td>
            <td width="70" align="center" bgcolor="#FAFAFA"><?php if ($list2[$i][del]) { echo $list2[$i][del] . "<img src='$g5[bbs_img_url]/btn_comment_delete.gif' width=45 height=14 border=0></a>"; } ?></td>
            <td width="150" align="center" bgcolor="#FAFAFA"><?php echo $list2[$i][datetime]?></td>
        </tr>
        <tr> 
            <td height="1" colspan="4" background="<?php echo $g5[bbs_img_url]?>/dot_bg.gif"></td>
        </tr>
        <tr> 
            <td width="20" height="25" bgcolor="#FAFAFA">&nbsp;</td>
            <td width="550" height="25" colspan="3" bgcolor="#FAFAFA"><?php echo _t($list2[$i][idea])?></td>
        </tr>
        </table>
    <?php } ?>

<?php } ?>

        <table width="600" border="0" cellspacing="0" cellpadding="0">
        <tr> 
            <td height="30" colspan="3" align="center" valign="middle"><table width="595" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                        <td width="595" height="1" background="<?php echo $g5[bbs_img_url]?>/dot_bg.gif"></td>
                    </tr>
                </table></td>
        </tr>
        <tr valign="top"> 
            <td height="30" colspan="3" align="left"><img src="<?php echo $g5[bbs_img_url]?>/title_01.gif" width="180" height="19"></td>
        </tr>
        <form name=fpolletc>
        <tr> 
            <td width="15" align="center">&nbsp;</td>
            <td width="35" align="center"><img src="<?php echo $g5[bbs_img_url]?>/icon_1.gif" width="15" height="8"></td>
            <td width="560"><select name=po_id onchange="select_po_id(this)"><?php for ($i=0; $i<count($list3); $i++) { ?><option value='<?php echo $list3[$i][po_id]?>'>[<?php echo $list3[$i][date]?>] <?php echo _t($list3[$i][subject])?><?php } ?></select><script>document.fpolletc.po_id.value='<?php echo $po_id?>';</script></td>
        </tr>
        </form>
        <tr> 
            <td height="10" colspan="3">&nbsp;</td>
        </tr>
        <tr> 
            <td height="5" colspan="3" background="<?php echo $g5[bbs_img_url]?>/down_line.gif"></td>
        </tr>
        <tr align="center" valign="bottom"> 
            <td height="38" colspan="3"><a href="javascript:window.close();"><img src="<?php echo $g5[bbs_img_url]?>/close.gif" width="66" height="20" border="0"></a></td>
        </tr>
        </table></td>
</tr>
</table>
<br>

<script type='text/javascript'>
function select_po_id(fld) 
{
    document.location.href = "./poll_result.php?po_id="+fld.options[fld.selectedIndex].value;
}
</script>
