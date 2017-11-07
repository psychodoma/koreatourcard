<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);

if($w == 'u'){
    $sql = " select count(*) cnt from g5_board_file where bo_table = '".$bo_table."' and wr_id = ".$wr_id;
    $benefit_cnt = sql_fetch($sql);
    if($benefit_cnt['cnt'] < 4){
        $benefit_cnt['cnt'] = 5;
    }
}else{
    $benefit_cnt['cnt'] = 5;
}

if($w == 'u'){
    $metro_sql = "select * from g5_write_cardbenefit_metro where bo_table_id = ".$wr_id;
    $metro_sql_cnt = "select count(*) cnt from g5_write_cardbenefit_metro where bo_table_id = ".$wr_id;
    $metro_reulst = sql_query($metro_sql);
    $metro_reulst_count = sql_fetch($metro_sql_cnt);
}

echo $action_url;

?>

<section id="bo_w">
    <h2 id="container_title"><?php echo $g5['title'] ?></h2>

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
            <td><input type="text" name="wr_name" value="<?php echo $name ?>" id="wr_name" required class="frm_input required" size="10" ></td>
        </tr>
        <?php } ?>

        <?php if ($is_password) { ?>
        <tr>
            <th scope="row"><label for="wr_password">비밀번호<strong class="sound_only">필수</strong></label></th>
            <td><input type="password" name="wr_password" id="wr_password" <?php echo $password_required ?> class="frm_input <?php echo $password_required ?>" ></td>
        </tr>
        <?php } ?>

        <?php if ($is_email) { ?>
        <tr>
            <th scope="row"><label for="wr_email">이메일</label></th>
            <td><input type="text" name="wr_email" value="<?php echo $email ?>" id="wr_email" class="frm_input email" size="50" ></td>
        </tr>
        <?php } ?>

        <?php if ($is_homepage) { ?>
        <tr>
            <th scope="row"><label for="wr_homepage">홈페이지</label></th>
            <td><input type="text" name="wr_homepage" value="<?php echo $homepage ?>" id="wr_homepage" class="frm_input" size="50"></td>
        </tr>
        <?php } ?>

        <!--<?php if ($option) { ?>
        <tr>
            <th scope="row">옵션</th>
            <td><?php echo $option ?></td>
        </tr>
        <?php } ?>-->

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
            <th scope="row"><label for="ca_name">대표 브랜드</label></th>
            <td>
                <input type='text' class="frm_input required" name='wr_title_ko_KR' value='<?=$write['wr_title_ko_KR']?>' placeholder='한글'>
                <input type='text' class="frm_input required" name='wr_title_en_US' value='<?=$write['wr_title_en_US']?>' placeholder='영어'>
                <input type='text' class="frm_input required" name='wr_title_ja_JP' value='<?=$write['wr_title_ja_JP']?>' placeholder='일본어'>
                <input type='text' class="frm_input required" name='wr_title_zh_CN' value='<?=$write['wr_title_zh_CN']?>' placeholder='간체'>
                <input type='text' class="frm_input required" name='wr_title_zh_TW' value='<?=$write['wr_title_zh_TW']?>' placeholder='번체'>
            </td>
        </tr>

        <tr>
            <th scope="row"><label for="wr_subject">제목<strong class="sound_only">필수</strong></label></th>
            <td>
                <div id="autosave_wrapper" class="CRbenefitWrite_name">
                    <input type="text" name="wr_subject" value="<?php echo $write['wr_subject'] ?>" id="wr_subject" required class="frm_input required" size="30"  placeholder='한글 브랜드명'>
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

                <div id="autosave_wrapper" class="CRbenefitWrite_name">
                    <input type="text" name="wr_subject_en_US" value="<?php echo $write['wr_subject_en_US'] ?>" id="wr_subject_en_US" required class="frm_input required" size="30"  placeholder='영어 브랜드명'>
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

                <div id="autosave_wrapper" class="CRbenefitWrite_name">
                    <input type="text" name="wr_subject_ja_JP" value="<?php echo $write['wr_subject_ja_JP'] ?>" id="wr_subject_ja_JP" required class="frm_input required" size="30" placeholder='일본어 브랜드명'>
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

                <div id="autosave_wrapper" class="CRbenefitWrite_name">
                    <input type="text" name="wr_subject_zh_CN" value="<?php echo $write['wr_subject_zh_CN'] ?>" id="wr_subject_zh_CN" required class="frm_input required" size="30"  placeholder='간체 브랜드명'>
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

                <div id="autosave_wrapper" class="CRbenefitWrite_name">
                    <input type="text" name="wr_subject_zh_TW" value="<?php echo $write['wr_subject_zh_TW'] ?>" id="wr_subject_zh_TW" required class="frm_input required" size="30"  placeholder='번체 브랜드명'>
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
            <th scope="row"><label for="ca_name">그룹<strong class="sound_only">필수</strong></label></th>
            <td>
                <?
                if($w != "u"){
                    $obj = sql_query(" select * from g5_benefit_group where bo_name = 'cardbenefit' ");
                    $table = "g5_benefit_group";
                    $name = "wr_group";
                    echo set_select_ktc($obj,$table,$name);
                }else{
                    $obj = sql_query(" select * from g5_benefit_group where bo_name = 'cardbenefit' ");
                    $table = "g5_benefit_group";
                    $name = "wr_group";
                    $select = $write['wr_group'];
                    echo get_select_ktc($obj,$table,$name,$select);   //1.쿼리값  2.테이블이름   3.select name의 이름   4.선택된 값
                }
                ?>   



                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;



                <input type='text'size="30" class='group_type' placeholder='그룹이름 입력후 생성,삭제 버튼'>
                <button class='addg' val='add' onclick='return false;'>그룹생성</button>
                <button class='addg' val='del'  onclick='return false;'>그룹삭제</button>
            </td>
        </tr>



        <tr>
            <th scope="row"><label for="ca_name">이미지 확장</label></th>
            <td>
                
                <?echo $wr_img_append_html_en_US;?> 
                <?echo $wr_img_append_html_ja_JP;?> 
                <?echo $wr_img_append_html_zh_CN;?> 
                <?echo $wr_img_append_html_zh_TW;?> 
            </td>
        </tr>
        
        <tr>
            <th scope="row"><label for="wr_content">내용<strong class="sound_only">필수</strong></label></th>
            <td class="wr_content">
                <div style='color:red; width:100%; height:30px; padding-top:5px;'>브랜드 설명을 입력하세요.</div>
                <div id="autosave_wrapper" style='width:33%; float:left; padding-bottom:10px;'>
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


                <div id="autosave_wrapper" style='width:33%; float:left; padding-bottom:10px;'>
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
                <div id="autosave_wrapper" style='width:33%; float:left; padding-bottom:10px;'>
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
                <div id="autosave_wrapper" style='width:33%; float:left;'>
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
                <div id="autosave_wrapper" style='width:33%; float:left; '>
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

        

        <?php for ($i=0; $is_file && $i<$file_count; $i++) { ?>
       
            <?if($i == 4){?>
                <tr>
                    <th></th>
                    <td style="padding:25px 0;">
                        <div class='option_add' valMaxCnt="<?=$file_count?>"  valCnt="<?=$benefit_cnt['cnt']?>">카드 혜택 추가</div>
                    </td>
                </tr>
            <?}?>

            <tr class="benefit1_show<?php echo $i?>" <?if($benefit_cnt['cnt'] <= $i) echo "style='display:none;'" ?>>
                <?if($i == 0){?> <th scope="row" style='width:70px;'>메인 이미지</th>
                <?}else if($i == 1){?> <th scope="row" style='width:70px;'>메인 로고</th>
                <?}else if($i == 2){?> <th scope="row" style='width:70px;'>리스트 배경</th>
                <?}else if($i == 3){?> <th scope="row" style='width:70px;'>매장 이미지</th>
                <?}else{?> <th scope="row"   >카드혜택</th>
                <?}?>
                <td class="CRbenefitWrite_MainList">
                    <?if($i == 0){?>
                        <div style='color:red; width:100%; height:30px; padding-top:5px;'>이미지크기 976px * 300px / JPG, PNG 파일을 올려주세요.</div>
                    <?}else if($i == 1){?>
                        <div style='color:red; width:100%; height:30px; padding-top:5px;'>이미지크기 360px * 125px / JPG, PNG 파일을 올려주세요.</div>
                    <?}else if($i == 2){?>
                        <div style='color:red; width:100%; height:30px; padding-top:5px;'>이미지크기 230px * 230px / JPG, PNG 파일을 올려주세요.</div>
                    <?}else if($i == 3){?>
                        <div style='color:red; width:100%; height:30px; padding-top:5px;'>이미지크기 320px * 220px / JPG, PNG 파일을 올려주세요.</div>
                    <?}else if($i == 4){?>
                        <div style='color:red; width:100%; height:30px; padding-top:5px;'>이미지크기 195px * 70px / JPG, PNG 파일을 올려주세요.</div>
                    <?}?>

                    <div style='padding-bottom:10px;'>
                        <input type="file" name="bf_file[]" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" class="frm_file frm_input">
                    </div>

                    <?if($i > 3){?>
                        
                        <?if($w != "u"){?>
                            <?$obj = sql_query("select * from g5_default_img");?>
                            <?=set_select_ktc($obj,"cardbenefit","bf_ck[]");?>
                        <?}else{?>
                            <?$file_result = sql_fetch( "select * from g5_board_file where bo_table = 'cardbenefit' and wr_id = ".$wr_id." and bf_no = ".$i);?>
                            <?$obj = sql_query("select * from g5_default_img");?>
                            <?=get_select_ktc($obj,"cardbenefit","bf_ck[]",$file_result['bf_ck']);?>
                        <?}?>
                    <br><br>
                    <?}?>
                    <?php if ($is_file_content) { ?>
                    
                    <textarea style='width:700px; height:50px;' class="fileInupt" type="text" name="bf_content[]" value="<?php echo ($w == 'u') ? $file[$i]['bf_content'] : '';?> <?if($i < 3) echo "first";?> " title="파일 설명을 입력해주세요." class="frm_file frm_input" id="bf_file_del_txt<?php echo $i ?>" size="31" placeholder="한글"><?php echo ($w == 'u') ? $file[$i]['bf_content'] : '';?> <?if($i < 3) echo "first";?></textarea></br></br>
                    
                    <?if($i > 3){?>
                        <textarea style='width:700px; height:50px;' class="fileInupt" type="text" name="bf_content_en_US[]" value="<?php echo ($w == 'u') ? $file[$i]['bf_content_en_US'] : ''; ?>" title="파일 설명을 입력해주세요." class="frm_file frm_input" id="bf_file_del_txt<?php echo $i ?>" size="31" placeholder="영어"><?php echo ($w == 'u') ? $file[$i]['bf_content_en_US'] : ''; ?></textarea></br></br>
                        <textarea style='width:700px; height:50px;' class="fileInupt" type="text" name="bf_content_ja_JP[]" value="<?php echo ($w == 'u') ? $file[$i]['bf_content_ja_JP'] : ''; ?>" title="파일 설명을 입력해주세요." class="frm_file frm_input" id="bf_file_del_txt<?php echo $i ?>" size="31" placeholder="일본어"><?php echo ($w == 'u') ? $file[$i]['bf_content_ja_JP'] : ''; ?></textarea></br></br>
                        <textarea style='width:700px; height:50px;' class="fileInupt" type="text" name="bf_content_zh_CN[]" value="<?php echo ($w == 'u') ? $file[$i]['bf_content_zh_CN'] : ''; ?>" title="파일 설명을 입력해주세요." class="frm_file frm_input" id="bf_file_del_txt<?php echo $i ?>" size="31" placeholder="간체"><?php echo ($w == 'u') ? $file[$i]['bf_content_zh_CN'] : ''; ?></textarea></br></br>
                        <textarea style='width:700px; height:50px;' class="fileInupt" type="text" name="bf_content_zh_TW[]" value="<?php echo ($w == 'u') ? $file[$i]['bf_content_zh_TW'] : ''; ?>" title="파일 설명을 입력해주세요." class="frm_file frm_input" id="bf_file_del_txt<?php echo $i ?>" size="31" placeholder="번체"><?php echo ($w == 'u') ? $file[$i]['bf_content_zh_TW'] : ''; ?></textarea></br></br>
                    <?}else{?>
                        <textarea style='display:none; width:700px; height:50px;' type="text" name="bf_content_en_US[]" value="first" title="파일 설명을 입력해주세요." class="frm_file frm_input" id="bf_file_del_txt<?php echo $i ?>" size="31" placeholder="영어"></textarea>
                        <textarea style='display:none; width:700px; height:50px;' type="text" name="bf_content_ja_JP[]" value="first" title="파일 설명을 입력해주세요." class="frm_file frm_input" id="bf_file_del_txt<?php echo $i ?>" size="31" placeholder="일본어"></textarea>
                        <textarea style='display:none; width:700px; height:50px;' type="text" name="bf_content_zh_CN[]" value="first" title="파일 설명을 입력해주세요." class="frm_file frm_input" id="bf_file_del_txt<?php echo $i ?>" size="31" placeholder="간체"></textarea>
                        <textarea style='display:none; width:700px; height:50px;' type="text" name="bf_content_zh_TW[]" value="first" title="파일 설명을 입력해주세요." class="frm_file frm_input" id="bf_file_del_txt<?php echo $i ?>" size="31" placeholder="번체"></textarea>
                    <?}?>

                    <span class="option_delete benefit1_show_span<?php echo $i?>" style='display:none;' valCnt='<?php echo $i?>'> 삭제</span>
                    <?php } ?>
                    <?php if($w == 'u' && ($file[$i]['file'] || $file[$i]['bf_content'])) { ?>
                    <input type="checkbox" class='bf_file_del_txt' valVal="bf_file_del_txt<?php echo $i ?>" id="bf_file_del<?php echo $i ?>" name="bf_file_del[<?php echo $i;  ?>]" value="1" valnum='<?php echo $i?>' > <label  valnum='<?php echo $i?>' for="bf_file_del<?php echo $i ?>"><?php if($i <= 3) echo $file[$i]['source'].'('.$file[$i]['size'].')';  ?> 파일삭제</label>
                    <?php } ?>
                </td>
            </tr>
            
        <?php } ?>




        <!--<tr>
            <th scope="row"><label for="wr_subject">이동 주소</label></th>
            <td>
                <div id="autosave_wrapper">
                    <input type="text" name="wr_url" value="<?php echo $write['wr_url']?>" id="wr_url"  class="frm_input " size="100" maxlength="255" placeholder=" ex) https://www.naver.com/">
                </div>
            </td>
        </tr>-->






        <tr>
            <th scope="row"><label for="wr_link<?php echo $i ?>">홈페이지 url</label></th>
            <td>
                한글 : <input style='width:800px;' class="frm_input required" name='wr_homepage_ko_KR' value="<?=$write['wr_homepage_ko_KR']?>" ><br><br>
                영어 : <input style='width:800px;' class="frm_input required" name='wr_homepage_en_US' value="<?=$write['wr_homepage_en_US']?>" ><br><br>
                일어 : <input style='width:800px;' class="frm_input required" name='wr_homepage_ja_JP' value="<?=$write['wr_homepage_ja_JP']?>" ><br><br>
                간체 : <input style='width:800px;' class="frm_input required" name='wr_homepage_zh_CN' value="<?=$write['wr_homepage_zh_CN']?>" ><br><br>
                번체 : <input style='width:800px;' class="frm_input required" name='wr_homepage_zh_TW' value="<?=$write['wr_homepage_zh_TW']?>" ><br>
            </td>
        </tr>




