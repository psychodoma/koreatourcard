<?php
include_once('../_common.php');


if( $_SESSION['lang'] != "zh_CN" ){
	$url = urlencode($_SERVER["REQUEST_URI"]);
	header("Location:http://koreatourcard.kr/bbs/change_lang.php?l=zh_CN&u=\''.$url.'\'");

}


//include_once('/bbs/board.php'); ///goodbuilder
?>
