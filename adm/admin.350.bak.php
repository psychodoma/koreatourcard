<?
///goodbuilder
$menu["menu350"] = array (
	array("350000", "빌더 관리", G5_ADMIN_URL."/builder/basic_tmpl_config_form.php"),
	array("-", "■", G5_ADMIN_URL."/builder/basic_tmpl_screenshot.php"),
	array("350601", "템플릿 설정", G5_ADMIN_URL."/builder/basic_tmpl_config_form.php", "", 1),
	array("350604", "템플릿 등록", G5_ADMIN_URL."/builder/basic_tmpl_register_form.php"),
	array("350602", "템플릿 생성", G5_ADMIN_URL."/builder/basic_tmpl_create_form.php"),
	array("350603", "템플릿 삭제", G5_ADMIN_URL."/builder/basic_tmpl_delete_form.php"),
	array("350600", "템플릿 정보", G5_ADMIN_URL."/builder/basic_tmpl_screenshot.php"),
	array("350101", "공통 이용 설정", G5_ADMIN_URL."/builder/default_config_form.php", "", 1),
	array("350201", "기본 설정", G5_ADMIN_URL."/builder/basic_config_form.php", "", 1),
	array("350301", "메뉴 관리", G5_ADMIN_URL."/builder/menu_config_form.php"),
	array("350401", "상단 화면 관리", G5_ADMIN_URL."/builder/head_config_form.php"),
	array("350402", "좌측 화면 관리", G5_ADMIN_URL."/builder/main_left_config_form.php"),
	array("350403", "중앙 화면 관리", G5_ADMIN_URL."/builder/main_config_form.php"),
	array("350404", "우측 화면 관리", G5_ADMIN_URL."/builder/main_right_config_form.php"),
	array("350405", "하단 화면 관리", G5_ADMIN_URL."/builder/tail_config_form.php"),
	array("350605", "템플릿 설정 정보", G5_ADMIN_URL."/builder/basic_tmpl_setupinfo.php"),
	array("-", "■", G5_ADMIN_URL."/builder/mobile/basic_tmpl_screenshot.php"),
	array("350701", "모바일 템플릿 설정", G5_ADMIN_URL."/builder/mobile/basic_tmpl_config_form.php", "", 1),
	array("350704", "모바일 템플릿 등록", G5_ADMIN_URL."/builder/mobile/basic_tmpl_register_form.php"),
	array("350702", "모바일 템플릿 생성", G5_ADMIN_URL."/builder/mobile/basic_tmpl_create_form.php"),
	array("350703", "모바일 템플릿 삭제", G5_ADMIN_URL."/builder/mobile/basic_tmpl_delete_form.php"),
	array("350700", "모바일 템플릿 정보", G5_ADMIN_URL."/builder/mobile/basic_tmpl_screenshot.php"),
	array("350102", "모바일 공통 이용 설정", G5_ADMIN_URL."/builder/mobile/default_config_form.php", "", 1),
	array("350501", "모바일 기본 설정", G5_ADMIN_URL."/builder/mobile/basic_config_form.php", "", 1),
	array("350705", "모바일 템플릿 설정 정보", G5_ADMIN_URL."/builder/mobile/basic_tmpl_setupinfo.php"),
	array("-", "■", G5_ADMIN_URL."/builder/high_level_config_form.php"),
	array("350901", "고급 설정", G5_ADMIN_URL."/builder/high_level_config_form.php"),
);

if(defined('G5_USE_TMPL_SKIN') and G5_USE_TMPL_SKIN) {
$menu["menu350"] = array_merge ($menu["menu350"], array(
	array("350902", "템플릿 기본 스킨 설정", G5_ADMIN_URL."/builder/tmpl_config_form.php"),
	array("350903", "템플릿 게시판 스킨 설정", G5_ADMIN_URL."/builder/tmpl_board_list.php"),
	array("350902", "모바일 템플릿 기본 스킨 설정", G5_ADMIN_URL."/builder/mobile/tmpl_config_form.php"),
	array("350903", "모바일 템플릿 게시판 스킨 설정", G5_ADMIN_URL."/builder/mobile/tmpl_board_list.php"),
        )
);
};

