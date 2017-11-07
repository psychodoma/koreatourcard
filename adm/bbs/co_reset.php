<?
include_once('./_common.php');
$course_sql = "select * from g5_write_course where wr_course is NULL or wr_course = ".$wr_id;
//$course_sql_cnt = "select count(*) cnt from g5_write_course";
$course_reulst = sql_query($course_sql);
$course_reulst_cnt = sql_fetch($course_sql_cnt);

echo "<select class='course' style='float:left;'>";
echo "<option value=''>선택하세요</option>";

while($row = sql_fetch_array($course_reulst)){
    $id = $row['wr_id'];
    $subject = $row['wr_subject'];
    echo "<option class=".$id." value=".$id.">".$subject."</option>";
}

echo "</select>";
?>