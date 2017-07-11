<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>个人中心-我的钱包</title>
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <link rel="stylesheet" type="text/css" href="/Public/static/vendor/mui/mui.min.css"/>
    <link rel="stylesheet" type="text/css" href="/Public/static/mobile/css/public.css"/>
    <link rel="stylesheet" type="text/css" href="/Public/static/mobile/css/rehoming.css"/>
</head>
<body style="background-color: #FBFBFB;">
	<header class="mui-bar mui-bar-nav pub-head">	<!--头部导航-->
        <a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left pub-head-back"></a>
        <h1 class="mui-title">资金管理</h1>
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
   	
  
   	
  	<div class="my_pub-white-box1">
		<ul class="itemtab-menu2">
			<li><a href="<?php echo U('Mobile/User/account',array('cattype'=>'chongzhi'));?>" class="a1 <?php if($_GET[cattype] == ''): ?>anav-active<?php endif; ?> <?php if($_GET[cattype] == 'chongzhi'): ?>anav-active<?php endif; ?>">账户余额</a></li>
			<li><a href="<?php echo U('Mobile/User/account',array('cattype'=>'daikuan'));?>" class="a2 <?php if($_GET[cattype] == 'daikuan'): ?>anav-active<?php endif; ?>">贷款余额</a></li>
		</ul>
		<div class="money-info">
			<!--根据类型提取-->
	   		<div class="money-info-loan" style="display: block">
	   			账户余额<span id="account-balance" class="balance"><?php echo ($user['user_money']); ?>元</span>
	   		</div>
   		</div>
   	</div>
   	
   	
   	
	<ul class="consumerinfobox">
		<?php if(is_array($account_log)): foreach($account_log as $k=>$item): ?><a class="a-purseone">
			<li class="consumerone account-list" style="display: block;">
				<div class="litop">
					<span>金额:</span><span id="consumer-money" style="color: #e41735;"><?php echo ($item["user_money"]); ?></span>
					<img src="/Public/static/mobile/images/icoright.png" style="width: 20px; float: right;"/>
				</div>
				<p id="consumer-datatime"><?php echo (date('Y-m-d H:i:s',$item["change_time"])); ?></p>
				<p class="consumer-info">				
					账户余额支付:<span id="consumer-info"><?php echo ($item["desc"]); ?></span>				
				</p>
			</li>
		</a><?php endforeach; endif; ?>
	</ul>
	
	<div class="btnbox2" style="display: block">
		<input type="button" name="" id="txbtn" value="提现" />
		<input type="button" name="" id="czbtn" value="充值" />
	</div>
   	
   	 <div class="gotop">
   		<img src="/Public/static/mobile/images/gotop.png"/>
   	</div>
   	
   	<script src="/Public/static/vendor/mui/mui.min.js" type="text/javascript" charset="utf-8"></script>    
    <script src="/Public/static/vendor/jquery/jquery-3.1.1.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="/Public/static/mobile/js/public.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript">
    	mui.init();/*mui框架初始化*/
   
	$(function(){
	  
	   $(window).scroll(function (){			
			var b = $(window).scrollTop();
			if(b>0){
				$(".gotop").stop().fadeIn('fast');
			}
			else{
				$(".gotop").stop().fadeOut('fast');
			}   	
	   })

	   $(".gotop").click(function(){
	   		$('html,body').animate({scrollTop: '0px'},400); 
	   })
	   
	})
   
   </script>
	</body>
</html>