<?
///goodbuilder
if (!defined('G5_USE_CONTENTS') || !G5_USE_CONTENTS) return;
$menu["menu350"] = array (
	array("350000", "빌더 관리", G5_ADMIN_URL."/builder/basic_tmpl_config_form.php"),
);

$menu["menu350"] = array_merge ($menu["menu350"], array(
	array("350202", "기본 환경 설정", G5_ADMIN_URL."/builder/basic_config_form.php", "", 1),
	)
);

if(0) {

$menu["menu350"] = array_merge ($menu["menu350"], array(
	array("350201", "기본 설정", G5_ADMIN_URL."/builder/basic_config_form.php", "", 1),
	)
);

if($g5['use_multi_lang']) {
$menu["menu350"] = array_merge ($menu["menu350"], array(
	array("350800", "언어 설정", G5_ADMIN_URL."/builder/lang_config_form.php"),
        )
);
};

$menu["menu350"] = array_merge ($menu["menu350"], array(
	array("350901", "고급 설정", G5_ADMIN_URL."/builder/high_level_config_form.php"),
	)
);

}

$menu["menu350"] = array_merge ($menu["menu350"], array(
	array("350601", "템플릿 관리", G5_ADMIN_URL."/builder/basic_tmpl_config_form.php", "", 1),
	array("350302", "메뉴 관리", G5_ADMIN_URL."/builder/basic_menu_config_form.php", "", 1),
	array("350401", "화면 관리", G5_ADMIN_URL."/builder/head_config_form.php"),
	)
);

if(defined('G5_USE_TMPL_SKIN') and G5_USE_TMPL_SKIN) {
$menu["menu350"] = array_merge ($menu["menu350"], array(
	array("350902", "스킨 관리", G5_ADMIN_URL."/builder/tmpl_config_form.php", "", 1),
	)
);
}

$menu["menu350"] = array_merge ($menu["menu350"], array(
	array("350909", "모듈 관리", G5_ADMIN_URL."/builder/module"),
        )
);

if(defined('G5_USE_MULTI_LANG_DB') && G5_USE_MULTI_LANG_DB && $g5['is_db_trans_possible']) {

$menu["menu350"] = array_merge ($menu["menu350"], array(
	array("350802", "다국어 기본 관리", G5_ADMIN_URL."/builder/multi_lang/config_list.php"),
        )
);

$menu["menu350"] = array_merge ($menu["menu350"], array(
	array("350803", "다국어 게시판 관리", G5_ADMIN_URL."/builder/multi_lang/board_list.php"),
        )
);

if(defined('G5_USE_SHOP') && G5_USE_SHOP) {
$menu["menu350"] = array_merge ($menu["menu350"], array(
	array("350820", "다국어 쇼핑몰 관리", G5_ADMIN_URL."/builder/multi_lang/shop/configform.php"),
        )
);
}

if(defined('G5_USE_CONTENTS') && G5_USE_CONTENTS) {
$menu["menu350"] = array_merge ($menu["menu350"], array(
	array("350870", "다국어 컨텐츠몰 관리", G5_ADMIN_URL."/builder/multi_lang/contents/configform.php"),
        )
);
}

$menu["menu350"] = array_merge ($menu["menu350"], array(
	array("350805", "다국어 빌더 관리", G5_ADMIN_URL."/builder/multi_lang/builder/basic_config_list.php"),
        )
);

}; /// multi lang

if(0) $menu["menu350"] = array_merge ($menu["menu350"], array(
        array("350606", "작업 템플릿 설정", G5_ADMIN_URL."/builder/work_tmpl_config_form.php"),
	)
);

$menu["menu350"] = array_merge ($menu["menu350"], array(
	array("350801", "데이타베이스 업그레이드", G5_ADMIN_URL."/builder/database_form.php"),
        )
);

/// sub menu & root

$submenu["350202"] = array (
	array("350202", "기본 설정", G5_ADMIN_URL."/builder/basic_config_form.php", "", 1),
	array("350901", "고급 설정", G5_ADMIN_URL."/builder/high_level_config_form.php"),
	array("350800", "언어 설정", G5_ADMIN_URL."/builder/lang_config_form.php"),
);

