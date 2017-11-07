<?php

/*
 * Group List
 */
include_once './_common.php';
include_once './_lib/banner.lib.php';
include_once './_lib/config.php';
include_once './ask_header.php';

use Page\PageHeader;
use Lists\Lists;
use Paging\Paginator;

//해더
$pageheader = new PageHeader;
$pageheader->title = '그룹목록';
$pageheader->contents = '그룹 목록, 수정, 삭제 가능합니다.';
$pageheader->display();

//페이징 설정
$sql = "select count(*) as cnt from " . ASK_GROUP_TABLE . "";
$rows_count = sql_fetch($sql);
if (!$rows_count) {
    alert('그룹을 하나 이상 생성해야 됩니다.');
    exit;
}
$pages = new Paginator($rows_count['cnt'], 9, array(15, 3, 6, 9, 12, 25, 50, 100, 250, 'All'));

//목록
$sql = "select * from " . ASK_GROUP_TABLE . " limit {$pages->limit_start}, {$pages->limit_end} ";
$result = sql_query($sql);
$list = array();
while ($rows = sql_fetch_array($result)) {
    //배열 가공
    if ($rows['gr_open'] == 1) {
        $rows['gr_open'] = "회원등록가능";
    } else {
        $rows['gr_open'] = "관리자전용";
    }

    $rows['manage'] = "<a href='./group_add.php?idx={$rows['gr_idx']}&w=u' class='btn btn-primary'>수정</a>";
    $list[] = $rows;
}

//랜더링
$table = new Lists;
$table->header = array('No', '그룹명', '관리'); //타이틀
$table->field = array('gr_idx', 'gr_name', 'manage'); //가져올필드
$table->body = $list; //배열할당
$table->class = 'group_list';
$table->display(); //출력
//페이징 출력
echo "<div class='paging-wrap'>";
echo $pages->display_pages();
echo "<span class=\"\">" . $pages->display_jump_menu() . $pages->display_items_per_page() . "</span>";
//echo "<p class=\"paginate\">Page: $pages->current_page of $pages->num_pages</p>\n";
echo "</div>";

include_once './ask_footer.php';
