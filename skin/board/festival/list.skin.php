<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// 선택옵션으로 인해 셀합치기가 가변적으로 변함
$colspan = 5;

if ($is_checkbox) $colspan++;
if ($is_good) $colspan++;
if ($is_nogood) $colspan++;




if( !$today ){
    $today = date("Y-m");
    $fetivaltitle = explode('-',$today);
}else{
    $fetivaltitle = explode('-',$today);
    if($cnt == "up"){
        $fetivaltitle[1] = $fetivaltitle[1]+1;

        if( $fetivaltitle[1] < 10 ){
            $fetivaltitle[1] = "0".$fetivaltitle[1];
        }else if(  $fetivaltitle[1] == 13 ){
            $fetivaltitle[1] =  "01";
            $fetivaltitle[0] =  $fetivaltitle[0] + 1;
        }
    }else if($cnt == "down"){
        $fetivaltitle[1] = $fetivaltitle[1]-1;
        if( $fetivaltitle[1] < 10 ){
            $fetivaltitle[1] = "0".$fetivaltitle[1];
        }
        if(  $fetivaltitle[1] == "00" ){
            $fetivaltitle[1] =  "12";
            $fetivaltitle[0] =  $fetivaltitle[0] - 1;
        }
    }
    $today =  $fetivaltitle[0]."-". $fetivaltitle[1];
}

$fe_title = "";
$fe_img = 0;


$fe_title = $fetivaltitle[0].".&nbsp;&nbsp;".$fetivaltitle[1].".";



$list = get_festival_list($stx, $sca, $today,$page,$page_rows);
$list_cnt = get_festival_list_cnt($stx, $sca, $today);
$total_page  = ceil($list_cnt['cnt'] / $page_rows);
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);

?>



