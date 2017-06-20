$(function() {
	$(".litigation").addClass('button_color'); // 初始化时添加背景1
	$(".litigation").siblings('.non_litigation').click(function() {
		$(this).addClass('button_color');
		$(this).siblings('.litigation').removeClass('button_color')
	});
	$(".non_litigation").siblings('.litigation').click(function() {
		$(this).addClass('button_color');
		$(this).siblings('.non_litigation').removeClass('button_color')
	});

	$(".litigation").siblings(".non_litigation").click(function() {
		$('.about_us_img_content1').hide();
		$(".about_us_img_content2").show();
	});

	$(".non_litigation").siblings(".litigation").click(function() {
		$('.about_us_img_content1').show();
		$(".about_us_img_content2").hide();
	});
	
	
	$(".sy").addClass('button_color'); // 初始化时添加背景1
	$(".generalization_title ul li").siblings('.generalization_title ul li').click(function() {
		$(this).addClass('button_color');
		$(this).siblings('.generalization_title ul li').removeClass('button_color')
	});
	
	
	$(".sy").addClass('button_color'); // 初始化时添加背景1
	$(".classic_case_choose ul li").siblings('.classic_case_choose ul li').click(function() {
		$(this).addClass('button_color');
		$(this).siblings('.classic_case_choose ul li').removeClass('button_color')
	});
	
	$(".fixed").addClass('button_color'); // 初始化时添加背景1
	$(".union ul li").siblings('.union ul li').click(function() {
		$(this).addClass('button_color');
		$(this).siblings('.union ul li').removeClass('button_color')
	});
	
	
});









$(function() {
	$('.constitution_li').click(function() {
		if($('.constitution').is(':hidden')) {
			$('.constitution').show();
			$('.union_container').hide();
		} else { //否则  
			$('.union_container').hide();
		}
	})
});

$(function() {
	$('.application').click(function() {
		if($('.union_container').is(':hidden')) {
			$('.union_container').show();
			$('.constitution').hide();
		} else { //否则  
			$(".constitution").hide();
		}
	})
});

//$(function() {
//	$('.tr').click(function() {
//		if($('#commodity_order1').is(':hidden')) {
//			$('#commodity_order1').show();
//			$('.returns_btn3').show();
//			$('#commodity_order4').hide();
//			$('.total').hide();
//			$('#commodity_order3').hide();
//			$('.returns_btn2').hide();
//			$('.save1').hide();
//			$('.returns_btn1').hide();
//			$('.returns_btn4').hide();
//			$("#commodity_order2").hide();
//		} else { //否则  
//			$("#commodity_order2").hide();
//			$("#commodity_order3").hide();
//		}
//	})
//});
//
//$(function() {
//	$('.ii').click(function() {
//		if($('#commodity_order4').is(':hidden')) {
//			$('.returns_btn4').show();
//			$('.save1').show();
//			$('#commodity_order4').show();
//			$('.returns_btn2').hide();
//			$('.returns_btn1').hide();
//			$('.total').hide();
//			$('.returns_btn3').hide();
//			$("#commodity_order1").hide();
//			$("#commodity_order2").hide();
//			$("#commodity_order3").hide();
//		} else { //否则  
//			$("#commodity_order2").hide();
//			$('.commodity_order1').hide();
//			$("#commodity_order3").hide();
//			$('.returns_btn4').show();
//			$('.returns_btn2').hide();
//			$('.returns_btn1').hide();
//			$('.returns_btn3').hide();
//			$('#commodity_order4').show();
//		}
//});
