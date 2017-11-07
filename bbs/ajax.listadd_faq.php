<?
include_once('./_common.php');
include_once(G5_LIB_PATH.'/thumbnail.lib.php');


if( !$stx && !$cate ){  // 아무런 조건이 없을때
    $result_add = sql_query(" select * from g5_faq where fm_id = ".$fm_id." order by fa_order limit ".($page*$page_rows).", ".$page_rows);
    $reuslt_cnt = sql_fetch("select count(*) cnt from ( select * from g5_faq where fm_id = ".$fm_id." order by fa_order limit ".($page*$page_rows).", ".$page_rows.") a" );
    $reuslt_total = sql_fetch(" select count(*) cnt from g5_faq where fm_id = ".$fm_id."");
}else if($stx){  //검색단어가 있을때
    $result_add = sql_query(" select * from g5_faq where fm_id = ".$fm_id." and fa_subject like '%".$stx."%' or fa_content like '%".$stx."%' order by fa_order limit ".($page*$page_rows).", ".$page_rows);
    $reuslt_cnt = sql_fetch("select count(*) cnt from ( select * from g5_faq where fm_id = ".$fm_id." and fa_subject like '%".$stx."%' or fa_content like '%".$stx."%' order by fa_order limit ".($page*$page_rows).", ".$page_rows.") a" );
    $reuslt_total = sql_fetch(" select count(*) cnt from g5_faq where fm_id = ".$fm_id." and fa_subject like '%".$stx."%' or fa_content like '%".$stx."%' ");
}else if($cate){  // 카테고리 선택했을때
    $result_add = sql_query(" select * from g5_faq where fm_id = ".$fm_id." and fa_cate like '%".$cate."%' order by fa_order limit ".($page*$page_rows).", ".$page_rows);
    $reuslt_cnt = sql_fetch("select count(*) cnt from ( select * from g5_faq  where fm_id = ".$fm_id." and fa_cate like '%".$cate."%' order by fa_order limit ".($page*$page_rows).", ".$page_rows.") a" );
    $reuslt_total = sql_fetch(" select count(*) cnt from g5_faq where fm_id = ".$fm_id." and fa_cate like '%".$cate."%'");
}else if($stx && $cate){  // 둘다 검색했을때
    $result_add = sql_query(" select * from g5_faq where fm_id = ".$fm_id." and fa_cate like '%".$cate."%' and fa_subject like '%".$stx."%' or fa_content like '%".$stx."%' order by fa_order limit ".($page*$page_rows).", ".$page_rows);
    $reuslt_cnt = sql_fetch("select count(*) cnt from ( select * from g5_faq where fm_id = ".$fm_id." and fa_cate like '%".$cate."%' and fa_subject like '%".$stx."%' or fa_content like '%".$stx."%' order by fa_order limit ".($page*$page_rows).", ".$page_rows.") a" );
    $reuslt_total = sql_fetch(" select count(*) cnt from g5_faq where fm_id = ".$fm_id." and fa_cate like '%".$cate."%' and fa_subject like '%".$stx."%' or fa_content like '%".$stx."%' ");
}





while($row = sql_fetch_array($result_add) ){
    $str_subject = cut_str(strip_tags($row['wr_subject']),10000);
?>

    <div class="sub4_5info_area">
                        
        <div class="sub45_info sub45_info<?=$page?>" style='background-image: url("/img/mobile/sub/sub4/sub4_5/sub41_arrow.png")'>
            <h3>[<?echo _t(conv_content($row['fa_cate'], 1));?>]</h3>

            <table>
                <tr>
                    <td style="padding-right:7px; vertical-align: top;"><img src="/img/mobile/sub/sub4/sub4_5/faq_q.jpg" alt="질문"/></td>
                    <td><?php echo conv_content($row['fa_subject'], 1);?></td>
                </tr>
            </table>

            <!--<p class="sub45_info_q"><span><img src="/img/mobile/sub/sub4/sub4_5/faq_q.jpg" alt="질문"/></span><?php echo conv_content($row['fa_subject'], 1);?></p>-->
            <p class="sub45_info_date"><?=substr($row['wr_datetime'],0,10);?></p>
        </div>
        
        <div class="sub45_a">
            <div class="sub45_a_area">
                <table>
                    <tr>
                        <td style="padding-right:7px; vertical-align: top;"><img src="/img/mobile/sub/sub4/sub4_5/faq_a.jpg" alt="답변"/></td>
                        <td><?php echo conv_content($row['fa_content'], 1); ?></td>
                    </tr>
                </table>
            </div>
        </div>               
        
    </div>



<?}?>

