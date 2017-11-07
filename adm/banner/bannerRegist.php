<?php
$sub_menu = '850200';
include_once('./_common.php');
include_once('../admin.lib.php');
include_once('./admin.banner.lib.php');

auth_check($auth[$sub_menu], "w");

$html_title = '배너';
$g5['title'] = $html_title.'분류 리스트'. '<label>  - 수정시 배너코드 클릭</label>';
$g5[g5_shop_banner_table] = 'g5_shop_banner_config';

$sca = $_GET["sca"];

if ($w=="u")
{
    $html_title .= ' 수정';
    $sql = " select * from g5_shop_banner_config where bn_code = '$bn_code' ";
    $bn = sql_fetch($sql);
}

include_once (G5_ADMIN_PATH.'/admin.head.php');
?>

<link rel="stylesheet" href="./banner.css">


<div class="tbl_head02 tbl_wrap" >
    <table>
    <caption><?php echo $g5['title']; ?> 목록</caption>
    <thead>
    <tr>
        <th scope="col"  id="th_num">Num</th>
		<th scope="col"  id="th_code">배너코드</th>
		<th scope="col"  id="th_area">배너그룹</th>
		<th scope="col"  id="th_position">배너노출위치</th>
		<th scope="col"  id="th_sort">순서지정</th>
		<th scope="col"  id="th_guide">위치가이드</th>
		<th scope="col"  id="th_del">관리</th>
    </tr>
    </thead>

    <tbody>
   <?php
	
	$sql_common = " from g5_shop_banner_config";

	// 테이블의 전체 레코드수만 얻음
	$sql = " select count(*) as cnt " . $sql_common;

	$row = sql_fetch($sql);
	$total_count = $row['cnt'];

	$rows = $config['cf_page_rows'];
	$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
	if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
	$from_record = ($page - 1) * $rows; // 시작 열을 구함


    $sql = " select *".$sql_common. $where ."
          order by bn_area desc, bn_num asc
          limit $from_record, $rows  ";
	
    $result = sql_query($sql);

    for ($i=0; $row=sql_fetch_array($result); $i++) {
		$row = $row;
		 $bg = 'bg'.($i%2);
	?>

    <tr class="<?php echo $bg; ?>">
        <td headers="th_id"class="td_num"><?=$row["bn_num"]?></td>  
		<td headers="th_code" class="td_code"><a href="./bannerRegist.php?w=u&bn_code=<?=$row['bn_code']?>"><?=$row["bn_code"]?></a></td> 
		<td headers="th_area" class="td_area"><?=$row["bn_area"]?></td> 
		<td headers="th_position"  class="td_position"><?=$row["bn_position"]?></td> 
		<td headers="th_sort"  class="td_position"><?=$row["bn_sort"]?></td> 
		<td headers="th_desc"  class="td_desc"><?=$row["bn_desc"]?></td> 
		<td headers="th_del"  class="td_del"><a href="./bannerRegist_update.php?w=d&amp;&bn_code=<?=$row['bn_code']?>" onclick="return delete_confirm(this);" class="btn btn_del">삭제</a></td> 

    </tr>

    <?php
    }

    if ($i == 0) {
    echo '<tr><td colspan="9" class="empty_table">자료가 없습니다.</td></tr>';
    }
    ?>
    </tbody>
    </table>

</div>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, "{$_SERVER['SCRIPT_NAME']}?$qstr&amp;page="); ?>


<form name="fbanner"  onsubmit="return checkform();"method="post" enctype="multipart/form-data">
<input type="hidden" name="w" value="<?php echo $w; ?>">
<input type="hidden" name="bn_num" value="<?php echo $bn_num; ?>">

<h1 class="admin_title_h1">분류등록/수정 <div class="btn_add01 sys"><a href="./bannerRegist.php" >새로등록</a></div> </h1> 

<div class="tbl_frm01 tbl_wrap">
    <table>
    <caption><?php echo $g5['title']; ?></caption>
    <colgroup>
        <col class="grid_4">
        <col>
    </colgroup>
    <tbody>
	<tr>
        <th scope="row">배너그룹</th>
        <td>
			<?php echo help(" 배너그룹");?>
             <input type="text" name="bn_area" value="<?php echo $bn['bn_area']; ?>" id="bn_area" class="frm_input" size="80">
        </td>
    </tr>

    <tr>
        <th scope="row">배너코드</th>
        <td>
			<?php echo help(" 배너분류 코드값 - 중복되지 않게 지정");?>
             <input type="text" name="bn_code" value="<?php echo $bn['bn_code']; ?>" id="bn_code" class="frm_input" size="80" required>
        </td>
    </tr>
	
    <tr>
        <th scope="row"><label for="bn_position">배너노출위치</label></th>
        <td>
			<?php echo help(" 배너노출위치 한글 입력");?>
            <input type="text" name="bn_position" value="<?php echo $bn['bn_position']; ?>" id="bn_position" class="frm_input" size="80" required>
        </td>
    </tr>
	
    </tbody>
    </table>
</div>

<div class="btn_confirm01 btn_confirm">
    <input type="submit" value="확인" class="btn_submit" accesskey="s">
    <a href="./bannerlist.php">목록</a>
</div>

</form>

<script>
function checkform() {
	document.fbanner.action = "./bannerRegist_update.php";

  if (document.fbanner.bn_code.value.length < 3) {
    alert("코드값은 2자이상 입력하세요");
    document.fbanner.bn_code.focus();
    return false;
  }
  document.fbanner.submit();
}
</script>

<?php
include_once (G5_ADMIN_PATH.'/admin.tail.php');
?>
