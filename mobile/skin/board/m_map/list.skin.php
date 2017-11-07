<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');
// 선택옵션으로 인해 셀합치기가 가변적으로 변함
$colspan = 2;

if ($is_checkbox) $colspan++;

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);

$reuslt_cnt = sql_fetch("select count(*) cnt from ( select * from g5_write_".$bo_table." order by wr_num limit 0, ".$page_rows.") a" );
$reuslt_total = sql_fetch(" select count(*) cnt from g5_write_".$bo_table);

include_once('../skin/board/map/m_map_query.php');
include_once('../lib/thumbnail.lib.php');
//include_once('./juso.php');


?>



<style>

	.gm-style{}
	.gm-style div div div div{
		
	}
	.gm-style .gm-style-iw{
		overflow: inherit !important;
		text-align: center;
	}
	.gm-style .gm-style-iw div{
		overflow: inherit !important;
	}
	.gm-style .gm-style-iw div div #content img{margin-bottom:5px;}

	.gm-style .gm-style-iw div div a div{
		margin-bottom:8px;
		border-radius:3px;
		border:1px solid #484848 !important;
		float: initial !important;
		margin: 0 auto;
	}


	.firstHeading{
		font-family: Nanum Barun Gothic, sans-serif;
		margin-bottom:15px;
	}

	.mapViewBtn{
		float:right;
		width:150px;
		height:30px; 
		line-height:30px; 
		border:1px solid #333; 
		text-align:center;
		margin-bottom:5px;
	}

</style>





<? for ($i=0; $i < count($option); $i++) { ?>
    <div class='info_option' val='<?=$option[$i]?>'></div>
<? } ?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="../skin/board/map/map.js"></script>


<div class='remember_page' valPage='<?=$page?>' valRow='<?=$page_rows?>' ></div>

<? $cnt = 1; while($service = sql_fetch_array($service_row)){ ?>
  <div class='service_img_src_<?=$cnt++;?>' val="<?=$service['service_img']?>"></div>
<? } ?>

<div class='lang' valLang='<?=$lang?>'></div>
<div class='url' valUrl='<?=$url?>'></div>

<div id='map' style='width:100%; height:320px; display:none;'></div>

