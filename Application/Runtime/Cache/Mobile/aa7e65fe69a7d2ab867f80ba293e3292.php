<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title></title>
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
	<link rel="stylesheet" href="/Public/static/vendor/mui/mui.min.css" />
	<link rel="stylesheet" href="/Public/static/mobile/css/public.css" />
	<link rel="stylesheet" href="/Public/static/mobile/css/iconfont.css" />
	<link rel="stylesheet" href="/Public/static/mobile/css/collection.css" />
	<script type="text/javascript" src="/Public/static/vendor/jquery/jquery-3.1.1.min.js"></script>
	<script src="/Public/static/vendor/mui/mui.min.js"></script>
	<script type="text/javascript" src="/Public/static/mobile/js/public.js"></script>
</head>
<style>
	html,body{ 
margin:0px; 
height:100%; 
} 
</style>
<body>
	<div class="tab_nav">
		<div class="header">
			<div class="h-left">
				<a class="sb-back" href="javascript:history.back(-1)" title="返回"></a>
			</div>
			<div class="h-mid">我的收藏</div>
			<div class="h-right">
				<aside class="top_bar">
					<div id="show_more">
						<a href="javascript:;"></a>
					</div>
				</aside>
			</div>
		</div>
	</div>
	<!--顶部菜单-->
	<div class="goods_nav show" id="menu">
	<div class="Triangle">
		<h2></h2>
	</div>
	<ul>
		<li>
			<a href="<?php echo U('Mobile/Index/index');?>"><span class="menu1"></span><i>首页</i></a>
		</li>
		<li>
			<a href="<?php echo U('Mobile/Goods/categoryList');?>"><span class="menu2"></span><i>分类</i></a>
		</li>
		<li>
			<a href="<?php echo U('Mobile/Cart/cart');?>"><span class="menu3"></span><i>购物车</i></a>
		</li>
		<li style=" border:0;">
			<a href="<?php echo U('Mobile/User/index');?>"><span class="menu4"></span><i>我的</i></a>
		</li>
	</ul>
</div>
	
	<ul class="collection-ul">
		<?php if(empty($goods_list)): ?><li>您还没有任何收藏</li>
		<?php else: ?>
		<form name="theForm" method="post" action="">
		<?php if(is_array($goods_list)): foreach($goods_list as $key=>$goods): ?><li>
			<a href="<?php echo U('Goods/goodsInfo',array('id'=>$goods[goods_id]));?>"><img src="<?php echo (goods_thum_images($goods["goods_id"],400,400)); ?>" alt=""  class="collection-ul-img"/></a>
			<div class="collection-ul-div">
				<a href="<?php echo U('Goods/goodsInfo',array('id'=>$goods[goods_id]));?>"><p class="collection-ul-div-p1"><?php echo (getSubstr($goods["goods_name"],0,14)); ?></p></a>
				<p class="collection-ul-div-p2"><?php echo ($goods["shop_price"]); ?></p>
				<div class="collection-ul-innerdiv">
					<p class="collection-ul-div-p4" onclick="AjaxAddCart(<?php echo ($goods["goods_id"]); ?>,1);">购买</p>
					<p class="collection-ul-div-p3" onclick="delCollection(<?php echo ($goods[collect_id]); ?>)">删除</p>
				</div>
			</div>
		</li><?php endforeach; endif; ?>
		</form><?php endif; ?>
	</ul>
	
	<!--底部导航-->
	<nav class="mui-bar mui-bar-tab">
    <a class="<?php if(CONTROLLER_NAME == 'Index' and ACTION_NAME == 'index'): ?>mui-active<?php endif; ?>" style="padding-top: 4px;" href="<?php echo U('Mobile/Index/index');?>">
        <i class="icon iconfont icon-shouye-icon1"></i>
        <p class="mui-tab-label" style="margin-bottom: 0px;">首页</p>
    </a>
    <a class="<?php if(CONTROLLER_NAME == 'Goods' and ACTION_NAME == 'categoryList'): ?>mui-active<?php endif; ?>" style="padding-top: 4px;" href="<?php echo U('Mobile/Goods/categoryList');?>">
        <i class="icon iconfont icon-fenlei-icon"></i>
        <p class="mui-tab-label" style="margin-bottom: 0px;">分类</p>
    </a>
    <a class="<?php if(CONTROLLER_NAME == 'Cart' and ACTION_NAME == 'cart'): ?>mui-active<?php endif; ?>" style="padding-top: 4px;" href="<?php echo U('Mobile/Cart/cart');?>">
        <i class="icon iconfont icon-gouwuche-icon"></i>
        <p class="mui-tab-label" style="margin-bottom: 0px;">购物车</p>
    </a>
    <a class="<?php if(CONTROLLER_NAME == 'User' and ACTION_NAME == 'index'): ?>mui-active<?php endif; ?>" style="padding-top: 4px;" href="<?php echo U('Mobile/User/index');?>">
        <i class="icon iconfont icon-wode-icon1"></i>
        <p class="mui-tab-label" style="margin-bottom: 0px;">我的</p>
    </a>
</nav>
	<script type="text/javascript">
	/*mui框架初始化*/
	mui.init();
	//删除收藏
	function delCollection(collectid){
		mui.confirm('确定要删除收藏吗？','亲',['删除','取消'],function (e) {          
		    if(e.index==0){
		       if (collectid) {
					$.ajax({
						type : "GET",
				        url:"<?php echo U('User/ajax_cancel_collect');?>?collect_id="+collectid,
				        success: function(data){
				            if (!data.status) {
				            	mui.confirm(data.msg,'提示',['确定'],function(e){
							    	if (e.index == 0) {
							    		location.href = window.location.href;
							    	}
							    },'div');
				            }else{
				            	//成功则直接刷新
				            	location.href = window.location.href;
				            }
				        }
					})
				} 
		    }
		  },'div')
			
	}

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
	</script>
</body>
</html>