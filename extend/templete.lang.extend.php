<?php

/// 다국어 이용
if( !(isset($config['cf_theme']) && trim($config['cf_theme'])) 
    /*&& preg_match('/^theme_/', $g5['tmpl'])*/ 
    /*&& !(defined('G5_IS_ADMIN') && G5_IS_ADMIN)*/ ) {

    // 테마 설정 로드
    if(is_file(G5_TMPL_PATH.'/theme.config.php'))
        include_once(G5_TMPL_PATH.'/theme.config.php');
    if(is_file(G5_MOBILE_TMPL_PATH.'/theme.config.php'))
        include_once(G5_MOBILE_TMPL_PATH.'/theme.config.php');
}

if(defined('ENABLE_MODULE_G5') && ENABLE_MODULE_G5) {
    $g5['use_multi_lang'] = 0;
    unset($_SESSION['lang']);
    $g5['lang_button_ok'] = 0;
} else if(defined('G5_USE_MULTI_LANG') and G5_USE_MULTI_LANG) {
    if(defined('G5_USE_MULTI_LANG_SINGLE') and G5_USE_MULTI_LANG_SINGLE) {
        $g5['use_multi_lang'] = 1;
        $g5['lang_button_ok'] = 0;
    } else if(G5_THEME_MULTI_LANG === true) {
        $g5['use_multi_lang'] = 1;
        $g5['lang_button_ok'] = 1;
    } else if(defined('G5_IS_ADMIN') && G5_IS_ADMIN) {
        $g5['use_multi_lang'] = 1;
        $g5['lang_button_ok'] = 0;
    } else {
        $g5['use_multi_lang'] = 0;
        $g5['lang_button_ok'] = 0;
    }
///} else if(defined('G5_USE_GLOBAL_LANG') and G5_USE_GLOBAL_LANG) {
///    $g5['use_multi_lang'] = 1;
///    $g5['lang_button_ok'] = 0;
} else {
    $g5['use_multi_lang'] = 0;
    unset($_SESSION['lang']);
    $g5['lang_button_ok'] = 0;
}

define('G5_LOCALE_PATH', G5_PATH.'/locale');
define('G5_LOCALE_IMG_PATH', G5_PATH.'/locale/img');

define('G5_LOCALE_URL', G5_URL.'/locale');
define('G5_LOCALE_IMG_URL', G5_URL.'/locale/img');

$g5['locale_path']     = G5_LOCALE_PATH;
$g5['locale_url']      = G5_LOCALE_URL;
$g5['locale_img_path'] = G5_LOCALE_IMG_PATH;
$g5['locale_img_url']  = G5_LOCALE_IMG_URL;

include_once $g5['locale_path'].'/basic/lang_name_list.inc.php';

/// 다국어 지원 목록
if($config2w_def['lang_list_all'])
    $g5['lang_list_all'] = array_map('trim',explode('|', $config2w_def['lang_list_all']));
else
    $g5['lang_list_all'] = array_keys($g5['lang_name_list']);

if($config2w_def['lang_list'])
    $g5['lang_list'] = array_map('trim',explode('|', $config2w_def['lang_list']));
else
    $g5['lang_list'] = array( 'ko_KR', 'en_US', 'zh_CN', 'ja_JP', 'ru_RU', 'fr_FR', 'de_DE', 'es_ES', 'ar' );

/// Javascript language list
foreach ($g5['lang_list'] as $val) {
    $g5['lang_js_list'][$val] = strtr($val, '_', '-');
}



// 2017-09-11 김지환 ( 각 페이지 언어별로 구분하기 위해서 우선 추가하였다. )


if( isset($_GET['lang']) ){
	if( $_GET['lang'] == "ko" ){
		$_GET['lang'] = "ko_KR";
		$_SESSION['lang'] = "ko_KR";
	}else if( $_GET['lang'] == "kr" ){
		$_GET['lang'] = "ko_KR";
		$_SESSION['lang'] = "ko_KR";
	}else if( $_GET['lang'] == "en" ){
		$_GET['lang'] = "en_US";
		$_SESSION['lang'] = "en_US";
	}else if( $_GET['lang'] == "jp" ){
		$_GET['lang'] = "ja_JP";
		$_SESSION['lang'] = "ja_JP";
	}else if( $_GET['lang'] == "cn" ){
		$_GET['lang'] = "zh_CN";
		$_SESSION['lang'] = "zh_CN";
	}else if( $_GET['lang'] == "tw" ){
		$_GET['lang'] = "zh_TW";
		$_SESSION['lang'] = "zh_TW";
	}else{
		$_GET['lang'] = "ko_KR";
		$_SESSION['lang'] = "ko_KR";
	}
}



// 2017-09-05 김지환 ( 다국어 페이지 /en, /jp... 이런것때문에 어쩔수없지.. ㅠㅠ )
$lang_url = $_SERVER["REQUEST_URI"];
$lang_url = explode("/",$lang_url);

