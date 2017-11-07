<?php // 굿빌더 ?>
<?php
if (!defined('_GNUBOARD_')) exit;

// 고객 센타 글 추출
function guide($skin_dir="", $bo_table, $wr_id)
{
    global $g5;

    if ($skin_dir) {
        $guide_skin_path = "$g5[path]/skin/guide/$skin_dir";
        $guide_skin_url = "$g5[url]/skin/guide/$skin_dir";
    } else {
        $guide_skin_path = "$g5[path]/skin/guide/basic";
        $guide_skin_url = "$g5[url]/skin/guide/basic";
    }

    $board_guide = sql_fetch(" select * from {$g5['board_table']} where bo_table = '$bo_table' ");

    $view_guide = array();

    $tmp_write_table = $g5['write_prefix'] . $bo_table; // 게시판 테이블 전체이름
    $sql = " select * from $tmp_write_table where wr_id='$wr_id'";
    $view_guide = sql_fetch($sql);

    ob_start();
    include "$guide_skin_path/guide.skin.php";
    $content = ob_get_contents();
    ob_end_clean();

    return $content;
} 
?>
