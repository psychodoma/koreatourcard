<?php // 굿빌더 ?>
<?php
if (!defined('_GNUBOARD_')) exit;

// 최근 게시물수 출력
function outnew($skin_dir="basic")
{
    global $config, $g5;

    $outnew_skin_path = "$g5[path]/skin/outnew/$skin_dir";
    $outnew_skin_url = "$g5[url]/skin/outnew/$skin_dir";

    ob_start();
    include_once ("$outnew_skin_path/outnew.skin.php");
    $content = ob_get_contents();
    ob_end_clean();

    return $content;
}
?>
