<?php
$sub_menu = '850000';
include_once('./_common.php');
include_once('../admin.lib.php');
include_once('./admin.banner.lib.php');

auth_check($auth[$sub_menu], "r");

$g5['title'] = '배너관리';
include_once (G5_ADMIN_PATH.'/admin.head.php');

$sql_common = " from {$g5['g5_shop_banner_table']} ";

$sca = $_GET['sca'];

if($sca){
	$where = "where bn_position= '$sca'";
}else{
	$where = '';
}


$order = "order by bn_position desc";

// 테이블의 전체 레코드수만 얻음
$sql = " select count(*) as cnt " . $sql_common. $where.$order;

$row = sql_fetch($sql);
$total_count = $row['cnt'];


//$rows = $config['cf_page_rows'];
$rows = 50;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

/*
$start_d = new DateTime('2012-01-01'); // 20120101 같은 포맷도 잘됨
$end_d = $today;

// $차이 는 DateInterval 객체. var_dump() 찍어보면 대충 감이 옴.

$gap    = date_diff($start_d, $end_d);
echo $gap;
*/

function live_day($begin_day)
{
	$date1 = date_create(date('Y-m-d'));
	$date2 = date_create($begin_day);
	$date3 = date_diff($date1, $date2);
	echo $date3->days; //경과일수
}
function remand_day($end_day)
{
	
	$date1 = date_create(date('Y-m-d'));
	$date2 = date_create($end_day);
	$date3 = date_diff($date1, $date2);
	echo $date3->days; //남은일수
}
?>
<!--기본값으로 닫힘-->



<script>
	$(document).ready(function() { 
		toggleNum = 0;
		//$('.btn_add01.sort').children().eq(<?=substr($sca,-1)?>).addClass('selected');
	}); 
</script>


<link rel="stylesheet" href="./banner.css">

<div class="local_ov01 local_ov" >
    등록된 배너 총 : <strong><?php echo $total_count; ?></strong>개 
		<a href="./bannerclick.php"  style="padding:10px 20px;margin-left:10px;">배너통계</a>

	<div class="btn_add01 btn_add sys" style="">
	<a href="#" class="closeAll">이미지 모두닫기</a>
	<a href="./bannerRegist.php" style="margin-right:10px;">배너분류 </a>  |
    <a href="./bannerform.php?sca=<?=$sca?>"  style="padding:10px 20px;margin-left:10px;">배너등록</a>

</div>
</div>



<div class="btn_add01 sort" >
	<?=get_banner_category($sca);?>
</div>



