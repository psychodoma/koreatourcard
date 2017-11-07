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