<?php // 굿빌더 ?>
<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
?>

<style>
.n_title1 { font-family:돋움; font-size:9pt; color:#FFFFFF; }
.n_title2 { font-family:돋움; font-size:9pt; color:#5E5E5E; }
</style>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr> 
    <td width="4" height="33" bgcolor="#7BB2D6"><img src="<?php echo $connect_skin_url?>/img/list_top_01.gif" width="4" height="33"></td>
    <td width="60" align="center" bgcolor="#7BB2D6"><font class=n_title1><strong><?php echo _t('번호'); ?></strong></font></td>
    <td width="5" align="center" valign="middle" bgcolor="#7BB2D6"><img src="<?php echo $connect_skin_url?>/img/list_top_02.gif" width="5" height="33"></td>
    <td width="5" align="center" valign="middle" bgcolor="#EEEEEE"><img src="<?php echo $connect_skin_url?>/img/list_top_03.gif" width="5" height="33"></td>
    <td width="" align="center" bgcolor="#EEEEEE"><font class=n_title2><strong><?php echo _t('이름'); ?></strong></font></td>
    <td width="500" align="center" bgcolor="#EEEEEE"><font class=n_title2><strong><?php echo _t('링크'); ?></strong></font></td>
    <td width="4" bgcolor="#EEEEEE"><img src="<?php echo $connect_skin_url?>/img/list_top_04.gif" width="4" height="33"></td>
</tr>
<?php
for ($i=0; $i<count($list); $i++)
{
    echo <<<HEREDOC
    <tr>
        <td colspan=3 align='center' height='30'>{$list[$i][num]}</td>
        <td colspan=2 align='center'>{$list[$i][name]}</td>
HEREDOC;

    $location = conv_content($list[$i][lo_location], 0);

    // 최고관리자에게만 허용
    // 이 조건문은 가능한 변경하지 마십시오.
    if ($list[$i][lo_url] && $is_admin == "super")
        echo "<td colspan=2>&nbsp;<a href='{$list[$i][lo_url]}'>{$location}</a></td>";
    else
        echo "<td colspan=2>&nbsp;{$location}</td>";

    echo <<<HEREDOC
    </tr>
    <tr><td colspan='7' height='1' background='{$connect_skin_url}/img/dot_bg.gif'></td></tr>
HEREDOC;
}

if ($i == 0)
    echo "<tr><td colspan=7 height=50 align=center>"._t("현재 접속자가 없습니다.")."</td></tr>";
?>
<tr> 
    <td colspan="7" height="30" align="center"><?php echo $write_pages;?></td>
</tr>
</table>