if( $lang_url[1] == "en" ){
	$_SESSION['lang'] = "en_US";
}else if( $lang_url[1] == "jp" ){
	$_SESSION['lang'] = "ja_JP";
}else if( $lang_url[1] == "cn" ){
	$_SESSION['lang'] = "zh_CN";
}else if( $lang_url[1] == "tw" ){
	$_SESSION['lang'] = "zh_TW";
}else if( $lang_url[1] == "ko" ){
	$_SESSION['lang'] = "ko_KR";
}else if( $lang_url[1] == "kr" ){
	$_SESSION['lang'] = "ko_KR";
}
// 끝


$lang = $_SESSION['lang'];
$g5['lang'] = $_SESSION['lang'];




/// 다국어 베이스 언어. 번역 메시지 코딩 언어
$g5['base_lang'] = "ko_KR";
/// 다국어 기본(default) 설정 언어
$g5['def_lang'] = $config2w_def['lang'] ? $config2w_def['lang'] : "ko_KR";
/// 다국어 실시간 번역 언어
$g5['tr_lang'] = "en_US"; // 실시간 번역에서만 사용
/// 언어 선택 버튼 언어
$g5['buton_lang'] = "en_US"; // 실시간 번역에서만 사용

if(0) { ///
/// 다국어 허용 템플릿
if(G5_IS_MOBILE) {
    if(!preg_match("/ml_|gl_/", $g5['mobile_tmpl'])) {
        unset($_SESSION['lang']);
        $g5['lang_button_ok'] = 0;
        $g5['is_ml_tmpl'] = 0;
    } else {
        $g5['is_ml_tmpl'] = 1;
    }
} else {
    if(!preg_match("/ml_|gl_/", $g5['tmpl'])) {
        unset($_SESSION['lang']);
        $g5['lang_button_ok'] = 0;
        $g5['is_ml_tmpl'] = 0;
    } else {
        $g5['is_ml_tmpl'] = 1;
    }
}
} ///

/// 단일 언어 지원시 lang session, button 리셋
if(count($g5['lang_list']) == 1) {
    unset($_SESSION['lang']);
    $g5['lang_button_ok'] = 0;
}

/// 다국어 현재 설정 언어
$g5['lang'] = $_SESSION['lang'] ? $_SESSION['lang'] : $g5['def_lang'];

/// 다국어 domain, path
$g5['ml_domain'] = 'messages';
$g5['ml_path'] = $g5['locale_path'].'/lang';

/// gettext 사용
$g5['use_gettext'] = 0;

///if($g5['use_multi_lang'] && $g5['is_ml_tmpl']) {
if($g5['use_multi_lang']) {
    if($g5['lang'] == $g5['base_lang']) $g5['is_trans'] = 0;
    else $g5['is_trans'] = 1;
} else {
    $g5['is_trans'] = 0;
}

$g5['config_ml_table']          = G5_TABLE_PREFIX."config_ml";
$g5['board_ml_table']           = G5_TABLE_PREFIX."board_ml";
$g5['board_write_ml_table']     = G5_TABLE_PREFIX."board_write_ml";
$g5['group_ml_table']           = G5_TABLE_PREFIX."group_ml";
$g5['poll_ml_table']            = G5_TABLE_PREFIX."poll_ml";
$g5['content_ml_table']         = G5_TABLE_PREFIX."content_ml";
$g5['faq_ml_table']             = G5_TABLE_PREFIX."faq_ml";
$g5['faq_master_ml_table']      = G5_TABLE_PREFIX."faq_master_ml";
$g5['qa_config_ml_table']       = G5_TABLE_PREFIX."qa_config_ml";
$g5['qa_content_ml_table']      = G5_TABLE_PREFIX.'qa_content_ml'; /// no use
$g5['new_win_ml_table']         = G5_TABLE_PREFIX."new_win_ml"; /// no use

$g5['config2w_ml_table']        = G5_TABLE_PREFIX."config2w_ml";
$g5['config2w_def_ml_table']    = G5_TABLE_PREFIX."config2w_def_ml";
$g5['config2w_menu_ml_table']   = G5_TABLE_PREFIX."config2w_menu_ml";

if (defined('G5_USE_SHOP') and G5_USE_SHOP) {
$g5['shop_default_ml_table']    = G5_SHOP_TABLE_PREFIX.'default_ml';
$g5['shop_category_ml_table']   = G5_SHOP_TABLE_PREFIX.'category_ml';
$g5['shop_item_ml_table']       = G5_SHOP_TABLE_PREFIX.'item_ml';
}

if (defined('G5_USE_CONTENTS') and G5_USE_CONTENTS) {
$g5['contents_default_ml_table']  = G5_CONTENTS_TABLE_PREFIX.'default_ml';
$g5['contents_category_ml_table'] = G5_CONTENTS_TABLE_PREFIX.'category_ml';
$g5['contents_item_ml_table']     = G5_CONTENTS_TABLE_PREFIX.'item_ml';
}

///if(sql_query(" SHOW TABLES LIKE '{$g5['config_ml_table']}' ", false)) 
$row = sql_fetch(" select * from {$g5['config_ml_table']} limit 1 ");
if(isset($row['cf_title']))
    $g5['is_db_trans_possible'] = 1;
else
    $g5['is_db_trans_possible'] = 0;

