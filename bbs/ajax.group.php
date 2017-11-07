<?
include_once('./_common.php');
if( $_GET['vals'] == "add" ){  //추가
    $re_result = sql_fetch( " select count(*) cnt from g5_benefit_group where g_name = '".$_GET['values']."'" );
    if($re_result['cnt'] == 1){
        echo "common"; // 같은 그룹이름 있을경우
        return; 
    }
    if( !$_GET['g_sel'] ){
        sql_query( " insert into g5_benefit_group (bo_name,g_name) values( '".$_GET['tablename']."','".$_GET['values']."' ) " );
    }else{
        sql_query( " insert into g5_benefit_group (bo_name,g_name,g_cate) values( '".$_GET['tablename']."','".$_GET['values']."','".$_GET['g_sel']."' ) " );
    }
}else{ // 삭제
    $re_result = sql_fetch( " select count(*) cnt from g5_benefit_group where g_name = '".$_GET['values']."'" );

    if($re_result['cnt'] == 1){
        sql_query( "delete from g5_benefit_group where g_name ='".$_GET['values']."'" );
        echo "suc";
    }else{
        echo "fail";
    }

}


?>