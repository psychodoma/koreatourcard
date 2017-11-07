<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>
<link rel="stylesheet" href="<?php echo G5_URL?>/css/lang_button.css">
<script>
function change_lang(lang, url) {
    var f = document.change;
    f.action = '<?php echo G5_BBS_URL; ?>/change_lang.php?l='+lang+'&u='+url; 
	f.submit();
}


function toggle() {
    var f = document.getElementById('flags');
    f.style.display = (f.style.display != 'none' ? 'none' : '' );
    f.style.visibility = (f.style.visibility != 'hidden' ? 'hidden' : '' );
}
</script>
<?
$url = urlencode($_SERVER["REQUEST_URI"]);

$arr_lang = array("lang%3Dko","lang%3Dkr", "lang%3Den", "lang%3Djp", "lang%3Dcn","lang%3Dtw");







if(strpos($url, "adm") != true) { 
?>




<div class="top_header">
<div  class='language'>
    <ul>
<?php

echo '<form name="change" id="change" method="post">'.PHP_EOL;
///echo '<img src="'.G5_LOCALE_IMG_URL.'/flag/'.$g5['flag_list'][$g5['lang']].'.png" alt="'._t($g5['lang_name_list'][$g5['lang']]).'" title="'._t($g5['lang_name_list'][$g5['lang']]).'" style="float:left; margin-top:1px"> '.PHP_EOL;
//echo '<img src="'.G5_LOCALE_IMG_URL.'/flag/'.$g5['flag_list'][$g5['lang']].'.png" alt="'._t($g5['lang_name_list'][$g5['lang']]).'" title="'._t($g5['lang_name_list_en'][$g5['lang']]).'" style="float:left; margin-top:1px"> '.PHP_EOL;
//echo '<img src="'.G5_LOCALE_IMG_URL.'/flag/arrow.png" onclick="javascript:toggle();" style="float:right; margin-right:10px;margin-top:1px"> '.PHP_EOL;
//echo '<span id="flags" style="float:right; margin-top:15px;margin-right:-21px; display:none; visibility:hidden;border:1px solid #aaa;padding:14px 14px 20px 14px;background:#fff;color:#333">'.PHP_EOL;

    for($i=0; $i<count($g5['lang_list']); $i++) {
        if($g5['lang_list'][$i] != $g5['lang'])
        if($g5['lang_name_list_en'][$g5['lang_list'][$i]] == "Korean (South Korea)"){
			$url = urlencode($_SERVER["REQUEST_URI"]);
			$url = str_replace($arr_lang,"lang%3Dkr",$url);

	$lang_url = $_SERVER["REQUEST_URI"];
	$lang_url = explode("%2F",$url);

	if( $lang_url[1] == "en" ){
		$url = "/kr";
	}else if( $lang_url[1] == "jp" ){
		$url = "/kr";
	}else if( $lang_url[1] == "cn" ){
		$url = "/kr";
	}else if( $lang_url[1] == "tw" ){
		$url = "/kr";
	}else if( $lang_url[1] == "ko" ){
		$url = "/kr";
	}else if( $lang_url[1] == "kr" ){
		$url = "/kr";
	}


            echo '<li><a href="#" onclick="javascript:change_lang(\''.$g5['lang_list'][$i].'\', \''.$url.'\');" alt="'._t($g5['lang_name_list'][$g5['lang_list'][$i]]).'">한국어</a></li>';
			//echo '<li><a href="#">한국어</a></li>';
            break;
        }
    }    

    for($i=0; $i<count($g5['lang_list']); $i++) {
        if($g5['lang_list'][$i] != $g5['lang'])
        if($g5['lang_name_list_en'][$g5['lang_list'][$i]] == "English (United States)"){
			$url = urlencode($_SERVER["REQUEST_URI"]);
			$url = str_replace($arr_lang,"lang%3Den",$url);


	$lang_url = $_SERVER["REQUEST_URI"];
	$lang_url = explode("%2F",$url);

	if( $lang_url[1] == "en" ){
		$url = "/en";
	}else if( $lang_url[1] == "jp" ){
		$url = "/en";
	}else if( $lang_url[1] == "cn" ){
		$url = "/en";
	}else if( $lang_url[1] == "tw" ){
		$url = "/en";
	}else if( $lang_url[1] == "ko" ){
		$url = "/en";
	}else if( $lang_url[1] == "kr" ){
		$url = "/en";
	}


            echo '<li><a href="#" onclick="javascript:change_lang(\''.$g5['lang_list'][$i].'\', \''.$url.'\');" alt="'._t($g5['lang_name_list'][$g5['lang_list'][$i]]).'">English</a></li>';
			//echo '<li><a href="#">English</a></li>';
            break;
        }
    }    

    for($i=0; $i<count($g5['lang_list']); $i++) {
        if($g5['lang_list'][$i] != $g5['lang'])
        if($g5['lang_name_list_en'][$g5['lang_list'][$i]] == "Japanese (Japan)"){
			$url = urlencode($_SERVER["REQUEST_URI"]);
			$url = str_replace($arr_lang,"lang%3Djp",$url);
	
	$lang_url = $_SERVER["REQUEST_URI"];
	$lang_url = explode("%2F",$url);

	if( $lang_url[1] == "en" ){
		$url = "/jp";
	}else if( $lang_url[1] == "jp" ){
		$url = "/jp";
	}else if( $lang_url[1] == "cn" ){
		$url = "/jp";
	}else if( $lang_url[1] == "tw" ){
		$url = "/jp";
	}else if( $lang_url[1] == "ko" ){
		$url = "/jp";
	}else if( $lang_url[1] == "kr" ){
		$url = "/jp";
	}


            echo '<li><a href="#" onclick="javascript:change_lang(\''.$g5['lang_list'][$i].'\', \''.$url.'\');" alt="'._t($g5['lang_name_list'][$g5['lang_list'][$i]]).'">日本語</a></li>';
			//echo '<li><a href="#">日本語</a></li>';
            break;
        }
    }    

    for($i=0; $i<count($g5['lang_list']); $i++) {
        if($g5['lang_list'][$i] != $g5['lang'])
        if($g5['lang_name_list_en'][$g5['lang_list'][$i]] == "Chinese (Simplified, China)"){
			$url = urlencode($_SERVER["REQUEST_URI"]);
			$url = str_replace($arr_lang,"lang%3Dcn",$url);


	$lang_url = $_SERVER["REQUEST_URI"];
	$lang_url = explode("%2F",$url);

	if( $lang_url[1] == "en" ){
		$url = "/cn";
	}else if( $lang_url[1] == "jp" ){
		$url = "/cn";
	}else if( $lang_url[1] == "cn" ){
		$url = "/cn";
	}else if( $lang_url[1] == "tw" ){
		$url = "/cn";
	}else if( $lang_url[1] == "ko" ){
		$url = "/cn";
	}else if( $lang_url[1] == "kr" ){
		$url = "/cn";
	}



            echo '<li><a href="#" onclick="javascript:change_lang(\''.$g5['lang_list'][$i].'\', \''.$url.'\');" alt="'._t($g5['lang_name_list'][$g5['lang_list'][$i]]).'">中文(简体)</a></li>';
		    //echo '<li><a href="#">中文(简体)</a></li>';
            break;
        }
    }  

    for($i=0; $i<count($g5['lang_list']); $i++) {
        if($g5['lang_list'][$i] != $g5['lang'])
        if($g5['lang_name_list_en'][$g5['lang_list'][$i]] == "Chinese (Traditional, Taiwan)"){
			$url = urlencode($_SERVER["REQUEST_URI"]);
			$url = str_replace($arr_lang,"lang%3Dtw",$url);



	$lang_url = $_SERVER["REQUEST_URI"];
	$lang_url = explode("%2F",$url);

	if( $lang_url[1] == "en" ){
		$url = "/tw";
	}else if( $lang_url[1] == "jp" ){
		$url = "/tw";
	}else if( $lang_url[1] == "cn" ){
		$url = "/tw";
	}else if( $lang_url[1] == "tw" ){
		$url = "/tw";
	}else if( $lang_url[1] == "ko" ){
		$url = "/tw";
	}else if( $lang_url[1] == "kr" ){
		$url = "/tw";
	}


            echo '<li><a href="#" onclick="javascript:change_lang(\''.$g5['lang_list'][$i].'\', \''.$url.'\');" alt="'._t($g5['lang_name_list'][$g5['lang_list'][$i]]).'">中文(繁體)</a></li>';
		  //echo '<li><a href="#">中文(繁體)</a></li>';
            break;
        }
    }  


//echo '<br/><center style="margin-top:6px">';
//echo '<a href="#" onclick="javascript:toggle();" style="padding:8px 16px;background:#ff00ff;color:#fff">'._t('닫기').'</a>';
//echo '<a href="#" onclick="javascript:toggle();" style="padding:8px 16px;background:#ff00ff;color:#fff">'.'Close'.'</a>';
//echo '</center>';
//echo '</span>'.PHP_EOL;
echo '</form>'.PHP_EOL;
?>
    </ul>
</div>


<?}?>