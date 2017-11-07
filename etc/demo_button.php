<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>
<?php ///if($is_admin && defined('DEMO_BUTTON') && DEMO_BUTTON) { ?>
<?php if(defined('DEMO_BUTTON') && DEMO_BUTTON) { ?>
<link rel="stylesheet" href="<?php echo G5_URL?>/css/demo_button.css">

<div id="demo">
<form method=post>
<div id="title"><?php echo BUILDER_NAME.' '.BUILDER_VERSION_NUMBER.' '.BUILDER_VERSION_CLASS.' '?>데모 템플릿 (<span><?php if(G5_IS_MOBILE) echo 'mobile'; else echo 'pc'; ?></span>)</div>
<div id="box">
<a href='<?php echo G5_URL?>/?device=pc' class='pc'>PC</a>
<select name=tmpl>
<option value="">Default 설정값
<?php
    for ($i = 0; $i < count($tmpl_arr); $i++) {
          if($tmpl_arr[$i] == $g5['tmpl']) $selected = " selected";
          else $selected = "";
          echo '<option value="'.$tmpl_arr[$i].'"'.$selected.'>'.$i.'. '.$tmpl_arr[$i].PHP_EOL;
    }
?>
</select>
<br/>
<a href='<?php echo G5_URL?>/?device=mobile'>모바일</a>
<select name=mobile_tmpl>
<option value="">Default 설정값
<?php
    for ($i = 0; $i < count($mobile_tmpl_arr); $i++) {
          if($mobile_tmpl_arr[$i] == $g5['mobile_tmpl']) $selected = " selected";
          else $selected = "";
          echo '<option value="'.$mobile_tmpl_arr[$i].'"'.$selected.'>'.$i.'. '.$mobile_tmpl_arr[$i].PHP_EOL;
    }
?>
</select>
<br/>
<input type=submit value="선 택">
</div>
</form>
</div>
<?php } ?>
