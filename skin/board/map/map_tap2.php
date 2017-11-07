

<? for ($i=0; $i < count($option); $i++) { ?>
    <div class='info_option' val='<?=$option[$i]?>'></div>
<? } ?>



    <div class="tabDetails">
        <div id="tab1" class="tabContents1">
		  <div class="sub2_1form_area">
				<p class="sub2_printBtn"><img id='btnPrint' src="/img/sub/sub2/sub2_1/sub2_printBtn.jpg" alt="프린트하기"/></p>
                <div class="sub2_1form">
                    <form action="">
                        <fieldset>
                            
                            <ul>
                                <li class="">
                                    <label for="" class="hide">검색창</label>
                                    <? include_once('../skin/board/map/juso/1.php') ?>
                                    <input type='hidden' name='bo_table' value='<?=$bo_table;?>'>
                                    <input type='hidden' name='info' value='<?=$info;?>'>
                                    <input type='hidden' name='me_code' value='<?=$me_code;?>'>
                                    <input type='hidden' name='num' value='<?=$num;?>'>
									<input type='hidden' name='lang' value='<?=lang_url($_SESSION['lang'])?>'>
                                </li>

                                <li class="btn">
                                    <input type="submit" value="<?=_t('검색')?>" class="search_btn_address" id="search_btn"  title="<?=_t('검색')?>" />
                                </li>
                            </ul>
                        </fieldset>
						
						<div class="sub2_1button">
							<button id="button" class="ui-state-default ui-corner-all select-btn sub21_stoBtn" onclick="return false;" style='<?=set_class("font-size:13px; background-position:107px 16px;","en_US")?>' ><?=_t('판매점 선택')?></button>
							
							<!-- 팝업 -->
							<div class="toggler sub2_1pop">
								<div id="effect" class="ui-widget-content ui-corner-all">
									
									<form class='checkbox-form' name='my_form'>
										<div class="sub21_popHead">
											<h3 class="" style='text-align:right; padding-right:10px; background:none; border:none;'><?=_t('분류선택')?></h3>
											<span class="ui-icon ui-icon-close show-close"></span>
										</div>

										<ul class="sub21_popBtn">
											<li class="fl_left">
												<button class='return-ck popBtn1' onclick='return false;'><?=_t('초기화')?></button> 
											</li>

											<li class="fl_right">
												<button class="popBtn2" onclick='false;'><?=_t('적용')?></button>
											</li>
										</ul>

										<div class="sub21_popCheck">
											<? while($row1 = sql_fetch_array($store_row)) { ?>
												<p id='<?=$row1['name']?>' style='font-size:14px;'><input class='option_ck' type='checkbox' name='option[]' value='<?=$row1['id']?>' style=''  />&nbsp;&nbsp;<?=$row1['name_'.$_SESSION['lang'].'']?></p>
											<? } ?>
										</div>
									</form>
									
								</div>
							</div>
							<!-- 팝업 끝 -->
						</div>

                    </form>

                </div>
			</div>

            <div id='map' style='width:100%; height:479px;'></div>

            <h3 class="table_number">
				<?if($_SESSION['lang'] != "en_US"){?>
					<?=_t('판매점 검색결과')?> (<?=_t('총')?> <span><?=$tatalCnt;?></span><?echo _t('개');?>)
				<?}else{?>
					<?=_t('판매점 검색결과')?> (<span><?=$tatalCnt;?></span> results in total)
				<?}?>
			</h3>
        
            <? include('../skin/board/map/map_list.php') ?>
            
        <div> 
    </div>







<!--<div class='tab1-option'>
    <div class='tab1-1line'>
        <div class='tab1-option-serach'>
            <form class='checkbox-form' name='my_form'>
                <button class='search-btn'>검색</button>
                <input type='hidden' name='lang' value='<?=$lang?>'>
                <input type='hidden' name='word' id='word'>
            </form>
        </div>

        <button id="button" class="ui-state-default ui-corner-all select-btn">판매점 선택</button>
    </div>



    <div class="tab1-option-toggler toggler">
        <div id="effect" class="ui-widget-content ui-corner-all">
            
            
            <form class='checkbox-form' name='my_form'>
                <input type='hidden' name='lang' value='<?=$lang?>'>
                <h3 class="ui-widget-header ui-corner-all"><button class='return-ck' onclick='return false;'>초기화</button><button>적용</button> <span class="ui-icon ui-icon-close show-close"></span></h3>
                <? while($row1 = sql_fetch_array($store_row)) { ?>
                    <p><input class='option_ck' type='checkbox' name='option[]' value='<?=$row1['id']?>' /><?=$row1['name_'.$lang.'']?></p>
                <? } ?>
            </form>
            
        </div>
    </div>
</div>-->

   
