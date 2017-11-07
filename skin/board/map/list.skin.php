<?
include_once('map_query.php');
include_once('../lib/thumbnail.lib.php');
//include_once('./juso.php');
?>
<? for ($i=0; $i < count($option); $i++) { ?>
    <div class='info_option' val='<?=$option[$i]?>'></div>
<? } ?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="<?echo G5_TMPL_URL;?>/js/map.js"></script>
<script src="<?echo G5_TMPL_URL;?>/js/printThis.js"></script>


<style>
	#effect {
		position: relative;
		border:2px solid #666;
		border-radius:5px;
	}
	#effect h3 {
		margin: 0;
		text-align: center;
	}



	.gm-style{}
	.gm-style div div div div{
		
	}
	.gm-style .gm-style-iw{
		overflow: inherit !important;
		text-align: center;
	}
	.gm-style .gm-style-iw div{
		overflow: inherit !important;
	}
	.gm-style .gm-style-iw div div #content img{margin-bottom:5px;}

	.gm-style .gm-style-iw div div a div{
		margin-bottom:8px;
		border-radius:3px;
		border:1px solid #484848 !important;
		display: inline-block;
		float: none !important;
	}
	.gm-style .gm-style-iw div div a div:hover{
		background-color:#415d72;
		color:#fff;
	}


	.firstHeading{
		font-family: Nanum Barun Gothic, sans-serif;
		margin-bottom:15px;
	}

	.mapViewBtn{
		float:right;
		width:150px;
		height:30px; 
		line-height:30px; 
		border:1px solid #333; 
		text-align:center;
		margin-bottom:5px;
	}



</style>


<?$cnt=0; while($newimg = sql_fetch_array($store_newimg_row)) { ?>
  <div class='newimg' valName='<?=$newimg['name']?>' valNewimg='<?=$newimg['newimg']?>'></div>
<? } ?>


<div class='lang' valLang='<?=$_SESSION['lang']?>'></div>
<div class='url' valUrl='<?=$url?>'></div>

<div class="sub2_store_searchTab">
    <ul class="store_searchTab div1">
        <li><a class="tab_link <?if($info == 'search') echo "active";?>" href="./board.php?bo_table=<?=$bo_table?>&info=search&me_code=<?=$me_code?>&num=<?=$num?><?=lang_url_a($_SESSION['lang'])?>"><?=_t('판매점 찾기')?></a></li>
        <li><a class="tab_link <?if($info == 'local') echo "active";?>" href="./board.php?bo_table=<?=$bo_table?>&info=local&me_code=<?=$me_code?>&num=<?=$num?><?=lang_url_a($_SESSION['lang'])?>"><?=_t('지역별 찾기')?></a></li>
    </ul>

    <?if($info == 'search') include_once('../skin/board/map/map_tap1.php');?>
    <?if($info == 'local') include_once('../skin/board/map/map_tap2.php');?>

</div>




<?
$map_lang = explode("_", $_SESSION['lang']);
?>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCIX9g1T3yPSC5_ewJO25c7mCiRs0clTU8&language=<?=$map_lang[0]?>&region=<?=$map_lang[1]?>"></script>

