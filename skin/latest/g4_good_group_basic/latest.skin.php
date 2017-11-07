<?php // 굿빌더 ?>
<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
?>

<table width=100% cellpadding=0 cellspacing=0>
<tr>
    <td width=14><img src='<?php echo $latest_skin_url?>/img/latest_t01.gif'></td>
    <td width='100%' background='<?php echo $latest_skin_url?>/img/bg_latest.gif'>&nbsp;&nbsp;<strong><a href='<?php echo $g5[bbs_url]?>/group.php?gr_id=<?php echo $gr_id?>'><?php echo _t($gr_subject)?> <?php echo _t('그룹'); ?></a></strong></td>
    <td width=37 background='<?php echo $latest_skin_url?>/img/bg_latest.gif'><a href='<?php echo $g5[bbs_url]?>/group.php?gr_id=<?php echo $gr_id?>'><img src='<?php echo $latest_skin_url?>/img/more.gif' border=0></a></td>
    <td width=14><img src='<?php echo $latest_skin_url?>/img/latest_t02.gif'></td>
</tr>
</table>

<table width=100% cellpadding=0 cellspacing=0>
<?php for ($i=0; $i<count($list); $i++) { ?>
<tr>
    <td colspan=4 align=center>
        <table width=95%>
        <tr>
            <td height=25><img src='<?php echo $latest_skin_url?>/img/latest_icon.gif' align=absmiddle>&nbsp;&nbsp; 
            <?php
            echo $list[$i]['icon_reply'] . " ";
            echo "<a href='{$list[$i]['href']}'>";
            if ($list[$i]['is_notice'])
                echo "<font style='font-family:돋움; font-size:9pt; color:#2C88B9;'><strong>"._t($list[$i]['subject'])."</strong></font>";
            else {
                echo "<font style='font-family:돋움; font-size:9pt; color:#999999;'>";
		echo "["._t($list[$i]['bo_subject'])."] "; ///
		/// echo "[{$list[$i]['ca_name']}] "; ///
                echo "</font>";
                echo "<font style='font-family:돋움; font-size:9pt; color:#6A6A6A;'>";
                echo _t($list[$i]['subject']);
                echo "</font>";
            }
            echo "</a>";

            if ($list[$i]['comment_cnt']) 
                echo " <a href=\"{$list[$i]['comment_href']}\"><span style='font-family:돋움; font-size:8pt; color:#9A9A9A;'>{$list[$i]['comment_cnt']}</span></a>";

            // if ($list[$i]['link']['count']) { echo "[{$list[$i]['link']['count']}]"; }
            // if ($list[$i]['file']['count']) { echo "<{$list[$i]['file']['count']}>"; }

            echo " " . $list[$i]['icon_new'];
            echo " " . $list[$i]['icon_file'];
            echo " " . $list[$i]['icon_link'];
            echo " " . $list[$i]['icon_hot'];
            echo " " . $list[$i]['icon_secret'];

            echo "</td><td align=right>";
            echo "<font style='font-family:돋움; font-size:9pt; color:#6A6A6A;'>{$list[$i][datetime2]}</font>"; 
            echo "</td><td width=8>\n";
            ?></td></tr>
        <tr><td colspan=3 bgcolor=#EBEBEB height=1></td></tr>
        </table></td>
</tr>
<?php } ?>

<?php if (count($list) == 0) { ?><tr><td colspan=4 align=center height=50><font color=#6A6A6A><?php echo _t('게시물이 없습니다.'); ?></a></td></tr><?php } ?>

</table>
