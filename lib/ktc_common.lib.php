<?




function get_paging_ktc($write_pages, $cur_page, $total_page, $url, $add="") // 페이지네이션 다른 스타일 2017-05-12
{
    if($total_page > 1){
        //$url = preg_replace('#&amp;page=[0-9]*(&amp;page=)$#', '$1', $url);
        $url = preg_replace('#&amp;page=[0-9]*#', '', $url) . '&amp;page=';
        $str = '';
        if ($cur_page > 1) {  //맨처음
            //$str .= '<li><a href="'.$url.'1'.$add.'"><span class="prev">'._t('<<').'</span></a></li>'.PHP_EOL;
        }

        $start_page = ( ( (int)( ($cur_page - 1 ) / $write_pages ) ) * $write_pages ) + 1;
        $end_page = $start_page + $write_pages - 1;

        if ($end_page >= $total_page) $end_page = $total_page;

        if ($start_page > 1) {
            $str .= '<li><a href="'.$url.($start_page-1).$add.'" class=""><span class="prev">'._t('< ').'</span></a></li>'.PHP_EOL;
        }else{
            $str .= '<li><a href="'.$url.'1'.$add.'"><span class="prev">'._t('<').'</span></a></li>'.PHP_EOL;
        }
        //$str .= '<li><a href="'.$url.($start_page-1).$add.'" class=""><span class="prev">'._t('< ').'</span></a></li>'.PHP_EOL;


        if ($total_page >= 1) {
            for ($k=$start_page;$k<=$end_page;$k++) {
                if ($cur_page != $k)
                    $str .= '<li><a href="'.$url.$k.$add.'" class="">'.$k.'</a></li>'.PHP_EOL;
                else
                    $str .= '<li><a href="'.$url.$k.$add.'" class=""><span class="over">'.$k.'</span></a></li>'.PHP_EOL;
                    //$str .= '<span class="sound_only">'._t('열린').'</span><strong class="pg_current">'.$k.'</strong><span class="sound_only">'._t('페이지').'</span>'.PHP_EOL;
            }
        }

        //if ($total_page > $end_page) $str .= '<a href="'.$url.($end_page+1).$add.'" class="pg_page pg_next">'._t('다음').'</a>'.PHP_EOL;
        if ($total_page > $end_page) {
            $str .= '<li><a href="'.$url.($end_page+1).$add.'" class=""><span class="next">'._t('> ').'</span></a></li>'.PHP_EOL;
        }else{
            $str .= '<li><a href="'.$url.$total_page.$add.'" class=""><span class="next">'._t('>').'</span></a></li>'.PHP_EOL; 
        }


        if ($cur_page < $total_page) { //맨끝
            //$str .= '<a href="'.$url.$total_page.$add.'" class="pg_page pg_end">'._t('맨끝').'</a>'.PHP_EOL;  
        }

        if ($str)
            return "<div class=\"pageNum\"><ul>{$str}</ul></div>";
        else
            return "";
    }
}


function get_paging_ktc1($write_pages, $cur_page, $total_page, $url, $add="") // 페이지네이션 다른 스타일 2017-05-12
{
    if($total_page > 1){
        //$url = preg_replace('#&amp;page=[0-9]*(&amp;page=)$#', '$1', $url);
        $url = preg_replace('#&amp;card_page=[0-9]*#', '', $url) . '&amp;card_page=';
        $str = '';
        if ($cur_page > 1) {  //맨처음
            //$str .= '<li><a href="'.$url.'1'.$add.'"><span class="prev">'._t('<<').'</span></a></li>'.PHP_EOL;
        }

        $start_page = ( ( (int)( ($cur_page - 1 ) / $write_pages ) ) * $write_pages ) + 1;
        $end_page = $start_page + $write_pages - 1;

        if ($end_page >= $total_page) $end_page = $total_page;

        if ($start_page > 1) {
            $str .= '<li><a href="'.$url.($start_page-1).$add.'" class=""><span class="prev">'._t('< ').'</span></a></li>'.PHP_EOL;
        }else{
            $str .= '<li><a href="'.$url.'1'.$add.'"><span class="prev">'._t('<').'</span></a></li>'.PHP_EOL;
        }
        //$str .= '<li><a href="'.$url.($start_page-1).$add.'" class=""><span class="prev">'._t('< ').'</span></a></li>'.PHP_EOL;


        if ($total_page >= 1) {
            for ($k=$start_page;$k<=$end_page;$k++) {
                if ($cur_page != $k)
                    $str .= '<li><a href="'.$url.$k.$add.'" class="">'.$k.'</a></li>'.PHP_EOL;
                else
                    $str .= '<li><a href="'.$url.$k.$add.'" class=""><span class="over">'.$k.'</span></a></li>'.PHP_EOL;
                    //$str .= '<span class="sound_only">'._t('열린').'</span><strong class="pg_current">'.$k.'</strong><span class="sound_only">'._t('페이지').'</span>'.PHP_EOL;
            }
        }

        //if ($total_page > $end_page) $str .= '<a href="'.$url.($end_page+1).$add.'" class="pg_page pg_next">'._t('다음').'</a>'.PHP_EOL;
        if ($total_page > $end_page) {
            $str .= '<li><a href="'.$url.($end_page+1).$add.'" class=""><span class="next">'._t('> ').'</span></a></li>'.PHP_EOL;
        }else{
            $str .= '<li><a href="'.$url.$total_page.$add.'" class=""><span class="next">'._t('>').'</span></a></li>'.PHP_EOL; 
        }


        if ($cur_page < $total_page) { //맨끝
            //$str .= '<a href="'.$url.$total_page.$add.'" class="pg_page pg_end">'._t('맨끝').'</a>'.PHP_EOL;  
        }

        if ($str)
            return "<div class=\"pageNum\"><ul>{$str}</ul></div>";
        else
            return "";
    }
}




