<?php if (!defined('THINK_PATH')) exit();?><html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>瑞和家商城</title>
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <link rel="stylesheet" type="text/css" href="/Public/static/vendor/mui/mui.min.css"/>
    <link rel="stylesheet" type="text/css" href="/Public/static/mobile/css/public.css"/>
    <link rel="stylesheet" type="text/css" href="/Public/static/mobile/css/rehoming.css"/>
    <link rel="stylesheet" href="/Public/static/mobile/css/coupon.css" />
</head>
<body style="background-color: #FBFBFB;">
	<header class="mui-bar mui-bar-nav pub-head">	<!--头部导航-->
        <a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left pub-head-back"></a>
        <h1 class="mui-title">我的优惠券</h1>
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
   	
   	<div class="my_coupon">
   	    <div class="my_couponHead" style="right: 0;">
   	        <a class="<?php if($_GET[type] == 0): ?>action<?php endif; ?>" href="<?php echo U('User/coupon',array('type'=>0));?>">未使用</a>
   	        <a class="<?php if($_GET[type] == 1): ?>action<?php endif; ?>" href="<?php echo U('User/coupon',array('type'=>1));?>">已使用</a>
   	        <a class="<?php if($_GET[type] == 2): ?>action<?php endif; ?>" href="<?php echo U('User/coupon',array('type'=>2));?>">已过期</a>
   	    </div>
   	    <div class="coupon-content">
   	        <div id="item1" >
   	            <ul class="mui-table-view">
                  <?php if(is_array($coupon_list)): $i = 0; $__LIST__ = $coupon_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$coupon): $mod = ($i % 2 );++$i;?><li>
   	                	<img src="/Public/static/mobile/images/coupon.png" alt="" />
   	                	<p class="coupon-money"><?php echo ($coupon["money"]); ?></p>
   	                	<p class="coupon-money4">VIP&nbsp;优惠劵</p>
   	                	<p class="coupon-money2">满<?php echo ($coupon["condition"]); ?>可以使用</p>
   	                	<p class="coupon-money3">有效期:<span><?php echo (date('Y-m-d H:i:s',$coupon["use_end_time"])); ?></span></p>
   	                </li><?php endforeach; endif; else: echo "" ;endif; ?>
   	            </ul>
   	        </div>
   	    </div>
   	</div>


	<script src="/Public/static/vendor/mui/mui.min.js" type="text/javascript" charset="utf-8"></script>    
    <script src="/Public/static/vendor/jquery/jquery-3.1.1.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="/Public/static/mobile/js/public.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript">
    mui.init();/*mui框架初始化*/

	</script>
	</body>
</html>