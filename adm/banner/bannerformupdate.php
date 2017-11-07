<?php
$sub_menu = '850500';
include_once('./_common.php');
include_once('../admin.lib.php');

include_once('./admin.banner.lib.php');
check_demo();

if ($W == 'd')
    auth_check($auth[$sub_menu], "d");
else
    auth_check($auth[$sub_menu], "w");

check_admin_token();

@mkdir(G5_DATA_PATH."/banner", G5_DIR_PERMISSION);
@chmod(G5_DATA_PATH."/banner", G5_DIR_PERMISSION);


$now = date("Y-m-d H:i:s", time());

$bn_bimg      = $_FILES['bn_bimg']['tmp_name'];
$bn_bimg_name = $_FILES['bn_bimg']['name'];

$bn_bimg_US      = $_FILES['bn_bimg_US']['tmp_name'];
$bn_bimg_US_name = $_FILES['bn_bimg_US']['name'];

$bn_bimg_JP      = $_FILES['bn_bimg_JP']['tmp_name'];
$bn_bimg_JP_name = $_FILES['bn_bimg_JP']['name'];

$bn_bimg_CN      = $_FILES['bn_bimg_CN']['tmp_name'];
$bn_bimg_CN_name = $_FILES['bn_bimg_CN']['name'];

$bn_bimg_TW      = $_FILES['bn_bimg_TW']['tmp_name'];
$bn_bimg_TW_name = $_FILES['bn_bimg_TW']['name'];

if ($bn_bimg_del)  @unlink(G5_DATA_PATH."/banner/$bn_id");
if ($bn_bimg_US_del)  @unlink(G5_DATA_PATH."/banner/US/$bn_id");
if ($bn_bimg_JP_del)  @unlink(G5_DATA_PATH."/banner/JP/$bn_id");
if ($bn_bimg_CN_del)  @unlink(G5_DATA_PATH."/banner/CN/$bn_id");
if ($bn_bimg_TW_del)  @unlink(G5_DATA_PATH."/banner/TW/$bn_id");


if ($w=="")
{
    if (!$bn_bimg_name) alert('배너 이미지를 업로드 하세요.');

    sql_query(" alter table {$g5['g5_shop_banner_table']} auto_increment=1 ");

    $sql = " insert into {$g5['g5_shop_banner_table']}
                set bn_alt        = '$bn_alt',
                    bn_url        = '$bn_url',
					bn_url_us        = '$bn_url_us',
					bn_url_jp        = '$bn_url_jp',
					bn_url_cn        = '$bn_url_cn',
					bn_url_tw        = '$bn_url_tw',
                    bn_device     = '$bn_device',
                    bn_position   = '$bn_position',
					bn_area   =  '$bn_code',
                    bn_border     = '$bn_border',
                    bn_new_win    = '$bn_new_win',
                    bn_begin_time = '$bn_begin_time',
                    bn_end_time   = '$bn_end_time',
                    bn_time       = '$now',
					reg_time      = '$now',
                    bn_hit        = '0',
                    bn_order      = '$bn_order' ";
    sql_query($sql);

    $bn_id = sql_insert_id();
}
else if ($w=="u")
{
    $sql = " update {$g5['g5_shop_banner_table']}
                set bn_alt        = '$bn_alt',
                    bn_url        = '$bn_url',
					bn_url_us        = '$bn_url_us',
					bn_url_jp        = '$bn_url_jp',
					bn_url_cn        = '$bn_url_cn',
					bn_url_tw        = '$bn_url_tw',
                    bn_device     = '$bn_device',
                    bn_position   = '$bn_position',
					bn_area   =  '$bn_code',
                    bn_border     = '$bn_border',
                    bn_new_win    = '$bn_new_win',
                    bn_begin_time = '$bn_begin_time',
                    bn_end_time   = '$bn_end_time',
                    bn_order      = '$bn_order'
              where bn_id = '$bn_id' ";
    sql_query($sql);
}
else if ($w=="d")
{
    @unlink(G5_DATA_PATH."/banner/$bn_id");
	@unlink(G5_DATA_PATH."/banner/US/$bn_id");
	@unlink(G5_DATA_PATH."/banner/JP/$bn_id");
	@unlink(G5_DATA_PATH."/banner/CN/$bn_id");
	@unlink(G5_DATA_PATH."/banner/TW/$bn_id");

    $sql = " delete from {$g5['g5_shop_banner_table']} where bn_id = $bn_id ";
    $result = sql_query($sql);
}


if ($w == "" || $w == "u")
{
    if ($_FILES['bn_bimg']['name']) upload_file($_FILES['bn_bimg']['tmp_name'], $bn_id, G5_DATA_PATH."/banner");
	if ($_FILES['bn_bimg_US']['name']) upload_file($_FILES['bn_bimg_US']['tmp_name'], $bn_id, G5_DATA_PATH."/banner/US");
	if ($_FILES['bn_bimg_JP']['name']) upload_file($_FILES['bn_bimg_JP']['tmp_name'], $bn_id, G5_DATA_PATH."/banner/JP");
	if ($_FILES['bn_bimg_CN']['name']) upload_file($_FILES['bn_bimg_CN']['tmp_name'], $bn_id, G5_DATA_PATH."/banner/CN");
	if ($_FILES['bn_bimg_TW']['name']) upload_file($_FILES['bn_bimg_TW']['tmp_name'], $bn_id, G5_DATA_PATH."/banner/TW");

    goto_url("./bannerform.php?w=u&amp;bn_id=$bn_id");
} else {
    goto_url("./bannerlist.php");
}

?>
