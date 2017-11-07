<?

if(!$card_page){
    $card_page = 1;
}
// -------------변수 설명-------------
// $row['g_img'] 백그라인드 이미지 주소
// $row['g_icon'] 아이콘 이미지 주소
// $row['g_name'] 제목 
// ----------------------------------
$page_rows = 9;  // 페이지당 개수
//$list = get_tourinfo_depth_list($g_id);

$list = get_group_list('tourinfo',$sca,$card_page,$page_rows);
$list_cnt = get_group_list_cnt('tourinfo',$sca);
$total_page = ktc_total_page( $list_cnt['cnt'], $page_rows );
$url = ktc_get_url();
?>
<ul class="sub4_1List_D <?if( $sca == "지역별 여행 추천 코스" ) echo "test11";?>">
    <?$i=0;while( $row = sql_fetch_array($list) ){?>
        <li <?if($i%3 == 2) echo "class='li_margin_r'"; ?> >
            <div class="grid">
                <div class="effect-bubba">
                    <img src="<?=$row['g_img']?>" class="imgsell" alt=""/>
					<a href="<?=$url?>&g_id=<?=$row['g_id']?><?=lang_url_a($_SESSION['lang'])?>">
						<div class="figcap bg1">
							<h2><img src="<?=$row['g_icon']?>"/></h2>
							<h3 class="hover_more"><?=_t($row['g_name_ko_KR']);?></h3>
							<p class="hover_more1"></p>
							<!--<a href="<?=$url?>&g_id=<?=$row['g_id']?>">View more</a>-->
						</div>
					</a>
					
					<div class="List_D_bg"></div>
                </div>
            </div>
        </li> 
    <?$i++;}?>
</ul>


<?php 
$write_pages = get_paging_ktc1($config[cf_write_pages], $card_page, $total_page, "./board.php?bo_table=$bo_table".$qstr,"&info=".$info."&me_code=".$me_code."&num=".$num.lang_url_a($_SESSION['lang']));
echo $write_pages; 
?>

