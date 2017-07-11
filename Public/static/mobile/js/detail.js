$(function(){
	$(".tag-click .mui-row div").click(function(){
		var x=$(".tag .mui-row div").index(this);
		$(".tag .mui-row li").eq(x).toggleClass("active");
	})
	$("#slider .mui-indicator").eq(0).addClass("mui-active");
})
