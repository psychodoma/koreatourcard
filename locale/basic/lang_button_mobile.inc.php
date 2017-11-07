<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>
<link rel="stylesheet" href="<?php echo G5_URL?>/css/lang_button.css">

<?
$url = urlencode($_SERVER["REQUEST_URI"]);
$arr_lang = array("lang%3Dko","lang%3Dkr", "lang%3Den", "lang%3Djp", "lang%3Dcn","lang%3Dtw");
?>


<?php
    
    for($i=0; $i<count($g5['lang_list']); $i++) {

        if($g5['lang_name_list_en'][$g5['lang_list'][$i]] == "Korean (South Korea)"){

			$url = urlencode($_SERVER["REQUEST_URI"]);
			$url = str_replace($arr_lang,"lang%3Dkr",$url);

	$lang_url = urlencode($_SERVER["REQUEST_URI"]);
	$lang_url = explode("%2F",$lang_url);

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



            echo '<option value="'.$g5['lang_list'][$i].','.$url.'"';
            if( $_SESSION['lang'] == "ko_KR" || $_SESSION['lang'] == "" ){
                echo "selected";
            }
            echo ' >한국어</option>';
            break;
        }
    }    

    for($i=0; $i<count($g5['lang_list']); $i++) {

        if($g5['lang_name_list_en'][$g5['lang_list'][$i]] == "English (United States)"){

			$url = urlencode($_SERVER["REQUEST_URI"]);
			$url = str_replace($arr_lang,"lang%3Den",$url);

	$lang_url = urlencode($_SERVER["REQUEST_URI"]);
	$lang_url = explode("%2F",$lang_url);

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


            echo '<option value="'.$g5['lang_list'][$i].','.$url.'"';
            if( $_SESSION['lang'] == "en_US" ){
                echo "selected";
            }
            echo ' >English</option>';	
            break;
        }
    }    

    for($i=0; $i<count($g5['lang_list']); $i++) {

        if($g5['lang_name_list_en'][$g5['lang_list'][$i]] == "Japanese (Japan)"){

			$url = urlencode($_SERVER["REQUEST_URI"]);
			$url = str_replace($arr_lang,"lang%3Djp",$url);

	$lang_url = urlencode($_SERVER["REQUEST_URI"]);
	$lang_url = explode("%2F",$lang_url);

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


            echo '<option value="'.$g5['lang_list'][$i].','.$url.'"';
            if( $_SESSION['lang'] == "ja_JP" ){
                echo "selected";
            }
            echo ' >日本語</option>';
            break;
        }
    }    

    for($i=0; $i<count($g5['lang_list']); $i++) {

        if($g5['lang_name_list_en'][$g5['lang_list'][$i]] == "Chinese (Simplified, China)"){

			$url = urlencode($_SERVER["REQUEST_URI"]);
			$url = str_replace($arr_lang,"lang%3Dcn",$url);

	$lang_url = urlencode($_SERVER["REQUEST_URI"]);
	$lang_url = explode("%2F",$lang_url);

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

            echo '<option value="'.$g5['lang_list'][$i].','.$url.'"';
            if( $_SESSION['lang'] == "zh_CN" ){
                echo "selected";
            }
            echo ' >中文(简体)</option>';		    
            break;
        }
    }  

    for($i=0; $i<count($g5['lang_list']); $i++) {

        if($g5['lang_name_list_en'][$g5['lang_list'][$i]] == "Chinese (Traditional, Taiwan)"){

			$url = urlencode($_SERVER["REQUEST_URI"]);
			$url = str_replace($arr_lang,"lang%3Dtw",$url);

	$lang_url = urlencode($_SERVER["REQUEST_URI"]);
	$lang_url = explode("%2F",$lang_url);

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

            echo '<option value="'.$g5['lang_list'][$i].','.$url.'" ';
            if( $_SESSION['lang'] == "zh_TW" ){
                echo "selected";
            }
            echo ' >中文(繁體)</option>';		  
            break;
        }
    }  


?>




<script>
$(function(){
    $('#change').change(function(){
        $vals = $( "#change option:selected" ).val().split(',');
        change_lang($vals[0],$vals[1]);
    })
})

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