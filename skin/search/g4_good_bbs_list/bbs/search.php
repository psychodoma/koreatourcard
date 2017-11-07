<?php // 굿빌더 ?>
<?php
include_once("./_common.php");

/// Mysyql 사용자 권한의 Create_tmp_table_priv가 'Y'가 아닌 경우 search_no_sort 값을 1로 함.
$que = "select * from information_schema.SCHEMA_PRIVILEGES where GRANTEE=\"'$mysql_user'@'$mysql_host'\" and TABLE_SCHEMA='$mysql_db' and PRIVILEGE_TYPE='CREATE TEMPORARY TABLES'";
$res = sql_query($que);
if(sql_num_rows($res)) $search_no_sort = 0; 
else $search_no_sort = 1;

$content_len = 300;
$thumb_use = 1;
$is_good = 1;
$is_nogood = 1;

if($search_no_sort) include("$search_skin_path/bbs/search_list_nosort.php");
else include("$search_skin_path/bbs/search_list.php");

?>
