<?php
include_once './_common.php';
include_once G5_PLUGIN_PATH . "/ask_banner/_lib/config.php";
include_once G5_PLUGIN_PATH . "/ask_banner/_lib/lib.php";
include_once './ask_header.php';
?>
<div class='jumbotron'>
    <h1 class="display-3">ASK Banner Ver 1.0.1</h1>
    <p class="lead">
        그누보드5 , 영카트5 배너 플러그인 입니다. 이미지, HTML, ADSENSE, TEXT 이미지등을 손쉽게 등록 가능합니다. 같은 그룹에 여러 배너 등록시 랜덤으로 출력되며 날짜 지정이 가능합니다.
    </p>
</div>

<?php

//배너 테이블 존재 검사
function ask_banner_exist() {
    $sql = "show tables like '" . ASK_BANNER_TABLE . "'";
    $result = sql_fetch($sql);
    $sql = "CREATE TABLE IF NOT EXISTS `" . ASK_BANNER_TABLE . "` (
  `ba_idx` int(11) NOT NULL AUTO_INCREMENT,
  `ba_gr_idx` int(11) NOT NULL,
  `ba_name` varchar(100) NOT NULL,
  `ba_type` varchar(50) NOT NULL,
  `ba_text` varchar(255) NOT NULL,
  `ba_url` varchar(255) NOT NULL,
  `ba_image` varchar(100) NOT NULL,
  `ba_html` text NOT NULL,
  `ba_use_time` int(11) NOT NULL,
  `ba_startday` date NOT NULL,
  `ba_endday` date NOT NULL,
  PRIMARY KEY (`ba_idx`),
  KEY `idxs` (`ba_gr_idx`,`ba_use_time`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='Banner Table';";
    if (!$result) {
        sql_query($sql);
    }

    $sql2 = "show tables like '" . ASK_GROUP_TABLE . "'";
    $result2 = sql_fetch($sql2);
    $sql2 = "CREATE TABLE IF NOT EXISTS `" . ASK_GROUP_TABLE . "` (
`gr_idx` int(11) NOT NULL AUTO_INCREMENT,
 `gr_name` varchar(100) NOT NULL,
 `gr_memo` text NOT NULL,
 PRIMARY KEY (`gr_idx`),
 KEY `gr_name` (`gr_name`)
) ENGINE = MyISAM AUTO_INCREMENT = 1 DEFAULT CHARSET = utf8;";
    if (!$result2) {
        sql_query($sql2);
    }
}

ask_banner_exist();

include_once './ask_footer.php';

