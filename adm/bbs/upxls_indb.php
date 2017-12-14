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

$g5['festival_table'] = 'g5_write_festival1';

$write_table = 'g5_write_festival';

if($_FILES['excelfile']['tmp_name']) {

    $file = $_FILES['excelfile']['tmp_name'];

    include_once(G5_LIB_PATH.'/Excel/reader.php');

    $data = new Spreadsheet_Excel_Reader();

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

    //echo $file;
    //exit();

    $data->read($file);


    error_reporting(E_ALL ^ E_NOTICE);

    $dup_it_id = array();
    $fail_it_id = array();
    $dup_count = 0;
    $total_count = 0;
    $fail_count = 0;
    $succ_count = 0;

	$numRows = $data->sheets[0]['numRows'];
	$numCols = $data->sheets[0]['numCols'];
	$datalist = $data->sheets[0]['cells'][1];
  $titlerow = $data->sheets[0]['cells'];


  for ($i = 2; $i <= $numRows; $i++) {
      for($k=1; $k<= $numCols; $k++) {
          $total_count++;
          $titlerow[$i][$k] = trim($titlerow[$i][$k]);

    		  if(!$mb_id) $mb_id = 'admin';
    		  if(!$wr_option) $wr_option = 'html1';
    		  $wr_datetime = '".G5_TIME_YMDHIS."';

          //mb_id 중복체크
          $sql2 = "select count(*) as cnt from {$g5['festival_table']}";
          $row2 = sql_fetch($sql2);

          if($row2['cnt']) {
      		    $fail_count++;
              continue;
          }
    		  //$succ_count++;
  	  }
      $wr_num = get_next_num("g5_write_festival");
      $sql = " insert into g5_write_festival
                  set wr_num = '$wr_num',
                       wr_reply = '$wr_reply',
                       wr_comment = 0,
                       ca_name = '".$titlerow[$i][1]."',
                       wr_option = 'html1',
                       wr_subject = '".$titlerow[$i][4]."',
                       wr_subject_ko_KR = '".$titlerow[$i][4]."',
                       wr_subject_en_US = '".$titlerow[$i][5]."',
                       wr_subject_ja_JP = '".$titlerow[$i][6]."',
                       wr_subject_zh_CN = '".$titlerow[$i][7]."',
                       wr_subject_zh_TW = '".$titlerow[$i][8]."',
                       wr_content = '$wr_content',
                       wr_content_ko_KR = '$wr_content',
                       wr_content_en_US = '$wr_content_en_US',
                       wr_content_ja_JP = '$wr_content_ja_JP',
                       wr_content_zh_CN = '$wr_content_zh_CN',
                       wr_content_zh_TW = '$wr_content_zh_TW',
                       wr_link1 = '$wr_link1',
                       wr_link2 = '$wr_link2',
                       wr_link1_hit = 0,
                       wr_link2_hit = 0,
                       wr_hit = 0,
                       wr_good = 0,
                       wr_nogood = 0,
                       mb_id = '{$member['mb_id']}',
                       wr_password = '$wr_password',
                       wr_name = '{$member['mb_name']}_excel',
                       wr_email = '{$member['mb_email']}',
                       wr_homepage = '$wr_homepage',
                       wr_datetime = '".G5_TIME_YMDHIS."',
                       wr_last = '".G5_TIME_YMDHIS."',
                       wr_ip = '{$_SERVER['REMOTE_ADDR']}',
                       wr_1 = '".$titlerow[$i][2]."',
                       wr_2 = '".$titlerow[$i][3]."',
                       wr_3 = '".$titlerow[$i][9]."',
                       wr_4 = '$wr_4',
                       wr_5 = '$wr_5',
                       wr_6 = '$wr_6',
                       wr_7 = '$wr_7',
                       wr_8 = '$wr_8',
                       wr_9 = '$wr_9',
                       wr_10 = '$wr_10',
                       wr_link_ko_KR = '".$titlerow[$i][10]."',
                       wr_link_en_US = '".$titlerow[$i][11]."',
                       wr_link_ja_JP = '".$titlerow[$i][12]."',
                       wr_link_zh_CN = '".$titlerow[$i][13]."',
                       wr_link_zh_TW = '".$titlerow[$i][14]."'";
      sql_query($sql);
      // 부모 아이디에 UPDATE
      $wr_id = sql_insert_id();

      sql_query(" update $write_table set wr_parent = '$wr_id' where wr_id = '$wr_id' ");
      // 새글 INSERT
      sql_query(" insert into {$g5['board_new_table']} ( bo_table, wr_id, wr_parent, bn_datetime, mb_id ) values ( '{$bo_table}', '{$wr_id}', '{$wr_id}', '".G5_TIME_YMDHIS."', '{$member['mb_id']}' ) ");
      // 게시글 1 증가
      sql_query("update {$g5['board_table']} set bo_count_write = bo_count_write + 1 where bo_table = '{$bo_table}'");

  }


}

$g5['title'] = '축제/행사 데이터 등록 결과';
include_once(G5_PATH.'/head.sub.php');
?>

<div class="new_win">
    <h1><?php echo $g5['title']; ?></h1>

    <div class="local_desc01 local_desc">
        <p>데이터 등록을 완료했습니다.</p>
    </div>

    <dl id="excelfile_result">
        <dt>총등록 데이터수</dt>
        <dd><?php echo number_format($total_count); ?></dd>
        <dt>등록건수</dt>
        <dd><?php echo number_format($succ_count); ?></dd>
        <dt>실패건수</dt>
        <dd><?php echo number_format($fail_count); ?></dd>

		  <?php if($fail_count > 0) { ?>
        <dt>실패 데이터항목</dt>
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
