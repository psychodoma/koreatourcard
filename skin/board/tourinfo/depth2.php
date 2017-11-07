<?
$row_page = 9;  // 페이지당 개수
//$list = get_tourinfo_depth_list($g_id);
$list = ktc_get_table_list("g5_write_tourinfo" ,$stx, $sca, $page ,$row_page, $g_id);
$list_cnt = ktc_get_table_list_cnt("g5_write_tourinfo" ,$stx, $sca, $page ,$row_page,$g_id);
$total_page = ktc_total_page( $list_cnt['cnt'], $row_page );
?>


<ul class="sub4_1List <?if( $sca == "지역별 여행 추천 코스" ) echo "test11";?>">
    <?if($list_cnt['cnt'] != 0){?>
        <?php
            $i=0;while( $row = sql_fetch_array($list) ){
            $thumb = get_list_thumbnail($board['bo_table'], $row['wr_id'], '308', '',false, true, 'center', true,'80/0.5/3',0);
            ?>
            <li <?if($i%3 == 2) echo "class='li_margin_r'"; ?> >
                <div class="grid">
                    <div class="effect-bubba">
                        <?if($thumb['src']){?>
                            <img src="<?php echo $thumb['src']?>" class="imgsell" alt=""/>
                        <?}else{?>
                            <img src="/img/default/ktc_tourinfo.png" class="imgsell" alt=""/>
                        <?}?>
                        

						<a href="/bbs/board.php?bo_table=tourinfo&info=<?=$info?>&me_code=<?=$me_code?>&num=<?=$num?>&sca=<?=urlencode($sca)?>&g_id=<?=$g_id?>&wr_id=<?=$row['wr_id']?><?=lang_url_a($_SESSION['lang'])?>" >
							<div class="figcap bg1">
								<p class="sub_41Title"><?=$row['wr_subject_'.$_SESSION['lang']]?></p>
								<h2 class="<?if( $sca == "지역별 여행 추천 코스" ) echo "plusicon";?>" ><img src="/img/sub/sub3/sub3_1/sub3_1more.png" alt="더보기 아이콘"/></h2>
								<h3 class="hover_more"><?=$row['wr_subject_'.$_SESSION['lang']]?></h3>
								<p class="hover_more1"><?=$row['wr_simple_'.$_SESSION['lang']]?></p>
							</div>		
						</a>
                    </div>
                </div>
            </li>
        <?$i++;}?>
    <?}else{?>
        <?if( $stx ){?>
            <p class="sub5_search_false"><?=_t('검색 결과가 없습니다.')?></p>
        <?}else{?>
         <p class="sub5_search_false"><?=_t('게시물이 없습니다.')?></p>
         <?}?>
    <?}?>
</ul>

<?php 
$write_pages = get_paging_ktc($config[cf_write_pages], $page, $total_page, "./board.php?bo_table=$bo_table".$qstr,"&info=".$info."&me_code=".$me_code."&num=".$num."&g_id=".$g_id.lang_url_a($_SESSION['lang']));
echo $write_pages; 
?>