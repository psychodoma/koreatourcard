<?php
if (!defined('_INC_')) exit; // 개별 페이지 접근 불가

//ip2geo 키값얻기: http://www.ipinfodb.com/register.php 에 가입
$ip_key = "46808de0d69bca59de27846ab331b5e8175f9a03d99816185639869257239dca";//ip2geo 키값

$ip= $_SERVER[REMOTE_ADDR];//방문자 ip

function get_ip2geo($ip){
		
	global $ip_key;
	$url = "http://api.ipinfodb.com/v3/ip-city/?ip=".$ip."&key=".$ip_key;
	
	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$buffer = curl_exec($ch);

	curl_close($ch);

	return $buffer;
}

$result = get_ip2geo($ip);//함수에서 처리한 $buffer값
//echo $result."<br><br>";

$ip_arr = explode(";",$result);

//도시별 영문 to 한글
$city_han = array("seoul"=>"서울","daegu"=>"대구","busan"=>"부산","kwangju"=>"광주",
				  "incheon"=>"인천","daejeon"=>"대전","jeju"=>"제주","suwon"=>"수원",
				  "anyang"=>"안양","seongnam"=>"성남","osan"=>"오산","wonju"=>"원주",
				  "chorwon"=>"철원","yongwol"=>"영월","yangyang"=>"양양","sokcho"=>"속초",
				  "kunsan"=>"군산","keumsan"=>"금산","jeonju"=>"전주","iksan"=>"익산",
				  "mokpo"=>"목포","yangsan"=>"양산","chungju"=>"충주","cheongju"=>"청주",
				  "ulsan"=>"울산","kwangmyong"=>"광명","hwaseong"=>"화성","haenam"=>"해남",
				  "Gwangju"=>"광주","Taegu"=>"대구","naju"=>"나주","wando"=>"완도",
				  "muan"=>"무안","gimcheon"=>"김천","ulleungdo"=>"울릉도","andong"=>"안동",
				  "pohang"=>"포항","uiseong"=>"의성","miryang"=>"밀양","masan"=>"마산",
				  "changwon"=>"창원","tongyoung"=>"통영","tongyeong"=>"통영","seogwipo"=>"서귀포",
				  "seogipo"=>"서귀포","gwangju"=>"광주","ansan"=>"안산","kuri"=>"구리");

//도시명 영문이 다른 경우(영문이 틀리면 날씨정보를 얻을 수 없는 경우를 위한...)
//포함시 반드시 Openweathermap.com에서 테스트후 넣어야 됨. K->G 안되는 경우 많음.
//전라도광주는 Kwangju, 경기도광주는 Gwangju
$city_match = array("Taegu"=>"daegu","Tongyeong"=>"tongyoung","Seogwipo"=>"sogwipo");

if(array_key_exists($ip_arr[6], $city_match)) $ip_arr[6] = ucfirst($city_match[$ip_arr[6]]);
?>