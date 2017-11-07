<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
if(defined('G5_THEME_PATH')){
    if($info){
        //if($info == "benefit" && $wr_id || $info == "benefitshop" && $wr_id){
        //    include_once(G5_THEME_MOBILE_PATH.'/mobile_brand_head.php');  
        //}else if($info == "event" && $wr_id){
        //   include_once(G5_THEME_MOBILE_PATH.'/mobile_tourinfo_head.php');  
        //}else{
            include_once(G5_THEME_MOBILE_PATH.'/mobile_head.php');
        //}
        
    }else{
        include_once(G5_THEME_MOBILE_PATH.'/head.php');
    }

}else{
    include_once($g5['mobile_tmpl_path'].'/head.php'); ///goodbuilder
}
?>
