<?php
$sub_menu = '850100';
include_once('./_common.php');
include_once('../admin.lib.php');
include_once('./admin.banner.lib.php');

auth_check($auth[$sub_menu], "w");

$html_title = '배너';
$g5['title'] = $html_title.'등록/수정';
$g5[g5_shop_banner_table] = 'g5_shop_banner';

$sca = $_GET["sca"];

if ($w=="u")
{
    $html_title .= ' 수정';
    $sql = " select * from {$g5['g5_shop_banner_table']} where bn_id = '$bn_id' ";
    $bn = sql_fetch($sql);
}
else
{
    $html_title .= ' 입력';
    $bn['bn_url']        = "http://";
    $bn['bn_begin_time'] = date("Y-m-d 00:00:00", time());
    $bn['bn_end_time']   = date("Y-m-d 00:00:00", time()+(60*60*24*31));
}



// 접속기기 필드 추가
if(!sql_query(" select bn_device from {$g5['g5_shop_banner_table']} limit 0, 1 ")) {
    sql_query(" ALTER TABLE `{$g5['g5_shop_banner_table']}`
                    ADD `bn_device` varchar(10) not null default '' AFTER `bn_url` ", true);
    sql_query(" update {$g5['g5_shop_banner_table']} set bn_device = 'pc' ", true);
}

include_once (G5_ADMIN_PATH.'/admin.head.php');
?>

<style>
	.tbl_wrap table tr th{width:50px;}
	td.lang_img{width:17.5%}
	td.lang_img input{width:220px;}
	td label.lb_lang{display:block;}
	td.lang_kr{background:#bbd6e0}
	.frm_input.link{width:17.5%;}
</style>

<form name="fbanner" action="./bannerformupdate.php" method="post" enctype="multipart/form-data">
<input type="hidden" name="w" value="<?php echo $w; ?>">
<input type="hidden" name="bn_id" value="<?php echo $bn_id; ?>">

<div class="tbl_frm01 tbl_wrap">
    <table>
    <caption><?php echo $g5['title']; ?></caption>
    <colgroup>
        <col class="grid_4">
        <col>
    </colgroup>
    <tbody>
    <tr>
        <th scope="row">이미지</th>
        <td class="lang_kr lang_img">
			<label class="lb_lang">한국어</label>
            <input type="file" name="bn_bimg">
            <?php
            $bimg_str = "";
            $bimg = G5_DATA_PATH."/banner/{$bn['bn_id']}";
            if (file_exists($bimg) && $bn['bn_id']) {
                $size = @getimagesize($bimg);
                if($size[0] && $size[0] > 750)
                    $width = 750;
                else
                    $width = $size[0];

                echo '<input type="checkbox" name="bn_bimg_del" value="1" id="bn_bimg_del"> <label for="bn_bimg_del">삭제</label>';
                $bimg_str = '<img src="'.G5_DATA_URL.'/banner/'.$bn['bn_id'].'" width="'.$width.'">';
            }
            if ($bimg_str) {
                echo '<div class="banner_or_img">';
                echo $bimg_str;
                echo '</div>';
            }
            ?>
        </td>

		<td class="lang_us  lang_img">
			<label class="lb_lang">영어</label>
            <input type="file" name="bn_bimg_US">
            <?php
            $bimg_US_str = "";
            $bimg_US = G5_DATA_PATH."/banner/US/{$bn['bn_id']}";
            if (file_exists($bimg_US) && $bn['bn_id']) {
                $size = @getimagesize($bimg_US);
                if($size[0] && $size[0] > 750)
                    $width = 750;
                else
                    $width = $size[0];

                echo '<input type="checkbox" name="bn_bimg_us_del" value="1" id="bn_bimg_us_del"> <label for="bn_bimg_us_del">삭제</label>';
                $bimg_US_str = '<img src="'.G5_DATA_URL.'/banner/US/'.$bn['bn_id'].'" width="'.$width.'">';
            }
            if ($bimg_str) {
                echo '<div class="banner_or_img">';
                echo $bimg_US_str;
                echo '</div>';
            }
            ?>
        </td>

		<td class="lang_JP lang_img">
			<label class="lb_lang">일어</label>
            <input type="file" name="bn_bimg_JP">
            <?php
            $bimg_JP_str = "";
            $bimg_JP = G5_DATA_PATH."/banner/JP/{$bn['bn_id']}";
            if (file_exists($bimg_JP) && $bn['bn_id']) {
                $size = @getimagesize($bimg_JP);
                if($size[0] && $size[0] > 750)
                    $width = 750;
                else
                    $width = $size[0];

                echo '<input type="checkbox" name="bn_bimg_JP_del" value="1" id="bn_bimg_JP_del"> <label for="bn_bimg_JP_del">삭제</label>';
                $bimg_JP_str = '<img src="'.G5_DATA_URL.'/banner/JP/'.$bn['bn_id'].'" width="'.$width.'">';
            }
            if ($bimg_str) {
                echo '<div class="banner_or_img">';
                echo $bimg_JP_str;
                echo '</div>';
            }
            ?>
        </td>

		<td class="lang_CN lang_img">
			<label class="lb_lang">중어(간체)</label>
            <input type="file" name="bn_bimg_CN">
            <?php
            $bimg_CN_str = "";
            $bimg_CN = G5_DATA_PATH."/banner/CN/{$bn['bn_id']}";
            if (file_exists($bimg_CN) && $bn['bn_id']) {
                $size = @getimagesize($bimg_CN);
                if($size[0] && $size[0] > 750)
                    $width = 750;
                else
                    $width = $size[0];

                echo '<input type="checkbox" name="bn_bimg_CN_del" value="1" id="bn_bimg_CN_del"> <label for="bn_bimg_CN_del">삭제</label>';
                $bimg_CN_str = '<img src="'.G5_DATA_URL.'/banner/CN/'.$bn['bn_id'].'" width="'.$width.'">';
            }
            if ($bimg_str) {
                echo '<div class="banner_or_img">';
                echo $bimg_CN_str;
                echo '</div>';
            }
            ?>
        </td>

		<td class="lang_TW lang_img">
			<label class="lb_lang">중어(번체)</label>
            <input type="file" name="bn_bimg_TW">
            <?php
            $bimg_TW_str = "";
            $bimg_TW = G5_DATA_PATH."/banner/TW/{$bn['bn_id']}";
            if (file_exists($bimg_TW) && $bn['bn_id']) {
                $size = @getimagesize($bimg_TW);
                if($size[0] && $size[0] > 750)
                    $width = 750;
                else
                    $width = $size[0];

                echo '<input type="checkbox" name="bn_bimg_TW_del" value="1" id="bn_bimg_TW_del"> <label for="bn_bimg_TW_del">삭제</label>';
                $bimg_TW_str = '<img src="'.G5_DATA_URL.'/banner/TW/'.$bn['bn_id'].'" width="'.$width.'">';
            }
            if ($bimg_str) {
                echo '<div class="banner_or_img">';
                echo $bimg_TW_str;
                echo '</div>';
            }
            ?>
        </td>



    </tr>
    <tr>
        <th scope="row"><label for="bn_alt">이미지 설명</label></th>
        <td colspan="5">
            <?php echo help("img 태그의 alt, title 에 해당되는 내용입니다.\n배너에 마우스를 오버하면 이미지의 설명이 나옵니다."); ?>
            <input type="text" name="bn_alt" value="<?php echo $bn['bn_alt']; ?>" id="bn_alt" class="frm_input" size="80">
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="bn_url">링크</label></th>
        <td colspan="5">
            <?php echo help("배너클릭시 이동하는 주소입니다. | 링크사용안할시 공란"); ?>
            <input type="text" name="bn_url" size="80" value="<?php echo $bn['bn_url']; ?>" id="bn_url" class="frm_input link">
			<input type="text" name="bn_url_us" size="80" value="<?php echo $bn['bn_url_us']; ?>" id="bn_url_us" class="frm_input link ">
			<input type="text" name="bn_url_jp" size="80" value="<?php echo $bn['bn_url_jp']; ?>" id="bn_url_jp" class="frm_input link">
			<input type="text" name="bn_url_cn" size="80" value="<?php echo $bn['bn_url_cn']; ?>" id="bn_url_cn" class="frm_input link">
			<input type="text" name="bn_url_tw" size="80" value="<?php echo $bn['bn_url_tw']; ?>" id="bn_url_tw" class="frm_input link">
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="bn_device">접속기기</label></th>
        <td colspan="5">
            <?php echo help('배너를 표시할 접속기기를 선택합니다.'); ?>
            <select name="bn_device" id="bn_device">
                <option value="both"<?php echo get_selected($bn['bn_device'], 'both', true); ?>>PC와 모바일</option>
                <option value="pc"<?php echo get_selected($bn['bn_device'], 'pc'); ?>>PC</option>
                <option value="mobile"<?php echo get_selected($bn['bn_device'], 'mobile'); ?>>모바일</option>
        </select>
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="bn_position">배너노출위치 </label></th>
        <td colspan="5">
            <!--<?php echo help("메인쇼핑분류 : 메인 상단 쇼핑분류에 표시\n메인판매점 : 메인 중단 판매점 영역 1/2/3 영역에 출력합니다.\n메인행사축제 : 메인 하단 행사 영역 1/2 영역에 출력합니다."); ?>-->
		
            <?php echo get_select_bannerPosition('bn_position',$bn['bn_position'],$sca);?>
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="bn_border">테두리</label></th>
        <td colspan="5">
             <?php echo help("배너이미지에 테두리를 넣을지를 설정합니다.", 50); ?>
            <select name="bn_border" id="bn_border">
                <option value="0" <?php echo get_selected($bn['bn_border'], 0); ?>>사용안함</option>
                <option value="1" <?php echo get_selected($bn['bn_border'], 1); ?>>사용</option>
            </select>
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="bn_new_win">새창</label></th>
        <td colspan="5">
            <?php echo help("배너클릭시 새창을 띄울지를 설정합니다.", 50); ?>
            <select name="bn_new_win" id="bn_new_win">
				<option value="0" <?php echo get_selected($bn['bn_new_win'], 0); ?>>사용안함</option>
				<option value="1" <?php echo get_selected($bn['bn_new_win'], 1); ?> selected>사용</option>
            </select>
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="bn_begin_time">시작일시</label></th>
        <td colspan="5">
            <?php echo help("배너 게시 시작일시를 설정합니다."); ?>
            <input type="text" name="bn_begin_time" value="<?php echo $bn['bn_begin_time']; ?>" id="bn_begin_time" class="frm_input"  size="21" maxlength="19">
            <input type="checkbox" name="bn_begin_chk" value="<?php echo date("Y-m-d 00:00:00", time()); ?>" id="bn_begin_chk" onclick="if (this.checked == true) this.form.bn_begin_time.value=this.form.bn_begin_chk.value; else this.form.bn_begin_time.value = this.form.bn_begin_time.defaultValue;">
            <label for="bn_begin_chk">오늘</label>
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="bn_end_time">종료일시</label></th>
        <td colspan="5">
            <?php echo help("배너 게시 종료일시를 설정합니다. 기본설정- 1개월"); ?>
            <input type="text" name="bn_end_time" value="<?php echo $bn['bn_end_time']; ?>" id="bn_end_time" class="frm_input" size=21 maxlength=19>
            <input type="checkbox" name="bn_end_chk" value="<?php echo date("Y-m-d 23:59:59", time()+60*60*24*31); ?>" id="bn_end_chk" onclick="if (this.checked == true) this.form.bn_end_time.value=this.form.bn_end_chk.value; else this.form.bn_end_time.value = this.form.bn_end_time.defaultValue;">
            <label for="bn_end_chk">오늘+31일</label>

			<input type="checkbox" name="bn_end_chk2" value="<?php echo date("Y-m-d 00:00:00", time()+60*60*24*366); ?>" id="bn_end_chk2" onclick="if (this.checked == true) this.form.bn_end_time.value=this.form.bn_end_chk2.value; else this.form.bn_end_time.value = this.form.bn_end_time.defaultValue;">
            <label for="bn_end_chk">오늘+365일</label>

        </td>
    </tr>
    <tr>
        <th scope="row"><label for="bn_order">출력 순서</label></th>
        <td colspan="5">
           <?php echo help("배너를 출력할 때 순서를 정합니다. 숫자가 작을수록 먼저 출력됩니다."); ?>
           <?php echo order_select("bn_order", $bn['bn_order']); ?>
        </td>
    </tr>
    </tbody>
    </table>
</div>

<div class="btn_confirm01 btn_confirm">
    <input type="submit" value="확인" class="btn_submit" accesskey="s">
    <a href="./bannerlist.php?sca=<? if($sca){ echo $sca; }else{ echo $bn['bn_position']; } ?>">목록 </a>
</div>

</form>

<?php
include_once (G5_ADMIN_PATH.'/admin.tail.php');
?>
