/**通用js**/

/**
 * addcart 将商品加入购物车
 * @goods_id  商品id
 * @num   商品数量
 * @form_id  商品详情页所在的 form表单
 * @to_catr 加入购物车后再跳转到 购物车页面 默认不跳转 1 为跳转
 * layer弹窗插件请参考http://layer.layui.com/mobile/
 */
function AjaxAddCart(goods_id,num,to_catr)
{                                                
    //如果有商品规格 说明是商品详情页提交
    if($("#buy_goods_form").length > 0){        
        $.ajax({
            type : "POST",
            url:"/index.php?m=Home&c=Cart&a=ajaxAddCart",
            data : $('#buy_goods_form').serialize(),// 你的formid 搜索表单 序列化提交                        
			dataType:'json',
            success: function(data){	
				// 加入购物车后再跳转到 购物车页面
			    if(data.status < 0)
				{
					//layer.open({content: data.msg,time: 2});
					mui.alert(data.msg,'提示','确认',function(){},'div');
					return false;
				}
			   if(to_catr == 1)  //直接购买
			   {
				   location.href = "/index.php?m=Mobile&c=Cart&a=cart";   
			   }
			    cart_num = parseInt($('#tp_cart_info').html())+parseInt($('#number').val());
			    $('#tp_cart_info').html(cart_num)
			    /*layer.open({
			        content: '添加成功！',
			        btn: ['再逛逛', '去购物车'],
			        shadeClose: false,
			        yes: function(){
			            layer.closeAll();
			        }, no: function(){
			        	location.href = "/index.php?m=Mobile&c=Cart&a=cart";
			        }
			    });*/
			    mui.confirm('添加成功！','提示',['再逛逛', '去购物车'],function(e){
			    	if (e.index == 0) {
			    		location.href = window.location.href;
			    	}else{
			    		location.href = "/index.php?m=Mobile&c=Cart&a=cart";
			    	}
			    },'div');
            }
        });     
    }else{ //否则可能是商品列表页 、收藏页商品点击加入购物车
        $.ajax({
            type : "POST",
            url:"/index.php?m=Home&c=Cart&a=ajaxAddCart",
            data :{goods_id:goods_id,goods_num:num} ,
			dataType:'json',
            success: function(data){
				  
				   if(data.status == -1)
				   {
					    //layer.open({content: data.msg,time: 2});
						location.href = "/index.php?m=Mobile&c=Goods&a=goodsInfo&id="+goods_id;   
				   }
				   else
				   {  
					    if(data.status < 0)
						{	
							mui.alert(data.msg,'提示','确认',function(e){
								if (data.status = -101) {
									location.href="/index.php?m=Mobile&c=User&a=login";
								}
								
							},'div');
							//layer.open({content:data.msg, time:2});
							return false;
						}
					    cart_num = parseInt($('#tp_cart_info').html())+parseInt(num);
					    $('#tp_cart_info').html(cart_num)
					    mui.alert(data.msg,'提示','确认',function(){},'div');
				    	//layer.open({content: data.msg,time: 1});
						return false;
				   }							   							   
            }
        });            
    }
}

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
	$(".mui-icon-search").click(function(){
		$(".search-content").show();
	})
	$(".cancel").click(function(){
		$(".search-content").hide();
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