<?php
$sub_menu = "200190";
include_once('./_common.php');

if ($is_admin != 'super')
    alert('최고관리자만 접근 가능합니다.');

$g5['title'] = '일정등록';

?>

<div style="padding:10px 0 0 10px;">
  <h2><?php echo $tipo['tipo_name'] ?></h2>
</div>

 <form name="fmemberexcel" method="post" action="./upxls_indb.php" enctype="MULTIPART/FORM-DATA" autocomplete="off">

<div class="tbl_head01 tbl_wrap" style="padding:10px; text-align:center; min-height:300px; width:95%;">

    <table style="width:700px;" align="center">
    <colgroup>
        <col class="grid_4">
        <col>
    </colgroup>

   <div id="excelfile_upload" >
        <label for="excelfile">파일선택</label>
        <input type="file" name="excelfile" id="excelfile">
    </div>

    <div class="btn_confirm01 btn_confirm" style="margin-top:20px;border-top:1px solid #ccc;padding-top:10px;">
        <input type="submit" value="엑셀파일 등록" class="btn_submit">
		<button type="button" onclick="window.close();">닫기</button>
    </div>

</div>

</form>
<br><br>
<div style='text-align:left;'>
  기본형식 유의사항!<br><br>
  <span style='color:red;'>*</span>엑셀파일 A2 부터 시작한다.<br><br>
  <span style='color:red;'>*</span>엑셀파일 A ~ N 까지 한 라인<br><br>
  <span style='color:red;'>*</span>분류(A) 입력 부분은 축제&행사 또는 공연&전시로 입력해야 한다.<br> ex) 축제/행사 X , 공연/전시 X <br><br>
  <span style='color:red;'>*</span>기간 시작(B),기간 끝(C) 입력 부분은 20170101 방식으로 입력<br> ex) 2017/01/01 X , 2017.01.01 X <br><br>
  <span style='color:red;'>*</span>지역(I) 입력시 줄임말X 서울X , 서울특별시 O    혹시 헷갈릴 경우 관리자 행사축제 -> 글쓰기에서 지역 셀랙박스안에 내용이랑 같게 입력 이렇게 안할때 번역문제가 생길수도있음
</div>
