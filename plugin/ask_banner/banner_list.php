<?php

/*
 * 
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
$pageheader->title = '배너목록!';
$pageheader->contents = '배너 목록 보기, 수정, 삭제 가능합니다.';
$pageheader->display();

//페이징 설정
$sql = "select count(*) as cnt from " . ASK_BANNER_TABLE . "";
$rows_count = sql_fetch($sql);
if (!$rows_count) {
    alert('배너를 하나 이상 등록해야 됩니다.');
    exit;
}
$pages = new Paginator($rows_count['cnt'], 9, array(15, 3, 6, 9, 12, 25, 50, 100, 250, 'All'));

//목록
$sql = "select * from " . ASK_BANNER_TABLE . " limit {$pages->limit_start}, {$pages->limit_end} ";
$result = sql_query($sql);
$list = array();
while ($rows = sql_fetch_array($result)) {
    //배열 가공
    $rows['manage'] = "<a href='./banner_add.php?idx={$rows['ba_idx']}&w=u' class='btn btn-primary'>수정</a>";
    if ($rows['ba_type'] == 'text') {
        $rows['preview'] = "<a href='{$rows['ba_url']}' target='_blank'>{$rows['ba_text']}</a>";
    }
    if ($rows['ba_type'] == 'image') {
        $rows['preview'] = "<div class='attach_preview'><a href='{$rows['ba_url']}' target='_blank'><img src='" . ASK_UPLOAD_URL . "{$rows['ba_image']}' ></a></div>";
    }
    if ($rows['ba_type'] == 'html') {
        $rows['preview'] = htmlentities($rows['ba_html']);
    }
    $list[] = $rows;
}

//랜더링
$table = new Lists;
$table->header = array('No', '배너명', '그룹', '배너종류', '배너', '관리'); //타이틀
$table->field = array('ba_idx', 'ba_name', 'ba_gr_idx', 'ba_type', 'preview', 'manage'); //가져올필드
$table->body = $list; //배열할당
$table->class = 'banner_list';
$table->display(); //출력
//페이징 출력
echo "<div class='paging-wrap'>";
echo $pages->display_pages();
echo "<span class=\"\">" . $pages->display_jump_menu() . $pages->display_items_per_page() . "</span>";
//echo "<p class=\"paginate\">Page: $pages->current_page of $pages->num_pages</p>\n";
echo "</div>";

include_once './ask_footer.php';
