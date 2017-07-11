<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>个人中心</title>
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
<link rel="stylesheet" href="/Public/static/vendor/mui/mui.min.css" />
<link rel="stylesheet" href="/Public/static/mobile/css/public.css" />
<link rel="stylesheet" href="/Public/static/mobile/css/iconfont.css" />
<link rel="stylesheet" type="text/css" href="/Public/static/mobile/css/my.css"/>
<script src="/Public/static/vendor/jquery/jquery.1.11.1.js"></script>
<script src="/Public/static/vendor/mui/mui.min.js"></script>
</head>
<body>
	<div class="my-content">
		<div class="my-content-title">
			<img src="/Public/static/mobile/images/my.jpg" alt="" class="my-content-title-img"/>
			<img src="<?php echo ((isset($user[head_pic]) && ($user[head_pic] !== ""))?($user[head_pic]):'/Template/mobile/new/Static/images/user68.jpg'); ?>" alt="" class="my-content-title-img2"/>
			<p class="my-content-Name"><?php echo ($user['nickname']); ?></p>
			<p class="my-content-integral">积分<?php echo ($user['pay_points']); ?>&nbsp;&nbsp;|&nbsp;&nbsp;余额¥<?php echo ($user['user_money']); ?></p>
			<a href="<?php echo U('Mobile/User/userinfo');?>" ><img src="/Public/static/mobile/images/SetUp.png" alt="" class="my-content-title-img3"/></a>
		</div>
		<ul class="mui-table-view my-Order">
		    <li class="mui-table-view-cell">
		        <a class="mui-navigate-right" href="<?php echo U('Mobile/User/order_list',array());?>" >我的订单<span class="check-order"> 查看全部订单</span></a>
		    </li>
		</ul>
		<ul class="documentary">
			 <a  href="<?php echo U('Mobile/User/order_list',array('type'=>'WAITPAY'));?>" ><li>
				<img src="/Public/static/mobile/images/Pendingpayment.jpg" alt="" />
				<p>待付款</p>
			</li></a>
			 <a  href="<?php echo U('Mobile/User/order_list',array('type'=>'WAITSEND'));?>" ><li>
				<img src="/Public/static/mobile/images/Waitingdelivery.jpg" alt="" />
				<p>待发货</p>
			</li></a>
			 <a  href="<?php echo U('Mobile/User/order_list',array('type'=>'WAITRECEIVE'));?>" ><li>
				<img src="/Public/static/mobile/images/Accountreceivable.jpg" alt="" />
				<p>待收货</p>
			</li></a>
			<a  href="<?php echo U('Mobile/User/order_list',array('type'=>'WAITCCOMMENT'));?>" ><li>
				<img src="/Public/static/mobile/images/completed.jpg" alt="" />
				<p>已完成</p>
			</li></a>
		</ul>
		<div class="line-1"></div>
		<ul class="mui-table-view my-Order2">
		    <li class="mui-table-view-cell">
		        <a href="<?php echo U('Mobile/User/account');?>" class="mui-navigate-right">我的钱包</a>
		    </li>
		    <li class="mui-table-view-cell">
		        <a href="<?php echo U('Mobile/User/points');?>" class="mui-navigate-right">我的积分</a>
		    </li>
		    <li class="mui-table-view-cell">
		        <a href="<?php echo U('Mobile/User/coupon');?>" class="mui-navigate-right">我的优惠券</a>
		    </li>
		    <!-- <li class="mui-table-view-cell">
		        <a href="<?php echo U('Mobile/User/membercenter');?>" class="mui-navigate-right">会员中心</a>
		    </li> -->
		    <li class="mui-table-view-cell">
		        <a href="<?php echo U('Mobile/User/collect_list');?>" class="mui-navigate-right">我的收藏</a>
		    </li>
		    <li class="mui-table-view-cell">
		        <a class="mui-navigate-right" href="tel:<?php echo ($tpshop_config['phone']); ?>">联系我们</a>
		    </li>
		</ul>
	</div>
	
	
	
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
</body>
<script>
</script>
</html>