<?
        $forpage = 0;
        if($page < 4){
                $forpage = 1;
        }else if($page + 3 <= $totalPage){
                $forpage = $page - 2; 
        }else{
                $forpage = $totalPage - 4;
        } 
?>

<!--<div id="container">
	<div class="pagination">
        <a href="#" class="page" id='first'>first</a>
        <?$cnt = 0;for($i=$forpage; $forpage != -1; $i++) { $cnt += 1; if($cnt == 6 || $totalPage == $cnt - 1) { break;}
            if($page == $i){ ?>
                <a href="#" val='<?=$i?>' class="page active"><?=$i?></a>
        <?  }else{ ?>
            
           <a href="#" val='<?=$i?>' class="page"><?=$i?></a>
        <? }} ?>
        <a href="#" val='<?=$i?>' class="page" id='last'>last</a>
	</div>
</div>-->



