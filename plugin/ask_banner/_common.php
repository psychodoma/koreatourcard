<?php
include_once('../../common.php');
if(!$is_admin == 'super'){
    echo "접속권한이 없습니다.";
    exit;
}