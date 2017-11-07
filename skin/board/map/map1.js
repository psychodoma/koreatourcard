$(function () {




  var lang = $('.lang').attr('valLang');

  //if(lang){
    if(lang == "ko_KR"){
      t_lang = "ko";
    }else if(lang == "en_US"){
      t_lang = "en";
    }else if(lang == "zh_CN"){
      t_lang = "ch1";
    }else if(lang == "zh_TW"){
      t_lang = "ch2";
    }else if(lang == "ja_JP"){
      t_lang = "ja";
    }else{
      t_lang = "ko";
    }
  //}




  $('.service_val').each(function (index) {
    $th = $(this);
    if($(this).attr('val')){
      $len = $(this).attr('val').split(',').length - 1;
      $str = "<ul>";
      $(this).attr('val').split(',').forEach(function (element, index) {
        $str += "<li><img src='/" + $('.service_img_src_' + element).attr('val') + "'></li>";
        if ($len == index) {
          $str += "</ul>";
        }
      });
      $th.append($str);
    }
  })

  $('.service_val2').each(function (index) {
    $th = $(this);
    if($(this).attr('val')){
      $len = $(this).attr('val').split(',').length - 1;
      $(this).attr('val').split(',').forEach(function (element, index) {
        $str += "<li><img src='/" + $('.service_img_src_' + element).attr('val') + "'></li>";
        if ($len == index) {
        }
      });
      $th.append($str);
    }
  })

  $('.info_focus').click(function () {
    var lats = parseFloat($(this).attr('valInfoLat')) + 0.00057;
    var lngs = parseFloat($(this).attr('valInfoLng')) - 0.00009;
    resetPositon({ lat: lats, lng:lngs }  ,  $(this).attr('valInfoName' + t_lang) ,  parseInt($(this).attr('valCnt')) , $(this).attr('valLink')  );
  })



  $('.info_option').each(function () {
    var option = $(this).attr('val');
    $('.option_ck').each(function () {
      var option1 = $(this).attr('value');
      var op = $(this);
      if (option == option1) {
        op.attr('checked', 'checked');
      }
    })
  })



  $('.page').click(function () {
    var url = $('.url').attr('valUrl');
    var true_url = url.split('&currentPage');
    if ($(this).attr('id') == "first") {
      location.href = true_url[0] + '&currentPage=1';
    } else if ($(this).attr('id') == "last") {
      var last = $('.map_info').attr('valTotalpage');
      location.href = true_url[0] + '&currentPage=' + last;
    } else {
      location.href = true_url[0] + '&currentPage=' + $(this).attr('val');
    }
  })


  $('#Address_D').change(function () {
    jQuery.ajax({
      type: "POST",
      url: "../skin/board/map/juso/2.php",
      data: "Name=" + $(this).val(),
      success: function (msg) {
        $('#Address_S').html(msg);
      },
    });
  });

 $('.search_btn_address').click(function(){
   if($('.Address_D').val() == ""){
      alert('검색 조건을 선택하세요.');
      return false;
   }else{
      $('#tab2_word').attr('value',$('.Address_D').val());
      $('#tab2_word1').attr('value',$('.Address_S').val());
      return true;
   }
   
 })


  $('#tab-1').click(function () {
    location.href = "/map/map_shop.php?lang=" + $('.lang').attr('valLang');
  })

  $('#tab-2').click(function () {
    location.href = "/map/map_local.php?lang=" + $('.lang').attr('valLang');
  })



  $('.search-btn').click(function () {
    $('#word').attr('value', $('.Address_D').val() + ' ' + $('.Address_S').val());
  })

  $('#search_btn').click(function () {
    $('.option_ck').each(function(){
        $(this).remove();
    })
  })

  // $('.newimg').each(function () { new
  //   if($(this).attr('valNewimg') != '0'){
  //     //$('#'+$(this).attr('valName')).append('<img src="new">');
  //     $('#'+$(this).attr('valName')).append(' <span style="color:red; font-size:8px;">&nbsp;NEW</span>');
  //   }

  // })


$('#btnPrint').click(function(){
  $('.tabContents1').printThis({
    debug: false,
    importCss: true,
    printContainer:true,
    loadCSS: "/tmpl/theme_basic/css/sub.css",
    pageTitle:"",
    removeInline:false 
  })
})

$('.popBtn2').click(function(){
  $('.Address_D').remove();
  $('.Address_S').remove();
  $('#word').remove();  
})






});










