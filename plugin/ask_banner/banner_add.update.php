<?php

/*
 * Banner Add Update
 */
include_once './_common.php';
include_once './_lib/banner.lib.php';
include_once './_lib/config.php';

if (!$_POST) {
    alert('잘못된 접속입니다.');
    exit;
}

use AskForm\GUMP;
use AskForm\Upload;

$gump = new GUMP();

//값 검사

$val_arr = array();
$fil_arr = array();

//default
$val_arr = array('ba_name' => 'required',
    'ba_gr_idx' => 'required',
    'ba_type' => 'required');
$fil_arr = array('ba_name' => 'trim|sanitize_string',
    'ba_gr_idx' => 'trim|sanitize_string',
    'ba_type' => 'trim|sanitize_string');

//text
if ($ba_type == 'text') {
    $val_arr += array('ba_url' => 'required|valid_url', 'ba_text' => 'required|min_len,2');
    $fil_arr += array('ba_url' => 'trim|sanitize_string', 'ba_text' => 'trim|sanitize_string');
}
//image
if ($ba_type == 'image') {
    $val_arr += array('ba_url' => 'required|valid_url', 'ba_image' => 'required_file|extension,png,jpg,gif');
    $fil_arr += array('ba_url' => 'trim|sanitize_string', 'ba_text' => 'trim|sanitize_string');
}
//html
if ($ba_type == 'html') {
    $val_arr += array('ba_html' => 'required|min_len,10');
    $fil_arr += array('ba_html' => 'trim');
}
//time
if ($ba_use_time) {
    $val_arr += array('ba_startday' => 'required|date', 'ba_endday' => 'required|date');
    $fil_arr += array('ba_startday' => 'trim|sanitize_string', 'ba_endday' => 'trim|sanitize_string');
}

$gump->validation_rules($val_arr);
$gump->filter_rules($fil_arr);
$data = $gump->run($_POST);

if ($data === false) {
    include_once './ask_header.php';
    echo $gump->get_readable_errors(true);
    echo "<div class='error_page_btn'><a href='./banner_add.php' class='btn btn-warning'>확인</a></div>";
    include_once './ask_footer.php';
} else {
    // validation successful
    //text
    if ($ba_type == 'text') {
        $ba_type_query = " ba_url = '{$data['ba_url']}', ";
        $ba_type_query .= " ba_text = '{$data['ba_text']}', ";
    }
    //image
    if ($ba_type == 'image') {
        $ba_type_query = " ba_url = '{$data['ba_url']}', ";
        //File Upload
        if (!empty($_FILES['ba_image']['tmp_name'])) {
            $upload = Upload::factory(ASK_UPLOAD_DIR, ASK_UPLOAD_PATH);
            $upload->file($_FILES['ba_image']);

            //set max. file size (in mb)
            $upload->set_max_file_size(5);

            //set allowed mime types
            $upload->set_allowed_mime_types(array('image/gif', 'image/jpeg', 'image/png'));

            $upload_result = $upload->upload();

            
            $ba_type_query .= " ba_image = '{$upload_result['filename']}', ";
        }
    }
    //html
    if ($ba_type == 'html') {
        $ba_type_query = " ba_html = '{$data['ba_html']}', ";
    }

    if (!$w) {
        //DB Insert
        $sql = "insert into " . ASK_BANNER_TABLE . " set ba_name = '{$data['ba_name']}', "
                . " ba_gr_idx = '{$data['ba_gr_idx']}', "
                . " ba_type = '{$data['ba_type']}', "
                . $ba_type_query
                . " ba_use_time = '{$data['ba_use_time']}', "
                . " ba_startday = '{$data['ba_startday']}', "
                . " ba_endday = '{$data['ba_endday']}'";
        sql_query($sql);
        $idx = sql_insert_id();
        alert('등록되었습니다.', "./banner_add.php?idx={$idx}&w=u");
    } elseif ($w == 'u') {
        if (!$ba_idx) {
            alert('잘못된 접속');
            exit;
        }
        $sql = "update " . ASK_BANNER_TABLE . " set "
                . "ba_name = '{$data['ba_name']}', "
                . " ba_gr_idx = '{$data['ba_gr_idx']}', "
                . " ba_type = '{$data['ba_type']}', "
                . $ba_type_query
                . " ba_use_time = '{$data['ba_use_time']}', "
                . " ba_startday = '{$data['ba_startday']}', "
                . " ba_endday = '{$data['ba_endday']}'"
                . " where ba_idx = '{$ba_idx}' limit 1";
        sql_query($sql);
        alert('수정되었습니다.', "./banner_add.php?idx={$ba_idx}&w=u");
    }
}