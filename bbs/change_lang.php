<?php
    include_once "./_common.php";
    $_SESSION['lang'] = $l;
	$g5['lang'] = $l;
	$lang = $l;
	session_save_path(G5_SESSION_PATH);
	session_start();


	goto_url($u);



    
?>
