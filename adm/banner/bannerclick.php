<?php
$sub_menu = '850000';
include_once('./_common.php');
include_once('../admin.lib.php');
include_once('./admin.banner.lib.php');

auth_check($auth[$sub_menu], "r");

$g5['title'] = '배너통계';
include_once (G5_ADMIN_PATH.'/admin.head.php');


/* 통계 피커 */
include_once(G5_LIB_PATH.'/visit.lib.php');
include_once('./admin.head.php');
include_once(G5_PLUGIN_PATH.'/jquery-ui/datepicker.php');

$timezone = +9;

if (empty($fr_date)) $fr_date = date("Y-m-01", time());
if (empty($to_date)) $to_date = date("Y-m-d", time());


$qstr = "fr_date=".$fr_date."&amp;to_date=".$to_date;
$query_string = $qstr ? '?'.$qstr : '';

/* 통계 피커*/ 


/*
$sql_common = " from {$g5['g5_shop_banner_table']} ";

$order = "order by bn_position desc";

// 테이블의 전체 레코드수만 얻음
$sql = " select count(*) as cnt " . $sql_common. $where.$order;

$row = sql_fetch($sql);
*/
/*
$sql_common = " from {$g5['g5_shop_banner_table']} ";

// 테이블의 전체 레코드수만 얻음
$sql = " select count(*) as cnt " . $sql_common. $where.$order;

$row = sql_fetch($sql);

$total_count = $row['cnt'];
$rows = 50;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함
*/


$order = " order by bn_position asc, bn_order asc, bn_id desc ";

$sql_common = 'FROM g5_shop_banner AS a
LEFT JOIN g5_shop_banner_click AS b ON a.bn_id = b.bn_id ';

$where = "   where bn_datetime between '{$fr_date}' and '{$to_date} 23:59:59'";

$sql_group = ' GROUP BY a.bn_id ';

$sql_select = "SELECT a.bn_id, a.bn_alt,a.bn_hit, a.bn_position,  COUNT(*) AS total_hit, COUNT(IF(SUBSTR(b.bn_lang,1,2) = 'ko',1, NULL)) AS kr_hit, COUNT(IF(SUBSTR(b.bn_lang,1,2) = 'en',1, NULL)) AS en_hit, COUNT(IF(SUBSTR(b.bn_lang,1,2) = 'ja',1, NULL)) AS jp_hit, COUNT(IF(SUBSTR(b.bn_lang,-2,2) = 'CN',1, NULL)) AS cn_hit, COUNT(IF(SUBSTR(b.bn_lang,-2,2) = 'TW',1, null)) AS tw_hit, COUNT(IF(b.bn_lang = '',1,NULL)) AS NULL_hit ";

$sql = $sql_select.$sql_common.$where.$sql_group.$order;

?>
<!--기본값으로 닫힘-->





<script>
$(function(){
    $("#fr_date, #to_date").datepicker({ changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd", showButtonPanel: true, yearRange: "c-99:c+99", maxDate: "+0d" });
});

function fvisit_submit(act)
{
    var f = document.fvisit;
    f.action = act;
    f.submit();
}
</script>

<link rel="stylesheet" href="./banner.css">
	<style>
		.lang_hit{width:50px;text-align:center;color:#565656;}
		.tbl_head02 thead th.th_total_hit,.th_total_hit{background:#565656; color:white;}
	</style>


<form name="fvisit" id="fvisit" class="local_sch02 local_sch" method="get">
<div class="sch_last">
    <strong>기간별검색</strong>
    <input type="text" name="fr_date" value="<?php echo $fr_date ?>" id="fr_date" class="frm_input" size="11" maxlength="10">
    <label for="fr_date" class="sound_only">시작일</label>
    ~
    <input type="text" name="to_date" value="<?php echo $to_date ?>" id="to_date" class="frm_input" size="11" maxlength="10">
    <label for="to_date" class="sound_only">종료일</label>
    <input type="submit" value="검색" class="btn_submit">
</div>
</form>


<div class="local_ov01 local_ov" >
    등록된 배너 총 : <strong><?php echo $total_count; ?></strong>개 
</div>



<div class="tbl_head02 tbl_wrap">
    <table>
    <caption><?php echo $g5['title']; ?> 목록</caption>
    <thead>
    <tr>
		<th scope="col" rowspan="3" id="th_num" style="width:20px;">Num</th>
		<th scope="col" rowspan="3" id="th_position" >위치</th>
        <th scope="col" rowspan="3" id="th_id">ID</th>
		<th scope="col" rowspan="3" id="th_id">배너명</th>
        <th scope="col" rowspan="3" id="th_hit"  style="width:100px;">누적배너클릭수 <br>(1일 한번)</th>
		<th scope="col" colspan="7" id="th_hit">기간별 통계 (중복클릭포함)</th>
    </tr>
	<tr>
		<th scope="col" rowspan="2" style="width:100px;" id ="th_total_hit" class="th_total_hit">합계</th>
		<th scope="col" colspan="6" style="background:#3d3d3d;color:white;">어권별</th>
	</tr>
	<tr>
		<th>국문</th>
		<th>영어</th>
		<th>일어</th>
		<th>중(간)</th>
		<th>중(번)</th>
		<th>기타</th>
	</tr>
  
    </thead>

    <tbody>
    <?php
	
	if($_SERVER["REMOTE_ADDR"] == "210.96.212.116" ) echo $sql;

    $result = sql_query($sql);

    for ($i=0; $row=sql_fetch_array($result); $i++) {
   
		
        switch($row['bn_device']) {
            case 'pc':
                $bn_device = 'PC';
                break;
            case 'mobile':
                $bn_device = '모바일';
                break;
            default:
                $bn_device = 'PC와 모바일';
                break;
        }

        $bn_begin_time = substr($row['bn_begin_time'], 2, 14);
        $bn_end_time   = substr($row['bn_end_time'], 2, 14);

        $bg = 'bg'.($i%2);
    ?>

    <tr class="<?php echo $bg; ?>">
        <td headers="th_num" rowspan="1" class="td_num"><?=$i +1?></td>
		<td headers="th_id" rowspan="1" class="td_position"><?=$row['bn_position']; ?></td>
		<td headers="th_id" rowspan="2" class="td_num"  style="width:40px;color:#666;"><?php echo $row['bn_id']; ?></td>
		<td headers="th_alt" rowspan="2" class="td_num" style="width:200px;"><strong><?php echo $row['bn_alt']; ?></strong></td>
        <td headers="th_hit" class="td_num" style="color:#666"><?php echo $row['bn_hit']; ?></td>
		<td headers="th_total_hit" class="td_num th_total_hit"><?php echo $row['total_hit']; ?></td>
		<td class="lang_hit"><?php echo $row['kr_hit'];?></td>
		<td class="lang_hit"><?php echo $row['en_hit'];?></td>
		<td class="lang_hit"><?php echo $row['jp_hit'];?></td>
		<td class="lang_hit"><?php echo $row['cn_hit'];?></td>
		<td class="lang_hit"><?php echo $row['tw_hit'];?></td>
		<td class="lang_hit"><?php echo $row['NULL_hit'];?></td>

    </tr>

    <tr class="<?php echo $bg; ?>"></tr>

    <?}?>
    </tbody>
    </table>

</div>


<?php
include_once (G5_ADMIN_PATH.'/admin.tail.php');
?>
