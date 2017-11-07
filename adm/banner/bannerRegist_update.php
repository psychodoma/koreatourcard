<?php
$sub_menu = '850300';
include_once('./_common.php');
include_once('../admin.lib.php');
include_once('./admin.banner.lib.php');


if ($W == 'd')
    auth_check($auth[$sub_menu], "d");
else
    auth_check($auth[$sub_menu], "w");

check_admin_token();

if ($w=="")
{
    sql_query("alter table g5_shop_banner_config auto_increment=1 ");

    $sql = " insert into g5_shop_banner_config
                set bn_code        = '$bn_code',
					 bn_area        = '$bn_area',
                     bn_position        = '$bn_position',
					 bn_sort        = '$bn_sort',
					 bn_desc        = '$bn_desc'";
    sql_query($sql);
	//$bn_num= sql_insert_id();

}else if($w =="u"){

	 $sql = " update g5_shop_banner_config
                 set bn_area        = '$bn_area',
                     bn_position        = '$bn_position',
					 bn_sort        = '$bn_sort',
					 bn_desc        = '$bn_desc'
				where bn_code = '$bn_code' ";
    sql_query($sql);

}else if($w =="d"){
	 $sql = "delete from g5_shop_banner_config where bn_code = '$bn_code'";
     $result = sql_query($sql);
}


if ($w == "" || $w == "u")
{
    goto_url("./bannerRegist.php");
} else {
    goto_url("./bannerRegist.php");
}
?>
