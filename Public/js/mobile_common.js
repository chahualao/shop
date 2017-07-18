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
			   //重新获取购物车数量
			   $.ajax({
						type: "GET",
						url: "/index.php?m=Home&c=Cart&a=header_cart_list", //+tab,
						success: function(data) {
							cart_cn = Cookies.get('newcn');
							$('#tp_cart_info').html(cart_cn)
						}
					});
			    //cart_num = parseInt($('#tp_cart_info').html())+parseInt($('#number').val());
			    //$('#tp_cart_info').html(cart_num)
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
					     //重新获取购物车数量
					   $.ajax({
								type: "GET",
								url: "/index.php?m=Home&c=Cart&a=header_cart_list", //+tab,
								success: function(data) {
									cart_cn = Cookies.get('newcn');
									$('#tp_cart_info').html(cart_cn)
								}
							});
					    mui.alert(data.msg,'提示','确认',function(){},'div');
				    	//layer.open({content: data.msg,time: 1});
						return false;
				   }							   							   
            }
        });            
    }
}