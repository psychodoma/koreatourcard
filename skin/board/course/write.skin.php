<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);

if($w == 'u'){
    $sql = " select count(*) cnt from g5_board_file where bo_table = '".$bo_table."' and wr_id = ".$wr_id;
    $benefit_cnt = sql_fetch($sql);
}else{
    $benefit_cnt['cnt'] = 5;
}

if($w == 'u'){
    $metro_sql = "select * from g5_write_cardbenefit_metro where bo_table_id = ".$wr_id;
    $metro_reulst = sql_query($metro_sql);
}
?>

<section id="bo_w">
    <h2 id="container_title" style="padding-bottom:10px;"><?php echo $g5['title'] ?></h2>

    <!-- 게시물 작성/수정 시작 { -->
    <form name="fwrite" id="fwrite" action="<?php echo $action_url ?>" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" style="width:<?php echo $width; ?>">
    <input type="hidden" name="uid" value="<?php echo get_uniqid(); ?>">
    <input type="hidden" name="w" value="<?php echo $w ?>">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="wr_id" value="<?php echo $wr_id ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="spt" value="<?php echo $spt ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <?php
    $option = '';
    $option_hidden = '';
    if ($is_notice || $is_html || $is_secret || $is_mail) {
        $option = '';
        if ($is_notice) {
            $option .= "\n".'<input type="checkbox" id="notice" name="notice" value="1" '.$notice_checked.'>'."\n".'<label for="notice">공지</label>';
        }

        if ($is_html) {
            if ($is_dhtml_editor) {
                $option_hidden .= '<input type="hidden" value="html1" name="html">';
            } else {
                $option .= "\n".'<input type="checkbox" id="html" name="html" onclick="html_auto_br(this);" value="'.$html_value.'" '.$html_checked.'>'."\n".'<label for="html">html</label>';
            }
        }

        if ($is_secret) {
            if ($is_admin || $is_secret==1) {
                $option .= "\n".'<input type="checkbox" id="secret" name="secret" value="secret" '.$secret_checked.'>'."\n".'<label for="secret">비밀글</label>';
            } else {
                $option_hidden .= '<input type="hidden" name="secret" value="secret">';
            }
        }

        if ($is_mail) {
            $option .= "\n".'<input type="checkbox" id="mail" name="mail" value="mail" '.$recv_email_checked.'>'."\n".'<label for="mail">답변메일받기</label>';
        }
    }

    echo $option_hidden;
    ?>

    <div class="tbl_frm01 tbl_wrap">
        <table>
        <tbody>
        <?php if ($is_name) { ?>
        <tr>
            <th scope="row"><label for="wr_name">이름<strong class="sound_only">필수</strong></label></th>
            <td><input type="text" name="wr_name" value="<?php echo $name ?>" id="wr_name" required class="frm_input required" size="10" maxlength="20"></td>
        </tr>
        <?php } ?>

        <?php if ($is_password) { ?>
        <tr>
            <th scope="row"><label for="wr_password">비밀번호<strong class="sound_only">필수</strong></label></th>
            <td><input type="password" name="wr_password" id="wr_password" <?php echo $password_required ?> class="frm_input <?php echo $password_required ?>" maxlength="20"></td>
        </tr>
        <?php } ?>

        <?php if ($is_email) { ?>
        <tr>
            <th scope="row"><label for="wr_email">이메일</label></th>
            <td><input type="text" name="wr_email" value="<?php echo $email ?>" id="wr_email" class="frm_input email" size="50" maxlength="100"></td>
        </tr>
        <?php } ?>

        <?php if ($is_homepage) { ?>
        <tr>
            <th scope="row"><label for="wr_homepage">홈페이지</label></th>
            <td><input type="text" name="wr_homepage" value="<?php echo $homepage ?>" id="wr_homepage" class="frm_input" size="50"></td>
        </tr>
        <?php } ?>

        <?php if ($option) { ?>
        <!--<tr>
            <th scope="row">옵션</th>
            <td><?php echo $option ?></td>
        </tr>-->
        <?php } ?>

        <?php if ($is_category) { ?>
        <tr>
            <th scope="row"><label for="ca_name">분류<strong class="sound_only">필수</strong></label></th>
            <td>
                <select name="ca_name" id="ca_name" required class="required" >
                    <option value="">선택하세요</option>
                    <?php echo $category_option ?>
                </select>
            </td>
        </tr>
        <?php } ?>

        <tr>




            <th scope="row"><label for="wr_subject">제목<strong class="sound_only">필수</strong></label></th>
            <td>
                <div id="autosave_wrapper" class="courseWrrite_name">
                    <input type="text" name="wr_subject" value="<?php echo $write['wr_subject'] ?>" id="wr_subject" required class="frm_input required" size="30" maxlength="255" placeholder='한글 브랜드명'>
                    <!--<textarea class='textarea_subject' style='width:100%; height:50px;'></textarea>-->
                    <?php if ($is_member) { // 임시 저장된 글 기능 ?>
                    <script src="<?php echo G5_JS_URL; ?>/autosave.js"></script>
                    <!--<button type="button" id="btn_autosave" class="btn_frmline">임시 저장된 글 (<span id="autosave_count"><?php echo $autosave_count; ?></span>)</button>-->
                    <!--<div id="autosave_pop">
                        <strong>임시 저장된 글 목록</strong>
                        <div><button type="button" class="autosave_close"><img src="<?php echo $board_skin_url; ?>/img/btn_close.gif" alt="닫기"></button></div>
                        <ul></ul>
                        <div><button type="button" class="autosave_close"><img src="<?php echo $board_skin_url; ?>/img/btn_close.gif" alt="닫기"></button></div>
                    </div>-->
                    <?php } ?>
                </div>

                <div id="autosave_wrapper" class="courseWrrite_name">
                    <input type="text" name="wr_subject_en_US" value="<?php echo $write['wr_subject_en_US'] ?>" id="wr_subject_en_US" required class="frm_input required" size="30" maxlength="255" placeholder='영어 브랜드명'>
                    <!--<textarea class='textarea_subject' style='width:100%; height:50px;'></textarea>-->
                    <?php if ($is_member) { // 임시 저장된 글 기능 ?>
                    <script src="<?php echo G5_JS_URL; ?>/autosave.js"></script>
                    <!--<button type="button" id="btn_autosave" class="btn_frmline">임시 저장된 글 (<span id="autosave_count"><?php echo $autosave_count; ?></span>)</button>-->
                    <!--<div id="autosave_pop">
                        <strong>임시 저장된 글 목록</strong>
                        <div><button type="button" class="autosave_close"><img src="<?php echo $board_skin_url; ?>/img/btn_close.gif" alt="닫기"></button></div>
                        <ul></ul>
                        <div><button type="button" class="autosave_close"><img src="<?php echo $board_skin_url; ?>/img/btn_close.gif" alt="닫기"></button></div>
                    </div>-->
                    <?php } ?>
                </div>

                <div id="autosave_wrapper" class="courseWrrite_name">
                    <input type="text" name="wr_subject_ja_JP" value="<?php echo $write['wr_subject_ja_JP'] ?>" id="wr_subject_ja_JP" required class="frm_input required" size="30" maxlength="255" placeholder='일본어 브랜드명'>
                    <!--<textarea class='textarea_subject' style='width:100%; height:50px;'></textarea>-->
                    <?php if ($is_member) { // 임시 저장된 글 기능 ?>
                    <script src="<?php echo G5_JS_URL; ?>/autosave.js"></script>
                    <!--<button type="button" id="btn_autosave" class="btn_frmline">임시 저장된 글 (<span id="autosave_count"><?php echo $autosave_count; ?></span>)</button>-->
                    <!--<div id="autosave_pop">
                        <strong>임시 저장된 글 목록</strong>
                        <div><button type="button" class="autosave_close"><img src="<?php echo $board_skin_url; ?>/img/btn_close.gif" alt="닫기"></button></div>
                        <ul></ul>
                        <div><button type="button" class="autosave_close"><img src="<?php echo $board_skin_url; ?>/img/btn_close.gif" alt="닫기"></button></div>
                    </div>-->
                    <?php } ?>
                </div>

                <div id="autosave_wrapper" class="courseWrrite_name">
                    <input type="text" name="wr_subject_zh_CN" value="<?php echo $write['wr_subject_zh_CN'] ?>" id="wr_subject_zh_CN" required class="frm_input required" size="30" maxlength="255" placeholder='간체 브랜드명'>
                    <!--<textarea class='textarea_subject' style='width:100%; height:50px;'></textarea>-->
                    <?php if ($is_member) { // 임시 저장된 글 기능 ?>
                    <script src="<?php echo G5_JS_URL; ?>/autosave.js"></script>
                    <!--<button type="button" id="btn_autosave" class="btn_frmline">임시 저장된 글 (<span id="autosave_count"><?php echo $autosave_count; ?></span>)</button>-->
                    <!--<div id="autosave_pop">
                        <strong>임시 저장된 글 목록</strong>
                        <div><button type="button" class="autosave_close"><img src="<?php echo $board_skin_url; ?>/img/btn_close.gif" alt="닫기"></button></div>
                        <ul></ul>
                        <div><button type="button" class="autosave_close"><img src="<?php echo $board_skin_url; ?>/img/btn_close.gif" alt="닫기"></button></div>
                    </div>-->
                    <?php } ?>
                </div>

                <div id="autosave_wrapper" class="courseWrrite_name">
                    <input type="text" name="wr_subject_zh_TW" value="<?php echo $write['wr_subject_zh_TW'] ?>" id="wr_subject_zh_TW" required class="frm_input required" size="30" maxlength="255" placeholder='번체 브랜드명'>
                    <!--<textarea class='textarea_subject' style='width:100%; height:50px;'></textarea>-->
                    <?php if ($is_member) { // 임시 저장된 글 기능 ?>
                    <script src="<?php echo G5_JS_URL; ?>/autosave.js"></script>
                    <!--<button type="button" id="btn_autosave" class="btn_frmline">임시 저장된 글 (<span id="autosave_count"><?php echo $autosave_count; ?></span>)</button>-->
                    <!--<div id="autosave_pop">
                        <strong>임시 저장된 글 목록</strong>
                        <div><button type="button" class="autosave_close"><img src="<?php echo $board_skin_url; ?>/img/btn_close.gif" alt="닫기"></button></div>
                        <ul></ul>
                        <div><button type="button" class="autosave_close"><img src="<?php echo $board_skin_url; ?>/img/btn_close.gif" alt="닫기"></button></div>
                    </div>-->
                    <?php } ?>
                </div>
            </td>
        </tr>










        <!--<tr>
            <th scope="row"><label for="wr_subject">이동 주소</label></th>
            <td>
                <div id="autosave_wrapper">
                    <input type="text" name="wr_url" value="<?php echo $write['wr_url']?>" id="wr_url"  class="frm_input " size="100" maxlength="255" placeholder=" ex) https://www.naver.com/">
                </div>
            </td>
        </tr>-->












        <tr>
            <th scope="row"><label for="wr_link<?php echo $i ?>">지도등록</label></th>
            <td class="courseWrrite_map">
                <!--<div style='padding-bottom:10px;'>주소 입력</div>-->
                <input type="text" name='wr_address_num' id="sample2_postcode" value='<?=$write['wr_address_num']?>' placeholder="우편번호" style='margin-bottom:10px;'>
                <input type="button" onclick="sample2_execDaumPostcode()" value="우편번호 찾기" style='margin-bottom:10px;'><br>
                <input type="text" name='' id="sample2_address" value='<?=$write['wr_1']?>' placeholder="한글주소" style='margin-bottom:10px;' size='75'>
                <input type="text" name='wr_address_en_US' id="sample2_addressEnglish" placeholder="영문주소" style='margin-bottom:10px; display:none;' size='75'><br>
                <!--<input type="text" name='wr_address_ja_JP' placeholder="일본주소" style='margin-bottom:10px;' size='75' >
                <input type="text" name='wr_address_zh_CN' placeholder="간체주소" size='75'><br>
                <input type="text" name='wr_address_en_US' placeholder="번체주소" size='75'><br><br><br>-->
                
                좌표 : 
                <input type="text" id='wr_lat' name='wr_lat' placeholder="lat" value='<?=$write['wr_lat']?>' size='30'>
                <input type="text" id='wr_lng' name='wr_lng' placeholder="lng" value='<?=$write['wr_lng']?>' size='30'>

                <div id="layer" style="display:none;position:fixed;overflow:hidden;z-index:1;-webkit-overflow-scrolling:touch;">
                <img src="//t1.daumcdn.net/localimg/localimages/07/postcode/320/close.png" id="btnCloseLayer" style="cursor:pointer;position:absolute;right:-3px;top:-3px;z-index:1" onclick="closeDaumPostcode()" alt="닫기 버튼">
                </div>  
                <script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>

            </td>
        </tr>


        <tr>
            <th scope="row"><label for="wr_link<?php echo $i ?>">이용정보</label></th>
            <td class="courseWrrite_input">
                <input type="text" name='wr_1'  id="sample2_address" value='<?=$write['wr_1']?>' placeholder="한글주소" style='margin-bottom:15px;' size='60'>
                <input type="text" name='wr_2' value='<?=$write['wr_2']?>'  id="" placeholder="한글상세주소" style='margin-bottom:15px;' size='60'><br>
                <input type="text" name='wr_3' id="sample2_addressEnglish" value='<?=$write['wr_3']?>' placeholder="영어주소" style='margin-bottom:15px;' size='60'>
                <input type="text" name='wr_4' value='<?=$write['wr_4']?>'  id="" placeholder="영어상세주소" style='margin-bottom:15px;' size='60'><br>
                <input type="text" name='wr_5' id="wr_5" value='<?=$write['wr_5']?>' placeholder="일본어주소" style='margin-bottom:15px;' size='60' >
                <input type="text" name='wr_6' value='<?=$write['wr_6']?>'  id="" placeholder="일본어상세주소" style='margin-bottom:15px;' size='60'><br>
                <input type="text" name='wr_7' id="wr_7" value='<?=$write['wr_7']?>' placeholder="간체주소" style='margin-bottom:15px;' size='60'>
                <input type="text" name='wr_8' value='<?=$write['wr_8']?>'  id="" placeholder="간체상세주소" style='margin-bottom:15px;' size='60'><br>
                <input type="text" name='wr_9' id="wr_9" value='<?=$write['wr_9']?>' placeholder="번체주소" style='margin-bottom:15px;' size='60'>
                <input type="text" name='wr_10' value='<?=$write['wr_10']?>'  id="" placeholder="번체상세주소" style='margin-bottom:15px;' size='60'><br><br><br>


                <div style='color:red; width:100%; height:30px; padding-top:5px; font-size:15px;'>비용 & 혜택</div>

                <div class="courseWrrite_benTitle">한글 비용 & 혜택</div>
                <div id="autosave_wrapper" style='width:70%;  padding-bottom:10px;'>
                    <?php if($write_min || $write_max) { ?>
                    <!-- 최소/최대 글자 수 사용 시 -->
                    <p id="char_count_desc">이 게시판은 최소 <strong><?php echo $write_min; ?></strong>글자 이상, 최대 <strong><?php echo $write_max; ?></strong>글자 이하까지 글을 쓰실 수 있습니다.</p>
                    <?php } ?>
                    <?php echo $editor_html; // 에디터 사용시는 에디터로, 아니면 textarea 로 노출 ?>
                    <?php if($write_min || $write_max) { ?>
                    <!-- 최소/최대 글자 수 사용 시 -->
                    <div id="char_count_wrap"><span id="char_count"></span>글자</div>
                    <?php } ?>
                </div>

                <div class="courseWrrite_benTitle">영어 비용 & 혜택</div>
                <div id="autosave_wrapper" style='width:70%;  padding-bottom:10px;'>
                    <?php if($write_min || $write_max) { ?>
                    <!-- 최소/최대 글자 수 사용 시 -->
                    <p id="char_count_desc">이 게시판은 최소 <strong><?php echo $write_min; ?></strong>글자 이상, 최대 <strong><?php echo $write_max; ?></strong>글자 이하까지 글을 쓰실 수 있습니다.</p>
                    <?php } ?>
                    <?php echo $editor_en_US_html; // 에디터 사용시는 에디터로, 아니면 textarea 로 노출 ?>
                    <?php if($write_min || $write_max) { ?>
                    <!-- 최소/최대 글자 수 사용 시 -->
                    <div id="char_count_wrap"><span id="char_count"></span>글자</div>
                    <?php } ?>
                </div>

                <div class="courseWrrite_benTitle">일본어 비용 & 혜택</div>
                <div id="autosave_wrapper" style='width:70%;  padding-bottom:10px;'>
                    <?php if($write_min || $write_max) { ?>
                    <!-- 최소/최대 글자 수 사용 시 -->
                    <p id="char_count_desc">이 게시판은 최소 <strong><?php echo $write_min; ?></strong>글자 이상, 최대 <strong><?php echo $write_max; ?></strong>글자 이하까지 글을 쓰실 수 있습니다.</p>
                    <?php } ?>
                    <?php echo $editor_ja_JP_html; // 에디터 사용시는 에디터로, 아니면 textarea 로 노출 ?>
                    <?php if($write_min || $write_max) { ?>
                    <!-- 최소/최대 글자 수 사용 시 -->
                    <div id="char_count_wrap"><span id="char_count"></span>글자</div>
                    <?php } ?>
                </div>

                <div class="courseWrrite_benTitle">간체 비용 & 혜택</div>
                <div id="autosave_wrapper" style='width:70%; padding-bottom:10px;'>
                    <?php if($write_min || $write_max) { ?>
                    <!-- 최소/최대 글자 수 사용 시 -->
                    <p id="char_count_desc">이 게시판은 최소 <strong><?php echo $write_min; ?></strong>글자 이상, 최대 <strong><?php echo $write_max; ?></strong>글자 이하까지 글을 쓰실 수 있습니다.</p>
                    <?php } ?>
                    <?php echo $editor_zh_CN_html; // 에디터 사용시는 에디터로, 아니면 textarea 로 노출 ?>
                    <?php if($write_min || $write_max) { ?>
                    <!-- 최소/최대 글자 수 사용 시 -->
                    <div id="char_count_wrap"><span id="char_count"></span>글자</div>
                    <?php } ?>
                </div>

                <div class="courseWrrite_benTitle">번체 비용 & 혜택</div>
                <div id="autosave_wrapper" style='width:70%;  padding-bottom:10px;'>
                    <?php if($write_min || $write_max) { ?>
                    <!-- 최소/최대 글자 수 사용 시 -->
                    <p id="char_count_desc">이 게시판은 최소 <strong><?php echo $write_min; ?></strong>글자 이상, 최대 <strong><?php echo $write_max; ?></strong>글자 이하까지 글을 쓰실 수 있습니다.</p>
                    <?php } ?>
                    <?php echo $editor_zh_TW_html; // 에디터 사용시는 에디터로, 아니면 textarea 로 노출 ?>
                    <?php if($write_min || $write_max) { ?>
                    <!-- 최소/최대 글자 수 사용 시 -->
                    <div id="char_count_wrap"><span id="char_count"></span>글자</div>
                    <?php } ?>
                </div>
                
                <br><br><br><br>
                <div style='color:red; width:100%; height:30px; padding-top:5px;'>지하철역 예시 ) 충무로역(3,4호선)</div>

                <input type='text' name='wr_metro_ko_KR' value="<?=$write['wr_metro_ko_KR']?>" placeholder='한글' size="50"><br><br>
                <input type='text' name='wr_metro_en_US' value="<?=$write['wr_metro_en_US']?>" placeholder='영어' size="50"><br><br>
                <input type='text' name='wr_metro_ja_JP' value="<?=$write['wr_metro_ja_JP']?>" placeholder='일본어' size="50"><br><br>
                <input type='text' name='wr_metro_zh_CN' value="<?=$write['wr_metro_zh_CN']?>" placeholder='간체' size="50"><br><br>
                <input type='text' name='wr_metro_zh_TW' value="<?=$write['wr_metro_zh_TW']?>" placeholder='번체' size="50">

                <br><br><br><br>
                <div style='color:red; width:100%; height:30px; padding-top:5px;'>이용시간 예시 ) 09:00 ~ 19:00</div>

                <input type='text' name='wr_time_ko_KR' value="<?=$write['wr_time_ko_KR']?>" placeholder='한글' size="50"><br><br>
                <input type='text' name='wr_time_en_US' value="<?=$write['wr_time_en_US']?>" placeholder='영어' size="50"><br><br>
                <input type='text' name='wr_time_ja_JP' value="<?=$write['wr_time_ja_JP']?>" placeholder='일본어' size="50"><br><br>
                <input type='text' name='wr_time_zh_CN' value="<?=$write['wr_time_zh_CN']?>" placeholder='간체' size="50"><br><br>
                <input type='text' name='wr_time_zh_TW' value="<?=$write['wr_time_zh_TW']?>" placeholder='번체' size="50">

                 <br><br><br><br>
                 <div style='color:red; width:100%; height:30px; padding-top:5px;'>추천해요</div>

				 <?php echo $recom_editor_ko_KR_html;?>
				 <?php echo $recom_editor_en_US_html;?>
				 <?php echo $recom_editor_ja_JP_html;?>
				 <?php echo $recom_editor_zh_CN_html;?>
				 <?php echo $recom_editor_zh_TW_html;?>