<div class="sub2_2center sub2_1form_area">
    <div class="sub4_6form_area sub4_5form" style='margin-bottom:0px;'>
        <form name="fsearch" method="get" class="sub_search" style='margin-bottom:0;' onsubmit="return fsearchbox_submit(this);" >
            <fieldset style='padding:0;'>
                <ul>
                    <li class="input">
                        <label for="" class="hide">검색창</label>
                        <input style='margin: 7px 10px 0 0px' type="text" name="stx" value="<?=$stx?>" id="stx" class="sub46_input" size="15" maxlength="15" placeholder="<?=_t('검색어를 입력하세요.')?>">
                    </li>

                    <li class="btn">
                        <input type="submit" value="<?=_t('검색')?>" class="sub46_search" id="" title="<?=_t('검색')?>" />
                    </li>
                <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
                <input type="hidden" name="sca" value="<?php echo $sca ?>">
                <input type="hidden" name="me_code" value="<?php echo $me_code ?>">
                <input type="hidden" name="info" value="<?php echo $info ?>">
                <input type="hidden" name="num" value="<?php echo $num ?>">
                <input type="hidden" name="today" value="<?php echo $today ?>">
                <input type="hidden" name="sop" value="and">
				<input type='hidden' name='lang' value='<?=lang_url($_SESSION['lang'])?>'
                </ul>
            </fieldset>
        </form>


            <script>
            function fsearchbox_submit(f)
            {
                if (f.stx.value.length < 2) {
                    alert("<?=_t('검색어는 두글자 이상 입력하십시오.')?>");
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

                return true;
            }
            </script>


    </div>

 <div class="sub4_trafficTab" style='margin-bottom:0'>
    <ul class="traffic_searchTab">
        <li style="width:33%;"><a class="tab_link <?if($sca == "") echo 'active';?>  " href="/bbs/board.php?bo_table=festival&info=info&me_code=40&num=3<?=lang_url_a($_SESSION['lang'])?>"><?=_t('전체 일정')?></a></li>
        <li style="width:34%;"><a class="tab_link <?if($sca == "축제&행사") echo 'active';?>  " href="/bbs/board.php?bo_table=festival&info=info&me_code=40&num=3&sca=<?=urlencode('축제&행사')?><?=lang_url_a($_SESSION['lang'])?>"><?=_t('축제/행사')?></a></li>
        <li style="width:33%;"><a class="tab_link <?if($sca == "공연&전시") echo 'active';?>" href="/bbs/board.php?bo_table=festival&info=info&me_code=40&num=3&sca=<?=urlencode('공연&전시')?><?=lang_url_a($_SESSION['lang'])?>" ids="1"><?=_t('공연/전시')?></a></li>
    </ul>
</div>



<div class="sub4_3calendar">
    <a href='./board.php?bo_table=festival&sca=<?=urlencode($sca)?>&info=<?=$info?>&me_code=40&cnt=down&num=3&today=<?=$today?>&stx=<?=$stx?><?=lang_url_a($_SESSION['lang'])?>'>
        <div style='float:left; width:33%; text-align:right;'><i class="fa fa-chevron-left fa-2x" aria-hidden="true"></i></div>
    </a>

    <div class="sub4_3calendar_title"><?=$fe_title?></div>

    <a href='./board.php?bo_table=festival&sca=<?=urlencode($sca)?>&info=<?=$info?>&me_code=40&num=3&cnt=up&today=<?=$today?>&stx=<?=$stx?><?=lang_url_a($_SESSION['lang'])?>'>
        <div style='float:left; width:33%; text-align:left;'><i class="fa fa-chevron-right fa-2x" aria-hidden="true"></i></div>
    </a>
</div>


    <?if( $list_cnt['cnt'] != 0){?>
        <table class="sub4_6table" width="100%;">
            <thead>
                <th width="120px"><?=_t('분류')?></th>
                <th width="350px"><?=_t('기간')?></th>
                <th width=""><?=_t('소개')?></th>
                <th width="150px"><?=_t('지역')?></th>
            </thead>
            <tbody>
                <?php
                while( $row = sql_fetch_array($list) ){
                    $str_subject = cut_str(strip_tags($row['wr_subject_'.$_SESSION['lang']]),$board['bo_subject_len']);

                ?>
                    <?if(!$row['is_notice']){?>
                        <tr>
                            <td align="center">
                                <?
                                    echo _t(substr($row['ca_name'],0,6)."/".substr($row['ca_name'],7,6));
                                ?>
                            </td>
                            <td class="noticeTD" style='text-align:center;'>
                                <!--<a href="<?php echo $row['href']."&me_code=".$me_code."&info=".$info."&num=".$num; ?>">-->
                                    <?
                                        echo substr($row['wr_1'],0,4);
                                        echo ". ";
                                        echo substr($row['wr_1'],4,2);
                                        echo ". ";
                                        echo substr($row['wr_1'],6,2);
                                        echo "&nbsp;&nbsp;~&nbsp;&nbsp;";
                                        echo substr($row['wr_2'],0,4);
                                        echo ". ";
                                        echo substr($row['wr_2'],4,2);
                                        echo ". ";
                                        echo substr($row['wr_2'],6,2);
                                    ?>
                                <!--</a>-->
                            </td>

                            <td align="center" >
                                <?if(!$row['wr_link_'.$_SESSION['lang']]){?>
                                  <?if($row['wr_link_en_US']){?>
                                    <a href='<?=$row['wr_link_en_US']?>' target='_blank' style="color:#505050; font-weight: 600;">
                                  <?}else{?>
                                    <a href='<?=$row['wr_link_ko_KR']?>' target='_blank' style="color:#505050; font-weight: 600;">
                                  <?}?>
                                <?}else{?>
                                    <a href='<?=$row['wr_link_'.$_SESSION['lang']]?>' target='_blank' style="color:#505050; font-weight: 600;">
                                <?}?>
                                  <?=$str_subject?>
                                </a>
                            </td>

                            <td align="center">
								<?if($row['wr_3']){?>
									<?=_t($row['wr_3'])?>&nbsp;
								<?}?>

								<?if($row['wr_4']){?>
									<?=_t($row['wr_4'])?>
								<?}?>
                            </td>
                        </tr>
                    <?}?>
                <?}?>

            </tbody>
        </table>
    <?}else{?>
        <?if( $stx ){?>
            <p class="sub5_search_false"><?=_t('검색 결과가 없습니다.')?></p>
        <?}else{?>
         <p class="sub5_search_false"><?=_t('게시물이 없습니다.')?></p>
         <?}?>
    <?}?>


<?php
$write_pages = get_paging_ktc($config[cf_write_pages], $page, $total_page, "./board.php?bo_table=$bo_table".$qstr."&info=".$info,"&me_code=".$me_code."&num=".$num."&today=".$today.lang_url_a($_SESSION['lang']));
echo $write_pages;
?>

</div>




</div>





<!--여기서부터가 기본 소스-->

<!--<h2 id="container_title"><?php echo $board['bo_subject'] ?><span class="sound_only"> 목록</span></h2>-->

<!-- 게시판 목록 시작 { -->


<?php if($is_checkbox) { ?>
<noscript>
<p>자바스크립트를 사용하지 않는 경우<br>별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
</noscript>
<?php } ?>

<!-- 페이지 -->



<!-- 게시판 검색 시작 { -->

<!-- } 게시판 검색 끝 -->

<?php if ($is_checkbox) { ?>
<script>
function all_checked(sw) {
    var f = document.fboardlist;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]")
            f.elements[i].checked = sw;
    }
}

function fboardlist_submit(f) {
    var chk_count = 0;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]" && f.elements[i].checked)
            chk_count++;
    }

    if (!chk_count) {
        alert(document.pressed + "할 게시물을 하나 이상 선택하세요.");
        return false;
    }

    if(document.pressed == "선택복사") {
        select_copy("copy");
        return;
    }

    if(document.pressed == "선택이동") {
        select_copy("move");
        return;
    }

    if(document.pressed == "선택삭제") {
        if (!confirm("선택한 게시물을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다\n\n답변글이 있는 게시글을 선택하신 경우\n답변글도 선택하셔야 게시글이 삭제됩니다."))
            return false;

        f.removeAttribute("target");
        f.action = "./board_list_update.php";
    }

    return true;
}

// 선택한 게시물 복사 및 이동
function select_copy(sw) {
    var f = document.fboardlist;

    if (sw == "copy")
        str = "복사";
    else
        str = "이동";

    var sub_win = window.open("", "move", "left=50, top=50, width=500, height=550, scrollbars=1");

    f.sw.value = sw;
    f.target = "move";
    f.action = "./move.php";
    f.submit();
}
</script>
<?php } ?>
<!-- } 게시판 목록 끝 -->
