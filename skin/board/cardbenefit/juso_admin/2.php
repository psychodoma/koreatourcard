<?php 

include_once('../../../../common.php');

if(!$_POST['Name']){ 
echo "<option value=''>";
if($info == "benefitarea"){
	echo _t('선택하세요');
}else{
	echo _t('선택하세요');
}
echo "</option>";	
exit; 
} 

$zipfile = array(); 
$fp = fopen("./code.db", "r"); 
while(!feof($fp)) { 
 
$zipfile[] = fgets($fp, 4096); 
} 
fclose($fp); 
$cnt = count($zipfile); 
echo "<option value='' selected >";
if($info == "benefitarea"){
	echo _t('선택하세요');
}else{
	echo _t('선택하세요');
}
echo "</option>";
for($i=0; $i <= $cnt; $i++){ 


    


if(preg_match("/".$_POST['Name']."/",$zipfile[$i])){ 
$joso_ex = explode(" ",$zipfile[$i]); 




if($_POST['word1'] == $joso_ex[1]){
echo "<option value='".$joso_ex[1]."' selected >"._t($joso_ex[1])."</option>"; 
}else{
echo "<option value='".$joso_ex[1]."' >"._t($joso_ex[1])."</option>";   
}
} 
} 
?>