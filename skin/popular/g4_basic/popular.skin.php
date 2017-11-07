<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
?>
<?php echo _t('인기검색어'); ?> : 
<?php 
for ($i=0; $i<count($list); $i++) {
    echo "<a href='$g5[bbs_url]/search.php?sfl=wr_subject&sop=and&stx=".urlencode($list[$i][pp_word])."'>{$list[$i][pp_word]}</a>&nbsp;";
} 
?>