<div class="sub3_1area">
    <div class="sub31_tab">

        <ul class="store_searchTab">
            <li><a class="tab_link active" href="/bbs/board.php?bo_table=map&info=search&me_code=20&num=1<?=lang_url_a($_SESSION['lang'])?>"><?=_t('판매점 찾기')?></a></li>
            <li><a href="/bbs/board.php?bo_table=map&info=search&me_code=20&num=1&mapinfo=1<?=lang_url_a($_SESSION['lang'])?>" ids="1" class="tab_link"><?=_t('지역별 찾기')?></a></li>
        </ul>

        <div class="tabDetails">
            <div id="tab1" class="tabContents1">

                <div class="sub2_1form_area">
                    <div class="sub2_1form">

                        <form name="fsearchbox" method="get" action="" onclick='return false;' class="search_check">
                            <fieldset>
                                <input type='hidden' name='bo_table' value='<?=$bo_table;?>'>
                                <input type='hidden' name='info' value='<?=$info;?>'>
                                <input type='hidden' name='me_code' value='<?=$me_code;?>'>
                                <input type='hidden' name='num' value='<?=$num;?>'>
                                <input type='hidden' name='option' value='<?=$option?>' class='option_value'>
								<input type='hidden' name='lang' value='<?=lang_url($_SESSION['lang'])?>' >

                               
                                <label for="sch_stx" class="sound_only hide">검색어<strong class="sound_only"> 필수</strong></label>

                                <ul>
                                    <li class="search21_input">
                                        <label for="" class="hide">검색창</label>
                                        <input type="text" class="sub21_bar" name="word" id="sch_stx" value='<?=$word?>' maxlength="" placeholder="<?=_t('매장명 또는 주소를 입력하세요.')?>" >
                                    </li>

                                    <li class="search21_btn">
                                        <input type="image" class="syb21_loginbtn" id="sch_submit" src="/img/mobile/sub/sub2/sub2_1/sub2_1search.png" alt="<?=_t('검색')?>" title="<?=_t('검색')?>" />
                                    </li>
                                </ul>
                            
                            </fieldset>
                        </form>

                    </div><!-- sub2_1form 끝 -->
                </div><!-- sub2_1form_area 끝 -->


                <div class="sub21_storeChoi">
                    <div class="storeChoi_title">
                        <h3><?=_t('판매점 선택')?></h3>
                    </div>

                    <div class="storeChoi_check" style="display: none;">
                        <ul>
                            
                            <? while($row1 = sql_fetch_array($store_row)) { ?>
                              
                                <li id='<?=$row1['name']?>'>
                                    <input class='option_ck' val='1' id="sub21_chk1" type='checkbox' name='option[]' value='<?=$row1['id']?>' style=''  />
                                    <label for="sub21_chk1" onclick='return false;'><?=$row1['name_'.$_SESSION['lang'].'']?></label>
                                </li>

                            <? } ?> 

                        </ul>
                    </div><!-- storeChoi_check 끝 -->


                    <div class="sub2_1board">
                        <div class="sub2_1board_title">
                            <h3 class="table_number">
								<?if($_SESSION['lang']!="en_US"){?>
									<?=_t('판매점 검색결과')?> (<?=_t('총')?> <span><?php echo number_format($tatalCnt)?></span><?if($_SESSION['lang'] != 'en_US' ) echo _t('개');?>)
								<?}else{?>
									<?=_t('판매점 검색결과')?> (<span><?php echo number_format($tatalCnt)?></span> results in total)
								<?}?>
							</h3>
                        </div>

                        <div class="sub2_1info">

                            
                            <?$cnt=0; while ($result = sql_fetch_array($row)) { ?>

                                <? 
                                    //$thumb1 = get_list_thumbnail_ktc('allshop', $result['store_detail'], '150', '', false, true, 'center', true,'80/0.5/3',0);
                                    $thumb = get_list_thumbnail_ktc('allshop', $result['store_detail'], 114, 45, '', '', '', '','',0);
                                
                                ?>
                                <div class='sub2_1info_area'>

                                    <div class="info info_num_<?=$cnt?> sub21_info" style='background-image: url(""); position:relative;' valSrc='<?php echo $thumb['src']?>' valLink='<?=$result['wr_link1']?>'  valInfoLat='<?=$result['info_lat']?>' valCnt='<?=$cnt?>' valId='<?=$result['id']?>' valInfoLng='<?=$result['info_lng']?>'  valInfoNameko='<?=$result['info_name_'.$_SESSION['lang']]?>' valInfoNameen='<?=$result['info_name_en_US']?>' valInfoNameja='<?=$result['info_name_ja_JP']?>' valInfoNamech1='<?=$result['info_name_zh_CN']?>' valInfoNamech2='<?=$result['info_name_zh_TW']?>' style='cursor:pointer;'>
                                        <h3><?=$result['info_name_'.$_SESSION['lang']]?></h3>
                                        <p class="sub21_info_add"><?=$result['info_address_'.$_SESSION['lang']]?></p>

										<?if( $result['info_phone'] ){?>
											<a href = "tel:<?=$result['info_phone']?>"><p class="sub21_info_tel"><?=$result['info_phone']?></p></a>
										<?}?>
										<?if( $result['info_servicetime_'.$_SESSION['lang']] ){?>
											<p class="sub21_info_tel" style='background-image: url(/img/mobile/sub/sub3/sub3_1/sub31list_icon3.jpg' ><?=$result['info_servicetime_'.$_SESSION['lang']]?></p>
										<?}?>
                                        <ul class="service service_val" val='<?=$result['service_id']?>'></ul>
                                        <img class='img_pin' src='/img/mobile/sub/sub2/sub2_1/sub21_arrow1_1.png'>
                                    </div>
									



                                    <div class="sub21_map">
                                        <div class="sub21_map_area">
                                            
                                        </div>
                                    </div>
                                </div>


                                <div class='map_info' valcked='<?=$cnt?>' valSrc='<?php echo $thumb['src']?>'  valLink='<?=$result['wr_link1']?>' valTotalpage='<?=$totalPage?>' valId='<?=$result['id']?>' valInfoNameko='<?=$result['info_name_ko_KR']?>' valInfoNameen='<?=$result['info_name_en_US']?>' valInfoNameja='<?=$result['info_name_ja_JP']?>' valInfoNamech1='<?=$result['info_name_zh_CN']?>' valInfoNamech2='<?=$result['info_name_zh_TW']?>' valInfoAddressko='<?=$result['info_address_ko_KR']?>' valInfoAddressen='<?=$result['info_address_en_US']?>' valInfoAddressja='<?=$result['info_address_ja_JP']?>' valInfoAddressch1='<?=$result['info_address_zh_CN']?>' valInfoAddressch2='<?=$result['info_address_zh_TW']?>' valInfoLat='<?=$result['info_lat']?>' valInfoLng='<?=$result['info_lng']?>' valInfoServicetimeko='<?=$result['info_servicetime_ko_KR']?>' valInfoServicetimeen='<?=$result['info_servicetime_en_US']?>' valInfoServicetimeja='<?=$result['info_servicetime_ja_JP']?>' valInfoServicetimech1='<?=$result['info_servicetime_zh_CN']?>' valInfoServicetimech2='<?=$result['info_servicetime_zh_TW']?>' valNameko='<?=$result['name_ko_KR']?>' valNameen='<?=$result['name_en_US']?>' valNameja='<?=$result['name_ja_JP']?>' valNamech1='<?=$result['name_zh_CN']?>' valNamech2='<?=$result['name_zh_TW']?>' valTypeko='<?=$result['type_ko_KR']?>' valTypeen='<?=$result['type_en_US']?>' valTypeja='<?=$result['type_ja_JP']?>' valTypech1='<?=$result['type_zh_CN']?>' valTypech2='<?=$result['type_zh_TW']?>'></div>
                            <?$cnt++;}?>


                        </div><!-- sub2_1info 끝 -->

                    </div>

                    <script type="text/javascript">

                        $(document).ready(function(){
                            $(".storeChoi_check").hide();
                            $(".storeChoi_title").click(function() {
                                $(this).next(".storeChoi_check").slideToggle();
                                $(this).toggleClass("sub21_active")
                                        .siblings(".storeChoi_title").removeClass("sub21_active");
                                });

                            var d_map;
                           // var m_map;
                            var ccc = 0;

                            $(".img_pin").click(function(){

                                var th = $(this).parent();
                                var lats = parseFloat($(this).parent().attr('valInfoLat')); 
                                var lngs = parseFloat($(this).parent().attr('valInfoLng'));
                                var src = $(this).parent().attr('valSrc') ;
                                var link = $(this).parent().attr('valLink') ;
                                var name1 = $(this).parent().attr('valInfoName'+t_lang);

                                d_map = $('#map').detach();
                               // m_map = d_map;

                                var thisel = $(this).parent().parent().find(".sub21_map").css("display");
                                    $(".sub21_info").each(function(){
                                        var thatel = $(this).parent().find(".sub21_map").css("display");
                                        if(thisel != thatel){
                                        $(this).parent().find(".sub21_map").hide();
                                        $(this).children('img').attr('src','/img/mobile/sub/sub2/sub2_1/sub21_arrow1_1.png');
                                        }
                                    });


                                    $(this).parent().parent().find(".sub21_map").slideToggle("",function(){
                                        //$('.sub21_map_area').html("<div id='map' style='width:100%; height:479px;' class='div1'></div>");
                                        
                                        $(this).children('.sub21_map_area').html(d_map);
                                        $('#map').css('display','block');
                                        
                                        resetPositon_add({ lat: lats, lng:lngs }  , name1  ,  parseInt($(this).attr('valCnt')) , link , src );
                 
                                    });			

                                return false;
                            });



                            $(".img_pin").click(function(){
                                
                                var ck = $(this).parent().hasClass('sub21_active1');
                                
                                var class_name = $(this).parent().attr("class"); 
                                var class_name_arr = class_name.split(" ");
                                var menu_number = class_name_arr[0];
                                $("#" + menu_number).slideToggle();
                                

                                $('.sub21_active1').each(function(){
                                    $(this).removeClass("sub21_active1");
                                    //$(this).toggleClass("naviClick").siblings("#navigation .navigation_list li.b_sub .drop").removeClass("naviClick");
                                })
                                        
                                $(this).parent().toggleClass("sub21_active1").siblings(".sub21_info").removeClass("sub21_active1");
                                $(this).attr('src','/img/mobile/sub/sub2/sub2_1/sub21_arrow1_2.png');

        
                            

                                if(ck){
                                    $('.sub21_info').each(function(){
                                        $(this).removeClass("sub21_active1");
                                        $(this).children('img').attr('src','/img/mobile/sub/sub2/sub2_1/sub21_arrow1_1.png');
                                        // $('.sub21_map_area').each(function(){
                                        //     $(this).remove();
                                        // })
                                        //$(this).toggleClass("naviClick").siblings("#navigation .navigation_list li.b_sub .drop").removeClass("naviClick");
                                    })	
                                }

                                

                            });


                        });

                    </script>




                </div><!-- storeChoi_check 끝 -->



                <?if( $tatalCnt > $page_rows){?>
                
                <div class="subMore_btn">
                    <div class="subMore_btn_area">
                        <a>
                            <p class="subMore_icon"></p>
                            <?if( $tatalCnt < $page_rows ){
                                $tatalCnt_view = $page_rows;
                            }else{
                                $tatalCnt_view = $tatalCnt;
                            }                        
                            ?>
                            <p class="subMore_info">(<?=($page-1)*$page_rows + $cnt?> / <?=$tatalCnt_view?>)</p>
                        </a>
                    </div>
                </div>

                <?}?>

            </div><!--탭1 끝-->



        </div><!-- tabDetails 끝 -->
    </div>



