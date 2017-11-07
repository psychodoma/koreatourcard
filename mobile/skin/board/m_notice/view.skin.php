<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>

<script src="<?php echo G5_JS_URL; ?>/viewimageresize.js"></script>


		<div class="sub1_3area mb60">
			<!--
			<div class="sub1_3topTxt">
				<h4><?=$board['bo_mobile_subject']?></h4>
			</div>
			-->
			
			<div class="sub13_board_view">
				<table class="sub1_3table_view">
					<tr>
						<td class="title">
							<h2><?echo cut_str(get_text($view['wr_subject_'.$_SESSION['lang']]), 70);?></h2>
							<p><?=substr($view['wr_datetime'],0,10);?></p>
						</td>
					</tr>

						<!--파일 다운-->
						<?if($view['file']['count']){?>

						<tr>
							<td colspan='3' class="fileDown">
								<?php
								if ($view['file']['count']) {
									$cnt = 0;
									for ($i=0; $i<count($view['file']); $i++) {
										if (isset($view['file'][$i]['source']) && $view['file'][$i]['source'] && !$view['file'][$i]['view'])
											$cnt++;
									}
								}
								?>

								<?php if($cnt) { ?>
								<!-- 첨부파일 시작 { -->
								<section id="bo_v_file">
									<h2><?=_t('첨부파일')?></h2>
									<ul>
									<?php
									// 가변 파일
									for ($i=0; $i<count($view['file']); $i++) {
										if (isset($view['file'][$i]['source']) && $view['file'][$i]['source'] && !$view['file'][$i]['view']) {
									?>
										<li>
											<a href="<?php echo $view['file'][$i]['href'];  ?>" class="view_file_download">
											<?
													$file_source = addslashes($view['file'][$i]['source']);
													$file_type = $$ext = preg_replace('/^.*\.([^.]+)$/D', '$1', $file_source);
													echo "<img src='/skin/board/notice/filetype/". $file_type .".gif' border=0>";
											?>
												<strong><?php echo $view['file'][$i]['source'] ?></strong>
												<?php echo $view['file'][$i]['bf_content'] ?> (<?php echo $view['file'][$i]['size'] ?>)
											</a>
											<!--<span class="bo_v_file_cnt"><?php echo $view['file'][$i]['download'] ?>회 다운로드</span>-->
											<span class="fileDownDate">DATE : <?php echo substr($view['file'][$i]['datetime'],0,10) ?></span>
										</li>
									<?php
										}
									}
									?>
									</ul>
								</section>
								<!-- } 첨부파일 끝 -->
								<?php } ?>
							</td>
						</tr>

						<?}?>
						<!--파일 다운 끝-->


					<tr>
						<td class="content">
							<div class="">

                                <div id="bo_v_con"><?php echo get_view_thumbnail($view['wr_content_'.$_SESSION['lang']]); ?></div>

							</div>
						</td>
					</tr>
				</table>
			</div>


			<div class="board_btn">
				<a href="<?php echo $list_href."&me_code=".$me_code."&info=".$info."&num=".$num; ?><?=lang_url_a($_SESSION['lang'])?>" class="list"><?=_t('목록')?></a>
			</div>
		</div>






<script>
<?php if ($board['bo_download_point'] < 0) { ?>
$(function() {
    $("a.view_file_download").click(function() {
        if(!g5_is_member) {
            alert("<?php echo _t('다운로드 권한이 없습니다.').'\n'._t('회원이시라면 로그인 후 이용해 보십시오.'); ?>");
            return false;
        }

        var msg = "<?php echo _t('파일을 다운로드 하시면 포인트가 차감'); ?>(<?php echo number_format($board['bo_download_point']) ?><?php echo _t('점'); ?>)<?php echo _t('됩니다.'); ?>\n\n<?php echo _t('포인트는 게시물당 한번만 차감되며 다음에 다시 다운로드 하셔도 중복하여 차감하지 않습니다.').'\n\n'._t('그래도 다운로드 하시겠습니까?'); ?>";

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

<!-- 게시글 보기 끝 -->

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
                    $tx.text("<?php echo _t('이 글을 비추천하셨습니다.'); ?>");
                    $tx.fadeIn(200).delay(2500).fadeOut(200);
                } else {
                    $tx.text("<?php echo _t('이 글을 추천하셨습니다.'); ?>");
                    $tx.fadeIn(200).delay(2500).fadeOut(200);
                }
            }
        }, "json"
    );
}
</script>
