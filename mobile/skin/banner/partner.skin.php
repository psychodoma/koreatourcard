<?php
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ�

add_stylesheet('<link rel="stylesheet" href="'.G5_THEME_URL.'/skin/banner'.'/style.css">', 2);
?>

<?php
echo '<div class="slider1">';
for ($i=0; $row=sql_fetch_array($result); $i++)
{

    if ($i=0) echo '<aside id="sbn_side" class="scn"><h2>'._t('����/��Ʈ�� ���').'</h2>'.PHP_EOL;
   
    // �׵θ� �ִ���
    $bn_border  = ($row['bn_border']) ? ' class="sbn_border"' : '';

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

        echo '<div class="slide">'.PHP_EOL;

        if ($row['bn_url'][0] == '#')
            $banner .= '<a href="'.$row['bn_url'].'">';

        else if ($row['bn_url'] && $row['bn_url'] != 'http://') {
            $banner .= '<a href="'.G5_URL.'/bannerhit.php?bn_id='.$row['bn_id'].'&amp;url='.urlencode($row[$blinke_URL]).'"'.$bn_new_win.'>';
        }

        echo $banner.'<img src="'.$bimg_URL.'" alt="'.$row['bn_alt'].'" width="'.$size[0].'" height="'.$size[1].'"'.$bn_border.'>';

        if($banner)
            echo '</a>'.PHP_EOL;

        echo '</div>'.PHP_EOL;
    }
	
}
echo '</div>'.PHP_EOL;
?>