function hosun($idx,$lang){
    if($idx <= 9){
        if($lang == "_en_US"){
            return "Line".$idx;
        }else if($lang == "_ja_JP"){
            return $idx."号線";
        }else if($lang == "_zh_CN"){
            return $idx."号线";
        }else if($lang == "_zh_TW"){
            return $idx."號線";
        }else{
            return $idx."호선";
        }
    }else if($idx == 10){
        if($lang == "_en_US"){
            return "Incheon Line 1";
        }else if($lang == "_ja_JP"){
            return "仁川1号線";
        }else if($lang == "_zh_CN"){
            return "仁川1号线";
        }else if($lang == "_zh_TW"){
            return "仁川1號線";
        }else{
            return "인천1호선";
        }
    }else if($idx == 11){
        if($lang == "_en_US"){
            return "Incheon Line 2";
        }else if($lang == "_ja_JP"){
            return "仁川2号線";
        }else if($lang == "_zh_CN"){
            return "仁川2号线";
        }else if($lang == "_zh_TW"){
            return "仁川2號線";
        }else{
            return "인천2호선";
        }
    }else if($idx == 12){
        if($lang == "_en_US"){
            return "Bundang Line";
        }else if($lang == "_ja_JP"){
            return "盆唐線";
        }else if($lang == "_zh_CN"){
            return "盆唐线";
        }else if($lang == "_zh_TW"){
            return "盆唐線";
        }else{
            return "분당선";
        }
    }else if($idx == 13){
        if($lang == "_en_US"){
            return "Shinbundang Line";
        }else if($lang == "_ja_JP"){
            return "新盆唐線";
        }else if($lang == "_zh_CN"){
            return "新盆唐线";
        }else if($lang == "_zh_TW"){
            return "新盆唐線";
        }else{
            return "신분당선";
        }
    }else if($idx == 14){
        if($lang == "_en_US"){
            return "Gyeongui-Jungang Line";
        }else if($lang == "_ja_JP"){
            return "京義・中央線";
        }else if($lang == "_zh_CN"){
            return "京义中央线";
        }else if($lang == "_zh_TW"){
            return "京義中央線";
        }else{
            return "경의중앙선";
        }
    }else if($idx == 15){
        if($lang == "_en_US"){
            return "Gyeongchun Line";
        }else if($lang == "_ja_JP"){
            return "京春線";
        }else if($lang == "_zh_CN"){
            return "京春线";
        }else if($lang == "_zh_TW"){
            return "京春線";
        }else{
            return "경춘선";
        }
    }else if($idx == 16){
        if($lang == "_en_US"){
            return "Airport Railroad";
        }else if($lang == "_ja_JP"){
            return "空港鉄道";
        }else if($lang == "_zh_CN"){
            return "地铁机场专线";
        }else if($lang == "_zh_TW"){
            return "機場鐵路";
        }else{
            return "공항철도";
        }
    }else if($idx == 17){
        if($lang == "_en_US"){
            return "Magnetic Levitation";
        }else if($lang == "_ja_JP"){
            return "磁気浮上";
        }else if($lang == "_zh_CN"){
            return "磁悬浮列车";
        }else if($lang == "_zh_TW"){
            return "磁懸浮列車";
        }else{
            return "자기부상";
        }
    }else if($idx == 18){
        if($lang == "_en_US"){
            return "Uijeongbu";
        }else if($lang == "_ja_JP"){
            return "礒政府";
        }else if($lang == "_zh_CN"){
            return "议政府线";
        }else if($lang == "_zh_TW"){
            return "議政府線";
        }else{
            return "의정부";
        }
    }else if($idx == 19){
        if($lang == "_en_US"){
            return "Everline";
        }else if($lang == "_ja_JP"){
            return "エバーライン";
        }else if($lang == "_zh_CN"){
            return "爱宝专线";
        }else if($lang == "_zh_TW"){
            return "愛寶專線";
        }else{
            return "에버라인";
        }
    }else if($idx == 20){
        if($lang == "_en_US"){
            return "Sooin";
        }else if($lang == "_ja_JP"){
            return "水仁";
        }else if($lang == "_zh_CN"){
            return "水仁线";
        }else if($lang == "_zh_TW"){
            return "水仁線";
        }else{
            return "수인";
        }
    }else if($idx == 21){
        if($lang == "_en_US"){
            return "Gyeonggang Line";
        }else if($lang == "_ja_JP"){
            return "京江線";
        }else if($lang == "_zh_CN"){
            return "京江线";
        }else if($lang == "_zh_TW"){
            return "京江線";
        }else{
            return "경강선";
        }
    }else if($idx == 22){
        if($lang == "_en_US"){
            return "UI Line";
        }else if($lang == "_ja_JP"){
            return "牛耳新設";
        }else if($lang == "_zh_CN"){
            return "牛耳新设线";
        }else if($lang == "_zh_TW"){
            return "牛耳新設線";
        }else{
            return "우이신설";
        }
    }else if($idx == 23){
        if($lang == "_en_US"){
            return "Daegu Line 1";
        }else if($lang == "_ja_JP"){
            return "大邱1号線";
        }else if($lang == "_zh_CN"){
            return "大邱1号线";
        }else if($lang == "_zh_TW"){
            return "大邱1號線";
        }else{
            return "대구1호선";
        }
    }else if($idx == 24){
        if($lang == "_en_US"){
            return "Daegu Line 2";
        }else if($lang == "_ja_JP"){
            return "大邱2号線";
        }else if($lang == "_zh_CN"){
            return "大邱2号线";
        }else if($lang == "_zh_TW"){
            return "大邱2號線";
        }else{
            return "대구2호선";
        }
    }else if($idx == 25){
        if($lang == "_en_US"){
            return "Daegu Line 3";
        }else if($lang == "_ja_JP"){
            return "大邱3号線";
        }else if($lang == "_zh_CN"){
            return "大邱3号线";
        }else if($lang == "_zh_TW"){
            return "大邱3號線";
        }else{
            return "대구3호선";
        }
    }else if($idx == 26){
        if($lang == "_en_US"){
            return "Daejeon Line 1";
        }else if($lang == "_ja_JP"){
            return "大田1号線";
        }else if($lang == "_zh_CN"){
            return "大田1号线";
        }else if($lang == "_zh_TW"){
            return "大田1號線";
        }else{
            return "대전1호선";
        }
    }else if($idx == 27){
        if($lang == "_en_US"){
            return "Gwangju Line 1";
        }else if($lang == "_ja_JP"){
            return "光州1号線";
        }else if($lang == "_zh_CN"){
            return "光州1号线";
        }else if($lang == "_zh_TW"){
            return "光州1號線";
        }else{
            return "광주1호선";
        }
    }else if($idx == 28){
        if($lang == "_en_US"){
            return "Busan Line 1";
        }else if($lang == "_ja_JP"){
            return "釜山1号線";
        }else if($lang == "_zh_CN"){
            return "釜山1号线";
        }else if($lang == "_zh_TW"){
            return "釜山1號線";
        }else{
            return "부산1호선";
        }
    }else if($idx == 29){
        if($lang == "_en_US"){
            return "Busan Line 2";
        }else if($lang == "_ja_JP"){
            return "釜山2号線";
        }else if($lang == "_zh_CN"){
            return "釜山2号线";
        }else if($lang == "_zh_TW"){
            return "釜山2號線";
        }else{
            return "부산2호선";
        }
    }else if($idx == 30){
        if($lang == "_en_US"){
            return "Busan Line 3";
        }else if($lang == "_ja_JP"){
            return "釜山3号線";
        }else if($lang == "_zh_CN"){
            return "釜山3号线";
        }else if($lang == "_zh_TW"){
            return "釜山3號線";
        }else{
            return "부산3호선";
        }
    }else if($idx == 31){
        if($lang == "_en_US"){
            return "Busan Line 4";
        }else if($lang == "_ja_JP"){
            return "釜山4号線";
        }else if($lang == "_zh_CN"){
            return "釜山4号线";
        }else if($lang == "_zh_TW"){
            return "釜山4號線";
        }else{
            return "부산4호선";
        }
    }else if($idx == 32){
        if($lang == "_en_US"){
            return "Donghae Line";
        }else if($lang == "_ja_JP"){
            return "東海線";
        }else if($lang == "_zh_CN"){
            return "东海线";
        }else if($lang == "_zh_TW"){
            return "東海線";
        }else{
            return "동해선";
        }
    }else if($idx == 33){
        if($lang == "_en_US"){
            return "Busan – Gimhae Line Rail Transit";
        }else if($lang == "_ja_JP"){
            return "釜山-金海軽電鉄";
        }else if($lang == "_zh_CN"){
            return "山-金海轻电铁";
        }else if($lang == "_zh_TW"){
            return "釜山-金海輕電鐵";
        }else{
            return "부산-김해경전철";
        }
    }





}