<script>
    $(document).ready(function(){

        $(".sub45_info<?=$page?>").click(function(){
            var thisel = $(this).parent().find(".sub45_a").css("display");
                $(".sub45_info<?=$page?>").each(function(){
                    var thatel = $(this).parent().find(".sub45_a").css("display");
                    if(thisel != thatel){
                    $(this).parent().find(".sub45_a").hide();
                    }
                });
                $(this).parent().find(".sub45_a").slideToggle("");			

            return false;
        });



        $(".sub45_info<?=$page?>").click(function(){
            var ck = $(this).hasClass('sub45_active1');
            
            var class_name = $(this).attr("class"); 
            var class_name_arr = class_name.split(" ");
            var menu_number = class_name_arr[0];
            $("#" + menu_number).slideToggle();
            

            $('.sub45_active1').each(function(){
                $(this).removeClass("sub45_active1");
                //$(this).toggleClass("naviClick").siblings("#navigation .navigation_list li.b_sub .drop").removeClass("naviClick");
            })
                    
            $(this).toggleClass("sub45_active1").siblings(".sub45_info<?=$page?>").removeClass("sub45_active1");

            if(ck){
                $('.sub45_info<?=$page?>').each(function(){
                    $(this).removeClass("sub45_active1");
                    //$(this).toggleClass("naviClick").siblings("#navigation .navigation_list li.b_sub .drop").removeClass("naviClick");
                })	
            }

        });


    });

</script>



<?if(($page)*$page_rows + $reuslt_cnt['cnt'] < $reuslt_total['cnt']){?>
<div class="subMore_btn" style='padding-top:30px;'>
    <div class="subMore_btn_area">
        <a>
            <p class="subMore_icon"></p>
            <p class="subMore_info">(<?=($page)*$page_rows + $reuslt_cnt['cnt']?> / <?echo $reuslt_total['cnt']?>)</p>
        </a>
    </div>
</div>
<?}?>

<?if(($page)*$page_rows + $reuslt_cnt['cnt'] != $reuslt_total['cnt']){?>

<script>
$(function(){

    $('.subMore_btn_area a').click(function(){
		$(this).html('<div style="padding-top:10px;" ><i class="fa fa-spinner fa-spin fa-2x fa-fw "></i><span class="sr-only">Loading...</span></div>');
		$('.subMore_btn_area a').unbind('click');
        $.ajax({
            url: "/bbs/ajax.listadd_faq.php",
            data: {
                    'page': $('.remember_page').attr('valPage'),
                    'page_rows': '10',
                    'info': '<?=$info?>',
                    'me_code': '<?=$me_code?>',
                    'num': '<?=$num?>',
                    'cate': '<?=$cate?>',
                    'stx': '<?=$stx?>',
					'fm_id': '<?=$fm_id?>'
                  },
            success:function(data){
                $('.subMore_btn').remove();
                var page_num = parseInt($('.remember_page').attr('valPage'))+1;
                var page_row = parseInt($('.remember_page').attr('valRow'));
                $('.sub46_list').append(data);
                $('.remember_page').attr('valPage',page_num);
                
            }
        })
    })

})


</script>

<?}?>


