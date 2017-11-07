<?
	$sql2 = " select *
				from {$g5['menu_table']}
				where me_use = '1'
				and length(me_code) = '4'
				and substring(me_code, 1, 2) = '{$_SESSION['me_code'.$me_code]}'
				order by me_order, me_id ";
	$result2 = sql_query($sql2);


	$info_sql = sql_fetch('select * from g5_menu where me_url = "'.$info.'" order by me_code desc');


	// header("Content-Type: text/html; charset=UTF-8");
	// $str = $info;
	// if($HTTP_REFERER == "")
	// $info = iconv("euc-kr", "utf-8", $str);

?>



<div class="sub_contents">
	<div class="sub_leftNavi <?=set_class('sub_leftNavi_jp','ja_JP')?>">
		<h3 class="color<?=$num+1?>"><?echo _t($_SESSION['me_name'.$me_code.''])?></h3>
		<ul class="sub_leftNavi_list">
			 <?for ($k=0; $row3=sql_fetch_array($result2); $k++) {?>
				<li><a href="<?php echo $row3['me_link']."&info=".$row3['me_url']."&me_code=".$me_code."&num=".$num ?><?=lang_url_a($_SESSION['lang'])?>" target="_<?php echo $row3['me_target']; ?>" class="<?if( $info == $row3['me_url'] || "local" == $info && "search" == $row3['me_url']) {
					echo "hover";
				 }?>"><?=_t($row3['me_name'])?></a></li>
			 <?}?>
			<!--<li><a href="">코리아투어카드 정보</a></li>
			<li><a href="">코리아투어카드 홍보센터</a></li>-->
			<li class="leftIcon_area">
				<ul class="leftIcon <?=set_class('leftIcon_cn','zh_CN/zh_TW')?>">
					<li>
						<a href="/bbs/content.php?co_id=company&info=cardguide&me_code=10<?=lang_url_a($_SESSION['lang'])?>">
							<div class="leicon1"></div>
							<p><?=_t('가이드북')?></p>
						</a>
					</li>

					<li>
						<a href="/bbs/board.php?bo_table=map&info=search&me_code=20&num=1<?=lang_url_a($_SESSION['lang'])?>">
							<div class="leicon2"></div>
							<p><?=_t('판매점')?></p>
						</a>
					</li>

					<li>
						<a href="/bbs/faq.php?&info=qa&me_code=40&num=3<?=lang_url_a($_SESSION['lang'])?>">
							<div class="leicon3"></div>
							<p>FAQ</p>
						</a>
					</li>
				</ul>
			</li>
		</ul>
	</div><!-- sub_leftNavi -->


	<div class="sub_cont">

		<div class="sub_titleHead">
			<h2>
				<?if($info != "local"){?>
					<?=_t($info_sql['me_name'])?>
				<?}else{?>
					<?=_t("지역별 찾기")?>
				<?}?>
			</h2>

<?
	$url = "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
	$url = explode('wr_id=',$url);


	$url_end = explode('&',$url[1]);
	$url_str = "";

	for($i=1; $i<count($url_end); $i++){
		$url_str .= "&".$url_end[$i];
	}



	$url_str = $url[0].$url_str;
?>
			<ul>
				<li><a href="/<?=lang_url($_SESSION['lang'])?>"><img src="/img/sub/subHead_home_icon.jpg" alt="<?=_t('홈')?>"/></a></li>
				<?if($_SESSION['me_name'.$me_code.''] == "카드소개"){?>
					<li><a href="/bbs/content.php?co_id=company&info=cardguide&me_code=10&num=0<?=lang_url_a($_SESSION['lang'])?>"><?echo _t($_SESSION['me_name'.$me_code.''])?></a></li>
				<?}else if($_SESSION['me_name'.$me_code.''] == "판매점안내"){?>
					<li><a href="/bbs/board.php?bo_table=map&info=search&me_code=20&num=1<?=lang_url_a($_SESSION['lang'])?>"><?echo _t($_SESSION['me_name'.$me_code.''])?></a></li>
				<?}else if($_SESSION['me_name'.$me_code.''] == "판매점안내" ){?>
					<li><a href="/bbs/board.php?bo_table=map&info=search&me_code=20&num=1<?=lang_url_a($_SESSION['lang'])?>"><?echo _t($_SESSION['me_name'.$me_code.''])?></a></li>
				<?}else if($_SESSION['me_name'.$me_code.''] == "카드사용혜택"){?>
					<li><a href="/bbs/board.php?bo_table=cardbenefit&info=benefit&me_code=30&num=2<?=lang_url_a($_SESSION['lang'])?>"><?echo _t($_SESSION['me_name'.$me_code.''])?></a></li>
				<?}else if($_SESSION['me_name'.$me_code.''] == "이벤트 & 커뮤니티"){?>
					<li><a href="/bbs/board.php?bo_table=tourinfo&sca=테마여행%20추천코스&info=event&me_code=40&num=3<?=lang_url_a($_SESSION['lang'])?>"><?echo _t($_SESSION['me_name'.$me_code.''])?></a></li>
				<?}?>



				<?if( $info == "local" ){?>
					<li><a href="<?=$url_str?>" class="hover hover_if"><?echo _t('지역별 찾기')?></a></li>
				<?}else{?>
					<li><a href="<?=$url_str?>" class="hover hover_if"><?=_t($info_sql['me_name'])?></a></li>
				<?}?>
			</ul>
		</div>