function get_address_lang($result,$lang){
    if($lang == "ko_KR"){
        echo $result['wr_6'];
    }else if($lang == "en_US"){
        echo $result['wr_7'];
    }else if($lang == "ja_JP"){
        echo $result['wr_8'];
    }else if($lang == "zh_CN"){
        echo $result['wr_9'];
    }else if($lang == "zh_TW"){
        echo $result['wr_10'];
    }

}

function get_course($id){
    $course_sql = "select * from g5_write_course where wr_course is NULL or wr_course = ".$id;
    $course_sql_cnt = "select count(*) cnt from g5_write_course where wr_course is NULL";
    $course_reulst = sql_query($course_sql);
    $course_reulst_cnt = sql_fetch($course_sql_cnt);
    echo "<select class='course' style='float:left;'>";
    echo "<option value=''>선택하세요</option>";
    
    while($row = sql_fetch_array($course_reulst)){
        $id = $row['wr_id'];
        $subject = $row['wr_subject'];
        echo "<option class=".$id." value=".$id.">".$subject."</option>";
    }
    echo "</select>";
}

function set_select_ktc($obj,$table,$name){   //1.쿼리값  2.테이블이름   3.select name의 이름 
    echo "<select name='".$name."' class='select_ktc' style='float:left;'>";
    echo "<option value=''>선택하세요</option>"; 
    while($row = sql_fetch_array($obj)){
        if($table == "allshop"){
            $id = $row['id'];
            $subject = $row['type_ko_KR'];
        }else if( $table == "cardbenefit" ){
            $id = $row['d_id'];
            $subject = $row['d_detail'];       
        }else if( $table == "g5_benefit_group" ){
            
            $id = $row['g_id'];
            $subject = $row['g_name'];       
        }else{
            $id = $row['wr_id'];
            $subject = $row['wr_subject'];       
        }
        echo "<option class=".$id." value=".$id.">".$subject."</option>";
    }
    echo "</select>";
}


function get_select_ktc($obj,$table,$name,$select){   //1.쿼리값  2.테이블이름   3.select name의 이름   4.선택된 값
    echo "<select name='".$name."' class='select_ktc' style='float:left;'>";
    echo "<option value=''>선택하세요</option>"; 

    while($row = sql_fetch_array($obj)){
        if($table == "allshop"){
            $id = $row['id'];
            $subject = $row['type_ko_KR'];
        }else if( $table == "g5_benefit_group" ){
            $id = $row['g_id'];
            $subject = $row['g_name'];       
        }else if( $table == "cardbenefit" ){
            $id = $row['d_id'];
            $subject = $row['d_detail'];       
        }else{
            $id = $row['wr_id'];
            $subject = $row['wr_subject'];       
        }

        if($select == $id){
            echo "<option class=".$id." value=".$id." selected >".$subject."</option>";
        }else{
            echo "<option class=".$id." value=".$id.">".$subject."</option>";
        }
    }
    echo "</select>";
}

function set_radio_ktc($obj,$table,$name){
    echo $obj;
}