$submenu["350601"] = array (
	array("350601", "템플릿 설정", G5_ADMIN_URL."/builder/basic_tmpl_config_form.php", "", 1),
	array("350201", "템플릿 기본 설정", G5_ADMIN_URL."/builder/default_basic_config_form.php", "", 1),
	array("350101", "공통 이용 설정", G5_ADMIN_URL."/builder/default_common_config_form.php", "", 1),
	array("350605", "템플릿 설정 정보", G5_ADMIN_URL."/builder/basic_tmpl_setupinfo.php"),
	array("350604", "템플릿 등록", G5_ADMIN_URL."/builder/basic_tmpl_register_form.php"),
	array("350602", "템플릿 생성", G5_ADMIN_URL."/builder/basic_tmpl_create_form.php"),
	array("350603", "템플릿 삭제", G5_ADMIN_URL."/builder/basic_tmpl_delete_form.php"),
	array("350600", "템플릿 정보", G5_ADMIN_URL."/builder/basic_tmpl_screenshot.php"),
        array("350606", "작업 템플릿 설정", G5_ADMIN_URL."/builder/work_tmpl_config_form.php"),
	array("350701", "모바일 템플릿 설정", G5_ADMIN_URL."/builder/mobile/basic_tmpl_config_form.php", "", 1),
	array("350501", "모바일 기본 설정", G5_ADMIN_URL."/builder/mobile/default_basic_config_form.php", "", 1),
	array("350102", "모바일 공통 이용 설정", G5_ADMIN_URL."/builder/mobile/default_common_config_form.php", "", 1),
	array("350705", "모바일 템플릿 설정 정보", G5_ADMIN_URL."/builder/mobile/basic_tmpl_setupinfo.php"),
	array("350704", "모바일 템플릿 등록", G5_ADMIN_URL."/builder/mobile/basic_tmpl_register_form.php"),
	array("350702", "모바일 템플릿 생성", G5_ADMIN_URL."/builder/mobile/basic_tmpl_create_form.php"),
	array("350703", "모바일 템플릿 삭제", G5_ADMIN_URL."/builder/mobile/basic_tmpl_delete_form.php"),
	array("350700", "모바일 템플릿 정보", G5_ADMIN_URL."/builder/mobile/basic_tmpl_screenshot.php"),
	array("350302", "메뉴 관리", G5_ADMIN_URL."/builder/basic_menu_config_form.php", "", 1),
	array("350401", "화면 관리", G5_ADMIN_URL."/builder/head_config_form.php"),
);

if(defined('G5_USE_TMPL_SKIN') and G5_USE_TMPL_SKIN) {
$submenu["350601"] = array_merge ($submenu["350601"], array(
	array("350902", "스킨 관리", G5_ADMIN_URL."/builder/tmpl_config_form.php", "", 1),
	)
);
}

$submenu["350902"] = array(
	array("350902", "템플릿 기본 스킨 설정", G5_ADMIN_URL."/builder/tmpl_config_form.php"),
	array("350903", "템플릿 게시판 스킨 설정", G5_ADMIN_URL."/builder/tmpl_board_list.php"),
	array("350904", "모바일 템플릿 기본 스킨 설정", G5_ADMIN_URL."/builder/mobile/tmpl_config_form.php"),
	array("350905", "모바일 템플릿 게시판 스킨 설정", G5_ADMIN_URL."/builder/mobile/tmpl_board_list.php"),
);

$submenu["350302"] = array (
	array("350302", "메뉴 설정", G5_ADMIN_URL."/builder/basic_menu_config_form.php", "", 1),
	array("350301", "메뉴 편집", G5_ADMIN_URL."/builder/menu_config_form.php"),
	array("350303", "메뉴 생성", G5_ADMIN_URL."/builder/menu_create_form.php"),
	array("350304", "메뉴 삭제", G5_ADMIN_URL."/builder/menu_delete_form.php"),
);

$submenu["350401"] = array (
	array("350401", "상단 화면 편집", G5_ADMIN_URL."/builder/head_config_form.php"),
	array("350402", "좌측 화면 편집", G5_ADMIN_URL."/builder/main_left_config_form.php"),
	array("350403", "중앙 화면 편집", G5_ADMIN_URL."/builder/main_config_form.php"),
	array("350404", "우측 화면 편집", G5_ADMIN_URL."/builder/main_right_config_form.php"),
	array("350405", "하단 화면 편집", G5_ADMIN_URL."/builder/tail_config_form.php"),
);

if(0) $submenu["350901"] = array(
	array("350901", "고급 설정", G5_ADMIN_URL."/builder/high_level_config_form.php"),
);

