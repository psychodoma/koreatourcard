<?php // 굿빌더 ?>
<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
?>

<!-- 인기 검색어 시작 -->
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="sideTable">
<tr> 
    <td width="100%" height="25" colspan="2" class="sideTitle">&nbsp;<b><?php echo _t('인기검색어'); ?></b></td>
</tr>
<tr><td height="5" colspan="2"></td></tr>
<tr> 
    <td width="10%"></td>
    <td width="90%">
       <table border="0" cellspacing="0" cellpadding="0">
          <?for ($i=0; $i<count($list); $i++) {?>
          <tr><td>
          <a href="<?php echo $g5[bbs_url]?>/search.php?sfl=wr_subject||wr_content&sop=and&stx=<?php echo urlencode($list[$i][pp_word])?>"><?php echo $list[$i][pp_word]?></a>
          </td>
          <td width="30" align="right">
          <?php echo $list[$i][cnt]?>
          </td><td></td></tr>
          <?php }?>
       </table>
    </td>
</tr>
<tr><td height="5" colspan="2"></td></tr>
</table>
<!-- 인기 검색어 끝 -->
