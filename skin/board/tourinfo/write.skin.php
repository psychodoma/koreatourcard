<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);









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
        <tr>
            <th scope="row" width="">옵션</th>
            <td><?php echo $option ?></td>
        </tr>
        <?php } ?>

        <?php if ($is_category) { ?>
        <tr>
            <th scope="row"><label for="ca_name">분류<strong class="sound_only">필수</strong></label></th>
            <td>
                <select name="ca_name" id="ca_name" required class="" >
                    <option value="">선택하세요</option>
                    <?php echo $category_option ?>
                </select>
            </td>
        </tr>
        <?php } ?>



        <tr>
            <th scope="row"><label for="ca_name">그룹<strong class="sound_only">필수</strong></label></th>
            <td>

                <?
                if($w != "u"){
                    $obj = sql_query(" select * from g5_benefit_group where bo_name = 'tourinfo' ");
                    $table = "g5_benefit_group";
                    $name = "wr_1";
                    echo set_select_ktc($obj,$table,$name);
                }else{
                    $obj = sql_query(" select * from g5_benefit_group where bo_name = 'tourinfo' ");
                    $table = "g5_benefit_group";
                    $name = "wr_1";
                    $select = $write['wr_1'];
                    echo get_select_ktc($obj,$table,$name,$select);   //1.쿼리값  2.테이블이름   3.select name의 이름   4.선택된 값
                }
                ?>   

                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <select name="g_sel" id="g_sel" required class="" >
                    <option value="" >선택하세요</option>
                    <?php echo $category_option ?>
                </select>
                <input type='text'size="30" class='group_type' placeholder='그룹이름 입력후 생성,삭제 버튼'>
                <button class='addg' val='add' onclick='return false;'>그룹생성</button>
                <button class='addg' val='del'  onclick='return false;'>그룹삭제</button>
            </td>
        </tr>







        <tr>
            <th scope="row"><label for="wr_subject">제목<strong class="sound_only">필수</strong></label></th>
            <td>
                <div id="autosave_wrapper">
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

                <div id="autosave_wrapper">
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

                <div id="autosave_wrapper">
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

                <div id="autosave_wrapper">
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

                <div id="autosave_wrapper">
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









        <tr>
            <th scope="row"><label for="wr_subject">간략 설명<strong class="sound_only">필수</strong></label></th>
            <td>
                <div id="autosave_wrapper" style='width:70%; height:35px;'>
                    <input type="text" name="wr_simple_ko_KR" value="<?php echo $write['wr_simple_ko_KR'] ?>" id="wr_simple_ko_KR" required class="frm_input required" size="130" maxlength="255" placeholder='한글 간략설명'>
                </div>

                <div id="autosave_wrapper" style='width:70%; height:35px;'>
                    <input type="text" name="wr_simple_en_US" value="<?php echo $write['wr_simple_en_US'] ?>" id="wr_simple_en_US" required class="frm_input required" size="130" maxlength="255" placeholder='영어 간략설명'>
                </div>

                <div id="autosave_wrapper" style='width:70%; height:35px;'>
                    <input type="text" name="wr_simple_ja_JP" value="<?php echo $write['wr_simple_ja_JP'] ?>" id="wr_simple_ja_JP" required class="frm_input required" size="130" maxlength="255" placeholder='일본어 간략설명'>
                </div>

                <div id="autosave_wrapper" style='width:70%; height:35px;'>
                    <input type="text" name="wr_simple_zh_CN" value="<?php echo $write['wr_simple_zh_CN'] ?>" id="wr_simple_zh_CN" required class="frm_input required" size="130" maxlength="255" placeholder='간체 간략설명'>
                </div>

                <div id="autosave_wrapper" style='width:70%; height:35px;'>
                    <input type="text" name="wr_simple_zh_TW" value="<?php echo $write['wr_simple_zh_TW'] ?>" id="wr_simple_zh_TW" required class="frm_input required" size="130" maxlength="255" placeholder='번체 간략설명'>
                </div>
            </td>
        </tr>



        <tr>
            <th scope="row">메인 이미지</th>
            <td>
                <div style='color:red; width:100%; height:30px; padding-top:5px;'>이미지크기  308px * 280px / JPG, PNG 파일을 올려주세요.</div>
                <input type="file" name="bf_file[]" title="파일첨부 <?php echo 0+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" class="frm_file frm_input">
                <?php if ($is_file_content) { ?>
                <input type="text" name="bf_content[]" value="<?php echo ($w == 'u') ? $file[0]['bf_content'] : ''; ?>" title="파일 설명을 입력해주세요." class="frm_file frm_input" size="50">
                <?php } ?>
                <?php if($w == 'u' && $file[0]['file']) { ?>
                <input type="checkbox" id="bf_file_del<?php echo 0 ?>" name="bf_file_del[<?php echo 0;  ?>]" value="1"> <label for="bf_file_del<?php echo 0 ?>"><?php echo $file[0]['source'].'('.$file[0]['size'].')';  ?> 파일 삭제</label>
                <?php } ?>
            </td>
        </tr>



        <tr>
            <th scope="row"><label for="wr_content">내용<strong class="sound_only">필수</strong></label></th>
            <td class="wr_content">
                <!--<div style='color:red; width:100%; height:30px; padding-top:5px;'>브랜드 설명을 입력하세요.</div>-->
                <div id="autosave_wrapper" style='width:70%; padding-bottom:10px; height:100px; margin-bottom:10px;'>
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


                <div id="autosave_wrapper" style='width:70%; padding-bottom:10px; height:100px; margin-bottom:10px;'>
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
                <div id="autosave_wrapper" style='width:70%; padding-bottom:10px; height:100px; margin-bottom:10px;'>
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
                <div id="autosave_wrapper" style='width:70%; padding-bottom:10px; height:100px; margin-bottom:10px;'>
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
                <div id="autosave_wrapper" style='width:70%; padding-bottom:10px; height:100px;'>
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
            </td>
        </tr>






        <!--<?php for ($i=1; $is_link && $i<=G5_LINK_COUNT; $i++) { ?>
        <tr>
            <th scope="row"><label for="wr_link<?php echo $i ?>"><?if($i==1) echo "페이스북 url"; else echo "트위터 url";?></label></th>
            <td><input type="text" name="wr_link<?php echo $i ?>" value="<?php if($w=="u"){echo$write['wr_link'.$i];} ?>" id="wr_link<?php echo $i ?>" class="frm_input" size="50"></td>
        </tr>
        <?php } ?>-->






        <!--<?php for ($i=1; $is_file && $i<$file_count; $i++) { ?>
        <tr>
            <th scope="row">파일 #<?php echo $i+1 ?></th>
            <td>
                <input type="file" name="bf_file[]" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" class="frm_file frm_input">
                <?php if ($is_file_content) { ?>
                <input type="text" name="bf_content[]" value="<?php echo ($w == 'u') ? $file[$i]['bf_content'] : ''; ?>" title="파일 설명을 입력해주세요." class="frm_file frm_input" size="50">
                <?php } ?>
                <?php if($w == 'u' && $file[$i]['file']) { ?>
                <input type="checkbox" id="bf_file_del<?php echo $i ?>" name="bf_file_del[<?php echo $i;  ?>]" value="1"> <label for="bf_file_del<?php echo $i ?>"><?php echo $file[$i]['source'].'('.$file[$i]['size'].')';  ?> 파일 삭제</label>
                <?php } ?>
            </td>
        </tr>
        <?php } ?>-->

        <tr>
            <th scope="row">코스선택</th>
            <td>
                <div class='co_reset'>
                    <?=get_course($wr_id)?>
                </div>
                <div class='course_reset' style='margin-left:30px; float:left; background:gray; color:white; text-align:center; width:150px; height:20px; padding-top:5px; cursor:pointer; border-radius:5px;'>코스 새로고침 및 적용</div>
                <a href='./write.php?bo_table=course' target='_blank'><div class='course_add' style='margin-left:20px; float:left; background:gray; color:white; text-align:center; width:100px; height:20px; padding-top:5px; cursor:pointer; border-radius:5px;'>코스등록</div></a>
                
                
                <div class='courses' style='padding-top:50px;'>
                    <?if($w == "u"){?>
                        <?
                            $course_result = sql_query(" select * from g5_write_course where wr_course = ".$wr_id." order by wr_cnt ");
                            $cnt = 1;
                            while( $row = sql_fetch_array($course_result) ){?>

                                <div class="course_div" valId='<?=$row["wr_id"]?>' style="width:100%; height:40px;">
                                    <div style="padding-right:15px; float:left; font-size:18px;">
                                        <span class="course_span"><?=$cnt?></span>
                                        코스&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$row["wr_subject"]?>
                                    </div>
                                    <input type="hidden" name="wr_course[]" value='<?=$row["wr_id"]?>'>
                                    <input type="hidden" name="wr_course_subject[]" value='<?=$row["wr_subject"]?>'>   
                                    <div class="course_del course_del_<?=$cnt?>" style="color:red; cursor:pointer; width:30px; float:left;">삭제</div>
                                </div>



                            <?$cnt++;}?>
                    <?}?>
                    <div class='course_cnt_u' valCk='1' valCnt='<?=$cnt?>' ></div>
                </div>


            </td>
        </tr>

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
        <a href="/bbs/board.php?bo_table=<?php echo $bo_table ?>&wr_id=<?php echo $wr_id ?>&info=event&num=3&me_code=40&sca=<?=$ca_name?>" class="btn_cancel" target='_blank'>글 보기</a>
    </div>
    </form>

    <script>

	$(function(){
		$('.admin_title_h1').html('여행정보');
	})



    $('.addg').click(function(){
        var vals = $(this).attr('val'); //삭제 추가 판별
        var values = $('.group_type').val(); // 그룹 이름
        //var values = $('.group_type').val(); // 그룹 이름

        $.ajax({
            url: "/bbs/ajax.group.php",
            data: {
                'vals': vals,
                'values': values,
                'tablename': "tourinfo",
                'g_sel': $('#g_sel').val(),
            },
            success: function(data){
                if(data.trim() == "common"){
                    alert('같은 그룹의 이름이 있습니다.');
                    return;
                }else if(data.trim() == "suc"){
                    alert('삭제 하였습니다.');
                    return;
                }else if(data.trim() == "fail"){
                    alert('같은 이름의 그룹이 없습니다.');
                    return;  
                }
                alert('그룹이 추가되었습니다.');           
            }
        })
    })






    var optioncnt = function(classname){
        var option_cnt = 1;
        $('.'+classname).each(function(index){
            option_cnt = index;
        })
        return option_cnt+1;
    }   

    //var benefit_cnt = 0;
    if( $('.course_cnt_u').attr('valCk') == 1 ){
        course_cnt = $('.course_cnt_u').attr('valCnt');   
    }else{
        course_cnt = 1;
    }
    course_ck = 0;
    $('.course').change(function(){
        var th = $(this);
        $('.course_div').each(function(){
            if( $(this).attr('valId') == th.val() ){
                alert('이미 등록한 코스입니다.');
                course_ck = 1;
                return false;
            }
        })
        if( course_ck != 1 ){
            $('.courses').append('<div class="course_div" valId='+$(this).val()+' style="width:100%; height:40px;"><div style="padding-right:15px; float:left; font-size:18px;"><span class="course_span">'+course_cnt+'</span>코스&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+$('.'+$(this).val()).text()+'</div><input type="hidden" name="wr_course[]" value="'+$(this).val()+' "><input type="hidden" name="wr_course_subject[]" value="'+$('.'+$(this).val()).text()+' "><div class="course_del course_del_'+course_cnt+'" style="color:red; cursor:pointer; width:30px; float:left;">삭제</div></div>');

            course_cnt++;
            $('.course_del').click(function(){
                $(this).parent().remove();
                course_cnt = 1;
                $('.course_div').each(function(){
                    $(this).children('div').children('span').text(course_cnt);
                    course_cnt++;
                    
                })
            })
        }
        course_ck = 0;
    })


    $('.course_del').click(function(){
        $(this).parent().remove();
        course_cnt = 1;
        $('.course_div').each(function(){
            $(this).children('div').children('span').text(course_cnt);
            course_cnt++;
            
        })
    })






    $('.course_reset').click(function(){

        $.ajax({
            data:'wr_id=<?=$wr_id?>',
            url:'./co_reset.php',
            success:function(data){
                $('.courses').text("");
                $('.co_reset').html(data);
                course_cnt = 1;
                course_ck = 0;
                $('.course').change(function(){
                    var th = $(this);
                    $('.course_div').each(function(){
                        if( $(this).attr('valId') == th.val() ){
                            alert('이미 등록한 코스입니다.');
                            course_ck = 1;
                            return false;
                        }
                    })
                    if( course_ck != 1 ){
                        $('.courses').append('<div class="course_div" valId='+$(this).val()+' style="width:100%; height:40px;"><div style="padding-right:15px; float:left; font-size:18px;"><span class="course_span">'+course_cnt+'</span>코스&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+$('.'+$(this).val()).text()+'</div><div class="course_del course_del_'+course_cnt+'" style="color:red; cursor:pointer;">삭제</div></div>');
                        $('.courses').append('<input type="hidden" name="wr_course[]" value="'+$(this).val()+' ">');
                        $('.courses').append('<input type="hidden" name="wr_course_subject[]" value="'+$('.'+$(this).val()).text()+' ">');
                        course_cnt++;
                        $('.course_del').click(function(){
                            $(this).parent().remove();
                            course_cnt = 1;
                            $('.course_div').each(function(){
                                $(this).children('div').children('span').text(course_cnt);
                                course_cnt++;
                            })
                        })
                    }
                    course_ck = 0;
                })


            }
        })
    })




    $('.bf_file_del_txt').click(function(){
        var result = confirm('삭제 시 복구가 불가능 합니다. 그래도 하시겠습니까?'); 
            var num = $(this).attr('valnum');
        if(result) { 
            $('#'+$(this).attr('valVal')).attr('value',"");
         }else{
            $("#bf_file_del"+num).attr("checked", false);
         }
    })

    $('.option_add').click(function(){
        var cnt = $(this).attr('valCnt');

        //alert($(this).attr('valMaxCnt'));
        //alert(cnt);

        if( parseInt($(this).attr('valMaxCnt')) <= parseInt(cnt) ){
            alert('더이상 추가 할 수 없습니다.');
        }else{
            $('.benefit1_show'+cnt).css('display','table-row');
            $('.benefit1_show_span'+cnt).css('display','');
            cnt++;
            $(this).attr('valCnt', cnt);
           
        }
    })


    $('.option_delete').click(function(){
        var cnt = $(this).attr('valCnt');
        $('.benefit1_show'+cnt).css('display','none');
        $('.benefit1_show_span'+cnt).css('display','none');
    })


    $('.metro_input_add').click(function(){
       $me_cl = $('.metro_input_re').clone();
       $me_cl.removeClass('metro_input_re');
       $me_cl.addClass('metro_input_cl');
       $me_cl.children('#metro_id_ck').attr('value',"insert");

       $me_cl_add = $me_cl.children('.metro_input_add');
       $me_cl_add.removeClass('metro_input_add');
       $me_cl_add.addClass('metro_input_remove');
       $me_cl_add.text('삭제');
       

       $me_cl_add.click(function(){
           //$metro_id = $(this).parent().children('#metro_id');
           //$(this).parent().prev().append($metro_id);
           //$(this).parent().prev().append("<input type='hidden' name='metro_id_ck[]' value='del'>");
           $(this).parent().remove();
       })

       $('.metro').append($me_cl);
    })


    $('#bf_file_del_txt0').css('display','none');
    $('#bf_file_del_txt1').css('display','none');
    $('#bf_file_del_txt2').css('display','none');
    $('#bf_file_del_txt3').css('display','none');

    $('.metro_input_remove').click(function(){
           $metro_id = $(this).parent().children('#metro_id');

           $metro_id1 = $(this).parent().children('#metro_info');
           $metro_id2 = $(this).parent().children('#metro_info_en_US');
           $metro_id3 = $(this).parent().children('#metro_info_ja_JP');
           $metro_id4 = $(this).parent().children('#metro_info_zh_CN');
           $metro_id5 = $(this).parent().children('#metro_info_zh_TW');
           $metro_id6 = $(this).parent().children('#wr_metro');

           $metro_id1.attr('type','hidden');
           $metro_id2.attr('type','hidden');
           $metro_id3.attr('type','hidden');
           $metro_id4.attr('type','hidden');
           $metro_id5.attr('type','hidden');
           $(this).parent().prev().append("<input type='hidden' name='wr_metro[]' value='"+$metro_id6.val()+"'>");

           $(this).parent().prev().append($metro_id);

           $(this).parent().prev().append($metro_id1);
           $(this).parent().prev().append($metro_id2);
           $(this).parent().prev().append($metro_id3);
           $(this).parent().prev().append($metro_id4);
           $(this).parent().prev().append($metro_id5);
           
           $(this).parent().prev().append("<input type='hidden' name='metro_id_ck[]' value='del'>");
           $(this).parent().remove();
        
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
        <?php echo $editor_js_ja_JP; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>
        <?php echo $editor_js_en_US; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>
        <?php echo $editor_js_zh_CN; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>
        <?php echo $editor_js_zh_TW; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>
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