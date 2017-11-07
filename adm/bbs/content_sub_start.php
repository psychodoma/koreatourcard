<?
	$sql2 = " select *
				from {$g5['menu_table']}
				where me_use = '1'
				and length(me_code) = '4'
				and substring(me_code, 1, 2) = '{$_SESSION['me_code'.$me_id]}'
				order by me_order, me_id ";
	$result2 = sql_query($sql2);
?>



<div class="sub_contents">
	<div class="sub_leftNavi">
		<h3 class="color<?=$num+1?>"><?echo $_SESSION['me_name'.$me_id.'']?></h3>
		<ul class="sub_leftNavi_list">
			 <?for ($k=0; $row3=sql_fetch_array($result2); $k++) {?>
				<li><a href="<?php echo $row3['me_link']."&me_id=".$me_id."&num=".$num ?>" target="_<?php echo $row3['me_target']; ?>" class="<?if( $info == $row3['me_name'] ) {echo "hover"; }?>"><?=$row3['me_name']?></a></li>
			 <?}?>
			<!--<li><a href="">코리아투어카드 정보</a></li>
			<li><a href="">코리아투어카드 홍보센터</a></li>-->
			<li class="leftIcon_area">
				<ul class="leftIcon">
					<li>
						<a href="">
							<img src="<?echo $g5['tmpl_url']?>/img/sub/subLeft_icon1.jpg" alt=""/>
							<p>이용안내</p>
						</a>
					</li>

					<li>
						<a href="">
							<img src="<?echo $g5['tmpl_url']?>/img/sub/subLeft_icon2.jpg" alt=""/>
							<p>판매처</p>
						</a>
					</li>

					<li>
						<a href="">
							<img src="<?echo $g5['tmpl_url']?>/img/sub/subLeft_icon3.jpg" alt=""/>
							<p>FAQ</p>
						</a>
					</li>
				</ul>
			</li>
		</ul>
	</div><!-- sub_leftNavi -->
	

	<div class="sub_cont">
	
		<div class="sub_titleHead">
			<h2><?=$info?></h2>


			<ul>
				<li><a href="index.html"><img src="<?echo $g5['tmpl_url']?>/img/sub/subHead_home_icon.jpg" alt="홈"/></a></li>
				<li><a href=""><?echo $_SESSION['me_name'.$me_id.'']?></a></li>
				<li><a href="" class="hover"><?=$info?></a></li>
			</ul>
		</div>