<!--         <?php for ($i=1; $is_link && $i<G5_LINK_COUNT; $i++) { ?>
        <tr>
            <th scope="row"><label for="wr_link<?php echo $i ?>">브랜드 url</label></th>
            <td><input type="text" name="wr_link<?php echo $i ?>" value="<?php if($w=="u"){echo$write['wr_link'.$i];} ?>" id="wr_link<?php echo $i ?>" class="frm_input" size="50"></td>
        </tr>
        <?php } ?>
         -->



        <tr>
            <th scope="row"><label for="wr_link<?php echo $i ?>">안내</label></th>
            <td>
				<?echo $wr_guide_html_ko_KR;?> 
				<?echo $wr_guide_html_en_US;?> 
				<?echo $wr_guide_html_ja_JP;?> 
				<?echo $wr_guide_html_zh_CN;?> 
				<?echo $wr_guide_html_zh_TW;?> 


<!-- 
                <textarea name='wr_guide' style='height:100px;'><?=$write['wr_guide']?></textarea><br><br>
                <textarea name='wr_guide_en_US' style='height:100px;'><?=$write['wr_guide_en_US']?></textarea><br><br>
                <textarea name='wr_guide_ja_JP' style='height:100px;'><?=$write['wr_guide_ja_JP']?></textarea><br><br>
                <textarea name='wr_guide_zh_CN' style='height:100px;'><?=$write['wr_guide_zh_CN']?></textarea><br><br>
                <textarea name='wr_guide_zh_TW' style='height:100px;'><?=$write['wr_guide_zh_TW']?></textarea><br><br> -->
            </td>
        </tr>





        <tr>
            <th scope="row"><label for="wr_link<?php echo $i ?>">유의사항</label></th>
            <td>
                <div id="autosave_wrapper" style='width:33%; float:left; padding-bottom:10px;'>
                    <?php if($write_min || $write_max) { ?>
                    <!-- 최소/최대 글자 수 사용 시 -->
                    <p id="char_count_desc">이 게시판은 최소 <strong><?php echo $write_min; ?></strong>글자 이상, 최대 <strong><?php echo $write_max; ?></strong>글자 이하까지 글을 쓰실 수 있습니다.</p>
                    <?php } ?>
                    <?php echo $wa_editor_html; // 에디터 사용시는 에디터로, 아니면 textarea 로 노출 ?>
                    <?php if($write_min || $write_max) { ?>
                    <!-- 최소/최대 글자 수 사용 시 -->
                    <div id="char_count_wrap"><span id="char_count"></span>글자</div>
                    <?php } ?>
                </div>


                <div id="autosave_wrapper" style='width:33%; float:left; padding-bottom:10px;'>
                    <?php if($write_min || $write_max) { ?>
                    <!-- 최소/최대 글자 수 사용 시 -->
                    <p id="char_count_desc">이 게시판은 최소 <strong><?php echo $write_min; ?></strong>글자 이상, 최대 <strong><?php echo $write_max; ?></strong>글자 이하까지 글을 쓰실 수 있습니다.</p>
                    <?php } ?>
                    <?php echo $wa_editor_en_US_html; // 에디터 사용시는 에디터로, 아니면 textarea 로 노출 ?>
                    <?php if($write_min || $write_max) { ?>
                    <!-- 최소/최대 글자 수 사용 시 -->
                    <div id="char_count_wrap"><span id="char_count"></span>글자</div>
                    <?php } ?>
                </div>
                <div id="autosave_wrapper" style='width:33%; float:left; padding-bottom:10px;'>
                    <?php if($write_min || $write_max) { ?>
                    <!-- 최소/최대 글자 수 사용 시 -->
                    <p id="char_count_desc">이 게시판은 최소 <strong><?php echo $write_min; ?></strong>글자 이상, 최대 <strong><?php echo $write_max; ?></strong>글자 이하까지 글을 쓰실 수 있습니다.</p>
                    <?php } ?>
                    <?php echo $wa_editor_ja_JP_html; // 에디터 사용시는 에디터로, 아니면 textarea 로 노출 ?>
                    <?php if($write_min || $write_max) { ?>
                    <!-- 최소/최대 글자 수 사용 시 -->
                    <div id="char_count_wrap"><span id="char_count"></span>글자</div>
                    <?php } ?>
                </div>
                <div id="autosave_wrapper" style='width:33%; float:left;'>
                    <?php if($write_min || $write_max) { ?>
                    <!-- 최소/최대 글자 수 사용 시 -->
                    <p id="char_count_desc">이 게시판은 최소 <strong><?php echo $write_min; ?></strong>글자 이상, 최대 <strong><?php echo $write_max; ?></strong>글자 이하까지 글을 쓰실 수 있습니다.</p>
                    <?php } ?>
                    <?php echo $wa_editor_zh_CN_html; // 에디터 사용시는 에디터로, 아니면 textarea 로 노출 ?>
                    <?php if($write_min || $write_max) { ?>
                    <!-- 최소/최대 글자 수 사용 시 -->
                    <div id="char_count_wrap"><span id="char_count"></span>글자</div>
                    <?php } ?>
                </div>
                <div id="autosave_wrapper" style='width:33%; float:left; '>
                    <?php if($write_min || $write_max) { ?>
                    <!-- 최소/최대 글자 수 사용 시 -->
                    <p id="char_count_desc">이 게시판은 최소 <strong><?php echo $write_min; ?></strong>글자 이상, 최대 <strong><?php echo $write_max; ?></strong>글자 이하까지 글을 쓰실 수 있습니다.</p>
                    <?php } ?>
                    <?php echo $wa_editor_zh_TW_html; // 에디터 사용시는 에디터로, 아니면 textarea 로 노출 ?>
                    <?php if($write_min || $write_max) { ?>
                    <!-- 최소/최대 글자 수 사용 시 -->
                    <div id="char_count_wrap"><span id="char_count"></span>글자</div>
                    <?php } ?>
                </div>
            </td>
        </tr>




        <tr>
            <th scope="row"><label for="wr_link<?php echo $i ?>">지도등록</label></th>
            <td class="CRbenefitWrite_map">
                <!--<div style='padding-bottom:10px;'>주소 입력</div>-->
                <input type="text" name='wr_address_num' id="sample2_postcode" value='<?=$write['wr_address_num']?>' placeholder="우편번호" style='margin-bottom:10px;'>
                <input type="button" onclick="sample2_execDaumPostcode()" value="우편번호 찾기" style='margin-bottom:10px;'><br>
                <input type="text" name='wr_address' id="sample2_address" value='<?=$write['wr_address_txt']?>' placeholder="한글주소" style='margin-bottom:10px;' size='75'>
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
            <th scope="row"><label for="wr_link<?php echo $i ?>">지역(시)입력</label></th>
            <td class="CRbenefitWrite_map">
				<? include('../../skin/board/cardbenefit/juso_admin/1.php') ?>
            </td>
        </tr>


        <tr>
            <th scope="row"><label for="wr_link<?php echo $i ?>">이용정보</label></th>
            <td class="CRbenefitWrite_ben">
                <input type="text" name='wr_1'  id="wr_1" value='<?=$write['wr_1']?>' placeholder="한글주소" size='60'>
                <input type="text" name='wr_2' value='<?=$write['wr_2']?>'  id="" placeholder="한글상세주소" size='60'><br>
                <input type="text" name='wr_3' id="wr_3" value='<?=$write['wr_3']?>' placeholder="영어주소" size='60'>
                <input type="text" name='wr_4' value='<?=$write['wr_4']?>'  id="" placeholder="영어상세주소" size='60'><br>
                <input type="text" name='wr_5' id="wr_5" value='<?=$write['wr_5']?>' placeholder="일본어주소" size='60' >
                <input type="text" name='wr_6' value='<?=$write['wr_6']?>'  id="" placeholder="일본어상세주소" size='60'><br>
                <input type="text" name='wr_7' id="wr_7" value='<?=$write['wr_7']?>' placeholder="간체주소" size='60'>
                <input type="text" name='wr_8' value='<?=$write['wr_8']?>'  id="" placeholder="간체상세주소" size='60'><br>
                <input type="text" name='wr_9' id="wr_9" value='<?=$write['wr_9']?>' placeholder="번체주소" size='60'>
                <input type="text" name='wr_10' value='<?=$write['wr_10']?>'  id="" placeholder="번체상세주소" size='60'><br><br><br>


                <div style='color:red; width:100%; height:30px; padding-top:5px;'>전화번호|영업시간|휴무일 및 기타 안내사항 순으로 입력하여주세요.<br>구분은 | 바 표시로 구분됩니다.</div>
                <div style='color:red; width:100%; height:30px; padding-top:5px;'>예시) +82212341234|24시간|연중무휴</div>

                <div id="autosave_wrapper" style='width:33%; float:left; padding-bottom:10px;'>
                    <?php if($write_min || $write_max) { ?>
                    <!-- 최소/최대 글자 수 사용 시 -->
                    <p id="char_count_desc">이 게시판은 최소 <strong><?php echo $write_min; ?></strong>글자 이상, 최대 <strong><?php echo $write_max; ?></strong>글자 이하까지 글을 쓰실 수 있습니다.</p>
                    <?php } ?>
                    <?php echo $service_editor_html; // 에디터 사용시는 에디터로, 아니면 textarea 로 노출 ?>
                    <?php if($write_min || $write_max) { ?>
                    <!-- 최소/최대 글자 수 사용 시 -->
                    <div id="char_count_wrap"><span id="char_count"></span>글자</div>
                    <?php } ?>
                </div>

                <div id="autosave_wrapper" style='width:33%; float:left; padding-bottom:10px;'>
                    <?php if($write_min || $write_max) { ?>
                    <!-- 최소/최대 글자 수 사용 시 -->
                    <p id="char_count_desc">이 게시판은 최소 <strong><?php echo $write_min; ?></strong>글자 이상, 최대 <strong><?php echo $write_max; ?></strong>글자 이하까지 글을 쓰실 수 있습니다.</p>
                    <?php } ?>
                    <?php echo $service_editor_en_US_html; // 에디터 사용시는 에디터로, 아니면 textarea 로 노출 ?>
                    <?php if($write_min || $write_max) { ?>
                    <!-- 최소/최대 글자 수 사용 시 -->
                    <div id="char_count_wrap"><span id="char_count"></span>글자</div>
                    <?php } ?>
                </div>
                <div id="autosave_wrapper" style='width:33%; float:left; padding-bottom:10px;'>
                    <?php if($write_min || $write_max) { ?>
                    <!-- 최소/최대 글자 수 사용 시 -->
                    <p id="char_count_desc">이 게시판은 최소 <strong><?php echo $write_min; ?></strong>글자 이상, 최대 <strong><?php echo $write_max; ?></strong>글자 이하까지 글을 쓰실 수 있습니다.</p>
                    <?php } ?>
                    <?php echo $service_editor_ja_JP_html; // 에디터 사용시는 에디터로, 아니면 textarea 로 노출 ?>
                    <?php if($write_min || $write_max) { ?>
                    <!-- 최소/최대 글자 수 사용 시 -->
                    <div id="char_count_wrap"><span id="char_count"></span>글자</div>
                    <?php } ?>
                </div>
                <div id="autosave_wrapper" style='width:33%; float:left;'>
                    <?php if($write_min || $write_max) { ?>
                    <!-- 최소/최대 글자 수 사용 시 -->
                    <p id="char_count_desc">이 게시판은 최소 <strong><?php echo $write_min; ?></strong>글자 이상, 최대 <strong><?php echo $write_max; ?></strong>글자 이하까지 글을 쓰실 수 있습니다.</p>
                    <?php } ?>
                    <?php echo $service_editor_zh_CN_html; // 에디터 사용시는 에디터로, 아니면 textarea 로 노출 ?>
                    <?php if($write_min || $write_max) { ?>
                    <!-- 최소/최대 글자 수 사용 시 -->
                    <div id="char_count_wrap"><span id="char_count"></span>글자</div>
                    <?php } ?>
                </div>
                <div id="autosave_wrapper" style='width:33%; float:left; '>
                    <?php if($write_min || $write_max) { ?>
                    <!-- 최소/최대 글자 수 사용 시 -->
                    <p id="char_count_desc">이 게시판은 최소 <strong><?php echo $write_min; ?></strong>글자 이상, 최대 <strong><?php echo $write_max; ?></strong>글자 이하까지 글을 쓰실 수 있습니다.</p>
                    <?php } ?>
                    <?php echo $service_editor_zh_TW_html; // 에디터 사용시는 에디터로, 아니면 textarea 로 노출 ?>
                    <?php if($write_min || $write_max) { ?>
                    <!-- 최소/최대 글자 수 사용 시 -->
                    <div id="char_count_wrap"><span id="char_count"></span>글자</div>
                    <?php } ?>
                </div>

            </td>
        </tr>


        <tr>
            <th scope="row"><label for="wr_link<?php echo $i ?>">지하철</label></th>
            <td class='metro'>
                <?if($w != 'u'){?>
                        <div class='metro_input metro_input_re'>   
                            <select name='wr_metro[]'>
								<option value='' >선택하세요</option>
								<optgroup label='서울'>
									<option value='1' >1호선</option>
									<option value='2' >2호선</option>
									<option value='3' >3호선</option>
									<option value='4' >4호선</option>
									<option value='5' >5호선</option>
									<option value='6' >6호선</option>
									<option value='7' >7호선</option>
									<option value='8' >8호선</option>
									<option value='9' >9호선</option>
									<option value='10'>인천1호선</option>
									<option value='11'>인천2호선</option>
									<option value='12'>분당선</option>
									<option value='13'>신분당</option>
									<option value='14'>경의중앙선</option>
									<option value='15'>경춘선</option>
									<option value='16'>공항</option>
									<option value='17'>자기부상철도</option>
									<option value='18'>의정부경전철</option>
									<option value='19'>에버라인</option>
									<option value='20'>수인선</option>
									<option value='21'>경강선</option>
									<option value='22'>우이신설</option>
									</optgroup>

								<optgroup label='대구'>
									<option value='23'>대구1호선</option>
									<option value='24'>대구2호선</option>
									<option value='25'>대구3호선</option>
								</optgroup>
									
								<optgroup label='대전'>
									<option value='26'>대전1호선</option>
								</optgroup>

								<optgroup label='광주'>
									<option value='27'>광주1호선</option>
								</optgroup>

								<optgroup label='부산'>
									<option value='28'>부산1호선</option>
									<option value='29'>부산2호선</option>
									<option value='30'>부산3호선</option>
									<option value='31'>부산4호선</option>
									<option value='32'>동해선</option>
									<option value='33'>부산-김해경전철</option>
								</optgroup>
                            </select>

                            <input type='text' name='metro_info[]' placeholder='ex) 잠실역 2번출구' size='28'>
                            <input type='text' name='metro_info_en_US[]' placeholder='영문' size='28'>
                            <input type='text' name='metro_info_ja_JP[]' placeholder='일본어' size='28'>
                            <input type='text' name='metro_info_zh_CN[]' placeholder='간체' size='28'>
                            <input type='text' name='metro_info_zh_TW[]' placeholder='번체' size='28'>

                            <input type='hidden' name='metro_id[]' value='no'> 
                            <input type='hidden' name='metro_id_ck[]' id='metro_id_ck' value='no'> 
                            
                            <div style='float:right; background:black; color:white; width:50px; height:100%; text-align:center; cursor:pointer;' class='metro_input_add'>추가</div>
                        </div>
                <?}?>

                <?if( $metro_reulst_count['cnt'] == 0 && $w == 'u' ){?>
                        <div class='metro_input metro_input_re'>   
                            <select name='wr_metro[]'>
								<option value='' >선택하세요</option>
								<optgroup label='서울'>
									<option value='1' >1호선</option>
									<option value='2' >2호선</option>
									<option value='3' >3호선</option>
									<option value='4' >4호선</option>
									<option value='5' >5호선</option>
									<option value='6' >6호선</option>
									<option value='7' >7호선</option>
									<option value='8' >8호선</option>
									<option value='9' >9호선</option>
									<option value='10'>인천1호선</option>
									<option value='11'>인천2호선</option>
									<option value='12'>분당선</option>
									<option value='13'>신분당</option>
									<option value='14'>경의중앙선</option>
									<option value='15'>경춘선</option>
									<option value='16'>공항</option>
									<option value='17'>자기부상철도</option>
									<option value='18'>의정부경전철</option>
									<option value='19'>에버라인</option>
									<option value='20'>수인선</option>
									<option value='21'>경강선</option>
									<option value='22'>우이신설</option>
								</optgroup>

								<optgroup label='대구'>
									<option value='23'>대구1호선</option>
									<option value='24'>대구2호선</option>
									<option value='25'>대구3호선</option>
								</optgroup>
									
								<optgroup label='대전'>
									<option value='26'>대전1호선</option>
								</optgroup>

								<optgroup label='광주'>
									<option value='27'>광주1호선</option>
								</optgroup>

								<optgroup label='부산'>
									<option value='28'>부산1호선</option>
									<option value='29'>부산2호선</option>
									<option value='30'>부산3호선</option>
									<option value='31'>부산4호선</option>
									<option value='32'>동해선</option>
									<option value='33'>부산-김해경전철</option>
								</optgroup>

                            </select>

                            <input type='text' name='metro_info[]' placeholder='ex) 잠실역 2번출구' size='28'>
                            <input type='text' name='metro_info_en_US[]' placeholder='영문' size='28'>
                            <input type='text' name='metro_info_ja_JP[]' placeholder='일본어' size='28'>
                            <input type='text' name='metro_info_zh_CN[]' placeholder='간체' size='28'>
                            <input type='text' name='metro_info_zh_TW[]' placeholder='번체' size='28'>

                            <input type='hidden' name='metro_id[]' value='no'> 
                            <input type='hidden' name='metro_id_ck[]' id='metro_id_ck' value='insert'> 
                            
                            <div style='float:right; background:black; color:white; width:50px; height:100%; text-align:center; cursor:pointer;' class='metro_input_add'>추가</div>
                        </div>
                <?}?>


                <? $metro_reulst_cnt = 0; while ($row = sql_fetch_array($metro_reulst)){ ?>
                        <div class='metro_input <?if($metro_reulst_cnt == 0) echo "metro_input_re";?>'>   
                            <select name='wr_metro[]' id='wr_metro'>
								<option value=''>선택하세요</option>
								<optgroup label='서울'>
									<option value='1' <?if( $row['metro_hosun'] == 1 ) echo "selected"; ?> >1호선</option>
									<option value='2' <?if( $row['metro_hosun'] == 2 ) echo "selected"; ?> >2호선</option>
									<option value='3' <?if( $row['metro_hosun'] == 3 ) echo "selected"; ?> >3호선</option>
									<option value='4' <?if( $row['metro_hosun'] == 4 ) echo "selected"; ?> >4호선</option>
									<option value='5' <?if( $row['metro_hosun'] == 5 ) echo "selected"; ?> >5호선</option>
									<option value='6' <?if( $row['metro_hosun'] == 6 ) echo "selected"; ?> >6호선</option>
									<option value='7' <?if( $row['metro_hosun'] == 7 ) echo "selected"; ?> >7호선</option>
									<option value='8' <?if( $row['metro_hosun'] == 8 ) echo "selected"; ?> >8호선</option>
									<option value='9' <?if( $row['metro_hosun'] == 9 ) echo "selected"; ?> >9호선</option>
									<option value='10' <?if( $row['metro_hosun'] == 10 ) echo "selected"; ?> >인천1호선</option>
									<option value='11' <?if( $row['metro_hosun'] == 11 ) echo "selected"; ?> >인천2호선</option>
									<option value='12' <?if( $row['metro_hosun'] == 12 ) echo "selected"; ?> >분당선</option>
									<option value='13' <?if( $row['metro_hosun'] == 13 ) echo "selected"; ?> >신분당선</option>
									<option value='14' <?if( $row['metro_hosun'] == 14 ) echo "selected"; ?> >경의중앙선</option>
									<option value='15' <?if( $row['metro_hosun'] == 15 ) echo "selected"; ?> >경춘선</option>
									<option value='16' <?if( $row['metro_hosun'] == 16 ) echo "selected"; ?> >공항철도</option>
									<option value='17' <?if( $row['metro_hosun'] == 17 ) echo "selected"; ?> >자기부상철도</option>
									<option value='18' <?if( $row['metro_hosun'] == 18 ) echo "selected"; ?> >의정부경전철</option>
									<option value='19' <?if( $row['metro_hosun'] == 19 ) echo "selected"; ?> >에버라인</option>
									<option value='20' <?if( $row['metro_hosun'] == 20 ) echo "selected"; ?> >수인선</option>
									<option value='21' <?if( $row['metro_hosun'] == 21 ) echo "selected"; ?> >경강선</option>
									<option value='22' <?if( $row['metro_hosun'] == 22 ) echo "selected"; ?> >우이신설</option>
								</optgroup>

								<optgroup label='대구'>
									<option value='23' <?if( $row['metro_hosun'] == 23 ) echo "selected"; ?> >대구1호선</option>
									<option value='24' <?if( $row['metro_hosun'] == 24 ) echo "selected"; ?> >대구2호선</option>
									<option value='25' <?if( $row['metro_hosun'] == 25 ) echo "selected"; ?> >대구3호선</option>
								</optgroup>
									
								<optgroup label='대전'>
									<option value='26' <?if( $row['metro_hosun'] == 26 ) echo "selected"; ?> >대전1호선</option>
								</optgroup>

								<optgroup label='광주'>
									<option value='27' <?if( $row['metro_hosun'] == 27 ) echo "selected"; ?> >광주1호선</option>
								</optgroup>

								<optgroup label='부산'>
									<option value='28' <?if( $row['metro_hosun'] == 28 ) echo "selected"; ?> >부산1호선</option>
									<option value='29' <?if( $row['metro_hosun'] == 29 ) echo "selected"; ?> >부산2호선</option>
									<option value='30' <?if( $row['metro_hosun'] == 30 ) echo "selected"; ?> >부산3호선</option>
									<option value='31' <?if( $row['metro_hosun'] == 31 ) echo "selected"; ?> >부산4호선</option>
									<option value='32' <?if( $row['metro_hosun'] == 32 ) echo "selected"; ?> >동해선</option>
									<option value='33' <?if( $row['metro_hosun'] == 33 ) echo "selected"; ?> >부산-김해경전철</option>
								</optgroup>


                            </select>

                            <input type='text' name='metro_info[]' id='metro_info' value='<?=$row['metro_info']?>' placeholder='ex) 잠실역 2번출구' size='28'>
                            <input type='text' name='metro_info_en_US[]' id='metro_info_en_US' value='<?=$row['metro_info_en_US']?>' placeholder='영문' size='28'>
                            <input type='text' name='metro_info_ja_JP[]' id='metro_info_ja_JP' value='<?=$row['metro_info_ja_JP']?>' placeholder='일본어' size='28'>
                            <input type='text' name='metro_info_zh_CN[]' id='metro_info_zh_CN' value='<?=$row['metro_info_zh_CN']?>' placeholder='간체' size='28'>
                            <input type='text' name='metro_info_zh_TW[]' id='metro_info_zh_TW' value='<?=$row['metro_info_zh_TW']?>' placeholder='번체' size='28'>

                            <input type='hidden' name='metro_id[]' id='metro_id' value='<?=$row['metro_id']?>'>                       
                            <input type='hidden' name='metro_id_ck[]' id='metro_id_ck' value='no'> 

                            <div class='add_btn <?if($metro_reulst_cnt == 0){ echo "metro_input_add";}else{ echo "metro_input_remove";}?>'><?if($metro_reulst_cnt == 0){ echo "추가";}else{ echo "삭제";}?></div>
                        </div>
                <? $metro_reulst_cnt++;  } ?>
            </td>
        </tr>

        <tr>
            <th scope="row"><label for="wr_link<?php echo $i ?>">버스</label></th>
            <td class="CRbenefitWrite_bus">
                <div style='width:100%; margin-bottom:8px;'>지선버스 : <input type='text' name='wr_bus_1' value='<?=$write['wr_bus_1']?>' size='80' placeholder=' ex) 3217,3313,3314,3315'></div>
                <div style='width:100%; margin-bottom:8px;'>일반버스 : <input type='text' name='wr_bus_5' value='<?=$write['wr_bus_5']?>' size='80'></div>
                <div style='width:100%; margin-bottom:8px;'>간선버스 : <input type='text' name='wr_bus_2' value='<?=$write['wr_bus_2']?>' size='80'></div>
                <div style='width:100%; margin-bottom:8px;'>좌석버스 : <input type='text' name='wr_bus_6' value='<?=$write['wr_bus_6']?>' size='80'></div>
                <div style='width:100%; margin-bottom:8px;'>광역버스 : <input type='text' name='wr_bus_3' value='<?=$write['wr_bus_3']?>' size='80'></div>
                <div style='width:100%; margin-bottom:8px;'>직행버스 : <input type='text' name='wr_bus_7' value='<?=$write['wr_bus_7']?>' size='80'></div>
                <div style='width:100%; margin-bottom:8px;'>공항버스 : <input type='text' name='wr_bus_4' value='<?=$write['wr_bus_4']?>' size='80'></div>

				<br><br>
                <div style='width:100%; margin-bottom:8px;'>마을버스 : <input type='text' name='wr_bus_8_ko_KR' value='<?=$write['wr_bus_8_ko_KR']?>' size='80' placeholder="한글"></div>
				<div style='width:100%; margin-bottom:8px;'>마을버스 : <input type='text' name='wr_bus_8_en_US' value='<?=$write['wr_bus_8_en_US']?>' size='80' placeholder="영어"></div>
				<div style='width:100%; margin-bottom:8px;'>마을버스 : <input type='text' name='wr_bus_8_ja_JP' value='<?=$write['wr_bus_8_ja_JP']?>' size='80' placeholder="일어"></div>
				<div style='width:100%; margin-bottom:8px;'>마을버스 : <input type='text' name='wr_bus_8_zh_CN' value='<?=$write['wr_bus_8_zh_CN']?>' size='80' placeholder="간체"></div>
				<div style='width:100%; margin-bottom:8px;'>마을버스 : <input type='text' name='wr_bus_8_zh_TW' value='<?=$write['wr_bus_8_zh_TW']?>' size='80' placeholder="번체"></div>


				<br><br>
                <div style='width:100%; margin-bottom:8px;'>버스 : <input type='text' name='wr_bus_9_ko_KR' value='<?=$write['wr_bus_9_ko_KR']?>' size='80' placeholder="한글"></div>
				<div style='width:100%; margin-bottom:8px;'>버스 : <input type='text' name='wr_bus_9_en_US' value='<?=$write['wr_bus_9_en_US']?>' size='80' placeholder="영어"></div>
				<div style='width:100%; margin-bottom:8px;'>버스 : <input type='text' name='wr_bus_9_ja_JP' value='<?=$write['wr_bus_9_ja_JP']?>' size='80' placeholder="일어"></div>
				<div style='width:100%; margin-bottom:8px;'>버스 : <input type='text' name='wr_bus_9_zh_CN' value='<?=$write['wr_bus_9_zh_CN']?>' size='80' placeholder="간체"></div>
				<div style='width:100%; margin-bottom:8px;'>버스 : <input type='text' name='wr_bus_9_zh_TW' value='<?=$write['wr_bus_9_zh_TW']?>' size='80' placeholder="번체"></div>

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
        <a href="/bbs/board.php?bo_table=<?php echo $bo_table ?>&wr_id=<?php echo $wr_id ?>&info=benefit&num=2&me_code=30" class="btn_cancel" target='_blank'>글 보기</a>
    </div>
    </form>

    <script>

	$(function(){
		$('.admin_title_h1').html('카드사용혜택');
	})


    $('.addg').click(function(){
        var vals = $(this).attr('val'); //삭제 추가 판별
        var values = $('.group_type').val(); // 그룹 이름

        $.ajax({
            url: "/bbs/ajax.group.php",
            data: {
                'vals': vals,
                'values': values,
                'tablename': "cardbenefit",
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
        <?php echo $editor_js_img_en_US; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>
        <?php echo $editor_js_img_ja_JP; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>
        <?php echo $editor_js_img_zh_CN; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>
        <?php echo $editor_js_img_zh_TW; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>

		<?php echo $editor_js_guide; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>
        <?php echo $editor_js_guide_en_US; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>
        <?php echo $editor_js_guide_ja_JP; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>
        <?php echo $editor_js_guide_zh_CN; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>
        <?php echo $editor_js_guide_zh_TW; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>
        var subject = "";
        var content = "";
        $.ajax({
            url: g5_bbs_url+"/ajax.filter.php",
            type: "POST",
            data: {
                "subject": f.wr_subject.value,
                "content": f.wr_content.value,
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