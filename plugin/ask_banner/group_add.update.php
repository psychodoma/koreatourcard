<?php

/*
 * Group Add Update
 */
include_once './_common.php';
include_once './_lib/banner.lib.php';
include_once './_lib/config.php';

if (!$_POST) {
    alert('잘못된 접속입니다.');
    exit;
}

use AskForm\GUMP;

$gump = new GUMP();

//값 검사
$_POST = $gump->sanitize($_POST);
$gump->validation_rules(array(
    'gr_name' => 'required',
    'gr_memo' => 'min_len,0'
));

$gump->filter_rules(array(
    'gr_name' => 'trim|sanitize_string',
    'gr_memo' => 'sanitize_string'
));
$data = $gump->run($_POST);

if ($data === false) {
    include_once './ask_header.php';
    echo $gump->get_readable_errors(true);
    echo "<div class='error_page_btn'><a href='./group_add.php' class='btn btn-warning'>확인</a></div>";
    include_once './ask_footer.php';
} else {
    // validation successful
    if (!$w) {
        //중복된 그룹 이름은 가입 불가
        $check = sql_fetch("select count(*) as cnt from " . ASK_GROUP_TABLE . " where gr_name = '{$data['gr_name']}'");
        if ($check['cnt'] > 0) {
            alert('이미 가입된 그룹명입니다. 중복된 그룹명은 사용할 수 없습니다.');
            exit;
        }
        //DB Insert
        $sql = "insert into " . ASK_GROUP_TABLE . " set gr_name= '{$data['gr_name']}', "
                . " gr_memo = '{$data['gr_memo']}'";
        sql_query($sql);
        $idx = sql_insert_id();
        alert('등록되었습니다.', "./group_add.php?idx={$idx}&w=u");
    } elseif ($w == 'u') {
        if (!$gr_idx) {
            alert('잘못된 접속');
            exit;
        }
        $sql = "update " . ASK_GROUP_TABLE . " set "
                . " gr_name = '{$data['gr_name']}', "
                . " gr_memo = '{$data['gr_memo']}'"
                . " where gr_idx = '{$gr_idx}' limit 1";
        sql_query($sql);
        alert('수정되었습니다.', "./group_add.php?idx={$gr_idx}&w=u");
    }
}