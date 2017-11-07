<?php
/*
 * ASK Banner Config
 */
if (!defined('_GNUBOARD_')) {
    exit;
} // 개별 페이지 접근 불가
error_reporting(E_ALL ^ E_NOTICE);
ini_set("display_errors", 1);
define('DS', DIRECTORY_SEPARATOR); //디렉토리 구분자
define('ASK_GROUP_TABLE', 'ab_group'); //그룹
define('ASK_BANNER_TABLE', 'ab_banner'); //배너
define('ASK_UPLOAD_URL', G5_DATA_URL . DS . 'ask_banner' . DS); //배너주소
define('ASK_UPLOAD_DIR', 'ask_banner'); //배너자정폴더명
define('ASK_UPLOAD_PATH', G5_DATA_PATH . DS); //배너폴더 생성될 경로
define('ASK_UPLOAD_FULL_PATH', ASK_UPLOAD_PATH . ASK_UPLOAD_DIR . DS); //배너폴더 생성될 경로
