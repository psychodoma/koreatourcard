<?php
$sub_menu = '600100';
include_once('./_common.php');

// 상품이 많을 경우 대비 설정변경
set_time_limit ( 0 );
ini_set('memory_limit', '50M');

auth_check($auth[$sub_menu], "w");

function only_number($n)
{
    return preg_replace('/[^0-9]/', '', $n);
}

$g5['festival_table'] = 'g5_write_festival';

if($_FILES['excelfile']['tmp_name']) {
    $file = $_FILES['excelfile']['tmp_name'];

    include_once(G5_LIB_PATH.'/Excel/reader.php');

    $data = new Spreadsheet_Excel_Reader();

    // Set output Encoding.
    $data->setOutputEncoding('UTF-8');

    /***
    * if you want you can change 'iconv' to mb_convert_encoding:
    * $data->setUTFEncoder('mb');
    *
    **/

    /***
    * By default rows & cols indeces start with 1
    * For change initial index use:
    * $data->setRowColOffset(0);
    *
    **/



    /***
    *  Some function for formatting output.
    * $data->setDefaultFormat('%.2f');
    * setDefaultFormat - set format for columns with unknown formatting
    *
    * $data->setColumnFormat(4, '%.3f');
    * setColumnFormat - set format for column (apply only to number fields)
    *
    **/

    $data->read($file);

    /*
     $data->sheets[0]['numRows'] - count rows
     $data->sheets[0]['numCols'] - count columns
     $data->sheets[0]['cells'][$i][$j] - data from $i-row $j-column

     $data->sheets[0]['cellsInfo'][$i][$j] - extended info about cell

        $data->sheets[0]['cellsInfo'][$i][$j]['type'] = "date" | "number" | "unknown"
            if 'type' == "unknown" - use 'raw' value, because  cell contain value with format '0.00';
        $data->sheets[0]['cellsInfo'][$i][$j]['raw'] = value if cell without format
        $data->sheets[0]['cellsInfo'][$i][$j]['colspan']
        $data->sheets[0]['cellsInfo'][$i][$j]['rowspan']
    */

    error_reporting(E_ALL ^ E_NOTICE);

    $dup_it_id = array();
    $fail_it_id = array();
    $dup_count = 0;
    $total_count = 0;
    $fail_count = 0;
    $succ_count = 0;

    for ($i = 4; $i <= $data->sheets[0]['numRows']; $i++) {
        $total_count++;

        $j = 1;

		$festival_num				= addslashes($data->sheets[0]['cells'][$i][$j++]);
		$festival_ca_name		= addslashes($data->sheets[0]['cells'][$i][$j++]);
		$festival_duedate			= addslashes($data->sheets[0]['cells'][$i][$j++]);
		$festival_subject			= addslashes($data->sheets[0]['cells'][$i][$j++]);
		$festival_region		= addslashes($data->sheets[0]['cells'][$i][$j++]);
		$festival_link		= addslashes($data->sheets[0]['cells'][$i][$j++]);
		
		//print_r($festival_subject.'<br> ');
		
        if($festival_region =='서울' ) $festival_region = $festival_region.'특별시';
		if(!$mb_id) $mb_id = 'admin';
		if(!$wr_option) $wr_option = 'html1';
		$wr_datetime = '".G5_TIME_YMDHIS."';
		
		$festival_duedate_array = explode("~",$festival_duedate);
		$festival_duedate_start = only_number($festival_duedate_array[0]);
		$festival_duedate_end = only_number($festival_duedate_array[1]);

        if(!$festival_subject) {
            $fail_count++;
            continue;
        }

        // mb_id 중복체크
        $sql2 = "select count(*) as cnt from {$g5['festival_table']} where wr_subject = '$festival_subject' ";
        $row2 = sql_fetch($sql2);
        if($row2['cnt']) {
            $fail_festival_num[] = $festival_num.' _ '.$festival_subject;
            $fail_count++;
            continue;
        }

        $sql = "INSERT INTO {$g5['festival_table']}
                     SET  ca_name = '$festival_ca_name',
						 wr_option = '$wr_option',
                         wr_subject = '$festival_subject',
                         wr_subject_ko_KR = '$festival_subject',
						 wr_subject_en_US = '$festival_subject',
						 wr_subject_ja_JP = '$festival_subject',
						 wr_subject_zh_CN = '$festival_subject',
						 wr_subject_zh_TW = '$festival_subject',
                         wr_content = '$festival_subject',
						 wr_content_ko_KR = '$festival_subject',
						 wr_content_en_US = '$festival_subject',
						 wr_content_ja_JP = '$festival_subject',
						 wr_content_zh_CN = '$festival_subject',
						 wr_content_zh_TW = '$festival_subject',
                         wr_link1 = '$festival_link',
						 wr_link1_hit = '',
						 wr_link2_hit = '',
						 wr_hit = '',
						 wr_good = '',
						 wr_nogood = '',
						 mb_id = '$mb_id',
                         wr_password = '".sql_password($mb_password)."',
						 wr_name='',
						 wr_email = '',
						 wr_homepage = '',
						 wr_datetime = '$wr_datetime',
						 wr_file = '',
						 wr_last='',
						 wr_ip='',
						 wr_facebook_user = '',
						 wr_twitter_user = '',
						 wr_1 = '$festival_duedate_start',
						 wr_2 = '$festival_duedate_end',
                         wr_3 = '$festival_region' ";
		$sql .= "{$sql_ip}";

       // print_r($sql);

		sql_query($sql);
	
        $succ_count++;
    }
}

$g5['title'] = '축제/행사 일정 등록 결과';
include_once(G5_PATH.'/head.sub.php');
?>

<div class="new_win">
    <h1><?php echo $g5['title']; ?></h1>

    <div class="local_desc01 local_desc">
        <p>일정 등록을 완료했습니다.</p>
    </div>

    <dl id="excelfile_result">
        <dt>총등록 일정수</dt>
        <dd><?php echo number_format($total_count); ?></dd>
        <dt>등록건수</dt>
        <dd><?php echo number_format($succ_count); ?></dd>
        <dt>실패건수</dt>
        <dd><?php echo number_format($fail_count); ?></dd>

		  <?php if($fail_count > 0) { ?>
        <dt>실패 일정항목</dt>
        <dd><?php echo implode('<br> ', $fail_festival_num); ?></dd>
        <?php } ?>

       
    </dl>

    <div class="btn_win01 btn_win">
        <button type="button" onclick="window.close();">창닫기</button>
    </div>

</div>

<?php
include_once(G5_PATH.'/tail.sub.php');
?>