$menu["menu350"] = array_merge ($menu["menu350"], array(
	array("-", "■", G5_ADMIN_URL."/builder/module"),
	array("350904", "모듈 관리", G5_ADMIN_URL."/builder/module"),
	array("-", "■", G5_ADMIN_URL."/builder/database_form.php"),
	array("350801", "데이타베이스 업그레이드", G5_ADMIN_URL."/builder/database_form.php"),
	array("-", "■", G5_ADMIN_URL."/builder/work_tmpl_config_form.php"),
	array("350606", "작업 템플릿 설정", G5_ADMIN_URL."/builder/work_tmpl_config_form.php"),
        )
);

if($g5['use_multi_lang']) {
$menu["menu350"] = array_merge ($menu["menu350"], array(
	array("-", "■", G5_ADMIN_URL."/builder/multi_lang/config_list.php"),
	array("350800", "언어 설정", G5_ADMIN_URL."/builder/multi_lang/multi_lang_config_form.php"),
        )
);
};

///if($g5['use_multi_lang'] && $g5['is_db_trans']) {
if($g5['use_multi_lang'] && $g5['is_db_trans_possible']) {
$menu["menu350"] = array_merge ($menu["menu350"], array(
	array("350802", "다국어 기본 환경 설정", G5_ADMIN_URL."/builder/multi_lang/config_list.php"),
	array("350803", "다국어 게시판 관리", G5_ADMIN_URL."/builder/multi_lang/board_list.php"),
	array("350804", "다국어 게시판 그룹 관리", G5_ADMIN_URL."/builder/multi_lang/boardgroup_list.php"),
	array("350807", "다국어 투표 관리", G5_ADMIN_URL."/builder/multi_lang/poll_list.php"),
	array("350808", "다국어 내용 관리", G5_ADMIN_URL."/builder/multi_lang/content_list.php"),
	array("350809", "다국어 1:1문의 관리", G5_ADMIN_URL."/builder/multi_lang/qa_config.php"),
	array("350810", "다국어 FAQ 관리", G5_ADMIN_URL."/builder/multi_lang/faqmaster_list.php"),
	array("350805", "다국어 페이지 기본 설정", G5_ADMIN_URL."/builder/multi_lang/builder/basic_config_list.php"),
	array("350806", "다국어 메뉴 관리", G5_ADMIN_URL."/builder/multi_lang/builder/menu_config_list.php"),
        )
);
if(defined('G5_USE_SHOP') && G5_USE_SHOP) {
$menu["menu350"] = array_merge ($menu["menu350"], array(
	array("-", "■", G5_ADMIN_URL."/builder/multi_lang/shop/configform.php"),
	array("350820", "다국어 쇼핑몰 설정 관리", G5_ADMIN_URL."/builder/multi_lang/shop/configform.php"),
	array("350821", "다국어 쇼핑몰 분류 관리", G5_ADMIN_URL."/builder/multi_lang/shop/categorylist.php"),
	array("350822", "다국어 쇼핑몰 상품 관리", G5_ADMIN_URL."/builder/multi_lang/shop/itemlist.php"),
        )
);
} /// shop
if(defined('G5_USE_CONTENTS') && G5_USE_CONTENTS) {
$menu["menu350"] = array_merge ($menu["menu350"], array(
	array("-", "■", G5_ADMIN_URL."/builder/multi_lang/contents/configform.php"),
	array("350870", "다국어 컨텐츠몰 설정 관리", G5_ADMIN_URL."/builder/multi_lang/contents/configform.php"),
	array("350871", "다국어 컨텐츠몰 분류 관리", G5_ADMIN_URL."/builder/multi_lang/contents/categorylist.php"),
	array("350872", "다국어 컨텐츠몰 상품 관리", G5_ADMIN_URL."/builder/multi_lang/contents/itemlist.php"),
        )
);
} /// contents
};
?>
