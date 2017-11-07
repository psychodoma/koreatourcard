<?php // 굿빌더 ?>
<?php
/// 게시판 출력 형태의 전체 검색 스킨 good_bbs_list2 버젼 1.0 (스킨 모듈)

if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 

// 선택옵션으로 인해 셀합치기가 가변적으로 변함
$colspan = 3;

//if ($is_category) $colspan++;
if ($is_checkbox) $colspan++;
if ($is_good) $colspan++;
if ($is_nogood) $colspan++;

$colspan_1 = $colspan + 1;

// 제목이 두줄로 표시되는 경우 이 코드를 사용해 보세요.
// <nobr style='display:block; overflow:hidden; width:000px;'>제목</nobr>

/// 완전한 검색 쿼리 지원
$qstr2_full = "$search_query2&gr_id=$gr_id&srows=$srows&onetable=$onetable&sca=$sca&page=$page";
?>

<style>
.board_top { clear:both; }

.board_list { clear:both; width:100%; table-layout:fixed; margin:5px 0 0 0; }
.board_list th { font-weight:bold; font-size:12px; } 
.board_list th { background:url(<?php echo $search_skin_url?>/img/title_bg.gif) repeat-x; } 
.board_list th { white-space:nowrap; height:34px; overflow:hidden; text-align:center; } 
.board_list th { border-top:1px solid #ddd; border-bottom:1px solid #ddd; } 

.board_list tr.bg0 { background-color:#fafafa; } 
.board_list tr.bg1 { background-color:#ffffff; } 
.board_list tr.bg0a { background-color:#fafafa; } 
.board_list tr.bg1a { background-color:#ffffff; } 

.board_list td { padding:.5em; }
/* .board_list td { border-bottom:1px solid #ddd; }  */
.board_list td { border-bottom:0; } 
.board_list td.num { color:#999999; text-align:center; }
.board_list td.checkbox { text-align:center; }
.board_list td.botable { overflow:hidden; }
.board_list td.caname { overflow:hidden; }
/* .board_list td.subject { overflow:hidden; } */
.board_list td.subject { font-size:12px; overflow:hidden; }
.board_list td.subject a { font-size:12px; }
.board_list td.name { padding:0 0 0 10px; }
.board_list td.datetime { font:normal 11px tahoma; color:#BABABA; text-align:center; }
.board_list td.hit { font:normal 11px tahoma; color:#BABABA; text-align:center; }
.board_list td.good { font:normal 11px tahoma; color:#BABABA; text-align:center; }
.board_list td.nogood { font:normal 11px tahoma; color:#BABABA; text-align:center; }
.board_list td.content { border-top:0; border-bottom:1px solid #ddd; padding:8px 2px 10px 8px}

.board_list .notice { font-weight:normal; }
.board_list .current { font:bold 11px tahoma; color:#E15916; }
.board_list .comment { font-family:Tahoma; font-size:10px; color:#EE5A00; }

.board_button { clear:both; margin:10px 0 0 0; }

.board_page { clear:both; text-align:center; margin:3px 0 0 0; }
.board_page a:link { color:#777; }

.board_search { text-align:center; margin:10px 0 0 0; }
.board_search .stx { height:21px; border:1px solid #9A9A9A; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8; padding:3px 2px 0 2px; } /* New */
</style>

<!-- 게시판 목록 시작 -->
<table width="98%" align="center" cellpadding="0" cellspacing="0"><tr><td>

    <!-- 분류 셀렉트 박스, 게시물 몇건, 관리자화면 링크 -->
    <div class="board_top">
        <div style="float:left;">
        </div>
        <div style="float:right;">
            <img src="<?php echo $search_skin_url?>/img/icon_total.gif" align="absmiddle" border='0'>
            <span style="color:#888888; font-weight:bold;"><?php echo _t('Total'); ?> <?php echo number_format($total_count)?></span>
            <?php if ($rss_href) { ?><a href='<?php echo $rss_href?>'><img src='<?php echo $search_skin_url?>/img/btn_rss.gif' border='0' align="absmiddle"></a><?php }?>
            <?php if ($admin_href) { ?><a href="<?php echo $admin_href?>"><img src="<?php echo $search_skin_url?>/img/btn_admin.gif" border='0' title="<?php echo _t('관리자'); ?>" align="absmiddle"></a><?php }?>
        </div>
    </div>

    <!-- 제목 -->
    <table cellspacing="0" cellpadding="0" class="board_list">
    <col width="50" />
    <col />
    <col width="110" />
    <col width="80" />
    <col width="50" />
    <?php if ($is_good) { ?><col width="40" /><?php } ?>
    <?php if ($is_nogood) { ?><col width="40" /><?php } ?>
    <tr>
        <th><?php echo _t('번호'); ?></th>
        <th><?php echo _t('제목'); ?></th>
        <th><?php echo _t('글쓴이'); ?></th>
        <th><?php echo subject_sort_link('wr_datetime', $qstr2_full, 1)?><?php echo _t('날짜'); ?></a></th>
        <th><?php echo subject_sort_link('wr_hit', $qstr2_full, 1)?><?php echo _t('조회'); ?></a></th>
        <?php if ($is_good) { ?><th><?php echo subject_sort_link('wr_good', $qstr2_full, 1)?><?php echo _t('추천'); ?></a></th><?php }?>
        <?php if ($is_nogood) { ?><th><?php echo subject_sort_link('wr_nogood', $qstr2_full, 1)?><?php echo _t('비추천'); ?></a></th><?php }?>
    </tr>

    <?php 
    $k=0;

    for ($idx=$table_index, $k=0; $idx<count($search_table) && $k<$rows; $idx++) 
    { 
        $comment_href = "";
        for ($i=0; $i<count($list[$idx]) && $k<$rows; $i++, $k++) 
        {
            $bg = $k%2 ? 0 : 1;
            $count = ($page-1)*$rows + $k + 1;

            $sql2 = " select bo_subject from $g5[board_table] where bo_table = '{$list[$idx][$i][bo_table]}' ";
            /// $sql2 = " select bo_subject from $g5[board_table] where bo_table = '$search_table[$idx]' ";
            $row2 = sql_fetch($sql2);

            echo "<tr class='bg{$bg}'>\n"; 
            echo "<td class='num'>".number_format($count)."</td>\n";
            echo "<td class='subject'>";

            echo "[";
            echo "<a href='$_SERVER[PHP_SELF]?$search_query2&gr_id=$gr_id&srows=$srows&onetable={$list[$idx][$i][bo_table]}&sca=&page='>"._t($row2[bo_subject])."</a>";
            if($list[$idx][$i][ca_name]) 
                echo " > <a href='$_SERVER[PHP_SELF]?$search_query2&gr_id=$gr_id&srows=$srows&onetable={$list[$idx][$i][bo_table]}&sca={$list[$idx][$i][ca_name]}&page='>{$list[$idx][$i][ca_name]}</a>";
            else
                echo "";
            echo "] ";

            /// echo "<hr size=1 color=#eeeeee>";

            if ($list[$idx][$i][wr_is_comment]) {
                echo "<font color=999999>["._t("코멘트")."]</font> ";
                $comment_href = "#c_".$list[$idx][$i][wr_id];
            }
            echo "<b><a href='{$list[$idx][$i][href]}{$comment_href}'>{$list[$idx][$i][subject]}</a></b>";

            /// echo "<br><div style='height:8px'>&nbsp;</div>";

            /// echo "<a href='{$list[$idx][$i][href]}{$comment_href}'>".$list[$idx][$i][content]."</a>";
            echo "</td>\n";
            echo "<td class='name'>{$list[$idx][$i][name]}</td>\n";
            /// echo "<td class='datetime'>".substr($list[$idx][$i][wr_datetime], 5, 5)."</td>\n";
            echo "<td class='datetime'>".substr($list[$idx][$i][wr_datetime], 0, 10)."</td>\n";
            echo "<td class='hit'>{$list[$idx][$i][wr_hit]}</td>\n";
            if ($is_good) echo "<td class='good'>{$list[$idx][$i][wr_good]}</td>\n";
            if ($is_nogood) echo "<td class='nogood'>{$list[$idx][$i][wr_nogood]}</td>\n";
            echo "</tr>\n";

            echo "<tr class='bg{$bg}a'>\n"; 
            echo "<td class='content'>";
            if($thumb_use) {
                $thumb_src = $g5[path]."/data/file/".$list[$idx][$i][bo_table]."/thumb/".$list[$idx][$i][wr_id];
                $thumb_src_url = $g5[url]."/data/file/".$list[$idx][$i][bo_table]."/thumb/".$list[$idx][$i][wr_id];
                if(file_exists($thumb_src)) echo "<a href='{$list[$idx][$i][href]}{$comment_href}'><img src='$thumb_src_url' width='40'></a>";
            }
            echo "</td><td class='content' colspan='$colspan_1'>\n";
            echo "&nbsp;<a href='{$list[$idx][$i][href]}{$comment_href}'>".$list[$idx][$i][content]."</a>";
            echo "</td></tr>\n";
        }
    }
    ?>

    <?php if (count($list) == 0) { echo "<tr><td colspan='$colspan' height=100 align=center>"._t("게시물이 없습니다.")."</td></tr>"; } ?>

    </table>

    <div class="board_button">
        <div style="float:left;">
        <?php if ($list_href) { ?>
        <a href="<?php echo $list_href?>"><img src="<?php echo $search_skin_url?>/img/btn_list.gif" align="absmiddle" border='0'></a>
        <?php } ?>
        <?php if ($is_checkbox) { ?>
        <a href="javascript:select_delete();"><img src="<?php echo $search_skin_url?>/img/btn_select_delete.gif" align="absmiddle" border='0'></a>
        <a href="javascript:select_copy('copy');"><img src="<?php echo $search_skin_url?>/img/btn_select_copy.gif" align="absmiddle" border='0'></a>
        <a href="javascript:select_copy('move');"><img src="<?php echo $search_skin_url?>/img/btn_select_move.gif" align="absmiddle" border='0'></a>
        <?php } ?>
        </div>

        <div style="float:right;">
        <?php if ($write_href) { ?><a href="<?php echo $write_href?>"><img src="<?php echo $search_skin_url?>/img/btn_write.gif" border='0'></a><?php } ?>
        </div>
    </div>

    <!-- 페이지 -->
    <div class="board_page">
        <?php if ($prev_part_href) { echo "<a href='$prev_part_href'><img src='$search_skin_url/img/page_search_prev.gif' border='0' align=absmiddle title='"._t("이전검색")."'></a>"; } ?>
        <?php
        // 기본으로 넘어오는 페이지를 아래와 같이 변환하여 이미지로도 출력할 수 있습니다.
        //echo $write_pages;
        $write_pages = str_replace("처음", "<img src='$search_skin_url/img/page_begin.gif' border='0' align='absmiddle' title='처음'>", $write_pages);
        $write_pages = str_replace("이전", "<img src='$search_skin_url/img/page_prev.gif' border='0' align='absmiddle' title='이전'>", $write_pages);
        $write_pages = str_replace("다음", "<img src='$search_skin_url/img/page_next.gif' border='0' align='absmiddle' title='다음'>", $write_pages);
        $write_pages = str_replace("맨끝", "<img src='$search_skin_url/img/page_end.gif' border='0' align='absmiddle' title='맨끝'>", $write_pages);
        //$write_pages = preg_replace("/<span>([0-9]*)<\/span>/", "$1", $write_pages);
        $write_pages = preg_replace("/<b>([0-9]*)<\/b>/", "<b><span style=\"color:#4D6185; font-size:12px; text-decoration:underline;\">$1</span></b>", $write_pages);
        ?>
        <?php echo $write_pages?>
        <?php if ($next_part_href) { echo "<a href='$next_part_href'><img src='$search_skin_url/img/page_search_next.gif' border='0' align=absmiddle title='"._t("다음검색")."'></a>"; } ?>
    </div>

    <!-- 검색 -->
    <div class="board_search">
        <form name=fsearch method=get onsubmit="return fsearch_submit(this);">
	<input type="hidden" name="srows" value="<?php echo $srows?>">
        <table border=0 cellspacing=2 cellpadding=0 align=center><tr><!-- New -->
        <td>
        <select name="sfl">
            <option value="wr_subject||wr_content"><?php echo _t('제목+내용'); ?></option>
            <option value="wr_subject"><?php echo _t('제목'); ?></option>
            <option value="wr_content"><?php echo _t('내용'); ?></option>
            <option value="mb_id"><?php echo _t('회원아이디'); ?></option>
            <option value="wr_name"><?php echo _t('이름'); ?></option>
            <option value="wr_good"><?php echo _t('추천수'); ?></option>
        </select>
        </td><td>
        <input name="stx" class="stx" maxlength="15" itemname="<?php echo _t('검색어'); ?>" required value='<?php echo $stx?>'>
        </td><td>
        <input type="image" src="<?php echo $search_skin_url?>/img/btn_search.gif" border='0' align="absmiddle">
        </td><td>
        <input type="radio" name="sop" value="and">and
        <input type="radio" name="sop" value="or">or
        </td></tr></table>
        </form>

        <script language="javascript">
        document.fsearch.sfl.value = "<?php echo $sfl?>";

        function fsearch_submit(f)
        {
            if (f.stx.value.length < 1) {
                alert("<?php echo _t('검색어는 한 글자 이상 입력하십시오.'); ?>");
                f.stx.select();
                f.stx.focus();
                return false;
            }

            // 검색에 많은 부하가 걸리는 경우 이 주석을 제거하세요.
            var cnt = 0;
            for (var i=0; i<f.stx.value.length; i++) {
                if (f.stx.value.charAt(i) == ' ')
                    cnt++;
            }

            if (cnt > 1) {
                alert("<?php echo _t('빠른 검색을 위하여 검색어에 공백은 한개만 입력할 수 있습니다.'); ?>");
                f.stx.select();
                f.stx.focus();
                return false;
            }
            
            f.action = "";
            return true;
        }
        </script>
    </div>

</td></tr></table>


