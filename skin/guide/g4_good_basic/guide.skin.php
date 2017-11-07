<?php // 굿빌더 ?>
<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 

global $is_admin;
?>

<!-- <?php echo $view_guide[wr_subject]?> 시작 -->
<table width="100%" border="0" cellspacing="0" cellpadding="2" class="sideTable">
<tr> 
    <td width="100%" height="25" colspan="2" class="sideTitle">&nbsp;<font color=#0000aa>▦</font>&nbsp; <?php if($is_admin) { ?><a href='<?php echo $g5[bbs_url]?>/board.php?bo_table=<?php echo $bo_table?>&wr_id=<?php echo $wr_id?>'><?php } ?><b><?php echo _t($board_guide[bo_subject])?></b><?php if($is_admin) { ?></a><?php } ?></td>
</tr>
<tr><td height="5" colspan="2"></td></tr>
<tr> 
    <td width="10%"></td>
    <td width="90%">
       <table border="0" cellspacing="0" cellpadding="0">
          <tr><td align="left">
<?php if($wr_id == '1' or $wr_id == '2') { ?>
             <?php if($is_admin) { ?><a href='<?php echo $g5[bbs_url]?>/board.php?bo_table=<?php echo $bo_table?>&wr_id=<?php echo $wr_id?>'><?php } ?><?php echo $view_guide[wr_content]?><?php if($is_admin) { ?></a><?php } ?>
<?php } else { // no 1, 2 ?>
             <a href='<?php echo $g5[bbs_url]?>/board.php?bo_table=<?php echo $bo_table?>&wr_id=<?php echo $wr_id?>'><?php echo _t($view_guide[wr_subject])?>&nbsp;</a><?php } ?>

          </td></tr>
       </table>
    </td>
</tr>
<tr><td height="5" colspan="2"></td></tr>
</table>
<!-- <?php echo $view_guide[wr_subject]?> 끝 -->
