<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');
// 선택옵션으로 인해 셀합치기가 가변적으로 변함
$colspan = 2;

if ($is_checkbox) $colspan++;

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>
<div class='remember_page' valPage='<?=$page?>' valRow='<?=$page_rows?>' ></div>

<div class="sub1_3area">
    <div class="sub1_3topTxt">
        <h4><?=$board['bo_mobile_subject_'.$_SESSION['lang']]?></h4>
    </div>

    <?php
      if($_SESSION['lang'] == "ko_KR"){$thumb_num = 0;}
      else if($_SESSION['lang'] == "en_US"){$thumb_num = 1;}
      else if($_SESSION['lang'] == "ja_JP"){$thumb_num = 2;}
      else if($_SESSION['lang'] == "zh_CN"){$thumb_num = 3;}
      else if($_SESSION['lang'] == "zh_TW"){$thumb_num = 4;}
      else{$thumb_num = 1;}
    ?>

    <div class="sub13_board">

        <?php
        for ($i=0; $i<count($list); $i++) {

        // $pattern = "/<img.*?src=[\"']?(?P<url>[^(http)].*?)[\"' >]/i";
        // preg_match($pattern,stripslashes(str_replace('&amp;','&',$list[$i]["wr_content"])), $match);
        // $img = substr($match['url'],1);

        $thumb1 = get_list_thumbnail(strtolower($board['bo_table']), $list[$i]['wr_id'], 100,100);
		    $thumb = get_list_thumbnail(strtolower($board['bo_table']), $list[$i]['wr_id'], $thumb1['width'],$thumb1['height'],true, false, 'left', false,'80/0.5/3',$thumb_num);

        if( !$thumb['src'] ){
            $thumb = get_list_thumbnail_ktc(strtolower($board['bo_table']), $list[$i]['wr_id'], $board['bo_gallery_width'], $board['bo_gallery_height'],true, false, 'left', false,'80/0.5/3',1);
        }

        if( !$thumb['src'] ){
            $thumb = get_list_thumbnail_ktc(strtolower($board['bo_table']), $list[$i]['wr_id'], $board['bo_gallery_width'], $board['bo_gallery_height'],true, false, 'left', false,'80/0.5/3',0);
        }



		//본문내용 텍스트만 가져오기
		$str_content = cut_str(strip_tags($list[$i]['wr_content_'.$_SESSION['lang']]),$board['bo_mobile_subject_len']);

        ?>
            <div class="sub13_board_area">
                <a href="<?php echo strtolower($list[$i]['href'])."&me_code=".$me_code."&info=".$info."&num=".$num; ?><?=lang_url_a($_SESSION['lang'])?>">
                    <div class="sub13_board_img">
                        <?if( $thumb['src'] ){?>
                            <img src="<?php echo $thumb['src']?>" alt="" />
                        <?}else{?>
                            <img src="/img/default/ktc_prcenter_M.png" alt="<?php echo $thumb['alt']?>"/>
                        <?}?>
                    </div>

                    <div class="sub13_info">
                        <h3><?=$list[$i]['wr_subject_'.$_SESSION['lang']]?></h3>
                        <p class="sub13_info_txt"><?=$str_content?></p>
                        <p class="sub13_info_date"><?=substr($list[$i]['wr_datetime'],0,10);?></p>
                    </div>
                </a>
            </div>
        <?}?>


        <?if($total_count > $page_rows){?>

        <div class="subMore_btn" >
            <div class="subMore_btn_area">
                <a>
                    <p class="subMore_icon"></p>
                    <?if( $total_count < $page_rows ){
                        $total_count_view = $page_rows;
                    }else{
                        $total_count_view = $total_count;
                    }
                    ?>
                    <p class="subMore_info">(<?=($page-1)*$page_rows + count($list)?> / <?=$total_count?>)</p>
                </a>
            </div>
        </div>

        <?}?>

    </div>




</div>
<?if( $total_count >= $page_rows ){?>
<script>
$(function(){
    $('.subMore_btn_area a').click(function(){
		$(this).html('<div style="padding-top:10px;" ><i class="fa fa-spinner fa-spin fa-2x fa-fw "></i><span class="sr-only">Loading...</span></div>');
		$('.subMore_btn_area a').unbind('click');
        $.ajax({
            url: "/bbs/ajax.listadd.php",
            data: {
                    'page': $('.remember_page').attr('valPage'),
                    'page_rows': '<?=$page_rows?>',
                    'bo_table': '<?=$bo_table?>',
                    'ww': <?=$board["bo_mobile_gallery_width"]?>,
                    'hh': <?=$board["bo_mobile_gallery_height"]?>,
                    'subject_len': <?=$board["bo_mobile_subject_len"]?>,
                    'info': '<?=$info?>',
                    'me_code': '<?=$me_code?>',
                    'num': '<?=$num?>'
                  },
            success:function(data){
                $('.subMore_btn').remove();
                var page_num = parseInt($('.remember_page').attr('valPage'))+1;
                var page_row = parseInt($('.remember_page').attr('valRow'));
                $('.sub13_board').append(data);
                $('.remember_page').attr('valPage',page_num);

            }
        })
    })
})
</script>
<?}?>


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
        alert(document.pressed + "<?php echo _t('할 게시물을 하나 이상 선택하세요.'); ?>");
        return false;
    }

    if(document.pressed == "<?php echo _t('선택복사'); ?>") {
        select_copy("copy");
        return;
    }

    if(document.pressed == "<?php echo _t('선택이동'); ?>") {
        select_copy("move");
        return;
    }

    if(document.pressed == "<?php echo _t('선택삭제'); ?>") {
        if (!confirm("<?php echo _t('선택한 게시물을 정말 삭제하시겠습니까?').'\n\n'._t('한번 삭제한 자료는 복구할 수 없습니다').'\n\n'._t('답변글이 있는 게시글을 선택하신 경우').'\n'._t('답변글도 선택하셔야 게시글이 삭제됩니다.'); ?>"))
            return false;

        f.removeAttribute("target");
        f.action = "./board_list_update.php";
    }

    return true;
}

// 선택한 게시물 복사 및 이동
function select_copy(sw) {
    var f = document.fboardlist;

    if (sw == 'copy')
        str = "<?php echo _t('복사'); ?>";
    else
        str = "<?php echo _t('이동'); ?>";

    var sub_win = window.open("", "move", "left=50, top=50, width=500, height=550, scrollbars=1");

    f.sw.value = sw;
    f.target = "move";
    f.action = "./move.php";
    f.submit();
}
</script>

<!-- 게시판 목록 끝 -->
