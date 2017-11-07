<?
$pagecnt = 5;
$totalPage  = ceil($row['cnt'] / $pagecnt);  // 전체 페이지 계산
$tatalCnt = $row['cnt'];
if(!(isset($page))){
     $page = 1;
}
$current_first  = (int)($page-1)*$pagecnt;
$current_second  = (int)$page*$pagecnt;
$query .= " order by info_name_".$_SESSION['lang'];
$query .= " limit $current_first, $pagecnt ";
?>
