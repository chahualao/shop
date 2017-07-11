<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title></title>
		<link rel="stylesheet" type="text/css" href="/Public/static/vendor/mui/mui.min.css" />
		<link rel="stylesheet" href="/Public/static/mobile/css/public.css" />
		<link rel="stylesheet" href="/Public/static/mobile/css/group_list.css" />
		<link rel="stylesheet" href="/Public/static/mobile/css/iconfont.css" />
		<script type="text/javascript" src="/Public/static/vendor/jquery/jquery-3.1.1.min.js"></script>
		<script type="text/javascript" src="/Public/static/vendor/mui/mui.min.js"></script>
		<script type="text/javascript" src="/Public/static/mobile/js/public.js"></script>
		<script >
var Tday = new Array();
var daysms = 24 * 60 * 60 * 1000
var hoursms = 60 * 60 * 1000
var Secondms = 60 * 1000
var microsecond = 1000
var DifferHour = -1
var DifferMinute = -1
var DifferSecond = -1

function clock11(key)
{
   var time = new Date()
   var hour = time.getHours()
   var minute = time.getMinutes()
   var second = time.getSeconds()
   var timevalue = ""+((hour > 12) ? hour-12:hour)
   timevalue +=((minute < 10) ? ":0":":")+minute
   timevalue +=((second < 10) ? ":0":":")+second
   timevalue +=((hour >12 ) ? " PM":" AM")
   var convertHour = DifferHour
   var convertMinute = DifferMinute
   var convertSecond = DifferSecond
   var Diffms = Tday[key].getTime() - time.getTime()
   DifferHour = Math.floor(Diffms / daysms)
   Diffms -= DifferHour * daysms
   DifferMinute = Math.floor(Diffms / hoursms)
   Diffms -= DifferMinute * hoursms
   DifferSecond = Math.floor(Diffms / Secondms)
   Diffms -= DifferSecond * Secondms
   var dSecs = Math.floor(Diffms / microsecond)
  
	if(convertHour != DifferHour) e="<span class=hour>"+DifferHour+"</span>天";
   if(convertMinute != DifferMinute) f="<span class=min>"+DifferMinute+"</span>时";
   if(convertSecond != DifferSecond) g="<span class=sec>"+DifferSecond+"</span>分";
     h="<span class=msec>"+dSecs+"</span>秒";
     if (DifferHour>0) {e=e}
     else {e=''}
     document.getElementById("jstimerBox"+key).innerHTML = e + f + g + h; 
}

</script>
<title>今日团购</title>
	</head>
<style>
	html,body{ 
margin:0px; 
height:100%; 
background: #fbfbfb;
} 
</style>
	<body>
		<div class="tab_nav">
			<div class="header">
				<div class="h-left">
					<a class="sb-back" href="javascript:history.back(-1)" title="返回"></a>
				</div>
				<div class="h-mid">今日团购</div>
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

		<ul class="product_list" id="good_list">
		<?php if(is_array($list)): foreach($list as $k=>$v): ?><li>
				<a class="url" href="<?php echo U('Activity/group',array('id'=>$v['goods_id']));?>">
					<img src="<?php echo (goods_thum_images($v["goods_id"],200,200)); ?>"> </a>
				<a href="<?php echo U('Activity/group',array('id'=>$v['goods_id']));?>" class="info_wrap">
					<div class="fn good"><?php echo ($v["goods_name"]); ?></div>
					<div class="price_wrap">
						<i class="discount" style="display:;"><?php $v_re = explode('.',$v['rebate']);echo str_replace('0','',$v_re[1]); ?>折</i> <span class="price" style="display:;">￥<?php echo ($v['price']); ?>元</span> <del class="old_price" style="display:;">￥<?php echo ($v['goods_price']); ?>元</del>
					</div>
					<div class="bottom_info">
						<span class="remain_num" style="display:;">已售<?php echo ($v['buy_num'] + $v['virtual_num']); ?>件</span>
						<span class="sg_g_time last_g_time" id="jstimerBox<?php echo ($v['goods_id']); ?>"></span>
					</div>
				</a>
			</li>
			<script>
			Tday['<?php echo ($v[goods_id]); ?>'] = new Date('<?php echo (date("Y/m/d H:i:s",$v["end_time"])); ?>');  
			window.setInterval(function()    
			{clock11('<?php echo ($v[goods_id]); ?>');}, 1000);  
			</script><?php endforeach; endif; ?>

			
		</ul>
		<div id="getmore" style="height: 60px;width: 100%;"></div>
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

</html>