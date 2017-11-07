<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    //include_once(G5_MOBILE_PATH.'/head_sub.php');
    include_once(G5_THEME_MOBILE_PATH.'/mobile_head.php');
    return;
}

if(defined('G5_THEME_PATH')){
    include_once(G5_THEME_PATH.'/head_sub.php');

}else{
    include_once($g5['tmpl_path'].'/head_sub.php'); ///goodbuilder
}
?>