<div class="tbl_head02 tbl_wrap">
    <table>
    <caption><?php echo $g5['title']; ?> 목록</caption>
    <thead>
    <tr>
        <th scope="col" rowspan="2" id="th_Num" style="width:30px;">Num</th>
		<th scope="col" rowspan="2" id="th_id" style="width:40px;">id</th>
		<th scope="col" rowspan="2" id="th_nm">배너명</th>
		<th scope="col" rowspan="2" id="th_mng">수정 / 관리</th>
        <th scope="col" id="th_dvc">접속기기</th>
        <th scope="col" id="th_loc">위치</th>
        <th scope="col" id="th_st">시작일시</th>
        <th scope="col" id="th_end">종료일시</th>
		<th scope="col" id="th_live">LIVE경과일 / 남은일수</th>
        <th scope="col" id="th_odr">출력순서</th>
        <th scope="col" id="th_hit" style="width:80px;">누적배너클릭수</th>
    </tr>
    <tr>
        <th scope="col" colspan="7" id="th_img">이미지</th>
    </tr>
    </thead>
    <tbody>
    <?php
	$order = " order by reg_time, bn_position asc, bn_order, bn_id desc ";

    $sql = " select * from {$g5['g5_shop_banner_table']} ". $where . $order."  limit $from_record, $rows  ";

	if($_SERVER["REMOTE_ADDR"] == "210.96.212.116" ) echo $sql;
	
    $result = sql_query($sql);

    for ($i=0; $row=sql_fetch_array($result); $i++) {
        // 테두리 있는지
        $bn_border  = $row['bn_border'];
        // 새창 띄우기인지
        $bn_new_win = ($row['bn_new_win']) ? 'target="_blank"' : '';

        $bimg = G5_DATA_PATH.'/banner/'.$row['bn_id'];
        if(file_exists($bimg)) {
            $size = @getimagesize($bimg);
            if($size[0] && $size[0] > 800)
                $width = 800;
            else
                $width = $size[0];

            $bn_img = "";
            if ($row['bn_url'] && $row['bn_url'] != "http://")
                $bn_img .= '<a href="'.$row['bn_url'].'" '.$bn_new_win.'>';
            $bn_img .= '<img src="'.G5_DATA_URL.'/banner/'.$row['bn_id'].'" width="'.$width.'" alt="'.$row['bn_alt'].'"></a>';
        }

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
        <td headers="th_id" rowspan="2" class="td_num" style="width:30px;"><?=$i +1?></td>
		<td headers="th_id" rowspan="2" class="td_num"  style="width:40px;color:#666;"><?php echo $row['bn_id']; ?></td>
		<td headers="th_alt" rowspan="2" class="td_num" style="width:200px;"><strong><?php echo $row['bn_alt']; ?></strong></td>
		 <td headers="th_mng" rowspan="2" class="td_mngsmall" style="width:120px;">
            <li><a href="./bannerform.php?w=u&amp;bn_id=<?php echo $row['bn_id']; ?>" class="btn_fix">수정</a></li>
            <li><a href="./bannerformupdate.php?w=d&amp;bn_id=<?php echo $row['bn_id']; ?>"  class="btn_del" onclick="return delete_confirm(this);">삭제</a></li>
        </td>
        <td headers="th_dvc"><?php echo $bn_device; ?></td>
        <td headers="th_loc"><?php echo $row['bn_area']; ?></td>
        <td headers="th_st" class="td_datetime"><?php echo $bn_begin_time; ?></td>
        <td headers="th_end" class="td_datetime"><?php echo $bn_end_time; ?></td>
		<td headers="th_live" class="td_liveday"><span class="live"><? live_day($bn_begin_time);?>일</span> / <span class="remand"><? remand_day($bn_end_time) ?>일</span></td>
        <td headers="th_odr" class="td_num"><?php echo $row['bn_order']; ?></td>
        <td headers="th_hit" class="td_num"><?php echo $row['bn_hit']; ?></td>
       
    </tr>
    <tr class="<?php echo $bg; ?>">
        <td headers="th_img" colspan="7" class="td_img_view sbn_img">
            <div class="sbn_image"><?php echo $bn_img; ?></div>
            <button type="button" class="sbn_img_view btn_frmline">이미지확인</button>
        </td>
    </tr>

    <?php
    }
    if ($i == 0) {
    echo '<tr><td colspan="10" class="empty_table">등록된 배너가 없습니다.<br> 배너를 등록해주세요.</td></tr>';
    }
    ?>
    </tbody>
    </table>

</div>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, "{$_SERVER['SCRIPT_NAME']}?$qstr&amp;page="); ?>

<script>
$(function() {
    $(".sbn_img_view").on("click", function() {
        $(this).closest(".td_img_view").find(".sbn_image").slideToggle();
    });
	
	$(".closeAll").on("click", function() {
		$(".td_img_view").find(".sbn_image").slideToggle();

		toggleNum += 1 ;
		var togglefn = (toggleNum%2);
		
		if(togglefn == 1 )
		{
			$(this).text('이미지 펼쳐 보기');
		}else{
			$(this).text('이미지 모두 닫기');
		}
	});
});
</script>


<?if($sca ==""){?><script>$(".td_img_view").find(".sbn_image").slideToggle(); $(".closeAll").text("이미지 펼쳐 보기"); 	toggleNum = 1;
</script><?}?>


<?php
include_once (G5_ADMIN_PATH.'/admin.tail.php');
?>