</div><!-- sub3_1area 끝 -->
</div><!-- sub31_tab 끝 -->





















































<?if( $tatalCnt >= $page_rows ){?>

<script>
$(function(){
    $('.subMore_btn_area a').click(function(){
		$(this).html('<div style="padding-top:10px;" ><i class="fa fa-spinner fa-spin fa-2x fa-fw "></i><span class="sr-only">Loading...</span></div>');
		$('.subMore_btn_area a').unbind('click');
        var str = "";
        var ck = 0;
        $('.option_ck').each(function(index){
            if($(this).is(':checked')){
                    if(ck == 0){
                        str = $(this).attr('value');
                        ck++;
                    }else{
                        str += ","+$(this).attr('value');
                    }
            }
        })

        $.ajax({
            url: "/bbs/ajax.listadd_map.php",
            data: {
                    'page': $('.remember_page').attr('valPage'),
                    'page_rows': '<?=$page_rows?>',
                    'bo_table': '<?=$bo_table?>',
                    'ww': <?=$board["bo_mobile_gallery_width"]?>,
                    'hh': <?=$board["bo_mobile_gallery_height"]?>,
                    'subject_len': <?=$board["bo_mobile_subject_len"]?>,
                    'info': '<?=$info?>',
                    'me_code': '<?=$me_code?>',
                    'num': '<?=$num?>',
                    'word': '<?=$word?>',
                    'word1': '<?=$word1?>',
                    'option': str,
					'search' : '<?=$search?>'
                  },
            success:function(data){
                $('.subMore_btn').remove();
                var page_num = parseInt($('.remember_page').attr('valPage'))+1;
                var page_row = parseInt($('.remember_page').attr('valRow'));
                $('.sub21_storeChoi').append(data);
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
<?
$map_lang = explode("_", $_SESSION['lang']);
?>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCIX9g1T3yPSC5_ewJO25c7mCiRs0clTU8&language=<?=$map_lang[0]?>&region=<?=$map_lang[1]?>"></script>