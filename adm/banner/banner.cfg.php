<?
function banner_area($code){
	switch ($code){
		case "mm1" :
			return"쇼핑분류배너";
			break;
		case "mp2" :
			return"메인판매점 1";
			break;
		case "mp3" :
			return"메인판매점 2";
			break;
		case "mp4" :
			return"메인판매점 3";
			break;
		case "mc5" :
			return"메인행사축제 1";
			break;
		case "mc6" :
			return"메인행사축제 2";
			break;
		case "mt7" :
			return"제휴/협력업체";
			break;
		case "ma8" :
			return"메인띠배너";
			break;
		default :
			return"메인배너";
	}
}
?>