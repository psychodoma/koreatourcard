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
							<h2><?echo cut_str(get_text($view['wr_subject']), 70);?></h2>
							<p><?=substr($view['wr_datetime'],0,10);?></p>
						</td>
					</tr>
					<tr>
						<td class="content">
							<div class="">

                                <div id="bo_v_con"><?php echo get_view_thumbnail($view['content']); ?></div>

							</div>
						</td>
					</tr>
				</table>
			</div>


			<div class="board_btn">
				<a href="<?php echo $list_href."&me_code=".$me_code."&info=".$info."&num=".$num; ?>" class="list">목록</a>
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
