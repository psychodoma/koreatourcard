<?php
if (!defined('_GNUBOARD_')) exit;


// 배너출력
function display_banner($position, $skin='',$lang='ko_KR')
{
    global $g5;
    if (!$position) $position = _t('메인');
    if (!$skin) $skin = 'mainbanner.skin.php';

    $skin_path = G5_THEME_PATH.'/skin/banner/'.$skin;

    if(G5_IS_MOBILE)
        $skin_path = G5_MOBILE_PATH.'/skin/banner/'.$skin;
	

    if(file_exists($skin_path)) {
        // 접속기기
        $sql_device = " and ( bn_device = 'both' or bn_device = 'pc' ) ";
        if(G5_IS_MOBILE)
            $sql_device = " and ( bn_device = 'both' or bn_device = 'mobile' ) ";
		
		if($position == "mp4"){
			$order = " rand() limit 3";
		}else{
			$order = " bn_order, bn_id desc";
		}

        // 배너 출력

        $sql = " select * from g5_shop_banner where '".G5_TIME_YMDHIS."' between bn_begin_time and bn_end_time $sql_device and bn_position = '$position' order by ".$order;
        
		$result = sql_query($sql);

        include $skin_path;
    } else {
        echo '<p>'.str_replace(G5_PATH.'/', '', $skin_path)._t('파일이 존재하지 않습니다.').'</p>';
    }
}

function bannerLang($lang){
	$langslot= '';
	
	if($lang != 'ko_KR'){
		$langslot = substr($lang,-2,2).'/';
	}

	return $langslot;
}


function bannerURL($lang){
	$linkeURL = '';
	if($lang != 'ko_KR'){
		$linkeURL = substr(strtolower($lang),2,3);
	}

	return $linkeURL;
}

?>


