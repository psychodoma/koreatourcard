<?php

include_once('../../../../common.php');

if(!$_POST['Name']){
echo "<option value=''>";
if($info == "benefitarea"){
	echo _t('전체');
}else{
	echo _t('선택하세요');
}
echo "</option>";
exit;
}

$zipfile = array();
if($info == "benefitarea"){
	$fp = fopen("../../cardbenefit/juso/code.db", "r");
}else{
	$fp = fopen("./code.db", "r");
}
while(!feof($fp)) {

$zipfile[] = fgets($fp, 4096);
}
fclose($fp);
$cnt = count($zipfile);
echo "<option value='' selected >";
if($info == "benefitarea"){
	echo _t('전체');
}else{
	echo _t('선택하세요');
}
echo "</option>";
for($i=0; $i <= $cnt; $i++){





if(preg_match("/".$_POST['Name']."/",$zipfile[$i])){
$joso_ex = explode(" ",$zipfile[$i]);




if($_POST['word1'] == $joso_ex[1]){
echo "<option value='".trim($joso_ex[1])."' selected >"._t(trim($joso_ex[1]))."</option>";
}else{
echo "<option value='".trim($joso_ex[1])."' >"._t(trim($joso_ex[1]))."</option>";
}
}
}
?>
