<?php
define('_INC_', true);

error_reporting(E_ALL);ini_set('display_errors',1);

header("Content-Type: text/html; charset=UTF-8");

include_once('./_common.php');

include_once('./ip2geo_inc.php');
include_once('./weather_inc.php');
?>

<html>
<head>
<link rel="stylesheet" href="./css/weather-icons.min.css">

<style>
.round{behavior: url(http://totalarts.cafe24.com/js/PIE.htc);padding:2px 5px;
	background:#04B4AE;color:#FFF;font-weight:bold;
    border-radius: 5px 5px 5px 5px;
	-webkit-border-radius: 5px 5px 5px 5px;}
.gap{margin-left:10px;}
</style>
</head>

<body>
<!--<img src="<?php echo './flags/'.$ip_arr[3].'.png'?>" style="vertical-align:middle;" />-->

<?php
//ip 및 국가 도시 정보
//echo "My ip : ".$ip_arr[2]."<br>";
//echo "Server ip : ".$_SERVER[SERVER_ADDR]."<br>";
//echo "국가코드 : ".$ip_arr[3]."<br>";
//echo "도시명 : ".$ip_arr[6]."<br>";
?>

<!--<img src="http://openweathermap.org/img/w/<?php echo $cur_icon.'.png'?>" style="vertical-align:middle;" />
<i class="wi <?php echo $owm_icon?>" style="color: #e91e63;font-weight:bold;"></i>-->

<?php
//날씨정보
//echo $cur_weather."<br>";
//echo $cur_temp." ℃ <br>";
//echo $cur_icon."<br>";
//echo $cur_icon_id."<br><br>";
?>

<?php
//영문도시명을 한글명으로...
$ip_arr[6] = strtolower($ip_arr[6]);
if(array_key_exists($ip_arr[6], $city_han)) $ip_arr[6] = $city_han[$ip_arr[6]];

?>

<!------종합------>
<div style="font-size:9pt;">
	<?php echo $ip_arr[6]?>
	<i class="wi <?php echo $owm_icon?>" style="color: #e91e63;font-size:10pt;font-weight:bold;"></i>
	<?php echo $cur_weather_han?>
	<span class="round">
		<?php echo $cur_temp."℃"?>
	</span>
	<span class="gap">
	<?php
	if($cur_temp_min != $cur_temp_max) echo $cur_temp_min." ~ ".$cur_temp_max."℃";	
	?>
	</span>
</div>
</body>
</html>