<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);

$sql_service_result = sql_query(" select * from g5_map_service");
$sql_store_result = sql_query(" select * from g5_map_store");
// $di_phone = explode(" - ", $write['info_phone']);
// $di_phone1 = explode(" - ", $write['info_phone1']);
$di_service = explode(",", $write['service_id']);


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

        <input type='hidden' name='wr_subject' value='1'>
        <input type='hidden' name='wr_content' value='1'>


        <!--<tr>
            <th scope="row"><label for="wr_subject">노출/비노출<strong class="sound_only">필수</strong></label></th>
            <td>   
                <?if($w == "u"){?>
                    <input type="radio" name="wr_1" value="0" <?if($write['wr_1'] == 0 ) echo "checked"; ?> >노출 
                    <input type="radio" name="wr_1" value="1" <?if($write['wr_1'] == 1 ) echo "checked"; ?> >비노출
                <?}else{?>
                    <input type="radio" name="wr_1" value="0" checked>노출 
                    <input type="radio" name="wr_1" value="1">비노출
                <?}?>
                <span style='padding-left:40px; font-size:11px; color:red;'>비노출 시 통합검색에서 노출이 가능합니다.</span>
            </td>
        </tr>-->






        <tr>
            <th scope="row"><label for="wr_subject">판매점 이름<strong class="sound_only">필수</strong></label></th>
            <td>
                <div style='color:red; width:100%; height:30px; padding-top:5px;'>예시) 상호명 지점명 / 세븐일레븐 강남점 / CU 제주점</div>
                <div id="autosave_wrapper" class="mapWrrite_name">
                    <input type="text" name="info_name_ko_KR" value="<?php echo $write['info_name_ko_KR'] ?>" id="info_name_ko_KR" required class="frm_input" size="30" maxlength="255" placeholder='한글 제목'>
                </div>

                <div id="autosave_wrapper" class="mapWrrite_name">
                    <input type="text" name="info_name_en_US" value="<?php echo $write['info_name_en_US'] ?>" id="info_name_en_US" required class="frm_input" size="30" maxlength="255" placeholder='영어 제목'>
                </div>

                <div id="autosave_wrapper" class="mapWrrite_name">
                    <input type="text" name="info_name_ja_JP" value="<?php echo $write['info_name_ja_JP'] ?>" id="info_name_ja_JP" required class="frm_input" size="30" maxlength="255" placeholder='일본어 제목'>
                </div>

                <div id="autosave_wrapper" class="mapWrrite_name">
                    <input type="text" name="info_name_zh_CN" value="<?php echo $write['info_name_zh_CN'] ?>" id="info_name_zh_CN" required class="frm_input" size="30" maxlength="255" placeholder='간체 제목'>
                </div>

                <div id="autosave_wrapper" class="mapWrrite_name">
                    <input type="text" name="info_name_zh_TW" value="<?php echo $write['info_name_zh_TW'] ?>" id="info_name_zh_TW" required class="frm_input" size="30" maxlength="255" placeholder='번체 제목'>
                </div>
            </td>
        </tr>






        <tr>
            <th scope="row"><label for="wr_link<?php echo $i ?>">주소</label></th>
            <td class="mapWrrite_add">
                <!--<div style='padding-bottom:10px;'>주소 입력</div>-->
                <input type="text" name='info_address_num' id="sample2_postcode" value='<?=$write['info_address_num']?>' placeholder="우편번호" style='margin-bottom:10px;'>
                <input type="button" onclick="sample2_execDaumPostcode()" value="우편번호 찾기" style='margin-bottom:10px;'><br>
                
                <input type="text" name='wr_1' value='<?=$write['wr_1']?>'  id="sample2_address" placeholder="한글주소" style='margin-bottom:10px;' size='60'>
                <input type="text" name='wr_2' value='<?=$write['wr_2']?>'  id="" placeholder="한글상세주소" style='margin-bottom:10px;' size='60'><br>



                <input type="text" name='wr_3' value='<?=$write['wr_3']?>'  id="sample2_addressEnglish" placeholder="영문주소" style='margin-bottom:10px;' size='60'>
                <input type="text" name='wr_4' value='<?=$write['wr_4']?>'  id="" placeholder="영문상세주소" style='margin-bottom:10px;' size='60'><br>



                <input type="text" name='wr_5' value='<?=$write['wr_5']?>'  id="sample2_address" placeholder="일본주소" style='margin-bottom:10px;' size='60'>
                <input type="text" name='wr_6' value='<?=$write['wr_6']?>'  id="" placeholder="일본상세주소" style='margin-bottom:10px;' size='60'><br>



                <input type="text" name='wr_7' value='<?=$write['wr_7']?>'  id="sample2_addressEnglish" placeholder="간체주소" style='margin-bottom:10px;' size='60'>
                <input type="text" name='wr_8' value='<?=$write['wr_8']?>'  id="" placeholder="간체상세주소" style='margin-bottom:10px;' size='60'><br>

                <input type="text" name='wr_9' value='<?=$write['wr_9']?>'  id="sample2_addressEnglish" placeholder="번체주소" style='margin-bottom:10px;' size='60'>
                <input type="text" name='wr_10' value='<?=$write['wr_10']?>'  id="" placeholder="번체상세주소" style='margin-bottom:10px;' size='60'><br><br>




                좌표 : 
                <input type="text" id='wr_lat' name='info_lat' placeholder="lat" value='<?=$write['info_lat']?>' size='30'>
                <input type="text" id='wr_lng' name='info_lng' placeholder="lng" value='<?=$write['info_lng']?>' size='30'>

                <div id="layer" style="display:none;position:fixed;overflow:hidden;z-index:1;-webkit-overflow-scrolling:touch;">
                <img src="//t1.daumcdn.net/localimg/localimages/07/postcode/320/close.png" id="btnCloseLayer" style="cursor:pointer;position:absolute;right:-3px;top:-3px;z-index:1" onclick="closeDaumPostcode()" alt="닫기 버튼">
                </div>  
                <script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>

            </td>
        </tr> 








        <div class='basic_store' valId='<?=$write['store_id']?>'></div>
        <div class='detail_store' valId='<?=$write['store_detail']?>'></div>

        <tr>
            <th scope="row"><label for="wr_link<?php echo $i ?>">판매점 종류</label></th>
            <td class='metro'>
                <?if($w != "u") set_select_ktc($sql_store_result,'allshop','store_id'); else get_select_ktc($sql_store_result,'allshop','store_id',$write['store_id']);?>

                <div class='radio_area'>
                
                </div>
            </td>
        </tr>




        <tr>
            <th scope="row"><label for="wr_link<?php echo $i ?>">판매점 번호</label></th>
            <td>
                
                <input type='text' name='info_phone' value='<?=$write['info_phone']?>' size="30"  maxlength="20" style='float:left;'; class="mapWrrite_inupt">
                <div style='color:red; width:50%; height:20px;  float:left; padding-left:20px;'>하이픈 제외, 국가번호를 함께 입력해주세요. <br>입력 예시) 02-1235-1234의 경우 +85 2-1235-1234</div>
                <!--<input type='text' name='info_phone[]' value='<?=$di_phone[1]?>' size="4"  maxlength="4"> -
                <input type='text' name='info_phone[]' value='<?=$di_phone[2]?>' size="4"  maxlength="4">-->
            </td>
        </tr> 

        <tr>
            <th scope="row"><label for="wr_link<?php echo $i ?>">대표 번호</label></th>
            <td>
                <input type='text' name='info_phone1' value='<?=$write['info_phone1']?>' size="30"  maxlength="20" class="mapWrrite_inupt">
                <!--<input type='text' name='info_phone1[]' value='<?=$di_phone1[1]?>' size="4"  maxlength="4"> -
                <input type='text' name='info_phone1[]' value='<?=$di_phone1[2]?>' size="4"  maxlength="4">-->
            </td>
        </tr> 



        <tr>
            <th scope="row"><label for="wr_link<?php echo $i ?>">서비스</label></th>
            <td>
                <?while( $row = sql_fetch_array($sql_service_result) ){?>
                <div style='width:200px; height:100%; float:left;'>
                    <input type="checkbox" name="service_id[]" value="<?=$row['id']?>" 
                     <?for($i=0; $i<count($di_service); $i++){

                        if($di_service[$i] == $row['id']) echo "checked";?>
                     <?}?>  > 
                    <?=$row['service_name']?>
                </div> 
                <? } ?>         
            </td>
        </tr> 



        <tr>
            <th scope="row"><label for="wr_link<?php echo $i ?>">서비스 시간</label></th>
            <td class="mapWrrite_time">
                <div style='color:red; width:100%; height:30px; padding-top:5px;'>입력 예시) 24시간 / 07:00 ~ 23:00</div>
                <input type="text" name='info_servicetime_ko_KR' value='<?=$write["info_servicetime_ko_KR"]?>' id="info_servicetime_ko_KR" placeholder="한글 서비스 시간" style='margin-bottom:10px;' size='75'>
                <input type="text" name='info_servicetime_en_US' value='<?=$write["info_servicetime_en_US"]?>' id="info_servicetime_ko_KR" placeholder="영문 서비스 시간" style='margin-bottom:10px;' size='75'><br>
                <input type="text" name='info_servicetime_ja_JP' value='<?=$write["info_servicetime_ja_JP"]?>' id="info_servicetime_ko_KR" placeholder="일본 서비스 시간" style='margin-bottom:10px;' size='75'>
                <input type="text" name='info_servicetime_zh_CN' value='<?=$write["info_servicetime_zh_CN"]?>' id="info_servicetime_ko_KR" placeholder="간체 서비스 시간" style='margin-bottom:10px;' size='75'><br>
                <input type="text" name='info_servicetime_zh_TW' value='<?=$write["info_servicetime_zh_TW"]?>' id="info_servicetime_ko_KR" placeholder="번체 서비스 시간" style='margin-bottom:10px;' size='75'><br>
            </td>
        </tr> 





        <?php for ($i=1; $is_link && $i<=1; $i++) { ?>
        <tr>
            <th scope="row"><label for="wr_link<?php echo $i ?>">상세보기 링크 #<?php echo $i ?></label></th>
            <td><input type="text" name="wr_link<?php echo $i ?>" value="<?php if($w=="u"){echo $write['wr_link'.$i];} ?>" id="wr_link<?php echo $i ?>" class="frm_input" size="50"></td>
        </tr>
        <?php } ?>

        <?php for ($i=0; $is_file && $i<$file_count; $i++) { ?>
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
        <a href="/bbs/board.php?bo_table=<?php echo $bo_table ?>&info=search&me_code=20&num=1&word=<?=$write['info_address_ko_KR']?>" class="btn_cancel" target='_blank'>글 보기</a>
    </div>
    </form>

    <script>
	$(function(){
		$('.admin_title_h1').html('판매점 관리');
	})



    $.ajax({
        url: './radio.ajax.php',
        data: 'val='+$('.basic_store').attr('valId')+'&val2='+$('.detail_store').attr('valId'),
        success:function(data){
            $('.radio_area').html(data);
        }
    })


    $('.select_ktc').change(function(){
        $.ajax({
            url: './radio.ajax.php',
            data: 'val='+$(this).val()+'&val2='+$('.detail_store').attr('valId'),
            success:function(data){
                $('.radio_area').html(data);
            }
        })
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
                url = "https://maps.googleapis.com/maps/api/geocode/json?address="+fulladd;
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