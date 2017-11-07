<?php
if (!defined('_INC_')) exit; // 개별 페이지 접근 불가

//날씨 키값얻기: http://api.openweathermap.org/ 에 가입
$appid = "2565250a408229281000b28987f28e85";//날씨API id

$nation = $ip_arr[3];
$city = $ip_arr[6];
$city = str_replace(" ","",trim($city));//도시명에 공백이 있으면 오류발생

$w_url = "http://api.openweathermap.org/data/2.5/weather?q=".$city.",".$nation."&appid=".$appid;

if(is_callable('curl_init')){
   function getInfo($w_url) 
   {
       $ch = curl_init();
       curl_setopt($ch, CURLOPT_URL, $w_url);
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
       curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
       curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
       $buffer = curl_exec($ch);
       curl_close($ch);
       return $buffer;
   }
   $json = getInfo($w_url);
   $w_result = json_decode($json);
}
else{
$json = file_get_contents($w_url);
$w_result = json_decode($json,true);
}

//json파일을 이용한 상태한글표시
$w_condition_json = file_get_contents("./icons.json");
$w_condition = json_decode($w_condition_json,true);


$cur_weather = strtolower($w_result->weather[0]->main);//오늘 날씨 소문자로...

$cur_temp_min = sprintf("%2.1f",$w_result->main->temp_min - 273.15);//오늘 최저 온도
$cur_temp_max = sprintf("%2.1f",$w_result->main->temp_max - 273.15);//오늘 최고 온도
$cur_temp = sprintf("%2.1f",$w_result->main->temp - 273.15);//오늘 현재온도

$cur_icon = $w_result->weather[0]->icon;//날씨아이콘이름
$cur_icon_id = $w_result->weather[0]->id;//날씨아이콘 id(숫자)

$cur_weather_han = $w_condition[$cur_icon_id]['han'];//날씨상태 한글

//시간대별로 아이콘폰트를 다르게 설정
$ymd = date("Y-m-d");
$cur_time = time();
$date1 = strtotime($ymd." 09:00:00");
$date2 = strtotime($ymd." 16:00:00");
$date3 = strtotime($ymd." 18:00:00");
$date5 = strtotime($ymd." 23:59:59");
$date6 = strtotime($ymd." 00:01:01");
$date7 = strtotime($ymd." 06:00:00");

if($cur_time > $date1 && $cur_time < $date2) $owm_icon = "wi-owm-day-".$cur_icon_id; //낮
elseif($cur_time > $date3 && $cur_time < $date5) $owm_icon = "wi-owm-night-".$cur_icon_id; //밤
elseif($cur_time > $date6 && $cur_time < $date7) $owm_icon = "wi-owm-night-".$cur_icon_id; //밤
else $owm_icon = "wi-owm-".$cur_icon_id; //아침과 해거름

?>