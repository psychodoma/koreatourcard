<?php

/*
 * Banner Delete
 */
include_once './_common.php';
include_once './_lib/banner.lib.php';
include_once './_lib/config.php';

if (!$_GET) {
    alert('잘못된 접속입니다. #1');
    exit;
}
if (!$is_admin) {
    alert('잘못된 접속입니다. #2');
    exit;
}
if (!$idx) {
    alert('잘못된 접속입니다. #3');
    exit;
}
if (filter_var($idx, FILTER_SANITIZE_NUMBER_INT)) {
    //첨부이미지 삭제 처리
    $sql = "select * from " . ASK_BANNER_TABLE . " where ba_idx = '{$idx}' ";
    $row = sql_fetch($sql);
    if($row['ba_type'] == 'image'){
        @unlink(ASK_UPLOAD_FULL_PATH . $row['ba_image']);
    }
    $sql = "delete from " . ASK_BANNER_TABLE . " where ba_idx = '{$idx}' limit 1 ";
    sql_query($sql);
    alert('삭제되었습니다.', './banner_list.php');
} else {
    alert('잘못된 접속입니다. #4');
    exit;
}