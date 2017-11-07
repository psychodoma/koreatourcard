<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>
<script src="https://cdn.jsdelivr.net/clipboard.js/1.5.3/clipboard.min.js"></script>
<script src="<?php echo G5_JS_URL; ?>/viewimageresize.js"></script>

<!-- 게시물 읽기 시작 { -->
<!-- div id="bo_v_table"><?php echo $board['bo_subject']; ?></div -->
<?
$next_page_info_result = sql_fetch("select * from g5_write_".$bo_table."  where wr_id < ".$wr_id." order by wr_id desc");
$prev_page_info_result = sql_fetch("select * from g5_write_".$bo_table."  where wr_id > ".$wr_id." ");
$sql_result_benefit = sql_query( "select * from g5_board_file where wr_id = ".$wr_id." order by bf_no" );
$sql_result_benefit_cnt = sql_fetch( "select count(*) cnt from g5_board_file where wr_id = ".$wr_id." order by bf_no" );

$v_img_count = count($view['file']);

if($_SESSION['lang'] == 'ko_KR'){
    $lang = "";
}else{
    $lang = "_".$_SESSION['lang'];
}

//$me_sql = "select * from g5_write_cardbenefit"


$metro_ids = explode("|", $view['wr_metro']);


$service_txt = get_view_thumbnail($view['service'.$lang]);
$service_txt = explode("\r", $service_txt );

?>

<div class='map_info' valTable='<?=$bo_table?>'  valInfoName='<?=$view['wr_subject']?>'  valInfoLat='<?=$view['wr_lat']?>' valInfoLng='<?=$view['wr_lng']?>'></div>

<div class="sub2_2center">
    <div class="sub3_1view">
        <div class="topImg">
            <?if($v_img_count) {
                for ($i=0; $i<1; $i++) {
                    if ($view['file'][$i]['view']) {
                        echo get_view_thumbnail($view['file'][$i]['view'],"975px");
                    }
                }
            }?>
        </div>
        <div class="topTxt">
            <h3>
                <?if($v_img_count) {
                    for ($i=1; $i<2; $i++) {
                        if ($view['file'][$i]['view']) {
                            echo get_view_thumbnail($view['file'][$i]['view'],"360px");
                        }
                    }
                }?>  
            </h3>
            <p><?php echo get_view_thumbnail($view['content'.$lang]); ?></p>
        </div>
    </div>


    <div class="sub3_1view1">
        <h3 class="title">혜택안내</h3>
			<ul class="sub3_benefit">
                <?if($v_img_count) {
                    for ($i=4; $i<count($view['file']); $i++) {
                        if ($view['file'][$i]['bf_content']) {?>
                            <li>
                                <h3 <?if( !($view['file'][$i]['view']) ) echo "style='padding-top:65px;'";?>>
                                    <?echo get_view_thumbnail($view['file'][$i]['view'],"195px");?> 
                                </h3>
                                <p><?echo $view['file'][$i]['bf_content'.$lang];?></p>
                            </li>
                        <?}
                    }
                }?>
            </ul>

            <div class="sub3_note">
                <div class="sub3_note_area">
                    <p class="sub3_note_icon"><img src="/img/sub/sub3/sub3_1/sub3_note_icon.jpg" alt=""/></p>

                    <div class="sub3_note_txt">
                        <h4>유의사항!</h4>
                        <ul>
                            <li>
                                <?php echo get_view_thumbnail($view['waring'.$lang]); ?>
                            </li>
                        </ul>
                    </div>

                    <p class="sub3_note_btn">
                        <a href="<?=$view['wr_link1']?>" target='_blank'>브랜드 바로가기</a>
                    </p>
                </div>
            </div>

			<div class="sub3_1view2">
				<h3 class="title">이용안내</h3>

				<div class="sub3_1view2_map">
                    <div id='map' style='width:100%; height:550px;'></div>
				</div>

				<div class="sub3_1view2_txt">
					<h3>이용정보</h3>

					<div class="view2_txtArea">
						<ul>
							<li class="s31_add"><?=$view['wr_address_txt'.$lang]?></li>
							<li class="s31_tel">
                                <?=$service_txt[0]?>
                            </li>
							<li class="s31_sto">
                                <?=$service_txt[1]?>
                            </li>
							<li class="s31_hol">
                                <?=$service_txt[2]?>
                            </li>
						</ul>
						<a  href="" valadd="<?=$view['wr_address_txt']?>" onclick="copy_trackback(this); return false;" class="sub3_1view2_btn1">주소복사</a>
						<a href="https://www.google.co.kr/maps/dir//<?=$view['wr_address_txt']?>" class="sub3_1view2_btn2" target='_blank'>길찾기 안내</a>
					</div>
				</div>



				<div class="sub3_1view2_txt1">
					<h3>교통정보 - 지하철</h3>
					<div class="view2_txtArea1">
                        <?for($i=0; $i<count($metro_ids); $i++){
                            $me_result = sql_fetch("select * from g5_write_cardbenefit_metro where metro_id = ".$metro_ids[$i]);?>
                            <div class="line2">
                                <p><img src="/img/sub/sub3/sub3_1/sub3_train<?=$me_result['metro_hosun'];?>.gif" alt="2호선"/></p>
                                <h4><span><?echo hosun($me_result['metro_hosun'],$lang)?></span>(<?=$me_result['metro_info'.$lang]?>)</h4>
                            </div>
                        <?}?>
                    </div>
				</div>





				<div class="sub3_1view2_txt1">
					<h3><?=_t('교통정보');?> - <?=_t('버스');?></h3>
					
					<ul class="view2_txtArea2">
						<li>
							<p class="Area2_icon"><img src="/img/sub/sub3/sub3_1/sub3g1.jpg" alt="아이콘"/></p>
							<h3>지선버스</h3>
							<p class="Area2_num"><?=$view['wr_bus_1']?></p>
						</li>

						<li>
							<p class="Area2_icon"><img src="/img/sub/sub3/sub3_1/sub3g2.jpg" alt="아이콘"/></p>
							<h3>간선버스</h3>
							<p class="Area2_num"><?=$view['wr_bus_2']?></p>
						</li>

						<li>
							<p class="Area2_icon"><img src="/img/sub/sub3/sub3_1/sub3g3.jpg" alt="아이콘"/></p>
							<h3>광역버스</h3>
							<p class="Area2_num"><?=$view['wr_bus_3']?></p>
						</li>

						<li>
							<p class="Area2_icon"><img src="/img/sub/sub3/sub3_1/sub3g4.jpg" alt="아이콘"/></p>
							<h3>공항버스</h3>
							<p class="Area2_num"><?=$view['wr_bus_4']?></p>
						</li>
					</ul>
				</div>
    










            </div>









<!-- } 게시판 읽기 끝 -->