function get_en_ktc($month){
    $month = explode('0',$month);
    $moarray = array("","Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
    return $moarray[$month[1]];
}




function Ncurrency() {
 
	# 데이터 호출
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'http://info.finance.naver.com/marketindex/exchangeList.nhn');
	curl_setopt($ch, CURLOPT_POST, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($ch);
	curl_close($ch);
	$res = iconv('euc-kr', 'UTF-8', $response); if(!$response) return 'false';
 
	# 파싱
	preg_match("/<tbody.*?>.*?<\/[\s]*tbody>/s", $res, $tbody); if(!is_array($tbody)) return 'false';
	preg_match_all('`<tr.*?>(.*?)<\/[\s]*tr>`s', $tbody[0], $tr); if(!is_array($tr)) return 'false';
 
	$Data = array();
	foreach($tr[0] as $k=>$v) {
 
		unset($td, $akey);
		preg_match_all('`<td.*?>(.*?)<\/td>`s', $v, $td);
		$td = $td[0];
		$akey = preg_replace('/([\xEA-\xED][\x80-\xBF]{2})+/', '', strip_tags($td[0]));
		$akey = trim(str_replace('JPY (100)', 'JPY', $akey));
		$akey = trim(str_replace(' 100', '', $akey)); if(!$akey) return 'false';
		$Data[$akey]['통화명'] = trim(strip_tags($td[0]));
		$Data[$akey]["매매기준율"] = str_replace(',', '', trim(strip_tags($td[1])));
		$Data[$akey]["현찰살때"] = str_replace(',', '', trim(strip_tags($td[2])));
		$Data[$akey]["현찰팔때"] = str_replace(',', '', trim(strip_tags($td[3])));
		$Data[$akey]["송금보낼때"] = str_replace(',', '', trim(strip_tags($td[4])));
		$Data[$akey]["송금받을때"] = str_replace(',', '', trim(strip_tags($td[5])));
		$Data[$akey]["환가료율"] = str_replace(',', '', trim(strip_tags($td[6])));
		$Data[$akey]["미화환산율"] = str_replace(',', '', trim(strip_tags($td[7])));
	}
 
	return $Data;
}



function get_sky_img($num){
	if($num == 1){
		echo "<img src='/img/weather/weather_1.png' >";
	}else if($num == 2){
		echo "<img src='/img/weather/weather_2.png' >";
	}else if($num == 3){
		echo "<img src='/img/weather/weather_3.png' >";
	}else if($num == 4){
		echo "<img src='/img/weather/weather_4.png' >";
	}
}

function get_type_img($num){
	if($num == 1){
		echo "<img src='/img/weather/weather_5.png' >";
	}else if($num == 2){
		echo "<img src='/img/weather/weather_6.png' >";
	}else if($num == 3){
		echo "<img src='/img/weather/weather_7.png' >";
	}
}


function get_sky_img_s($num){
	if($num == 1){
		echo "<img src='/img/weather/weather_1.png' class='weather_img_s' >";
	}else if($num == 2){
		echo "<img src='/img/weather/weather_2.png' class='weather_img_s' >";
	}else if($num == 3){
		echo "<img src='/img/weather/weather_3.png' class='weather_img_s' >";
	}else if($num == 4){
		echo "<img src='/img/weather/weather_4.png' class='weather_img_s' >";
	}
}

function get_type_img_s($num){
	if($num == 1){
		echo "<img src='/img/weather/weather_5.png' class='weather_img_s' >";
	}else if($num == 2){
		echo "<img src='/img/weather/weather_6.png' class='weather_img_s' >";
	}else if($num == 3){
		echo "<img src='/img/weather/weather_7.png' class='weather_img_s' >";
	}
}


function get_sky($num){
	if($num == 1){
		echo _t("맑음");
	}else if($num == 2){
		echo _t("구름조금");
	}else if($num == 3){
		echo _t("구름많이");
	}else if($num == 4){
		echo _t("흐림");
	}
}

function get_type($num){
	if($num == 1){
		echo _t("비");
	}else if($num == 2){
		echo _t("비/눈");
	}else if($num == 3){
		echo _t("눈");
	}
}

function get_weather_info($w_z, $w_y, $go_time, $today){
  //$service_key = 'vaeDMuBwanawSVTaZQmLikc3lk5yJM%2BuJByCKA%2FImLnJNyqRGNPXssECnU78U79hnwtdQXViH%2BkCSfohHQmaHg%3D%3D';  //내꺼
  $service_key = 'kD%2BbCpb4dyX7HJHiD0asBSm6B9XcqREXM9bPKCYgOpaTFqmMdl2jO%2FmEMLhP1%2FpeUt26PNZVb7W1W0DRWJ1VGw%3D%3D';  //코리아투어카드
  $service_url = 'http://newsky2.kma.go.kr/service/SecndSrtpdFrcstInfoService2/';
  $service_api_name = 'ForecastSpaceData';
  $service_full_url = $service_url . $service_api_name . '?';
  $service_full_url = $service_full_url . ('ServiceKey=' . $service_key);
  $service_full_url = $service_full_url . ('&base_date=' . $today);
  $service_full_url = $service_full_url . ('&base_time=' . $go_time);
  $service_full_url = $service_full_url . ('&nx=' . $w_z);
  $service_full_url = $service_full_url . ('&ny=' .  $w_y);
  //$service_full_url = $service_full_url . ('&_type=' . 'xml');
  //$service_full_url = $service_full_url . ('&pageNo=' . '1');
  //$service_full_url = $service_full_url . ('&numOfRows=' . '10');
 
  $ch = curl_init();
  //echo $service_full_url;
  //exit();
  curl_setopt($ch, CURLOPT_URL, $service_full_url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_TIMEOUT, 10);
  $response = curl_exec($ch);
 
  $errno = curl_errno($ch);
  if ($errno > 0) {
    if ($errno === 28) {
        echo "Connection timed out.";
    }
    else {
        echo "Error #" . $errno . ": " . curl_error($ch);
    }
 
    exit(0);
  }
 
  if (!$response) {
    echo "ERROR - 1";
    exit(0);
  }
 
  $json_list = XmlToJson::Parse($response);
 
  if (!$json_list) {
    echo "ERROR - 2";
    exit(0);
  }
 
  $json_list= json_decode($json_list, true);
  curl_close($ch);
 
  if (!$json_list) {
    echo "ERROR - 3";
    exit(0);
  }
 
  if(strcmp($json_list['header']['resultMsg'],'OK') == 0 ) {
	//var_dump($json_list);
	$wh_arr = array();

	if($go_time == '0500' || $go_time == '1100'){
		$wh_arr[0] = $json_list['body']['items']['item'][0]['fcstValue']; //강수확률

		$wh_arr[1] = $json_list['body']['items']['item'][3]['fcstValue']; // 하늘 상태       맑음(1), 구름조금(2), 구름많음(3), 흐림(4)

		$wh_arr[2] = $json_list['body']['items']['item'][1]['fcstValue']; // 내리는 형태       없음(0), 비(1), 비/눈(2), 눈(3)

		$wh_arr[3] = $json_list['body']['items']['item'][4]['fcstValue']; // 온도 
	}else{
		$wh_arr[0] = $json_list['body']['items']['item'][0]['fcstValue']; //강수확률

		$wh_arr[1] = $json_list['body']['items']['item'][5]['fcstValue']; // 하늘 상태       맑음(1), 구름조금(2), 구름많음(3), 흐림(4)

		$wh_arr[2] = $json_list['body']['items']['item'][1]['fcstValue']; // 내리는 형태       없음(0), 비(1), 비/눈(2), 눈(3)

		$wh_arr[3] = $json_list['body']['items']['item'][6]['fcstValue']; // 온도 	
	}


	//var_dump($json_list);
	

    return $wh_arr; //success
  }
 
  var_dump($json_list);
  return 1; //failed
}




function get_weather(){
    $weather_name = array("서울", "광주", "대구", "대전", "춘천", "청주", "전주", "강릉", "부산", "제주");
    $weather_z = array(60, 58, 89, 67, 73, 76, 63, 92, 98, 52); 
    $weather_y = array(127, 74, 90, 100, 134, 114, 89, 131, 76, 38);

    $weather_arr = array();
    $weather_rain = '';
    class XmlToJson {  
        public function Parse ($fileContents) {
            $fileContents = str_replace(array("\n", "\r", "\t"), '', $fileContents);
        
            $fileContents = trim(str_replace('"', "'", $fileContents));
        
            $simpleXml = simplexml_load_string($fileContents);
        
            $json = json_encode($simpleXml);
        
            return $json;
        
        }  
    }


    $time_area = array('1100', '0500', '0800', '1100','2500');
    $times = date('Hi',time());
    $today = date('Ymd');
    $go_time;


    for($i=1; $i<count($time_area); $i++){
        $k = $i-1;
        if( $time_area[$i] > $times ){
            $w_result = sql_fetch( " select w_time from weather where w_time = ".$time_area[$k]." order by w_timestamp " );
            if( !$w_result['w_time'] ){
                sql_fetch( "delete from weather" );
                for($j=0; $j<count($weather_z); $j++ ){
                    //$weather_arr[$i] = get_weather_info($weather_z[$i], $weather_y[$i], $time_area[$i]); // weather_arr 0.강수확률(6시간) 1.날씨상태 2.내리는상태(비,눈) 3. 현재 온도(3시간)
                    $weather_arr = get_weather_info($weather_z[$j], $weather_y[$j], $time_area[$k], $today); // weather_arr 0.강수확률(6시간) 1.날씨상태 2.내리는상태(비,눈) 3. 현재 온도(3시간)
                    sql_query( " insert into weather (w_name, w_z, w_y, w_time, w_date,w_rain, w_sky, w_type, w_temp) values('".$weather_name[$j]."', ".$weather_z[$j].", ".$weather_y[$j]." , ".$time_area[$k]." , ".$today."  , ".$weather_arr[0]."  , ".$weather_arr[1]."  , ".$weather_arr[2]."  , ".$weather_arr[3]."   ) " );	
                    //echo " insert into weather (w_name, w_z, w_y, w_time, w_date,w_rain, w_sky, w_type, w_temp) values('".$weather_name[$j]."', ".$weather_z[$j].", ".$weather_y[$j]." , ".$time_area[$k]." , ".$today."  , ".$weather_arr[0]."  , ".$weather_arr[1]."  , ".$weather_arr[2]."  , ".$weather_arr[3]."   ) ";
                }
            }
            return $weather_result = sql_query( " select * from weather " );
            //break;
        }
    }
}

function get_weather1(){
    $weather_name = array("서울", "광주", "대구", "대전", "춘천", "청주", "전주", "강릉", "부산", "제주");
    $weather_z = array(60, 58, 89, 67, 73, 76, 63, 92, 98, 52); 
    $weather_y = array(127, 74, 90, 100, 134, 114, 89, 131, 76, 38);

    $weather_arr = array();
    $weather_rain = '';
    class XmlToJson1 {  
        public function Parse ($fileContents) {
            $fileContents = str_replace(array("\n", "\r", "\t"), '', $fileContents);
        
            $fileContents = trim(str_replace('"', "'", $fileContents));
        
            $simpleXml = simplexml_load_string($fileContents);
        
            $json = json_encode($simpleXml);
        
            return $json;
        
        }  
    }


    $time_area = array('1100', '0500', '0800', '1100','2500');
    $times = date('Hi',time());
    $today = date('Ymd');
    $go_time;


    for($i=1; $i<count($time_area); $i++){
        $k = $i-1;
        if( $time_area[$i] > $times ){
            $w_result = sql_fetch( " select w_time from weather where w_time = ".$time_area[$k]." order by w_timestamp " );
            if( !$w_result['w_time'] ){
                sql_fetch( "delete from weather" );
                for($j=0; $j<count($weather_z); $j++ ){
                    //$weather_arr[$i] = get_weather_info($weather_z[$i], $weather_y[$i], $time_area[$i]); // weather_arr 0.강수확률(6시간) 1.날씨상태 2.내리는상태(비,눈) 3. 현재 온도(3시간)
                    $weather_arr = get_weather_info($weather_z[$j], $weather_y[$j], $time_area[$k], $today); // weather_arr 0.강수확률(6시간) 1.날씨상태 2.내리는상태(비,눈) 3. 현재 온도(3시간)
                    sql_query( " insert into weather (w_name, w_z, w_y, w_time, w_date,w_rain, w_sky, w_type, w_temp) values('".$weather_name[$j]."', ".$weather_z[$j].", ".$weather_y[$j]." , ".$time_area[$k]." , ".$today."  , ".$weather_arr[0]."  , ".$weather_arr[1]."  , ".$weather_arr[2]."  , ".$weather_arr[3]."   ) " );	
                    //echo " insert into weather (w_name, w_z, w_y, w_time, w_date,w_rain, w_sky, w_type, w_temp) values('".$weather_name[$j]."', ".$weather_z[$j].", ".$weather_y[$j]." , ".$time_area[$k]." , ".$today."  , ".$weather_arr[0]."  , ".$weather_arr[1]."  , ".$weather_arr[2]."  , ".$weather_arr[3]."   ) ";
                }
            }
            return $weather_result = sql_query( " select * from weather " );
            //break;
        }
    }
}


function get_exchange_data(){
    return $Data = Ncurrency();
}


function get_exchange(){
    return sql_fetch( " select * from exchange where ex_date = curdate() - interval 1 day order by ex_day " );
}


function get_exchange1(){
    return sql_fetch( " select * from exchange where ex_date = curdate() - interval 1 day order by ex_day " );
}

function get_exchange_db(){
    $Data = Ncurrency();
    $ck_exchange = sql_fetch( " select count(*) cnt from exchange where ex_date = curdate() order by ex_day " );
    //$ck_exchange1 = sql_fetch( " select * from exchange where ex_date = curdate() order by ex_id " );
    if( $ck_exchange['cnt'] == 1 ){ // 있을때 
        sql_fetch( " update exchange set ex_us = ".$Data['USD']['매매기준율'].", ex_jp = ".$Data['JPY']['매매기준율'].", ex_cn = ".$Data['CNY']['매매기준율'].", ex_date = '".date('Y-m-d')."' where ex_id = ".$ck_exchange1['ex_id']." ");
        //echo " update exchange set ex_us = ".$Data['USD']['매매기준율'].", ex_jp = ".$Data['JPY']['매매기준율'].", ex_cn = ".$Data['CNY']['매매기준율'].", ex_date = '".date('Y-m-d')."' where ex_id = ".$ck_exchange1['ex_id']." ";
    }else if( $ck_exchange['cnt'] == 0 ){ // 없을때
        sql_fetch( " insert into exchange (ex_us, ex_jp, ex_cn, ex_date) values ( ".$Data['USD']['매매기준율'].", ".$Data['JPY']['매매기준율'].", ".$Data['CNY']['매매기준율'].", '".date('Y-m-d')."' )" );
    }
}

function get_main_benefit($bo_table){
    $benefit_notice = sql_fetch( " select bo_notice from g5_board where bo_table = '".$bo_table."'" );
    return explode( "," , $benefit_notice['bo_notice'] );
}

function get_notice_row($bo_table, $id){ //테이블 이름 , 아이디값
    return sql_fetch( " select * from g5_write_".$bo_table." where wr_id = ".$id);
}

function get_notice_row1($bo_table, $id, $lang){ //테이블 이름 , 아이디값

	if($lang == "ko_KR"){
		return sql_fetch( " select * from g5_write_".$bo_table." where wr_id = ".$id." and  wr_1 = 'on' " );
	}else if($lang == "en_US"){
		return sql_fetch( " select * from g5_write_".$bo_table." where wr_id = ".$id." and  wr_2 = 'on' " );
	}else if($lang == "ja_JP"){
		return sql_fetch( " select * from g5_write_".$bo_table." where wr_id = ".$id." and  wr_3 = 'on' " );
	}else if($lang == "zh_CN"){
		return sql_fetch( " select * from g5_write_".$bo_table." where wr_id = ".$id." and  wr_4 = 'on' " );
	}else if($lang == "zh_TW"){
		return sql_fetch( " select * from g5_write_".$bo_table." where wr_id = ".$id." and  wr_5 = 'on' " );
	}

    
}



function get_notice_random($bo_table, $cnt){  // 테이블 이름, 갯수
    return sql_query( " select * from g5_write_".$bo_table." ORDER BY RAND() LIMIT ".$cnt );
}



function get_notice_random1($bo_table, $cnt, $lang){ //테이블 이름 , 아이디값
	if($lang == "ko_KR"){
		return sql_query( " select * from g5_write_".$bo_table." where wr_1 = 'on' ORDER BY RAND() LIMIT ".$cnt );
	}else if($lang == "en_US"){
		return sql_query( " select * from g5_write_".$bo_table." where wr_2 = 'on' ORDER BY RAND() LIMIT ".$cnt );
	}else if($lang == "ja_JP"){
		return sql_query( " select * from g5_write_".$bo_table." where wr_3 = 'on' ORDER BY RAND() LIMIT ".$cnt );
	}else if($lang == "zh_CN"){
		return sql_query( " select * from g5_write_".$bo_table." where wr_4 = 'on' ORDER BY RAND() LIMIT ".$cnt );
	}else if($lang == "zh_TW"){
		return sql_query( " select * from g5_write_".$bo_table." where wr_5 = 'on' ORDER BY RAND() LIMIT ".$cnt );
	}
}



function get_textarea_br($content){
    $clean_content = htmlspecialchars($content, ENT_QUOTES);
    $clean_content = str_replace("\r\n","<br/>",$clean_content); //줄바꿈 처리
    $clean_content = str_replace("\u0020","&nbsp;",$clean_content); // 스페이스바 처리
    return $clean_content;
}

function get_group_benefit($wr_group,$wr_id,$lang){
    if( $wr_group != 0 ){
		if($wr_group == 3){ //프리미엄 아울렛 때문에 따로 조건 줌 
			$result = sql_query(" select * from  g5_write_cardbenefit where wr_group = ".$wr_group." or wr_group = 28");
		}else if($wr_group == 28){ //프리미엄 아울렛 때문에 따로 조건 줌 
			$result = sql_query(" select * from  g5_write_cardbenefit where wr_group = ".$wr_group." or wr_group = 3");
		}else if($wr_id == 101){ //코마린 때문에 따로 조건 줌 
			$result = sql_query(" select * from  g5_write_cardbenefit where wr_id = 100 or wr_id = 101 ");
		}else if($wr_id == 100){ //코마린 때문에 따로 조건 줌 
			$result = sql_query(" select * from  g5_write_cardbenefit where wr_id = 101 or wr_id = 100 ");
		}else{
			$result = sql_query(" select * from  g5_write_cardbenefit where wr_group = ".$wr_group);
		}
        echo "<ul class='group_ul'>";
        while( $row = sql_fetch_array($result) ){
            echo "<a class='group_a' href='/bbs/board.php?bo_table=cardbenefit&wr_id=".$row['wr_id']."&info=benefit&me_code=30&num=2";
			echo lang_url_a($_SESSION['lang']);
			echo "' >";
            echo "<li class='group_li";
            if($wr_id == $row['wr_id']) echo " selected";
            echo "'>";
            echo $row['wr_subject_'.$lang];
            echo "</li>";
            echo "</a>";
        }
        echo "</ul>";
    }

}

function get_default_img($id){
    $result = sql_fetch(" select * from  g5_default_img where d_id = ".$id);
    echo "<img src='".$result['d_url']."'> ";
}


function get_festival_list($stx, $sca, $today, $page ,$page_rows){
    if(!$page){
        $page = 1;
    }

    $page = ($page-1)*$page_rows;

    $and = "";
    $sql = " select * from  g5_write_festival where ";

    if($stx){
        $sql .= $and." ( wr_subject like '%".$stx."%' or wr_subject_ko_KR like '%".$stx."%' or wr_subject_en_US like '%".$stx."%' or wr_subject_ja_JP like '%".$stx."%' or wr_subject_zh_CN like '%".$stx."%' or wr_subject_zh_TW like '%".$stx."%' ) ";
        $and = " and ";
    }
    if($sca){
        $sql .= $and." ca_name = '".$sca."' ";
        $and = " and ";
    }  

    if($today){
        $todays = explode('-',$today);
        $today1 = $todays[0].substr($todays[1],0,2);
        $today2 = $today1;

        $today1 .= "00";
        $today2 .= "32";

        $sql .= $and." ( wr_1 >= ".$today1." or wr_2 >= ".$today1."   ) and (  wr_1 <= ".$today2." or wr_2 <= ".$today2." ) ";
        $and = " and ";
    } 

    $sql .= " order by wr_1 limit ".$page." , ".$page_rows."  ";
    //echo $sql;
    return sql_query($sql);
}

function get_festival_list_cnt($stx, $sca, $today){
    $and = "";
    $sql = " select count(*) cnt from  g5_write_festival where ";

    if($stx){
        $sql .= $and." ( wr_subject like '%".$stx."%' or wr_subject_ko_KR like '%".$stx."%' or wr_subject_en_US like '%".$stx."%' or wr_subject_ja_JP like '%".$stx."%' or wr_subject_zh_CN like '%".$stx."%' or wr_subject_zh_TW like '%".$stx."%' ) ";
        $and = " and ";
    }
    if($sca){
        $sql .= $and." ca_name = '".$sca."' ";
        $and = " and ";
    }  

    if($today){
        $todays = explode('-',$today);
        $today1 = $todays[0].substr($todays[1],0,2);
        $today2 = $today1;

        $today1 .= "00";
        $today2 .= "32";

        $sql .= $and." ( wr_1 >= ".$today1." or wr_2 >= ".$today1."   ) and (  wr_1 <= ".$today2." or wr_2 <= ".$today2." ) ";
        $and = " and ";
    } 
    return sql_fetch($sql);
}


function get_group_list($bo_name,$g_cate,$page,$page_rows){   //테이블 이름 , 카테고리 이름
    if(!$page){
        $page = 1;
    }
    $page = ($page-1)*$page_rows;

    $sql = " select * from g5_benefit_group where bo_name = '".$bo_name."' and g_cate = '".$g_cate."' ";
    $sql .= " limit ".$page." , ".$page_rows." ";
    return sql_query($sql);
}

function get_group_list_cnt($bo_name,$g_cate){   //테이블 이름 , 카테고리 이름
    $sql = " select count(*) cnt from g5_benefit_group where bo_name = '".$bo_name."' and g_cate = '".$g_cate."' ";
    return sql_fetch($sql);
}

function get_tourinfo_depth_list($id){   //테이블 이름 , 카테고리 이름
    $sql = " select * from g5_write_tourinfo where wr_1 = ".$id;
    return sql_query($sql);
}

function ktc_get_url(){  //현재 url 가지고 오는 함수 변수값까지 다 가지고 옴
    return "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];     
}




function ktc_get_table_list($bo_table ,$stx, $sca, $page ,$page_rows,$g_id){ //테이블 이름, 검색단어, ca_name, 현재페이지, 페이지당 개수,
    if(!$page){
        $page = 1;
    }

    $page = ($page-1)*$page_rows;

    $and = "";
    $sql = " select * from  ".$bo_table." where ";

    if($stx){
        $sql .= $and." ( wr_subject like '%".$stx."%' or wr_subject_ko_KR like '%".$stx."%' or wr_subject_en_US like '%".$stx."%' or wr_subject_ja_JP like '%".$stx."%' or wr_subject_zh_CN like '%".$stx."%' or wr_subject_zh_TW like '%".$stx."%' ) ";
        $and = " and ";
    }
    if($sca){
        $sql .= $and." ca_name = '".$sca."' ";
        $and = " and ";
    }  

    if($g_id){
        $sql .= $and." wr_1 = ".$g_id." ";
        $and = " and ";
    } 

    if($today){
        $todays = explode('-',$today);
        $today1 = $todays[0].substr($todays[1],0,2);
        $today2 = $today1;

        $today1 .= "00";
        $today2 .= "32";

        $sql .= $and." ( wr_1 >= ".$today1." or wr_2 >= ".$today1."   ) and (  wr_1 <= ".$today2." or wr_2 <= ".$today2." ) ";
        $and = " and ";
    } 

    $sql .= " limit ".$page." , ".$page_rows." ";
    //echo $sql;
    return sql_query($sql);
}



function ktc_get_table_list_cnt($bo_table ,$stx, $sca, $page ,$page_rows,$g_id){
    $and = "";
    $sql = " select count(*) cnt from  ".$bo_table." where ";

    if($stx){
        $sql .= $and." ( wr_subject like '%".$stx."%' or wr_subject_ko_KR like '%".$stx."%' or wr_subject_en_US like '%".$stx."%' or wr_subject_ja_JP like '%".$stx."%' or wr_subject_zh_CN like '%".$stx."%' or wr_subject_zh_TW like '%".$stx."%' ) ";
        $and = " and ";
    }
    if($sca){
        $sql .= $and." ca_name = '".$sca."' ";
        $and = " and ";
    }  

    if($g_id){
        $sql .= $and." wr_1 = ".$g_id." ";
        $and = " and ";
    } 

    if($today){
        $todays = explode('-',$today);
        $today1 = $todays[0].substr($todays[1],0,2);
        $today2 = $today1;

        $today1 .= "00";
        $today2 .= "32";

        $sql .= $and." ( wr_1 >= ".$today1." or wr_2 >= ".$today1."   ) and (  wr_1 <= ".$today2." or wr_2 <= ".$today2." ) ";
        $and = " and ";
    } 
    return sql_fetch($sql);
}

function ktc_total_page($cnt, $page_rows){
    return ceil($cnt / $page_rows);    
}


// 관리자 패스 구분 (모루내부사용)
$pass = strstr($_SERVER["REMOTE_ADDR"],"210.96.212");


// 팝업 호출

// sql 검색
function ktc_get_sql_search($search_ca_name, $search_field, $search_text, $search_operator='and')
{
    global $g5;

    $str = "";
    if ($search_ca_name)
        $str = " ca_name = '$search_ca_name' ";

    $search_text = strip_tags(($search_text));
    $search_text = trim(stripslashes($search_text));

    if (!$search_text) {
        if ($search_ca_name) {
            return $str;
        } else {
            return '0';
        }
    }

    if ($str)
        $str .= " and ";

    // 쿼리의 속도를 높이기 위하여 ( ) 는 최소화 한다.
    $op1 = "";

    // 검색어를 구분자로 나눈다. 여기서는 공백
    $s = array();
    $s = explode(" ", $search_text);
	
	//검색시 언어설정 구분 

	if(!$lang) $lang = $_GET['lang'];

    // 검색필드를 구분자로 나눈다. 여기서는 +
    $tmp = array();
    $tmp = explode(",", trim($search_field));
    $field = explode("||", $tmp[0]);
    $not_comment = "";
    if (!empty($tmp[1]))
        $not_comment = $tmp[1];

    $str .= "(";
    for ($i=0; $i<count($s); $i++) {
        // 검색어
        $search_str = trim($s[$i]);
        if ($search_str == "") continue;

        // 인기검색어
        ktc_insert_popular($field, $search_str,$lang);

        $str .= $op1;
        $str .= "(";

        $op2 = "";
        for ($k=0; $k<count($field); $k++) { // 필드의 수만큼 다중 필드 검색 가능 (필드1+필드2...)

            // SQL Injection 방지
            // 필드값에 a-z A-Z 0-9 _ , | 이외의 값이 있다면 검색필드를 wr_subject 로 설정한다.
            $field[$k] = preg_match("/^[\w\,\|]+$/", $field[$k]) ? $field[$k] : "wr_subject";

            $str .= $op2;
            switch ($field[$k]) {
                case "mb_id" :
                case "wr_name" :
                    $str .= " $field[$k] = '$s[$i]' ";
                    break;
                case "wr_hit" :
                case "wr_good" :
                case "wr_nogood" :
                    $str .= " $field[$k] >= '$s[$i]' ";
                    break;
                // 번호는 해당 검색어에 -1 을 곱함
                case "wr_num" :
                    $str .= "$field[$k] = ".((-1)*$s[$i]);
                    break;
                case "wr_ip" :
                case "wr_password" :
                    $str .= "1=0"; // 항상 거짓
                    break;
                // LIKE 보다 INSTR 속도가 빠름
                default :
                    if (preg_match("/[a-zA-Z]/", $search_str)){
                        $str .= "INSTR(LOWER($field[$k]), LOWER('$search_str'))";
                        $str .= " or INSTR(LOWER(wr_subject_en_US), LOWER('$search_str'))";
                        $str .= " or INSTR(LOWER(wr_subject_ja_JP), LOWER('$search_str'))";
                        $str .= " or INSTR(LOWER(wr_subject_zh_CN), LOWER('$search_str'))";
                        $str .= " or INSTR(LOWER(wr_subject_zh_TW), LOWER('$search_str'))";
                    }
                    else
                        $str .= "INSTR($field[$k], '$search_str')";
                        $str .= " or INSTR(LOWER(wr_subject_en_US), LOWER('$search_str'))";
                        $str .= " or INSTR(LOWER(wr_subject_ja_JP), LOWER('$search_str'))";
                        $str .= " or INSTR(LOWER(wr_subject_zh_CN), LOWER('$search_str'))";
                        $str .= " or INSTR(LOWER(wr_subject_zh_TW), LOWER('$search_str'))";
                    break;
            }
            $op2 = " or ";
        }
        $str .= ")";

        $op1 = " $search_operator ";
    }
    $str .= " ) ";
    if ($not_comment)
        $str .= " and wr_is_comment = '0' ";

        
    return $str;
}



function ktc_get_sql_search_area($search_ca_name, $search_field, $search_text, $search_operator='and', $word, $word1)
{
    global $g5;


    $str = "";
    if ($search_ca_name)
        $str = " ca_name = '$search_ca_name' ";

    $search_text = strip_tags(($search_text));
    $search_text = trim(stripslashes($search_text));

    if (!$search_text) {
        if ($search_ca_name) {
            return $str;
        } else {
            return '0';
        }
    }

    if ($str)
        $str .= " and ";

    // 쿼리의 속도를 높이기 위하여 ( ) 는 최소화 한다.
    $op1 = "";

    // 검색어를 구분자로 나눈다. 여기서는 공백
    $s = array();
    $s = explode(" ", $search_text);

    // 검색필드를 구분자로 나눈다. 여기서는 +
    $tmp = array();
    $tmp = explode(",", trim($search_field));
    $field = explode("||", $tmp[0]);
    $not_comment = "";
    if (!empty($tmp[1]))
        $not_comment = $tmp[1];

    $str .= "(";
    for ($i=0; $i<count($s); $i++) {
        // 검색어
        $search_str = trim($s[$i]);
        if ($search_str == "") continue;

        // 인기검색어
        ktc_insert_popular($field, $search_str,$lang);

        $str .= $op1;
        $str .= "(";

        $op2 = "";
        for ($k=0; $k<count($field); $k++) { // 필드의 수만큼 다중 필드 검색 가능 (필드1+필드2...)

            // SQL Injection 방지
            // 필드값에 a-z A-Z 0-9 _ , | 이외의 값이 있다면 검색필드를 wr_subject 로 설정한다.
            $field[$k] = preg_match("/^[\w\,\|]+$/", $field[$k]) ? $field[$k] : "wr_subject";

            $str .= $op2;
            switch ($field[$k]) {
                case "mb_id" :
                case "wr_name" :
                    $str .= " $field[$k] = '$s[$i]' ";
                    break;
                case "wr_hit" :
                case "wr_good" :
                case "wr_nogood" :
                    $str .= " $field[$k] >= '$s[$i]' ";
                    break;
                // 번호는 해당 검색어에 -1 을 곱함
                case "wr_num" :
                    $str .= "$field[$k] = ".((-1)*$s[$i]);
                    break;
                case "wr_ip" :
                case "wr_password" :
                    $str .= "1=0"; // 항상 거짓
                    break;
                // LIKE 보다 INSTR 속도가 빠름
                default :
                    if (preg_match("/[a-zA-Z]/", $search_str)){
                        $str .= "INSTR(LOWER($field[$k]), LOWER('$search_str'))";

						//$str .= " and INSTR(LOWER(".$word."), LOWER('$search_str'))";
						//$str .= " and INSTR(LOWER(".$word1."), LOWER('$search_str'))";


                        $str .= " or INSTR(LOWER(wr_subject_en_US), LOWER('$search_str'))";
                        $str .= " or INSTR(LOWER(wr_subject_ja_JP), LOWER('$search_str'))";
                        $str .= " or INSTR(LOWER(wr_subject_zh_CN), LOWER('$search_str'))";
                        $str .= " or INSTR(LOWER(wr_subject_zh_TW), LOWER('$search_str'))";

						$str .= " or INSTR(LOWER(wr_local1_ko_KR), LOWER('$search_str'))";
						$str .= " or INSTR(LOWER(wr_local1_en_US), LOWER('$search_str'))";
						$str .= " or INSTR(LOWER(wr_local1_ja_JP), LOWER('$search_str'))";
						$str .= " or INSTR(LOWER(wr_local1_zh_CN), LOWER('$search_str'))";
						$str .= " or INSTR(LOWER(wr_local1_zh_TW), LOWER('$search_str'))";

						$str .= " or INSTR(LOWER(wr_1), LOWER('$search_str'))";
						$str .= " or INSTR(LOWER(wr_3), LOWER('$search_str'))";
						$str .= " or INSTR(LOWER(wr_5), LOWER('$search_str'))";
						$str .= " or INSTR(LOWER(wr_7), LOWER('$search_str'))";
						$str .= " or INSTR(LOWER(wr_9), LOWER('$search_str'))";



                    }
                    else
                        $str .= "INSTR($field[$k], '$search_str')";

						//$str .= " and INSTR(LOWER(".$word."), LOWER('$search_str'))";
						//$str .= " and INSTR(LOWER(".$word1."), LOWER('$search_str'))";

                        $str .= " or INSTR(LOWER(wr_subject_en_US), LOWER('$search_str'))";
                        $str .= " or INSTR(LOWER(wr_subject_ja_JP), LOWER('$search_str'))";
                        $str .= " or INSTR(LOWER(wr_subject_zh_CN), LOWER('$search_str'))";
                        $str .= " or INSTR(LOWER(wr_subject_zh_TW), LOWER('$search_str'))";

						$str .= " or INSTR(LOWER(wr_local1_ko_KR), LOWER('$search_str'))";
						$str .= " or INSTR(LOWER(wr_local1_en_US), LOWER('$search_str'))";
						$str .= " or INSTR(LOWER(wr_local1_ja_JP), LOWER('$search_str'))";
						$str .= " or INSTR(LOWER(wr_local1_zh_CN), LOWER('$search_str'))";
						$str .= " or INSTR(LOWER(wr_local1_zh_TW), LOWER('$search_str'))";

						$str .= " or INSTR(LOWER(wr_1), LOWER('$search_str'))";
						$str .= " or INSTR(LOWER(wr_3), LOWER('$search_str'))";
						$str .= " or INSTR(LOWER(wr_5), LOWER('$search_str'))";
						$str .= " or INSTR(LOWER(wr_7), LOWER('$search_str'))";
						$str .= " or INSTR(LOWER(wr_9), LOWER('$search_str'))";



                    break;
            }
            $op2 = " or ";
        }
        $str .= ")";

        $op1 = " $search_operator ";
    }
    $str .= " ) ";
    if ($not_comment)
        $str .= " and wr_is_comment = '0' ";

        
    return $str;
}


function set_class($classname,$lang){ //클레스 이름, 언어 선택(ko_KR/en_US/ja_JP/zh_CN/zh_TW)
	$langarr = explode("/", $lang);

	for( $i = 0; $i<count($langarr); $i++ ){
		if( $langarr[$i] == $_SESSION['lang'] ){
			echo $classname;
		}
	}

}


function set_class_index($lang){ //클레스 이름, 언어 선택(ko_KR/en_US/ja_JP/zh_CN/zh_TW)

		if( "ko_KR" == $lang ){
			echo "http://vkc.or.kr/";
		}else if( "en_US" == $lang ){
			echo "http://vkc.or.kr/en/";
		}else if( "ja_JP" == $lang ){
			echo "http://vkc.or.kr/jp/";
		}else if( "zh_CN" == $lang ){
			echo "http://vkc.or.kr/sc/";
		}else if( "zh_TW" == $lang ){
			echo "http://vkc.or.kr/tc/";
		}
}


function set_class_index2($lang){ //클레스 이름, 언어 선택(ko_KR/en_US/ja_JP/zh_CN/zh_TW)

		if( "ko_KR" == $lang ){
			echo "https://www.t-money.co.kr/";
		}else{
			echo "https://www.t-money.co.kr/ncs/pct/tmnyintd/ReadFrgnKoreaTourCardEngIntd.dev;jsessionid=ds0pkB7L96TK0MMI8emZXb6nz5C0Uvr1VRqI2fmMCfgIWlT59rc6kL1NaQBg4InU.czzw01ip_servlet_tmyweb";
		}
}


function set_class_index3($lang){ //클레스 이름, 언어 선택(ko_KR/en_US/ja_JP/zh_CN/zh_TW)

		if( "ko_KR" == $lang ){
			echo "https://www.facebook.com/smilekorea";
		}else if( "en_US" == $lang ){
			echo "https://www.facebook.com/visitkoreayear";
		}else if( "ja_JP" == $lang ){
			echo "https://www.facebook.com/visitkoreayearjp";
		}else if( "zh_CN" == $lang ){
			echo "http://weibo.com/visitkoreayearcn";
		}else if( "zh_TW" == $lang ){
			echo "https://www.facebook.com/visitkoreayeartw";
		}
}


function ck_category($sca){
	$result = sql_fetch(" select * from card_category where name_en_US = '".$sca."'");
	return $result['name_ko_KR'];
}


function lang_url($lang){

	if($lang == "ko_KR"){
		return "kr";
	}else if($lang == "en_US"){
		return "en";
	}else if($lang == "ja_JP"){
		return "jp";
	}else if($lang == "zh_CN"){
		return "cn";
	}else if($lang == "zh_TW"){
		return "tw";
	}else{
		return "kr";
	}

}


function lang_url_a($lang){

	if($lang == "ko_KR"){
		return "&lang=kr";
	}else if($lang == "en_US"){
		return "&lang=en";
	}else if($lang == "ja_JP"){
		return "&lang=jp";
	}else if($lang == "zh_CN"){
		return "&lang=cn";
	}else if($lang == "zh_TW"){
		return "&lang=tw";
	}else{
		return "&lang=kr";
	}

}



// 인기검색어 입력
function ktc_insert_popular($field, $str, $lang = "ko_KR")
{
    global $g5;
    if(!in_array('mb_id', $field)) {
        $sql = " insert into {$g5['popular_table']} set pp_word = '{$str}', pp_date = '".G5_TIME_YMD."', pp_ip = '{$_SERVER['REMOTE_ADDR']}', pp_lang = '{$lang}' ";
        sql_query($sql, FALSE);
    }
}


function ktc_area_init($word){
	if($word == '서울'){ return '서울특별시'; } 
	if($word == '광주'){ return '광주광역시'; } 
	if($word == '대전'){ return '대전광역시'; } 
	if($word == '부산'){ return '부산광역시'; } 
	if($word == '울산'){ return '울산광역시'; } 
	if($word == '대구'){ return '대구광역시'; } 
	if($word == '인천'){ return '인천광역시'; } 
	if($word == '세종'){ return '세종특별자치시'; } 
	if($word == '강원'){ return '강원도'; } 
	if($word == '경기'){ return '경기도'; } 
	if($word == '경상남도'){ return '경상남도'; } 
	if($word == '경상북도'){ return '경상북도'; } 
	if($word == '전라남도'){ return '전라남도'; } 
	if($word == '전라북도'){ return '전라북도'; } 
	if($word == '제주'){ return '제주특별자치도'; } 
	if($word == '충청남도'){ return '충청남도'; } 
	if($word == '충청북도'){ return '충청북도'; } 
}


?>