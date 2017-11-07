<?php
$sub_menu = '300700';
include_once('./_common.php');

auth_check($auth[$sub_menu], "r");

$g5['title'] = 'FAQ 상세관리';
if ($fm_subject) $g5['title'] .= ' : '.$fm_subject;
include_once (G5_ADMIN_PATH.'/admin.head.php');

$sql = " select * from {$g5['faq_master_table']} where fm_id = '$fm_id' ";
$fm = sql_fetch($sql);

if($cate){
    $sql_common = " from {$g5['faq_table']} where fa_cate = '$cate' and fm_id = '$fm_id' ";
}else{
    $sql_common = " from {$g5['faq_table']} where fm_id = '$fm_id' ";
}


// 테이블의 전체 레코드수만 얻음
$sql = " select count(*) as cnt " . $sql_common;
$row = sql_fetch($sql);
$total_count = $row[cnt];

$sql = "select * $sql_common order by fa_order , fa_id ";
$result = sql_query($sql);
?>

<script>
$(function(){
    $('.cate_btn').each(function(){
        var th = $(this);
        th.click(function(){
            $('#cate').attr('value', $(this).attr('valCate'));
            $('#cate_serach').click();
        })
    })
})
</script>




<div class="local_ov01 local_ov">
    등록된 FAQ 상세내용 <?php echo $total_count; ?>건
</div>

<div class="local_desc01 local_desc">
    <ol>
        <li>FAQ는 무제한으로 등록할 수 있습니다</li>
        <li><strong>FAQ 상세내용 추가</strong>를 눌러 자주하는 질문과 답변을 입력합니다.</li>
    </ol>
</div>


<div class="btn_add01 btn_add">
    <a href="./faqform.php?fm_id=<?php echo $fm['fm_id']; ?>">FAQ 상세내용 추가</a>
</div>


<form method='get' class="admFAQ_btnList">
	<ul>
		<li><div class='cate_btn' valCate=''>전체</div></li>
		<li><div class='cate_btn' valCate='코리아투어카드 이용안내'>코리아투어카드 이용안내</div></li>
		<li><div class='cate_btn' valCate='국내관광안내'>국내관광안내</div></li>
		<li><div class='cate_btn' valCate='기타'>기타</div></li>
	</ul>
    <input type='hidden' name='cate' id='cate'>
    <input type='hidden' name='fm_id' id='fm_id' value='<?=$fm_id?>'>
    <input type='hidden' name='fm_subject' id='fm_subject'  value='<?=$fm_subject?>'>
    <input type='submit' id='cate_serach' style='display:none;'>
</form>




<div class="tbl_head01 tbl_wrap">
    <table>
    <caption><?php echo $g5['title']; ?> 목록</caption>
    <thead>
    <tr>
        <th scope="col">번호</th>
        <th scope="col" width="14%">분류</th>
        <th scope="col">제목</th>
        <th scope="col">순서</th>
        <th scope="col">관리</th>
    </tr>
    </thead>
    <tbody>
    <?php
    for ($i=0; $row=sql_fetch_array($result); $i++)
    {
        $row1 = sql_fetch(" select COUNT(*) as cnt from {$g5['faq_table']} where fm_id = '{$row['fm_id']}' ");
        $cnt = $row1[cnt];

        $s_mod = icon("수정", "");
        $s_del = icon("삭제", "");

        $num = $i + 1;

        $bg = 'bg'.($i%2);
    ?>

    <tr class="<?php echo $bg; ?>">
        <td class="td_num"><?php echo $num; ?></td>
        <td class="td_num"><?php echo $row['fa_cate']; ?></td>
        <td><?php echo stripslashes($row['fa_subject']); ?></td>
        <td class="td_num"><?php echo $row['fa_order']; ?></td>
        <td class="td_mngsmall">
            <a href="./faqform.php?w=u&amp;fm_id=<?php echo $row['fm_id']; ?>&amp;fa_id=<?php echo $row['fa_id']; ?>"><span class="sound_only"><?php echo stripslashes($row['fa_subject']); ?> </span>수정</a>
            <a href="./faqformupdate.php?w=d&amp;fm_id=<?php echo $row['fm_id']; ?>&amp;fa_id=<?php echo $row['fa_id']; ?>" onclick="return delete_confirm(this);"><span class="sound_only"><?php echo stripslashes($row['fa_subject']); ?> </span>삭제</a>
        </td>
    </tr>

    <?php
    }

    if ($i == 0) {
        echo '<tr><td colspan="4" class="empty_table">자료가 없습니다.</td></tr>';
    }
    ?>
    </tbody>
    </table>

</div>

<div class="btn_confirm01 btn_confirm">
    <a href="./faqmasterlist.php">FAQ 관리</a>
</div>


<?php
include_once (G5_ADMIN_PATH.'/admin.tail.php');
?>