<script>

function copy_trackback(obj) {
    var address = $('.sub3_1view2_btn1').attr('valadd');
	var IE=(document.all)?true:false;
	if (IE) {
			window.clipboardData.setData("Text", address);
            alert('복사되었습니다.')
	} else {
		temp = prompt("이 글의 주소입니다. Ctrl+C를 눌러 클립보드로 복사하세요", address);
	}
}




<?php if ($board['bo_download_point'] < 0) { ?>
$(function() {
    

    var clipboard = new Clipboard('.clipboard');//로드 시 한번 선언 
    $("a.view_file_download").click(function() {
        if(!g5_is_member) {
            alert("다운로드 권한이 없습니다.\n회원이시라면 로그인 후 이용해 보십시오.");
            return false;
        }

        var msg = "파일을 다운로드 하시면 포인트가 차감(<?php echo number_format($board['bo_download_point']) ?>점)됩니다.\n\n포인트는 게시물당 한번만 차감되며 다음에 다시 다운로드 하셔도 중복하여 차감하지 않습니다.\n\n그래도 다운로드 하시겠습니까?";

        if(confirm(msg)) {
            var href = $(this).attr("href")+"&js=on";
            $(this).attr("href", href);

            return true;
        } else {
            return false;
        }
    });
});
<?php } ?>

function board_move(href)
{
    window.open(href, "boardmove", "left=50, top=50, width=500, height=550, scrollbars=1");
}
</script>

<script>


$(function() {

    $('.view2_txtArea ul li').each(function(){
        if($(this)[0].innerHTML.match('<br>')){
            var result = $(this)[0].innerHTML.split('<br>');
             //= explode("<br>", $(this)[0].innerHTML );
            $(this).text(result[1]);
           // $service_txt = explode("\r", $service_txt );
        }
    })





    $('.sub_titleHead h2').html("<?=$view['wr_subject'.$lang]?>");
    $('.sub_titleHead ul').append('<li><a href="" class="hover"><?=$view["wr_subject".$lang]?></a></li>');
    $('.hover_if').removeClass('hover');



    //resetPositon({ lat: parseFloat($('.map_info').attr('valInfoLat')), lng: parseFloat($('.map_info').attr('valInfoLng')) });
    $('.info_focus').click(function () {
        
    })
setTimeout(function(){ 
    resetPositon1({ lat: parseFloat($('.map_info').attr('valInfoLat')), lng: parseFloat($('.map_info').attr('valInfoLng')) });
}, 700);


    $("a.view_image").click(function() {
        window.open(this.href, "large_image", "location=yes,links=no,toolbar=no,top=10,left=10,width=10,height=10,resizable=yes,scrollbars=no,status=no");
        return false;
    });

    // 추천, 비추천
    $("#good_button, #nogood_button").click(function() {
        var $tx;
        if(this.id == "good_button")
            $tx = $("#bo_v_act_good");
        else
            $tx = $("#bo_v_act_nogood");

        excute_good(this.href, $(this), $tx);
        return false;
    });

    // 이미지 리사이즈
    $("#bo_v_atc").viewimageresize();
});

function excute_good(href, $el, $tx)
{
    $.post(
        href,
        { js: "on" },
        function(data) {
            if(data.error) {
                alert(data.error);
                return false;
            }

            if(data.count) {
                $el.find("strong").text(number_format(String(data.count)));
                if($tx.attr("id").search("nogood") > -1) {
                    $tx.text("이 글을 비추천하셨습니다.");
                    $tx.fadeIn(200).delay(2500).fadeOut(200);
                } else {
                    $tx.text("이 글을 추천하셨습니다.");
                    $tx.fadeIn(200).delay(2500).fadeOut(200);
                }
            }
        }, "json"
    );
}



</script>
<!-- } 게시글 읽기 끝 -->

<?
$map_lang = explode("_", $_SESSION['lang']);
?>
    
<script src="/skin/board/map/map.js"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDeGSv9G_NwSkiiG7C314_JALnZ-uaDuQQ&language=<?=$map_lang[0]?>&region=<?=$map_lang[1]?>"></script>
