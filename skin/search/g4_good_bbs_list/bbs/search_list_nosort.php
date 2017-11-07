<?php // 굿빌더 ?>
<?php
/// 게시판 출력 형태의 전체 검색 스킨 good_bbs_list2 버젼 1.0 (검색 모듈)

include_once("./_common.php");

//if (!$stx) alert("검색어가 없습니다."); 

$g5[title] = "검색 : " . $stx;
include_once("./_head.php");

if ($stx)
{
    //$stx = trim($stx);
    $stx = preg_replace("/\//", "\/", trim($stx));
    $sop = strtolower($sop);
    if (!$sop || !($sop == "and" || $sop == "or")) $sop = "and"; // 연산자 and , or
    if (!$srows) $srows = 10; // 한페이지에 출력하는 검색 행수

    unset($g5_search[tables]);
    unset($g5_search[read_level]);
    $sql = " select gr_id, bo_table, bo_read_level from $g5[board_table] where bo_use_search = '1' and bo_list_level <= '$member[mb_level]' ";
    //            and bo_read_level <= '$member[mb_level]' ";
    if ($gr_id)
        $sql .= " and gr_id = '$gr_id' ";
    if ($onetable) // 하나의 게시판만 검색한다면
        $sql .= " and bo_table = '$onetable' ";
    $sql .= " order by bo_order_search, gr_id, bo_table ";
    $result = sql_query($sql);
    for ($i=0; $row=sql_fetch_array($result); $i++) 
    {
        if ($is_admin != "super") 
        {
            // 그룹접근 사용에 대한 검색 차단
            $sql2 = " select gr_use_access, gr_admin from $g5[group_table] where gr_id = '$row[gr_id]' ";
            $row2 = sql_fetch($sql2);
            // 그룹접근을 사용한다면
            if ($row2[gr_use_access])
            {
                // 그룹관리자가 있으며 현재 회원이 그룹관리자라면 통과
                if ($row2[gr_admin] && $row2[gr_admin] == $member[mb_id])
                    ;
                else 
                {
                    $sql3 = " select count(*) as cnt from $g5[group_member_table] where gr_id = '$row[gr_id]' and mb_id = '$member[mb_id]' and mb_id <> '' ";
                    $row3 = sql_fetch($sql3);
                    if (!$row3[cnt])
                        continue;
                }
            }
        }
        $g5_search[tables][] = $row[bo_table];
        $g5_search[read_level][] = $row[bo_read_level];
    }

    $search_query = "sfl=".urlencode($sfl)."&stx=".urlencode($stx)."&sop=$sop";

    $text_stx = get_text(stripslashes($stx));

    $op1 = "";

    // 검색어를 구분자로 나눈다. 여기서는 공백
    $s = explode(" ", $stx);

    // 검색필드를 구분자로 나눈다. 여기서는 +
    $field = explode("||", trim($sfl));

    $str = "(";
    for ($i=0; $i<count($s); $i++) 
    {
        //$search_str = strtolower($s[$i]);
        $search_str = $s[$i];
        $str .= $op1;
        $str .= "(";
        
        $op2 = "";
        for ($k=0; $k<count($field); $k++) // 필드의 수만큼 다중 필드 검색 가능 (필드1+필드2...)
        {
            $str .= $op2;
            switch ($field[$k]) 
            {
                case "mb_id" :
                case "mb_name" :
                    $str .= "$field[$k] = '$s[$i]'";
                    break;
                default :
                    if (preg_match("/[a-zA-Z]/", $search_str))
                        $str .= "INSTR(LOWER($field[$k]), LOWER('$search_str'))";
                    else
                        $str .= "INSTR($field[$k], '$search_str')";
                    break;
            }
            $op2 = " or ";
        }
        $str .= ")";

        $op1 = " $sop ";

        /// <!--- 2010.03.02 굿빌더 (s) --->
        /// 인기검색어
        /// $sql = " insert into $g5[popular_table] set pp_word = '$search_str', pp_date = '$g5[time_ymd]', pp_ip = '$_SERVER[REMOTE_ADDR]' ";
        /// sql_query($sql, FALSE);
    }

    /// <!--- 2010.03.02 굿빌더 (s) --->
    /// 인기검색어
    $sql = " insert into $g5[popular_table] set pp_word = '$stx', pp_date = '$g5[time_ymd]', pp_ip = '$_SERVER[REMOTE_ADDR]' "; /// Moved here
    sql_query($sql, FALSE); /// Moved here

    $str .= ")";

    $sql_search = $str . " and wr_option not like '%secret%' "; // 비밀글은 제외
    //$sql_search = $str;
    $sql_search .= " and ca_name like '%$sca%' "; /// 카테고리 검색 지원

    $str_board_list = "";
    $board_count = 0;

    $time1 = get_microtime();

    $total_count = 0;
    for ($i=0; $i<count($g5_search[tables]); $i++) 
    {
        $tmp_write_table   = $g5[write_prefix] . $g5_search[tables][$i];
        
        $sql = " select wr_id from $tmp_write_table where $sql_search ";
        $result = sql_query($sql, false);
        $row[cnt] = @sql_num_rows($result);

        //$sql = " select count(*) as cnt from $tmp_write_table where $sql_search ";
        //$row = sql_fetch($sql);

        $total_count += $row[cnt];
        if ($row[cnt]) 
        {
            $board_count++;
            $search_table[] = $g5_search[tables][$i];
            $read_level[]   = $g5_search[read_level][$i];
            $search_table_count[] = $total_count;

            $sql2 = " select bo_subject from $g5[board_table] where bo_table = '{$g5_search[tables][$i]}' ";
            $row2 = sql_fetch($sql2);

            /// <!--- 2010.03.02 굿빌더 (s) --->
            /// $str_board_list .= "<li><a href='$_SERVER[PHP_SELF]?$search_query&gr_id=$gr_id&onetable={$g5_search[tables][$i]}'>$row2[bo_subject]</a> ($row[cnt])";

            $str_board_list .= "<li style='display:inline;'>| </li>"; /// New
            $str_board_list .= "<li style='display:inline;'><a href='$_SERVER[PHP_SELF]?$search_query&gr_id=$gr_id&onetable={$g5_search[tables][$i]}'>$row2[bo_subject]</a> ($row[cnt])</li>\n";
        }
    }

    /// <!--- 2010.03.02 굿빌더 (s) --->
    if($board_count > 0) $str_board_list .= "<li style='display:inline;'> |</li>"; /// New

    $rows = $srows;
    $total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
    if ($page == "") { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
    $from_record = ($page - 1) * $rows; // 시작 열을 구함

    for ($i=0; $i<count($search_table); $i++) 
    {
        if ($from_record < $search_table_count[$i]) 
        {
            $table_index = $i;
            $from_record = $from_record - $search_table_count[$i-1];
            break;
        }
    }

    $bo_subject = array();
    $list = array();

    $k=0;
    for ($idx=$table_index; $idx<count($search_table); $idx++) 
    {
        $sql = " select bo_subject from $g5[board_table] where bo_table = '$search_table[$idx]' ";
        $row = sql_fetch($sql);
        $bo_subject[$idx] = $row[bo_subject];

        $tmp_write_table = $g5[write_prefix] . $search_table[$idx];

        $sql = " select * from $tmp_write_table where $sql_search order by wr_id desc limit $from_record, $rows ";
        $result = sql_query($sql);
        for ($i=0; $row=sql_fetch_array($result); $i++) 
        {
            // 검색어까지 링크되면 게시판 부하가 일어남
            $list[$idx][$i] = $row;
            /// <!--- 2010.03.02 굿빌더 (s) --->
            /// $list[$idx][$i][href] = "./board.php?bo_table=$search_table[$idx]&wr_id=$row[wr_parent]";
            /// include search query. New!!!
            $list[$idx][$i][href] = "./board.php?bo_table=$search_table[$idx]&wr_id=$row[wr_parent]&$search_query";

            if ($row[wr_is_comment]) 
            { 
                $link .= "#c{$row[wr_id]}";
                $sql2 = " select wr_subject, wr_option from $tmp_write_table where wr_id = '$row[wr_parent]' ";
                $row2 = sql_fetch($sql2);
                //$row[wr_subject] = $row2[wr_subject];
                $row[wr_subject] = get_text($row2[wr_subject]);
            }

            // 비밀글은 검색 불가
            if (strstr($row[wr_option].$row2[wr_option], "secret")) 
                $row[wr_content] = "[비밀글 입니다.]";

            $subject = get_text($row[wr_subject]);
            if (strstr($sfl, "wr_subject")) 
                /// <!--- 2010.03.02 굿빌더 (s) --->
                /// $subject = search_font($stx, $subject);
                $subject = search_font($stx, strip_tags($subject)); /// New

            if ($read_level[$idx] <= $member[mb_level])
            {
                /// <!--- 2010.03.02 굿빌더 (s) --->
                /// $content = cut_str(get_text($row[wr_content]),$content_len,"…");
                $content = cut_str(get_text(strip_tags($row[wr_content])),$content_len,"…"); /// New
                if (strstr($sfl, "wr_content")) 
                    $content = search_font($stx, $content);
            }
            else
                $content = '';

            $list[$idx][$i][subject] = $subject;
            $list[$idx][$i][content] = $content;
            $list[$idx][$i][name] = get_sideview($row[mb_id], cut_str($row[wr_name], $config[cf_cut_name]), $row[wr_email], $row[wr_homepage]);
            
            $k++;
            if ($k >= $rows) 
                break; 
        }
        sql_free_result($result);
        
        if ($k >= $rows) 
            break; 

        $from_record = 0;
    }

    $write_pages = get_paging($config[cf_write_pages], $page, $total_page, "$_SERVER[PHP_SELF]?$search_query&gr_id=$gr_id&srows=$srows&onetable=$onetable&page=");

    ///echo "<script language=\"javascript\" src=\"$g5[url]/js/sideview.js\"></script>";
}

$group_select = "<select id='gr_id' name='gr_id' class=select><option value=''>전체 분류";
$sql = " select gr_id, gr_subject from $g5[group_table] order by gr_id ";
$result = sql_query($sql);
for ($i=0; $row=sql_fetch_array($result); $i++)
    $group_select .= "<option value='$row[gr_id]'>$row[gr_subject]";
$group_select .= "</select>";

if (!$sfl) $sfl = "wr_subject";
if (!$sop) $sop = "or";

include_once("$search_skin_path/search_list_nosort.skin.php");

include_once("./_tail.php");
?>