if($g5['is_trans']) {
    /// check lang db ok simply
    $row = sql_fetch(" select * from {$g5['config_ml_table']} where lang='{$g5['lang']}' ");
    ///if(isset($row['cf_title']) && preg_match("/ml_/", $g5['tmpl']))
    if(defined('G5_USE_MULTI_LANG_DB') && G5_USE_MULTI_LANG_DB && isset($row['cf_title']) && file_exists($g5['locale_path'].'/lib/lang.lib.php'))
        { $g5['is_db_trans'] = 1; /* $g5['lang_button_ok'] = 1; */ }
    else
        { $g5['is_db_trans'] = 0; /* $g5['lang_button_ok'] = 0; */ }
}

if($g5['is_trans'] 
    && (defined('_THEME_PREVIEW_') && _THEME_PREVIEW_ === true || !(defined('G5_IS_ADMIN') && G5_IS_ADMIN))) {
    /// lang pack
    if($g5['use_gettext'] && function_exists('gettext')) {
        ///putenv('LANG='.$g5['lang']);
        ///setlocale(LC_MESSAGES, $g5['lang']);
        putenv('LC_ALL='.$g5['lang']);
        setlocale(LC_ALL, $g5['lang']);
        bindtextdomain($g5['ml_domain'], $g5['ml_path']);
        bind_textdomain_codeset($g5['ml_domain'], 'utf8');
        textdomain($g5['ml_domain']);
    } else {
        include_once $g5['ml_path']."/". $g5['lang']."/LC_MESSAGES/messages.inc.php";
    }

    /// g5[title]을 위한 변환: fm_subject, qa_title 등은 head.sub.php, 템플릿의 head.php에서 랭귀지 팩 변환)

    /// lang db
    if($g5['is_db_trans']) {
        include_once $g5['locale_path'].'/lib/lang.lib.php';
        include_once $g5['locale_path'].'/include/lang_db.inc.php';
        if (defined('G5_USE_SHOP') and G5_USE_SHOP) {
            include_once $g5['locale_path'].'/include/shop.lang_db.inc.php';
        }
        if (defined('G5_USE_CONTENTS') and G5_USE_CONTENTS) {
            include_once $g5['locale_path'].'/include/contents.lang_db.inc.php';
        }
    } else {
        $config['cf_title'] = _t($config['cf_title']);
        $config['cf_stipulation'] = _t($config['cf_stipulation']);
        $config['cf_privacy'] = _t($config['cf_privacy']);
        for($i = 1; $i <= 20; $i++) {
            ${'cf_'.$i} = _t(${'cf_'.$i});
        }

        $config2w_def_tmpl_fields = array( 'cf_header_logo', 'cf_site_name', 'cf_site_addr', 'cf_zip', 'cf_tel', 'cf_fax', 'cf_email', 'cf_site_owner', 'cf_biz_num', 'cf_ebiz_num', 'cf_info_man', 'cf_info_email', 'cf_copyright', 'cf_keywords', 'cf_description');
        foreach ($config2w_def_tmpl_fields as $val) {
            $config2w_def[$val] = _t($config2w_def[$val]);
        }

        if(is_array($config2w_def)) {
            $config2w = array_merge($config2w, array_filter($config2w_def));
        }

        if($bo_table) {
            $board['bo_subject'] = _t($board['bo_subject']);
            if(G5_IS_MOBILE && $board['bo_mobile_subject'])
                $board['bo_mobile_subject'] = _t($board['bo_mobile_subject']);
            $group['gr_subject'] = _t($group['gr_subject']);
        } else if ($gr_id) {
            $group['gr_subject'] = _t($group['gr_subject']);
        }

        if (defined('G5_USE_SHOP') and G5_USE_SHOP) {
            $default['de_admin_company_owner'] = _t($default['de_admin_company_owner']);
            $default['de_admin_company_name']  = _t($default['de_admin_company_name']);
            $default['de_admin_company_addr']  = _t($default['de_admin_company_addr']);
            $default['de_admin_info_name']     = _t($default['de_admin_info_name']);
            $default['de_admin_tongsin_no']    = _t($default['de_admin_tongsin_no']); 
            $default['de_admin_buga_no']       = _t($default['de_admin_buga_no']);
            $default['de_delivery_company']    = _t($default['de_delivery_company']);
            $default['de_baesong_content']     = _t($default['de_baesong_content']);
            $default['de_change_content']      = _t($default['de_change_content']);
        }
        if (defined('G5_USE_CONTENTS') and G5_USE_CONTENTS) {
            $setting['de_admin_company_owner'] = _t($setting['de_admin_company_owner']);
            $setting['de_admin_company_name']  = _t($setting['de_admin_company_name']);
            $setting['de_admin_company_addr']  = _t($setting['de_admin_company_addr']);
            $setting['de_admin_info_name']     = _t($setting['de_admin_info_name']);
            $setting['de_admin_tongsin_no']    = _t($setting['de_admin_tongsin_no']); 
            $setting['de_admin_buga_no']       = _t($setting['de_admin_buga_no']);
        }
    }
} /// is trans
?>
