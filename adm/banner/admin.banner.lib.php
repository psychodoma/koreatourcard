<?
function get_select_bannerPosition($id, $val1="비교값1", $val2="비교값2"){
	 global $g5;

    $sql = " select * from g5_shop_banner_config ";
    $result = sql_query($sql);
    
	$str .= '<select name="'.$id.'"  id="'.$id.'">';
    for ($i=0; $row=sql_fetch_array($result); $i++)
    {
        $str .= '<option value="'.$row['bn_code'].'"';
        if ($val1 == $row['bn_code'] || $val2 == $row['bn_code']) $str .= ' selected';
        $str .= '>'.$row['bn_position']. '</option>';
    }
	$str .= '</select>';
    return $str;
}

function get_banner_category($sca="all"){
	 global $g5;

    $sql = " select * from g5_shop_banner_config order by bn_area desc, bn_sort asc";
    $result = sql_query($sql);
	$str .= '<a href="./bannerlist.php" class="all">All</a>';

    for ($i=0; $row=sql_fetch_array($result); $i++)
    {
      $str .= '<a href="./bannerlist.php?&amp;sca='.$row['bn_code'].'"';
	  if($row['bn_area'] == '공통'){ $str .= ' class = "public ';}
	  else if($row['bn_area'] == '메인'){ $str .= ' class = "main ';}
	  if($sca == $row['bn_code']) $str .= 'selected';
	  $str .= '">';
	  $str .= $row['bn_position'];
	  $str .= '</a>';
    }
    return $str;
}
?>

