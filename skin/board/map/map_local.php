<?
include_once('../skin/board/map/map_query.php');
//include_once('./juso.php');
?>
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="../skin/board/map/map.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="../skin/board/map/map.js"></script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDeGSv9G_NwSkiiG7C314_JALnZ-uaDuQQ&callback=initMap">
    </script>   
  </head>  
  <body>


<div class='lang' valLang='<?=$lang?>'></div>
<div class='url' valUrl='<?=$url?>' ></div>

<div id="tabs">
  <ul>
    <li id='tab-1'><a href="#tabs-1">판매점 찾기</a></li>
    <li id='tab-2' class="ui-tabs-tab ui-corner-top ui-state-default ui-tab ui-tabs-active ui-state-active"><a href="#tabs-2">지역별 찾기</a></li>
    <A href="javascript:window.print()">프린트하기</A>
</ul>



<div id="tabs-2">
  <? include_once('../skin/board/map/map_tap2.php') ?>
  <div id="map"></div>
  <br><br><br><br>
  <? include('../skin/board/map/map_list.php') ?>
</div>


</div>    
  </body>
</html>