<!--                 <input type='text' name='wr_recom_ko_KR' value="<?=$write['wr_recom_ko_KR']?>" placeholder='한글' size="150"><br><br>
                <input type='text' name='wr_recom_en_US' value="<?=$write['wr_recom_en_US']?>" placeholder='영어' size="150"><br><br>
                <input type='text' name='wr_recom_ja_JP' value="<?=$write['wr_recom_ja_JP']?>" placeholder='일본어' size="150"><br><br>
                <input type='text' name='wr_recom_zh_CN' value="<?=$write['wr_recom_zh_CN']?>" placeholder='간체' size="150"><br><br>
                <input type='text' name='wr_recom_zh_TW' value="<?=$write['wr_recom_zh_TW']?>" placeholder='번체' size="150"> -->
                <br><br><br><br>





                <tr>
                    <th scope="row"><label for="wr_link1">지하철</label></th>
                    <td>
						 <?php echo $subway_editor_ko_KR_html;?>
						 <?php echo $subway_editor_en_US_html;?>
						 <?php echo $subway_editor_ja_JP_html;?>
						 <?php echo $subway_editor_zh_CN_html;?>
						 <?php echo $subway_editor_zh_TW_html;?>
					</td>
                </tr>


                <tr>
                    <th scope="row"><label for="wr_link1">주변 관광지</label></th>
                    <td>
						 <?php echo $near_editor_ko_KR_html;?>
						 <?php echo $near_editor_en_US_html;?>
						 <?php echo $near_editor_ja_JP_html;?>
						 <?php echo $near_editor_zh_CN_html;?>
						 <?php echo $near_editor_zh_TW_html;?>
					</td>
                </tr>


                <tr>
                    <th scope="row"><label for="wr_link1">취급품목</label></th>
                    <td>
						 <?php echo $item_editor_ko_KR_html;?>
						 <?php echo $item_editor_en_US_html;?>
						 <?php echo $item_editor_ja_JP_html;?>
						 <?php echo $item_editor_zh_CN_html;?>
						 <?php echo $item_editor_zh_TW_html;?>
					</td>
                </tr>



                <tr>
                    <th scope="row"><label for="wr_link1">주요 메뉴</label></th>
                    <td>
						 <?php echo $main_editor_ko_KR_html;?>
						 <?php echo $main_editor_en_US_html;?>
						 <?php echo $main_editor_ja_JP_html;?>
						 <?php echo $main_editor_zh_CN_html;?>
						 <?php echo $main_editor_zh_TW_html;?>
					</td>
                </tr>


                <tr>
                    <th scope="row"><label for="wr_link1">기타</label></th>
                    <td>
						 <?php echo $etc_editor_ko_KR_html;?>
						 <?php echo $etc_editor_en_US_html;?>
						 <?php echo $etc_editor_ja_JP_html;?>
						 <?php echo $etc_editor_zh_CN_html;?>
						 <?php echo $etc_editor_zh_TW_html;?>
					</td>
                </tr>








 
                <tr>
                    <th scope="row"><label for="wr_link1">홈페이지 한</label></th>
                    <td><input type="text" name="wr_link1" value="<?php if($w=="u"){echo $write['wr_link1'];} ?>" id="wr_link1" class="frm_input" size="70"></td>
                </tr>


                <tr>
                    <th scope="row"><label for="wr_link1">홈페이지 영</label></th>
                    <td><input type="text" name="wr_link_en_US" value="<?php if($w=="u"){echo $write['wr_link_en_US'];} ?>" id="wr_link1" class="frm_input" size="70"></td>
                </tr>

                <tr>
                    <th scope="row"><label for="wr_link1">홈페이지 일</label></th>
                    <td><input type="text" name="wr_link_ja_JP" value="<?php if($w=="u"){echo $write['wr_link_ja_JP'];} ?>" id="wr_link1" class="frm_input" size="70"></td>
                </tr>

                <tr>
                    <th scope="row"><label for="wr_link1">홈페이지 간</label></th>
                    <td><input type="text" name="wr_link_zh_CN" value="<?php if($w=="u"){echo $write['wr_link_zh_CN'];} ?>" id="wr_link1" class="frm_input" size="70"></td>
                </tr>

                <tr>
                    <th scope="row"><label for="wr_link1">홈페이지 번</label></th>
                    <td><input type="text" name="wr_link_zh_TW" value="<?php if($w=="u"){echo $write['wr_link_zh_TW'];} ?>" id="wr_link1" class="frm_input" size="70"></td>
                </tr>


            </td>
        </tr>
        <?php for ($i=0; $is_file && $i<$file_count; $i++) { ?>
        <tr>
            <th scope="row">코스이미지 #<?php echo $i+1 ?></th>
            <td>
                <div style='color:red; width:100%; height:30px; padding-top:5px;'>이미지크기  473px * 297px / JPG, PNG 파일을 올려주세요.</div>
                <input type="file" name="bf_file[]" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" class="frm_file frm_input">
                <?php if ($is_file_content) { ?>
                <input type="text" name="bf_content[]" value="<?php echo ($w == 'u') ? $file[$i]['bf_content'] : ''; ?>" title="파일 설명을 입력해주세요." class="frm_file frm_input" size="50">
                <?php } ?>
                <?php if($w == 'u' && $file[$i]['file']) { ?>
                <input type="checkbox" id="bf_file_del<?php echo $i ?>" name="bf_file_del[<?php echo $i;  ?>]" value="1"> <label for="bf_file_del<?php echo $i ?>"><?php echo $file[$i]['source'].'('.$file[$i]['size'].')';  ?> 파일 삭제</label>
                <?php } ?>
            </td>
        </tr>
        <?php } ?>

        <?php if ($is_guest) { //자동등록방지  ?>
        <tr>
            <th scope="row">자동등록방지</th>
            <td>
                <?php echo $captcha_html ?>
            </td>
        </tr>
        <?php } ?>

        </tbody>
        </table>
    </div>

    <div class="btn_confirm">
        <input type="submit" value="작성완료" id="btn_submit" accesskey="s" class="btn_submit" style='height:35px;'>
        <a href="./board.php?bo_table=<?php echo $bo_table ?>" class="btn_cancel">취소</a>
    </div>
    </form>

    <script>
	$(function(){
		$('.admin_title_h1').html('코스등록');
	})



    <?php if($write_min || $write_max) { ?>
    // 글자수 제한
    var char_min = parseInt(<?php echo $write_min; ?>); // 최소
    var char_max = parseInt(<?php echo $write_max; ?>); // 최대
    check_byte("wr_content", "char_count");

    $(function() {
        $("#wr_content").on("keyup", function() {
            check_byte("wr_content", "char_count");
        });
    });

    <?php } ?>
    function html_auto_br(obj)
    {
        if (obj.checked) {
            result = confirm("자동 줄바꿈을 하시겠습니까?\n\n자동 줄바꿈은 게시물 내용중 줄바뀐 곳을<br>태그로 변환하는 기능입니다.");
            if (result)
                obj.value = "html2";
            else
                obj.value = "html1";
        }
        else
            obj.value = "";
    }

    function fwrite_submit(f)
    {
        <?php echo $editor_js; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>
		<?php echo $editor_js_en_US; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>
		<?php echo $editor_js_ja_JP; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>
		<?php echo $editor_js_zh_CN; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>
		<?php echo $editor_js_zh_TW; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>

		<?php echo $editor_js_recom_ko_KR; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>
		<?php echo $editor_js_recom_en_US; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>
		<?php echo $editor_js_recom_ja_JP; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>
		<?php echo $editor_js_recom_zh_CN; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>
		<?php echo $editor_js_recom_zh_TW; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>

		<?php echo $editor_js_subway_ko_KR; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>
		<?php echo $editor_js_subway_en_US; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>
		<?php echo $editor_js_subway_ja_JP; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>
		<?php echo $editor_js_subway_zh_CN; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>
		<?php echo $editor_js_subway_zh_TW; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>

        <?php echo $editor_js_near_ko_KR; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>
		<?php echo $editor_js_near_en_US; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>
		<?php echo $editor_js_near_ja_JP; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>
		<?php echo $editor_js_near_zh_CN; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>
		<?php echo $editor_js_near_zh_TW; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>

        <?php echo $editor_js_item_ko_KR; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>
		<?php echo $editor_js_item_en_US; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>
		<?php echo $editor_js_item_ja_JP; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>
		<?php echo $editor_js_item_zh_CN; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>
		<?php echo $editor_js_item_zh_TW; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>

        <?php echo $editor_js_main_ko_KR; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>
		<?php echo $editor_js_main_en_US; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>
		<?php echo $editor_js_main_ja_JP; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>
		<?php echo $editor_js_main_zh_CN; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>
		<?php echo $editor_js_main_zh_TW; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>

        <?php echo $editor_js_etc_ko_KR; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>
		<?php echo $editor_js_etc_en_US; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>
		<?php echo $editor_js_etc_ja_JP; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>
		<?php echo $editor_js_etc_zh_CN; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>
		<?php echo $editor_js_etc_zh_TW; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>

        var subject = "";
        var content = "";
        $.ajax({
            url: g5_bbs_url+"/ajax.filter.php",
            type: "POST",
            data: {
                "subject": f.wr_subject.value,
                "content": f.wr_content.value
            },
            dataType: "json",
            async: false,
            cache: false,
            success: function(data, textStatus) {
                subject = data.subject;
                content = data.content;
            }
        });

        if (subject) {
            alert("제목에 금지단어('"+subject+"')가 포함되어있습니다");
            f.wr_subject.focus();
            return false;
        }

        if (content) {
            alert("내용에 금지단어('"+content+"')가 포함되어있습니다");
            if (typeof(ed_wr_content) != "undefined")
                ed_wr_content.returnFalse();
            else
                f.wr_content.focus();
            return false;
        }

        if (document.getElementById("char_count")) {
            if (char_min > 0 || char_max > 0) {
                var cnt = parseInt(check_byte("wr_content", "char_count"));
                if (char_min > 0 && char_min > cnt) {
                    alert("내용은 "+char_min+"글자 이상 쓰셔야 합니다.");
                    return false;
                }
                else if (char_max > 0 && char_max < cnt) {
                    alert("내용은 "+char_max+"글자 이하로 쓰셔야 합니다.");
                    return false;
                }
            }
        }

        <?php echo $captcha_js; // 캡챠 사용시 자바스크립트에서 입력된 캡챠를 검사함  ?>

        document.getElementById("btn_submit").disabled = "disabled";

        return true;
    }
    </script>
