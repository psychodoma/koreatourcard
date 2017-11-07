<?
include_once('./_common.php');
$sql_radio = sql_query(" select * from g5_write_allshop where wr_1 = ".$_GET['val']);

if(isset($_GET['val'])){
    $sel_val = $_GET['val2'];
}else{
    $sel_val = -100;
}



while($row = sql_fetch_array($sql_radio) ){
    if($row['wr_id'] == $sel_val){
        echo '<input type="radio" name="store_detail" checked  value="'.$row['wr_id'].'">'.$row['wr_subject'];
    }else{
        echo '<input type="radio" name="store_detail" value="'.$row['wr_id'].'">'.$row['wr_subject'];
    }
    
    echo "&nbsp;&nbsp;&nbsp;";
}
?>