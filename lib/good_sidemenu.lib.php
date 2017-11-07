<?php // 굿빌더 ?>
<?php
if (!defined('_GNUBOARD_')) exit;

// 측면 연동 메뉴
function sidemenu($skin_dir="good_basic")
{
    global $config, $member, $g5;
    global $menu_list, $menu, $main_index, $side_index;

    $sidemenu_skin_path = G5_SKIN_PATH."/sidemenu/$skin_dir";
    $sidemenu_skin_url = G5_SKIN_URL."/sidemenu/$skin_dir";

    ob_start();
    include_once ("$sidemenu_skin_path/sidemenu.skin.php");
    $content = ob_get_contents();
    ob_end_clean();

    return $content;
}
?>