</section>
<!-- } 게시물 작성/수정 끝 -->


<script>
    // 우편번호 찾기 화면을 넣을 element
    var element_layer = document.getElementById('layer');

    function closeDaumPostcode() {
        // iframe을 넣은 element를 안보이게 한다.
        element_layer.style.display = 'none';
    }

    function sample2_execDaumPostcode() {
        new daum.Postcode({
            oncomplete: function(data) {
                // 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

                // 각 주소의 노출 규칙에 따라 주소를 조합한다.
                // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
                var fullAddr = data.address; // 최종 주소 변수
                var extraAddr = ''; // 조합형 주소 변수

                // 기본 주소가 도로명 타입일때 조합한다.
                if(data.addressType === 'R'){
                    //법정동명이 있을 경우 추가한다.
                    if(data.bname !== ''){
                        extraAddr += data.bname;
                    }
                    // 건물명이 있을 경우 추가한다.
                    if(data.buildingName !== ''){
                        extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                    }
                    // 조합형주소의 유무에 따라 양쪽에 괄호를 추가하여 최종 주소를 만든다.
                    fullAddr += (extraAddr !== '' ? ' ('+ extraAddr +')' : '');
                }

                // 우편번호와 주소 정보를 해당 필드에 넣는다.
                document.getElementById('sample2_postcode').value = data.zonecode; //5자리 새우편번호 사용
                
                document.getElementById('sample2_address').value = fullAddr;
                document.getElementById('sample2_addressEnglish').value = data.addressEnglish;

                $('#wr_address_txt').attr('value', fullAddr);
                $('#wr_address_txt_en_US').attr('value', data.addressEnglish);

                fulladd = encodeURI(fullAddr);
                url = "https://maps.googleapis.com/maps/api/geocode/json?address="+fulladd+"&language=ko";
                $.ajax({
                    url:url,
                    dataType: "json",
                    success:function(data){
                        $('#wr_lat').attr('value',data['results'][0].geometry.location.lat);
                        $('#wr_lng').attr('value',data['results'][0].geometry.location.lng);
                        //$('#time').append(data);
                    },
                    error:function(request,status,error){
                        alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
                    }

    
                })




                

                // iframe을 넣은 element를 안보이게 한다.
                // (autoClose:false 기능을 이용한다면, 아래 코드를 제거해야 화면에서 사라지지 않는다.)
                element_layer.style.display = 'none';
            },
            width : '100%',
            height : '100%',
            maxSuggestItems : 5
        }).embed(element_layer);

        // iframe을 넣은 element를 보이게 한다.
        element_layer.style.display = 'block';

        // iframe을 넣은 element의 위치를 화면의 가운데로 이동시킨다.
        initLayerPosition();
    }

    // 브라우저의 크기 변경에 따라 레이어를 가운데로 이동시키고자 하실때에는
    // resize이벤트나, orientationchange이벤트를 이용하여 값이 변경될때마다 아래 함수를 실행 시켜 주시거나,
    // 직접 element_layer의 top,left값을 수정해 주시면 됩니다.
    function initLayerPosition(){
        var width = 300; //우편번호서비스가 들어갈 element의 width
        var height = 400; //우편번호서비스가 들어갈 element의 height
        var borderWidth = 5; //샘플에서 사용하는 border의 두께

        // 위에서 선언한 값들을 실제 element에 넣는다.
        element_layer.style.width = width + 'px';
        element_layer.style.height = height + 'px';
        element_layer.style.border = borderWidth + 'px solid';
        // 실행되는 순간의 화면 너비와 높이 값을 가져와서 중앙에 뜰 수 있도록 위치를 계산한다.
        element_layer.style.left = (((window.innerWidth || document.documentElement.clientWidth) - width)/2 - borderWidth) + 'px';
        element_layer.style.top = (((window.innerHeight || document.documentElement.clientHeight) - height)/2 - borderWidth) + 'px';
    }
</script>