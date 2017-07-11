$(function(){
	//	头部栏目切换
	$(".h-mid li").click(function(){
		var x=$(".h-mid li").index(this);
		$(".content-out").hide();
		$(".content-out").eq(x).show();
		$(".h-mid li a").removeClass("on");
		$(".h-mid li a").eq(x).addClass("on");
	})
//	栏目切换	
	$("#show_more").on("click", function(e){
		menu();
	    $("body").one("click", function(){
	        $("#menu").hide();
	    });
	    e.stopPropagation();
	});
	$("#menu").on("click", function(e){
	    e.stopPropagation();
	});
	
//	搜索框的弹出
	$(".search-icon").click(function(){
		$(".search-content").show();
	})
	
	$(".search-content .search").bind('input propertychange', function() {
	    $(".cancel").remove();
	    $(".searchIn").show();
	   /* $(".search-content .searchIn").remove();
	    var x='<span class="searchIn" >搜索</span>';
	    $(".search-content .search").append(x);*/
	     var x=$(".searchInput").val();
	     if($(".searchInput").val()==""){
	    	 $(".search-content .searchIn").hide();
	    	 $(".search-content .search").append("<span class='cancel'>取消</span>");
	    }
	     $(".cancel").click(function(){
			$(".search-content").hide();
		})
	});
	$(".cancel").click(function(){
		$(".search-content").hide();
	})
	$(".recommend-content .mui-slider-indicator .mui-indicator").eq(0).addClass("mui-active");
    // 底部导航
    $(".mui-bar-tab a").click(function(){
    	var x=$(".mui-bar-tab a").index(this);
    	console.log(x);
    	$(".mui-bar-tab a").eq(x).addClass("mui-active");
    })
    
})
//栏目切换
function menu(){
	if($("#menu").css("display") == "none") {
		$("#menu").css('display', 'block');
	} else {
		$("#menu").css('display', 'none');
	}

}