<?php
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ�

add_stylesheet('<link rel="stylesheet" href="'.G5_THEME_URL.'/skin/banner'.'/style.css">', 2);
?>


<style>
	.scn h2 {position:absolute;font-size:0;line-height:0;overflow:hidden}
</style>

<?php
for ($i=0; $row=sql_fetch_array($result); $i++)
{

    if ($i==0) echo '<aside id="sbn_side" class="scn"><h2>'._t('���� ����').'</h2><ul>'.PHP_EOL;
    //print_r2($row);
    // �׵θ� �ִ���
    $bn_border  = ($row['bn_border']) ? ' class="sbn_border"' : '';;
    // ��â ��������
    $bn_new_win = ($row['bn_new_win']) ? ' target="_blank"' : '';

    $bimg_lang= G5_DATA_PATH.'/banner/'.bannerLang($lang).$row['bn_id'];
	$bimg = G5_DATA_PATH.'/banner/'.$row['bn_id'];

	//echo G5_DATA_PATH.'/banner/'.bannerLang($lang).$row['bn_id'];

	if(file_exists($bimg_lang)){
		$bimg_URL = G5_DATA_URL.'/banner/'.bannerLang($lang).$row['bn_id'];
	}else{
		$bimg_URL = G5_DATA_URL.'/banner/'.$row['bn_id'];
	}

	$blinke_URL = 'bn_url'.bannerURL($lang);

    if (file_exists($bimg))
    {
        $banner = '';
        $size = getimagesize($bimg);

		if(!$row[$blinke_URL]){
			$blinke_URL = 'bn_url';
			//echo $blinke_URL;
		};

        echo '<li>'.PHP_EOL;
        if ($row['bn_url'][0] == '#')
            $banner .= '<a href="'.$row['bn_url'].'" class="fbnbanner">';
        else if ($row['bn_url'] && $row['bn_url'] != 'http://') {
            $banner .= '<a href="'.G5_URL.'/bannerhit.php?bn_id='.$row['bn_id'].'&amp;url='.urlencode($row[$blinke_URL]).'"'.$bn_new_win.' class="fbnbanner">';
        }
        echo $banner.'<img src="'.$bimg_URL.'" width="100%" '.$bn_border.'>';
        if($banner)
            echo '</a>'.PHP_EOL;
        echo '</li>'.PHP_EOL;
    }
}
if ($i>0) echo '</ul></aside>'.PHP_EOL;
?>