

<div id="select_box1">
    <select class="Address_D" id="color" title="<?if($info == "benefitarea"){?><?=_t('지역을 선택하세요')?><?}else{?><?=_t('전체')?><?}?>" name='word' style="opacity:0">
		<?if($info == "benefitarea"){?><option value= ''><?=_t('지역을 선택하세요')?></option><?}else{?><option value= ''><?=_t('전체')?></option><?}?>
        <option value='서울' <?if($word == '서울'){ echo "selected"; $wordcom = "서울특별시";}?> ><?=_t('서울특별시')?></option>
		<!--<option value='광주' <?if($word == '광주'){ echo "selected"; $wordcom = "광주광역시";}?> ><?=_t('광주광역시')?></option>-->
		<option value='대구' <?if($word == '대구'){ echo "selected"; $wordcom = "대구광역시";}?> ><?=_t('대구광역시')?></option>
		<!--<option value='대전' <?if($word == '대전'){ echo "selected"; $wordcom = "대전광역시";}?> ><?=_t('대전광역시')?></option>-->
		<option value='부산' <?if($word == '부산'){ echo "selected"; $wordcom = "부산광역시";}?> ><?=_t('부산광역시')?></option>
		<!--<option value='울산' <?if($word == '울산'){ echo "selected"; $wordcom = "울산광역시";}?> ><?=_t('울산광역시')?></option>-->
		<option value='인천' <?if($word == '인천'){ echo "selected"; $wordcom = "인천광역시";}?> ><?=_t('인천광역시')?></option>
		<!--<option value='세종' <?if($word == '세종'){ echo "selected"; $wordcom = "세종특별자치시";}?> ><?=_t('세종특별자치시')?></option>-->
		<option value='강원' <?if($word == '강원'){ echo "selected"; $wordcom = "강원도";}?> ><?=_t('강원도')?></option>
		<option value='경기' <?if($word == '경기'){ echo "selected"; $wordcom = "경기도";}?> ><?=_t('경기도')?></option>
		<option value='경상남도' <?if($word == '경상남도'){ echo "selected"; $wordcom = "경상남도";}?> ><?=_t('경상남도')?></option>
		<option value='경상북도' <?if($word == '경상북도'){ echo "selected"; $wordcom = "경상북도";}?> ><?=_t('경상북도')?></option>
		<option value='전라남도' <?if($word == '전라남도'){ echo "selected"; $wordcom = "전라남도";}?> ><?=_t('전라남도')?></option>
		<option value='전라북도' <?if($word == '전라북도'){ echo "selected"; $wordcom = "전라북도";}?> ><?=_t('전라북도')?></option>
		<option value='제주' <?if($word == '제주'){ echo "selected"; $wordcom = "제주특별자치도";}?> ><?=_t('제주특별자치도')?></option>
		<option value='충청남도' <?if($word == '충청남도'){ echo "selected"; $wordcom = "충청남도";}?> ><?=_t('충청남도')?></option>
		<option value='충청북도' <?if($word == '충청북도'){ echo "selected"; $wordcom = "충청북도";}?> ><?=_t('충청북도')?></option>
    </select>
</div>




<div id="select_box1" class='select_box1' style="width:232px;height:50px;display:block;">
	<!--<div style="border:3px solid #333;border-radius:5px;width:222px;height:42px;background:white;z-index:0;position:absolute"></div>-->

    <select class="Address_S" id="color" title="<?=_t('전체')?>" name='word1' style=' z-index:3;opacity:0;'>

    </select>


</div>
<!-- ..... -->


<script>

$(function(){

	<?if($wordcom){?>
		$('.Address_D_label').html('<?=_t($wordcom)?>');
	<?}?>




    $(".select_word").change(function(){
		var classname = $(this).attr('class');

        //var select_name = $(this).children("option:selected").text();
        //$(this).siblings("label").text(select_name);


		jQuery.ajax({
			type: "POST",
			url: "../skin/board/cardbenefit/juso/2.php",
			data: "Name=" + $('.Address_D').val() + "&word1=<?=$word1?>&lang=<?=$_SESSION['lang']?>" + "&info=<?=$info?>" ,
			success: function (msg) {

				$('.select_box1').html('<select class="Address_S" id="color" name="word1">')

				$('.Address_S').append(msg);




				$('.Address_S').prettyDropdown({
					customClass: "select_word1 arrow",
					classic: true,
					afterLoad: function(){

            $('.Address_S').change(function(){
              $('.search_change').submit();
            })

						$('.select_word1 li').each(function(index){
							if( index == 0  ){
								$(this).addClass('selected');
							}else{
								$(this).removeClass('selected');
								$(this).find('span').remove();
							}

						})
					}

				});

			},
		});
    });


	jQuery.ajax({
		type: "POST",
		url: "../skin/board/cardbenefit/juso/2.php",
		data: "Name=" + $('.Address_D').val() + "&word1=<?=$word1?>&lang=<?=$_SESSION['lang']?>" + "&info=<?=$info?>" ,
		success: function (msg) {
			$('.Address_S').append(msg);

			$('.Address_S').prettyDropdown({
				customClass: "select_word1 arrow",
				classic: true,
				afterLoad: function(){
          $('.Address_S').change(function(){
            $('.search_change').submit();
          })

					$('.select_word1 li').each(function(index){
						if( index == 0 && "" == "<?=$word1?>" ){
							$(this).addClass('selected');
						}else if( $(this).attr('data-value') == "<?=$word1?>" ){
							$(this).addClass('selected');
						}else{
							$(this).removeClass('selected');
							$(this).find('span').remove();
						}
					})
				}

			});

		},
	});



})

</script>
