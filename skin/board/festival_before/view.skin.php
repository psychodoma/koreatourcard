<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>

<script src="<?php echo G5_JS_URL; ?>/viewimageresize.js"></script>

<!-- 게시물 읽기 시작 { -->
<!-- div id="bo_v_table"><?php echo $board['bo_subject']; ?></div -->
<?

if( $ck != 1 ){
    

    $mon = date("Ym");

    $next_mon = $next_mon1."/".$next_mon2;

    $str = "";
    if($sca == '축제행사'){
        if($today){
            if($list == "up"){
                $str = "select * from g5_write_festival where wr_subject_ko_KR >= ".$today." and ca_name = '축제&행사' order by wr_subject_ko_KR asc";
                $str_cnt = "select count(*) cnt from g5_write_festival where wr_subject_ko_KR >= ".$today." and ca_name = '축제&행사' order by wr_subject_ko_KR asc";
            }else{
                $str = "select * from g5_write_festival where wr_subject_ko_KR <= ".$today." and ca_name = '축제&행사' order by wr_subject_ko_KR desc";
                $str_cnt = "select count(*) cnt from g5_write_festival where wr_subject_ko_KR <= ".$today." and ca_name = '축제&행사' order by wr_subject_ko_KR desc";      
            }
        }else{
            if($list == "up"){
                $str = "select * from g5_write_festival where wr_subject_ko_KR <= ".$mon." and ca_name = '축제&행사' order by wr_subject_ko_KR desc";
                $str_cnt = "select count(*) cnt from g5_write_festival where wr_subject_ko_KR <= ".$mon." and ca_name = '축제&행사' order by wr_subject_ko_KR desc";
                
            }else{
                $str = "select * from g5_write_festival where wr_subject_ko_KR >= ".$mon." and ca_name = '축제&행사' order by wr_subject_ko_KR asc"; // 끝
                $str_cnt = "select count(*) cnt from g5_write_festival where wr_subject_ko_KR >= ".$mon." and ca_name = '축제&행사' order by wr_subject_ko_KR asc"; // 끝     
            }
        }


    }else{
        if($today){
            if($list == "up"){
                $str = "select * from g5_write_festival where wr_subject_ko_KR >= ".$today." and ca_name = '공연&전시' order by wr_subject_ko_KR asc";
                $str_cnt = "select count(*) cnt from g5_write_festival where wr_subject_ko_KR >= ".$today." and ca_name = '공연&전시' order by wr_subject_ko_KR asc";
            }else{
                $str = "select * from g5_write_festival where wr_subject_ko_KR <= ".$today." and ca_name = '공연&전시' order by wr_subject_ko_KR desc";
                $str_cnt = "select count(*) cnt from g5_write_festival where wr_subject_ko_KR <= ".$today." and ca_name = '공연&전시' order by wr_subject_ko_KR desc";      
            }
        }else{
            if($list == "up"){
                $str = "select * from g5_write_festival where wr_subject_ko_KR <= ".$mon." and ca_name = '공연&전시' order by wr_subject_ko_KR desc";
                $str_cnt = "select count(*) cnt from g5_write_festival where wr_subject_ko_KR <= ".$mon." and ca_name = '공연&전시' order by wr_subject_ko_KR desc";
                
            }else{
                $str = "select * from g5_write_festival where wr_subject_ko_KR >= ".$mon." and ca_name = '공연&전시' order by wr_subject_ko_KR asc"; // 끝
                $str_cnt = "select count(*) cnt from g5_write_festival where wr_subject_ko_KR >= ".$mon." and ca_name = '공연&전시' order by wr_subject_ko_KR asc"; // 끝     
            }
        }
    }
    

    $sql_month = sql_fetch($str);
    $sql_month_cnt = sql_fetch($str_cnt);

    if($sql_month_cnt['cnt'] == 0){
        echo "<script>alert(\"글이 없습니다..\"); history.back();</script>";
    }

    $days = 1;

    if($today){
        
    }else{
        $today = date("Y/m");
    }
    

    $prev_mon = $write['wr_subject_ko_KR'] -1;
    $prev_mon11 = $write['wr_subject_ko_KR'] ;

    $prev_mon1 = substr($prev_mon, 0, 4) ;
    $prev_mon2 = substr($prev_mon, 4, 2) ;

    if($prev_mon2 == 00){
        $prev_mon1--;
        $prev_mon2 = 12;
    }

    $prev_mon = $prev_mon1."/".$prev_mon2;


    $next_mon = $write['wr_subject_ko_KR'] +1;
    $next_mon22 = $write['wr_subject_ko_KR'] ;

    $next_mon1 = substr($next_mon, 0, 4) ;
    $next_mon2 = substr($next_mon, 4, 2) ;

    if($prev_mon2 == 13){
        $prev_mon1++;
        $prev_mon2 = 01;
    }
    $next_mon = $next_mon1."/".$next_mon2;

    if($list == "up"){
        //while( $row = sql_fetch_array($sql_month) ){

            //if( $row['wr_subject'] >= $today){
                echo("<script>location.href='/bbs/board.php?bo_table=festival&wr_id=".$sql_month['wr_id']."&sca=".$sca."&info=".$info."&me_code=".$me_code."&ck=1&num=".$num."';</script>"); 
           // }
            // }else{
            //     $today = date("Y/m", strtotime("+".$days."month"));
            //     $days++;
            // }
       // }
    }else{
       // while( $$sql_month = sql_fetch_array($sql_month) ){
           // if( $row['wr_subject'] <= $today){
               // exit();
                echo("<script>location.href='/bbs/board.php?bo_table=festival&wr_id=".$sql_month['wr_id']."&sca=".$sca."&info=".$info."&me_code=".$me_code."&ck=1&num=".$num."';</script>"); 
           // }
            // }else{
            // echo $today;
            // echo $row['wr_subject'];
            // echo "||||||||||";

            //     $today = date("Y/m", strtotime("-".$days."month"));
            //     $days++;
            // }
      //  }
    }

     echo("<script>location.href='/bbs/board.php?bo_table=festival&wr_id=".$wr_id."&sca=".$sca."&info=".$info."&me_code=".$me_code."&num=".$num."';</script>"); 

}


$next_page_info_result = sql_fetch("select * from g5_write_".$bo_table."  where wr_id < ".$wr_id." order by wr_id desc");
$prev_page_info_result = sql_fetch("select * from g5_write_".$bo_table."  where wr_id > ".$wr_id." ");


$fetivaltitle = explode('/',$write['wr_subject']);
$fe_title = "";
$fe_img = 0;
if($_SESSION['lang'] == "ko_KR" || $_SESSION['lang'] == ""){
    $fe_title = $fetivaltitle[0]."년 ".$fetivaltitle[1]."월";
}else if($_SESSION['lang'] == "en_US"){
    $fe_title = get_en_ktc($fetivaltitle[1])." ".$fetivaltitle[0]."Year";
    $fe_img = 1;
}else if($_SESSION['lang'] == "ja_JP"){
    $fe_title = $fetivaltitle[0]."년 ".$fetivaltitle[1]."월";
    $fe_img = 2;
}else if($_SESSION['lang'] == "zh_CN"){
    $fe_title = $fetivaltitle[0]."년 ".$fetivaltitle[1]."월";
    $fe_img = 3;
}else if($_SESSION['lang'] == "zh_TW"){
    $fe_title = $fetivaltitle[0]."년 ".$fetivaltitle[1]."월";
    $fe_img = 4;
}




// if()

?>






		<div class="sub1_3center">
			<div class="sub1_3topTxt">
				<h4><?php echo $board['bo_subject'] ?></h4>
			</div>

			

            <div class="sub4_trafficTab" style='margin-bottom:0;'>
                <ul class="traffic_searchTab">
                    <li style='width:50%;'><a href="./board.php?bo_table=festival&wr_id=1&sca=축제행사&info=<?=$info?>&me_code=40&num=3"  class="tab_link <?if($sca == "축제행사") echo "active"; ?>" href="#tab1">축제/행사</a></li>
                    <li style='width:50%;'><a href="./board.php?bo_table=festival&wr_id=1&sca=공연전시&info=<?=$info?>&me_code=40&num=3" ids="1" class="tab_link <?if($sca == '공연전시') echo 'active';?>">공연/전시</a></li>
                </ul>
            </div>

            <?$mons = $write['wr_subject_ko_KR']-1;

                $prev_mon1 = substr($mons, 0, 4) ;
                $prev_mon2 = substr($mons, 4, 2) ;

                if($prev_mon2 == 00){
                    $prev_mon1--;
                    $prev_mon2 = "12";
                }  
                $mons = $prev_mon1.$prev_mon2;
            ?>
            <?$mons1 = $write['wr_subject_ko_KR']+1;
            
                $prev_mon1 = substr($mons1, 0, 4) ;
                $prev_mon2 = substr($mons1, 4, 2) ;

                if($prev_mon2 == 13){
                    $prev_mon1++;
                    $prev_mon2 = "01";
                }
                $mons1 = $prev_mon1.$prev_mon2;  



            
            ?>

            <div class="sub4_3calendar">
                <a href='./board.php?bo_table=festival&wr_id=1&sca=<?=$sca?>&info=<?=$info?>&me_code=40&num=3&today=<?=$mons?>'>
					<div style='float:left; width:33%; text-align:right;'><i class="fa fa-chevron-left fa-2x" aria-hidden="true"></i></div>
				</a>

                <div class="sub4_3calendar_title"><?=$fe_title?></div>

                <a href='./board.php?bo_table=festival&wr_id=1&sca=<?=$sca?>&info=<?=$info?>&me_code=40&num=3&list=up&today=<?=$mons1?>'>
					<div style='float:left; width:33%; text-align:left;'><i class="fa fa-chevron-right fa-2x" aria-hidden="true"></i></div>
				</a>
            </div>


            <?$thumb = get_list_thumbnail('festival', $wr_id, '976', '',false, true, 'center', true,'80/0.5/3',$fe_img);?>


            <img src='<?=$thumb['src']?>'>	

            <!--<div style='padding: 100px 0 50px 0px;'>
                <div id="bo_v_con"><?php echo get_view_thumbnail($view['content']); ?></div>
            </div>-->
		</div>




<!-- } 게시판 읽기 끝 -->

<script>
<?php if ($board['bo_download_point'] < 0) { ?>
$(function() {
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