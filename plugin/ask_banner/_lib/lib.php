<?php

/*
 * ASK Banner Library
 */
if (!defined('_GNUBOARD_')) {
    exit;
}

/* 그룹 배너 출력용.
 * $group_name : 지정된 그룹명
 * $type : 배너종류(text,image,html, all)
 */

function ask_banner_print($group_name, $type = 'all') {
    $sql = "select * from " . ASK_GROUP_TABLE . " where gr_name = '{$group_name}'";
    $gr = sql_fetch($sql);
    if ($type == 'all') {
        $ba_type = "";
    }
    if ($type == 'text') {
        $ba_type = " ba_type = '{$type}' and ";
    }
    if ($type == 'image') {
        $ba_type = " ba_type = '{$type}' and ";
    }
    if ($type == 'html') {
        $ba_type = " ba_type = '{$type}' and ";
    }
    $sql = "select * from " . ASK_BANNER_TABLE . " where"
            . $ba_type
            . " ba_gr_idx = '{$gr['gr_idx']}'"
            . " and ((ba_use_time = '0')"
            . " or (ba_use_time = '1' and ba_startday <= '" . G5_TIME_YMD . "' and ba_endday >= '" . G5_TIME_YMD . "'))";
    $result = sql_query($sql);
    $banner = array();
    while ($row = sql_fetch_array($result)) {
        $banner[] = $row;
    }
    shuffle($banner);
    echo ask_make_banner($banner['0']);
}

function ask_make_banner($banner) {
    if ($banner['ba_type'] == 'html') {
        return $banner['ba_html'];
    }
    if ($banner['ba_type'] == 'text') {
        $tag = "<a href='{$banner['ba_url']}' target='_blank'>{$banner['ba_text']}</a>";
        return $tag;
    }
    if ($banner['ba_type'] == 'image') {
        $tag = "<a href='{$banner['ba_url']}' target='_blank'><img src='" . ASK_UPLOAD_URL . "{$banner['ba_image']}'></a>";
        return $tag;
    }
    return false;
}

//Banner Rotator
function ask_banner_rotator($group_name, $height, $time) {
    $class = cut_str(md5(base64_encode($$group_name)), 10);
    $script = "<script>function ask_banner_rotator(target_item){
			var initialFadeIn = 500;			
			var itemInterval = $time;			
			var fadeTime = 1500;
			var numberOfItems = $(target_item).length;
			var currentItem = 0;
			$(target_item).eq(currentItem).fadeIn(initialFadeIn);
			//loop through the items		
			var infiniteLoop = setInterval(function(){
				$(target_item).eq(currentItem).fadeOut(fadeTime);

				if(currentItem == numberOfItems -1){
					currentItem = 0;
				}else{
					currentItem++;
				}
				$(target_item).eq(currentItem).fadeIn(fadeTime);

			}, itemInterval);	
		} ask_banner_rotator('.{$class}');</script>";
    $sql = "select * from " . ASK_GROUP_TABLE . " where gr_name = '{$group_name}'";
    $gr = sql_fetch($sql);
    $sql = "select * from " . ASK_BANNER_TABLE . " where"
            . " ba_type = 'image' and "
            . " ba_gr_idx = '{$gr['gr_idx']}'"
            . " and ((ba_use_time = '0')"
            . " or (ba_use_time = '1' and ba_startday <= '" . G5_TIME_YMD . "' and ba_endday >= '" . G5_TIME_YMD . "'))";
    $result = sql_query($sql);
    $banner = array();
    while ($row = sql_fetch_array($result)) {
        $banner[] = $row;
    }
    shuffle($banner);

    $tag = "<div class='ask_banner_rotator' style='position:relative;overflow:hidden; height : {$height}px;'>";
    for ($i = 0; $i < count($banner); $i++) {
        $tag .= "<a href='{$banner[$i]['ba_url']}' target='_blank' class='{$class}' style='display:none;position:absolute;left:0;top:0;'><img src='" . ASK_UPLOAD_URL . "{$banner[$i]['ba_image']}'></a>";
    }
    $tag .= "</div>";
    return $tag . $script;
}
