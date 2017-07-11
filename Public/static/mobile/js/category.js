$(function(){
	$(".category-header i").click(function(){
		var x=$(".category-header i").index(this);
		$(".category-header i").removeClass("active");
		$(".category-header i").eq(x).addClass("active");
	})
	
	$(".category-header i").click(function(){
		var x=$(".category-header i").index(this);
		$(".tab-content").removeClass("active");
		$(".tab-content").eq(x).addClass("active");
	})
})
