
//����� �޴�
$(function(){
	$(".allmenuIn,#m_search,.search_bg,.submenuShadow").height($(document).height());
	
	$("#open_btn").click(function(){
		$(".allmenu").animate({marginLeft:-255+"px"},500); /*0�� �ӵ� 50�� �ӵ���*/ /*�޴��� ���������� width��*/
	})
	$("#close_btn").click(function(){
		$(".allmenu").animate({marginLeft:65+"px"},500); /*0�� �ӵ� 50�� �ӵ���*/ /*�޴��� �ٽ� ���� width��*/
	})
	$("#black_bg").click(function(){
		$(".allmenu").animate({marginLeft:65+"px"},500); /*0�� �ӵ� 50�� �ӵ���*/ /*�޴��� �ٽ� ���� width��*/
	})
	
	/*
	$(".sub_ul").hide();
	$(".small_menu").click(function(){
		var class_name = $(this).attr("class");
		var class_name_arr = class_name.split(" ");
		var menu_number = class_name_arr[0];
		$("#" + menu_number).slideToggle();
		$(this).toggleClass("sub_active")
			.siblings(".sub_ul").removeClass("sub_active");
	})
	*/
})

$(document).ready(function(){
	$(".drop").click(function(){
		var thisel = $(this).parent().find(".sssub").css("display");
			$(".drop").each(function(){
				var thatel = $(this).parent().find(".sssub").css("display");
				if(thisel != thatel){
				$(this).parent().find(".sssub").hide();
				}
			});
			$(this).parent().find(".sssub").fadeToggle("fast");			

		return false;
	});
});




$(function(){
	// Ŭ���� ����
	/*
	$("#navigation").find(".drop").mouseover(function(){
		$(this).css("color","#70bb2b")
		mouse_over_fn()
	})
	$("#navigation").find(".drop").mouseout(function(){
		$(this).css("color","#fff")
		mouse_out_fn()
	})
	$("#navigation").find(".dr_sub").mouseover(function(){
		var index_of_num=$(this).parent().index(".sssub")		//.sub????? ?? ???????? ???��???? ?????? ????
		$("#navigation").find(".drop").eq(index_of_num).css("color","#70bb2b")
		$(this).css("color","#F00")
		mouse_over_fn()
		
	})
	$("#navigation").find(".dr_sub").mouseout(function(){
		var index_of_num=$(this).parent().index(".sssub")		//.sub????? ?? ???????? ???��???? ?????? ????
		$("#navigation").find(".drop").eq(index_of_num).css("color","#fff")
		$(this).css("color","#000")
		mouse_out_fn()
	})
	*/

	
	//Ŭ���� ������ ����
	$("#navigation .navigation_list li.b_sub .drop").click(function(){

		var ck = $(this).hasClass('naviClick');
		
		var class_name = $(this).attr("class"); 
		var class_name_arr = class_name.split(" ");
		var menu_number = class_name_arr[0];
		$("#" + menu_number).slideToggle();
		

		$('.drop').each(function(){
			$(this).removeClass("naviClick");
			//$(this).toggleClass("naviClick").siblings("#navigation .navigation_list li.b_sub .drop").removeClass("naviClick");
		})
				
		$(this).toggleClass("naviClick").siblings("#navigation .navigation_list li.b_sub .drop").removeClass("naviClick");

		

		if(ck){
			$('.drop').each(function(){
				$(this).removeClass("naviClick");
				//$(this).toggleClass("naviClick").siblings("#navigation .navigation_list li.b_sub .drop").removeClass("naviClick");
			})	
		}

	})
})





$(document).ready(function(){
	
	$(".Sub_pgMenu ul").hide();
	$(".Sub_pgMenu .submenu a").click(function() {
		$(this).next(".Sub_pgMenu ul").slideToggle();
		$(this).children('span').addClass('subNavi_active');
		$(this).toggleClass("subNavi_active")
				.siblings(".Sub_pgMenu .submenu a .sna_icon").removeClass("subNavi_active");
		});

	
});


$(function(){
	var first = false;

	$('.sb_link').click(function(){
		if($('.submenuShadow').css('display') == "block"){
			$('.submenuShadow').css('display','none');	
		}else{
			$('.submenuShadow').css('display','block');
		}

		var ck = $(this).hasClass('subNavi_active');

		if(!ck){
			//alert($('.submenuShadow').css('display'));
			$(this).children('span').removeClass("subNavi_active");
		}

	})
})


/*
$(document).ready(function(){
	$(".Sub_pgMenu .SCmenu1 a").click(function(){
		var thisel = $(this).parent().find(".Sub_pgMenu ul").css("display");
			$(".Sub_pgMenu .SCmenu1 a").each(function(){
				var thatel = $(this).parent().find(".Sub_pgMenu ul").css("display");
				if(thisel != thatel){
				$(this).parent().find(".Sub_pgMenu ul").hide();
				}
			});
			$(this).parent().find(".Sub_pgMenu ul").fadeToggle();			

		return false;
	});
});
*/

			


function potfol_fn()
{
	$("#black_bg").css("display","block");	
}

function potfol_close()
{	
	$("#black_bg, .sssub").css("display","none");	
}



function search_fn()
{
	$(".search_bg").css("display","block");	
}

function search_close()
{	
	$(".search_bg").css("display","none");	
}







/*ž ��ũ��*/
$(document).ready(function(){ 
    $('.top_btn a').click(function(){ 
        $("html, body").animate({ scrollTop: 0 }, 200); 
        return false; 
    }); 
});

















//��
$(document).ready(function(){
	$(".tabContents,.tabContents1,.tabContents2,.tabContents3").hide(); // Hide all tab content divs by default
	$(".tabDetails,.tabDetails1").each(function(index){
		$(this).find(".tabContents:first,.tabContents1:first,.tabContents2:first,.tabContents3:first").show();
	});
	
	$(".tab_link").click(function(){ 
		var activeTab = $(this).attr("href"); 
		//$(this).removeClass("active"); 
		$(this).parent().parent().find("li a").removeClass("active")
		$(this).addClass("active"); 
		$(this).parent().parent().siblings("div").find(".tabContents,.tabContents1,.tabContents2,.tabContents3").hide();
		//$(".tabContents").hide();
		$(activeTab).fadeIn(); 
		
		return false; 
	});
});