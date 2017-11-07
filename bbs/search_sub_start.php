<div class="sub_contents">
	<div class="sub_leftNavi <?=set_class('sub_leftNavi_jp','ja_JP')?>">
		<h3 class="color5"><?=_t('통합검색')?></h3>
		<ul class="sub_leftNavi_list">
			<li><a href="/bbs/search_ktc.php?page=1&card_page=1<?=lang_url_a($_SESSION['lang'])?>" class="hover"><?=_t('통합검색')?></a></li>
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
			<h2><?=_t('통합검색')?></h2>

			<ul>
				<li><a href="/<?=lang_url($_SESSION['lang'])?>"><img src="/img/sub/subHead_home_icon.jpg" alt="<?=_t('홈')?>"/></a></li>
				<li><a href="" class="hover"><?=_t('통합검색')?></a></li>
			</ul>
		</div>

