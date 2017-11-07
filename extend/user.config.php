<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<?php 

// 디버그모드추가 
//170124_arcthan  디버그모드에서만 작동

$is_debug = false;

if($_REQUEST['mode']){
	 if ($_REQUEST['mode']=='debug'){
			$is_debug = true;
	 }else{
			$is_debug = false;
	 }
 }else{
		$is_debug =$_SESSION['is_debug'];
 }

$_SESSION['is_debug']  = $is_debug;

if($_SESSION['is_debug'])echo " debug : ".$_SESSION['is_debug'];



// 회사 IP추가
//170530_arcthan 
$superZone = strstr($_SERVER["REMOTE_ADDR"],"210.96.211");
if($superZone)echo "zone : " .$superZone;


//관리권한 설정 
// 최고관리자
if ($member[mb_id] == 'ktc') $is_admin = 'super';


// 그룹관리자
if ($gr_id == '그룹아이디')
{
    if ($member[mb_id] == '회원아이디1') $is_admin = 'group';
}

// 게시판관리자
if ($bo_table == '게시판아이디')
{
    if ($member[mb_id] == '회원아이디1') $is_admin = 'board';

    if ($is_admin == 'board') $board[bo_admin] = $member[mb_id];
}
?> 