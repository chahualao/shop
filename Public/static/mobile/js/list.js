$(function(){				
	initfun();	/*初始化*/
	$("#select-sign li").click(function(){	/*品牌按键*/
		$(this).toggleClass("active").siblings().removeClass("active")
	})				
	$("#select-cash li").click(function(){	/*价格按钮*/
		$(this).toggleClass("active").siblings().removeClass("active")
	})
	
	$("#select-tag li").click(function(){	/*标签按钮*/
		$(this).toggleClass("active").siblings().removeClass("active")
	})
	
	$(".pub-column-color li").click(function(){	/*颜色按钮*/
		$(this).toggleClass("mui-icon mui-icon-checkmarkempty a-color").siblings().removeClass("mui-icon mui-icon-checkmarkempty a-color");					
		colorfun();					
	})
	
	$("#select-class li").click(function(){	/*分类按钮*/
		$(this).toggleClass("active").siblings().removeClass("active");
		classfun();
	})
	
	$("#select-material li").click(function(){	/*材质按钮*/
		$(this).toggleClass("active").siblings().removeClass("active");
		materfun();
	})
	
	$("#select-style li").click(function(){	/*分类按钮*/
		$(this).toggleClass("active").siblings().removeClass("active");
		stylefun();
	})
	
	
	
//	筛选弹出
	$(".filtrate").click(function(){
		$("#screen-modal").show();
		$("body").addClass("oh");
	})
	var body_height=$(window).height();
	$("#_select").height(body_height-44);
//	筛选弹出 
$("#screen-modal .mui-pull-left").click(function(){
		$("#screen-modal").hide();
		$("body").removeClass("oh");
	})
})

function classfun(){	/*分类小预览*/
	$(".view-class").remove();
	$("#view-class").append('<span class="view-class"></span>');
	var mater = $("#select-class li.active").html();				
	$(".view-class").html(mater);
}

function materfun(){	/*材质小预览*/
	$(".view-material").remove();
	$("#view-material").append('<span class="view-material"></span>');
	var mater = $("#select-material li.active").html();				
	$(".view-material").html(mater);
}

function stylefun(){	/*风格小预览*/
	$(".view-style").remove();
	$("#view-style").append('<span class="view-style"></span>');
	var style1 = $("#select-style li.active").html();				
	$(".view-style").html(style1);
}


function colorfun(){	/*获取颜色选择的颜色值*/
	$(".view-color").remove("span");
	$("#view-color").append('<span class="view-color"></span>');
    var color = $(".a-color").css("background-color");
    $(".view-color").css('background',color);				   
}

function initfun(){	/*初始化*/
	$("#select-sign li").eq(0).addClass("active").siblings().removeClass("active");	/*品牌*/
	$("#select-cash li").eq(0).addClass("active").siblings().removeClass("active");	/*价格*/
	$("#select-tag li").eq(0).addClass("active").siblings().removeClass("active");	/*标签*/
	$(".mui-table-view li").eq(0).addClass("mui-active").siblings().removeClass("mui-active");
	$(".pub-column-color li").eq(0).addClass("mui-icon mui-icon-checkmarkempty a-color").siblings().removeClass("mui-icon mui-icon-checkmarkempty a-color");/*颜色*/
	colorfun();
	$("#select-class li").eq(0).addClass("active").siblings().removeClass("active");	/*分类*/
	classfun();
	$("#select-material li").eq(0).addClass("active").siblings().removeClass("active");	/*材质*/
	materfun();
	$("#select-style li").eq(0).addClass("active").siblings().removeClass("active");	/*风格*/
	stylefun();
}

function resetfun(){	/*重置*/
	$("#select-sign").find(".active").removeClass("active");
	$("#select-cash").find(".active").removeClass("active");
	$("#select-tag").find(".active").removeClass("active");
	$(".pub-column-color").find(".a-color").removeClass("mui-icon mui-icon-checkmarkempty a-color");
	$("#select-class").find(".active").removeClass("active");
	$("#select-material").find(".active").removeClass("active");
	$("#select-style").find(".active").removeClass("active");
	$(".view-class").remove();
	$(".view-material").remove();
	$(".view-style").remove();
	$(".view-color").remove();
}

function getSelect(sign,cash,tag,color,classs,material,stylee){
	//1.隐藏筛选
	var sign = $("#select-sign").find(".active").html();
	var cash = $("#select-cash").find(".active").html();
	var tag = $("#select-tag").find(".active").html();
	var color = $(".pub-column-color").find(".a-color").css("background-color");
	var classs = $("#select-class").find(".active").html();
	var material = $("#select-material").find(".active").html();
	var stylee = $("#select-style").find(".active").html();
	console.log(sign,cash,tag,color,classs,material,stylee);
	//2.获取所有的值
	
	//3.跳转List
//			location.href = '/index.php?m=Mobile&c=Goods&goodsList&brand='+brand_id+'2&color=#45455444.......';
//				
//				
//				return {brand:brand_val,color:}
}