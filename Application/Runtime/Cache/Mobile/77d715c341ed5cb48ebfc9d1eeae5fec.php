<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>瑞和家商城</title>
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <link rel="stylesheet" type="text/css" href="/Public/static/vendor/mui/mui.min.css"/>
    <link rel="stylesheet" type="text/css" href="/Public/static/mobile/css/public.css"/>
    <link rel="stylesheet" type="text/css" href="/Public/static/mobile/css/rehoming.css"/>
</head>
<body style="background-color: #FBFBFB;">
	<header class="mui-bar mui-bar-nav pub-head">	<!--头部导航-->
        <a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left pub-head-back"></a>
        <h1 class="mui-title">我的订单</h1>
        <a class="mui-pull-right pub-head-more" id="show_more"></a>        	
    <!--顶部右边more下拉菜单-->
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
   	</header>   <!--头部导航结束--> 
   	<div class="my_pub-white-box">
		<ul class="itemtab-menu">
			<li class="<?php if($_GET[type] == ''): ?>item-active<?php endif; ?>"><a href="<?php echo U('/Mobile/User/order_list');?>">全部</a></li>
      <li class="<?php if($_GET[type] == 'WAITPAY'): ?>item-active<?php endif; ?>"><a href="<?php echo U('/Mobile/User/order_list',array('type'=>'WAITPAY'));?>">待付款</a></li>
      <li class="<?php if($_GET[type] == 'WAITSEND'): ?>item-active<?php endif; ?>"><a href="<?php echo U('/Mobile/User/order_list',array('type'=>'WAITSEND'));?>">待发货</a></li>
      <li class="<?php if($_GET[type] == 'WAITRECEIVE'): ?>item-active<?php endif; ?>"><a href="<?php echo U('/Mobile/User/order_list',array('type'=>'WAITRECEIVE'));?>">待收货</a></li>
      <li class="<?php if($_GET[type] == 'WAITCCOMMENT'): ?>item-active<?php endif; ?>"><a href="<?php echo U('/Mobile/User/order_list',array('type'=>'WAITCCOMMENT'));?>">已完成</a></li>
		</ul>			
   	</div>
    <form action="<?php echo U('Mobile/order_list/ajax_order_list');?>" name="filter_form" id="filter_form">
   	<ul class="itemlist" style="display: block;">
      <?php if(is_array($lists)): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><li class="itemlist-one mui-clearfix">
   			<div class="itemlist-bottom">
   				<img src="/Public/static/mobile/images/shop.png" style="width: 24px;" />
   				<span class="goods-caption">订单号:</span>
   				<strong class="goods-num" id="goods-num"><?php echo ($list["order_sn"]); ?></strong>
   				<img src="/Public/static/mobile/images/icoright.png" style="width: 20px; float: right;"/>
   			</div>
          <a href="<?php echo U('/Mobile/User/order_detail',array('id'=>$list['order_id']));?>">
        <?php if(is_array($list["goods_list"])): $i = 0; $__LIST__ = $list["goods_list"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$good): $mod = ($i % 2 );++$i;?><div class="itemlist-bottom mui-clearfix">
   				<div class="goods-img"><img src="<?php echo (goods_thum_images($good["goods_id"],200,200)); ?>"/></div>
   				<div class="itemlist-bottom-mid">
   					<p class="goods-name"><?php echo ($good["goods_name"]); ?></p>
   					<p class="goods-color"><?php echo ($good["spec_key_name"]); ?></p>
   				</div>
   				<div class="itemlist-bottom-r">
   					<p class="goods-cash-now">¥<span id="goods-cash-now"><?php echo ($good['member_goods_price']); ?></span></p>
   					<p class="goods-cash-old">¥<span id="goods-cash-old"><?php echo ($good['shop_price']); ?></span></p>
   					<p class="goods-amount">×<span id="goods-amount"><?php echo ($good['goods_num']); ?></span></p>
   				</div>
   			</div><?php endforeach; endif; else: echo "" ;endif; ?></a>
   			<div class="itemlist-bottom mui-clearfix">
   				<p class="goods-sum">共<span id="goods-amount"><?php echo (count($list["goods_list"])); ?></span>件商品实付:<span id="goods-cash-sum">¥<?php echo ($list['order_amount']); ?></span></p>
   			</div>
        <?php if($list["cancel_btn"] == 1): ?><input type="button" class="goods-btn" onClick="cancel_order(<?php echo ($list["order_id"]); ?>)" value="取消订单" /><?php endif; ?>
        <?php if($list["pay_btn"] == 1): ?><a href="<?php echo U('Mobile/Cart/cart4',array('order_id'=>$list['order_id']));?>">  
        <input type="button" class="goods-btn" value="立即付款" /></a><?php endif; ?>
        <?php if($list["receive_btn"] == 1): ?><a href="<?php echo U('Mobile/User/order_confirm',array('id'=>$list['order_id']));?>">  
        <input type="button" class="goods-btn" value="确认收货" /></a><?php endif; ?>
        <?php if($list["comment_btn"] == 1): ?><a href="<?php echo U('/Mobile/User/comment');?>">  
        <input type="button" class="goods-btn" value="评价订单" /></a><?php endif; ?>
        <?php if($list["shipping_btn"] == 1): ?><a href="<?php echo U('User/express',array('order_id'=>$list['order_id']));?>">  
        <input type="button" class="goods-btn" value="查看物流" /></a><?php endif; ?>

   		</li><?php endforeach; endif; else: echo "" ;endif; ?>
   	</ul>
    <!--查询条件-->
    <input type="hidden" name="type" value="<?php echo $_GET['type'];?>" />
    </form>
<script src="/Public/static/vendor/mui/mui.min.js" type="text/javascript" charset="utf-8"></script>    
<script src="/Public/static/vendor/jquery/jquery-3.1.1.min.js" type="text/javascript" charset="utf-8"></script>
<script src="/Public/static/mobile/js/public.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
  mui.init();/*mui框架初始化*/
  //取消订单
  function cancel_order(id){
  mui.confirm('确定要取消订单吗？','亲',['取消','确认'],function (e) {          
    if(e.index==1){
       location.href = "/index.php?m=Mobile&c=User&a=cancel_order&id="+id; 
    }
  },'div')
  }
</script>
</body>
</html>