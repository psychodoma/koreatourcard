<?php
/* 배너클릭수 조회 _ arcthan*/
include_once("./_common.php");
include_once('/lib/common.lib.php');

$g5[g5_shop_banner_table] = 'g5_shop_banner';

$now = date("Y-m-d H:i:s", time());


if(!$lang){
	$lang =  substr($HTTP_ACCEPT_LANGUAGE,0,5);
}

$userdevice = 'pc';

if(G5_IS_MOBILE)
{
	$userdevice = 'mobile';
}

$sqlQuery = "insert into g5_shop_banner_click
		set bn_id        = '$bn_id',
   bn_datetime        = '$now',
   		   user_ip        = '$sIP',
		  bn_lang        = '$lang',
	user_agent         = '$userdevice'";
	
sql_query($sqlQuery);
//echo $sqlQuery;

if (get_cookie('ck_bn_id') != $bn_id)
{
    $sql = " update {$g5['g5_shop_banner_table']} set bn_hit = bn_hit + 1 where bn_id = '$bn_id' ";
    sql_query($sql);
	
    // 하루 동안
    set_cookie("ck_bn_id", $bn_id, 60*60*24);
}

goto_url($url);



?>
