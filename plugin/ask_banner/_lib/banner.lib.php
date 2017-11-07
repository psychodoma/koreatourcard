<?php
/*
 * ASK Banner Library
 */
if (!defined('_GNUBOARD_')) {
    exit;
} // 개별 페이지 접근 불가

function __autoload($className) {
    $className = strtolower($className);
    $className = str_replace("\\", '/', $className);
    $className .= '.class.php';
    $classpath = G5_PLUGIN_PATH . '/ask_banner/class/' . $className;
    if (file_exists($classpath)) {
        require_once($classpath);
        return true;
    }
    return false;
}

function ask_group_list() {
    $sql = "select * from " . ASK_GROUP_TABLE;
    $result = sql_query($sql);
    $i = 0;
    /*
     * Key=>Value 형태 배열로 넘겨준다.
     */
    while ($rows = sql_fetch_array($result)) {
        $data[$rows['gr_idx']] = $rows['gr_name'];
        $i++;
    }
    return $data;
}