$submenu["350909"] = array (
	array("350909", "모듈 관리", G5_ADMIN_URL."/builder/module"),
);

$submenu["350801"] = array (
	array("350801", "데이타베이스 업그레이드", G5_ADMIN_URL."/builder/database_form.php"),
);

if(0) $submenu["350606"] = array(
        array("350606", "작업 템플릿 설정", G5_ADMIN_URL."/builder/work_tmpl_config_form.php"),
);

if(0) $submenu["350800"] = array (
	array("350800", "언어 설정", G5_ADMIN_URL."/builder/lang_config_form.php"),
);

$submenu["350805"] = array (
	array("350805", "다국어 기본 환경 설정", G5_ADMIN_URL."/builder/multi_lang/builder/basic_config_list.php"),
	array("350806", "다국어 메뉴 관리", G5_ADMIN_URL."/builder/multi_lang/builder/menu_config_list.php"),
);

$submenu["350802"] = array (
	array("350802", "다국어 기본 환경 설정", G5_ADMIN_URL."/builder/multi_lang/config_list.php"),
	array("350807", "다국어 투표 관리", G5_ADMIN_URL."/builder/multi_lang/poll_list.php"),
	array("350808", "다국어 내용 관리", G5_ADMIN_URL."/builder/multi_lang/content_list.php"),
	array("350809", "다국어 1:1문의 관리", G5_ADMIN_URL."/builder/multi_lang/qa_config.php"),
	array("350810", "다국어 FAQ 관리", G5_ADMIN_URL."/builder/multi_lang/faqmaster_list.php"),
);

$submenu["350803"] = array (
	array("350803", "다국어 게시판 제목 관리", G5_ADMIN_URL."/builder/multi_lang/board_list.php"),
	array("350804", "다국어 게시판 그룹 관리", G5_ADMIN_URL."/builder/multi_lang/boardgroup_list.php"),
	array("350811", "다국어 게시판 내용 관리", G5_ADMIN_URL."/builder/multi_lang/board_list2.php"),
);

$submenu["350820"] = array (
	array("350820", "다국어 쇼핑몰 설정 관리", G5_ADMIN_URL."/builder/multi_lang/shop/configform.php"),
	array("350821", "다국어 쇼핑몰 분류 관리", G5_ADMIN_URL."/builder/multi_lang/shop/categorylist.php"),
	array("350822", "다국어 쇼핑몰 상품 관리", G5_ADMIN_URL."/builder/multi_lang/shop/itemlist.php"),
);

$submenu["350870"] = array (
	array("350870", "다국어 컨텐츠몰 설정 관리", G5_ADMIN_URL."/builder/multi_lang/contents/configform.php"),
	array("350871", "다국어 컨텐츠몰 분류 관리", G5_ADMIN_URL."/builder/multi_lang/contents/categorylist.php"),
	array("350872", "다국어 컨텐츠몰 상품 관리", G5_ADMIN_URL."/builder/multi_lang/contents/itemlist.php"),
);

$submenu_root = array(
"350201" => "350601",
"350101" => "350601",
"350501" => "350601",
"350102" => "350601",

"350601" => "350601",
"350604" => "350601",
"350602" => "350601",
"350603" => "350601",
"350600" => "350601",
"350605" => "350601",
"350606" => "350601",
"350701" => "350601",
"350704" => "350601",
"350702" => "350601",
"350703" => "350601",
"350700" => "350601",
"350705" => "350601",

"350800" => "350202",
"350901" => "350202",
"350202" => "350202",

"350902" => "350902",
"350903" => "350902",
"350904" => "350902",
"350905" => "350902",

"350302" => "350302",
"350301" => "350302",
"350303" => "350302",
"350304" => "350302",

"350401" => "350401",
"350402" => "350401",
"350403" => "350401",
"350404" => "350401",
"350405" => "350401",

"350909" => "350909",

"350801" => "350801",

"350802" => "350802",
"350807" => "350802",
"350808" => "350802",
"350809" => "350802",
"350810" => "350802",

"350803" => "350803",
"350804" => "350803",
"350811" => "350803",

"350805" => "350805",
"350806" => "350805",

"350820" => "350820",
"350821" => "350820",
"350822" => "350820",

"350870" => "350870",
"350871" => "350870",
"350872" => "350870",
);
?>
