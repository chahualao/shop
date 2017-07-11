<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title><?php echo ($tpshop_config['shop_info_store_title']); ?>-<?php echo ($goodsCate['name']); ?></title>
	</head>
	<link href="/Public/static/vendor/mui/mui.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="/Public/static/mobile/css/iconfont.css" />
	<link rel="stylesheet" type="text/css" href="/Public/static/mobile/css/rehoming.css"/>
	<link rel="stylesheet" href="/Public/static/mobile/css/list.css" />
	<link rel="stylesheet" type="text/css" href="/Public/static/mobile/css/public.css"/>
	<script src="http://apps.bdimg.com/libs/jquery/2.1.1/jquery.min.js"></script>
<style type="text/css">
#goods_list{overflow: hidden;}
</style>
	<body>
		<header id="head_search_box" style="position: fixed; top: 0px; width: 100%; display: block;">
			<div class="search_header">
				<a href="javascript:history.back(-1)" class="back search_back"></a>
				<div class="search">
					<form name="sourch_form" id="sourch_form2" method="post" action="/index.php/Mobile/Goods/search.html">
						<div class="text_box" name="list_search_text_box" onclick="return 1;">
							<input type="text" class="text" name="q" id="keyword" value="" placeholder="搜索关键字">
						</div>
						<input type="button" value="" class="submit" onclick="if($.trim($('#keyword').val()) != '') $('#sourch_form2').submit();">
					</form>
				</div>
				<a class="menu filtrate" name="list_go_filter" style=" color:#666">筛选</a>
			</div>
			<!--<div style="height:51px;" class="empty_div">&nbsp;</div>-->
		</header>
		<section class="filtrate_term" id="product_sort" style="width: 100%; background: rgb(255, 255, 255); position: fixed; top: 51px; display: block;">
			<ul>
				<li class="<?php if(($_GET[sort] == '') or ($_GET[sort] == 'is_new')): ?>on<?php endif; ?>">
					<a href="<?php echo urldecode(U('Mobile/Goods/goodsList',array_merge($filter_param,array('sort'=>'is_new')),''));?>">最新<span class="arrow_up"></span><span class="arrow_down"></span></a>
				</li>
				<li class="<?php if($_GET[sort] == 'shop_price'): ?>on<?php endif; ?>">
					<a href="<?php echo urldecode(U('Mobile/Goods/goodsList',array_merge($filter_param,array('sort'=>'shop_price','sort_asc'=>$sort_asc)),''));?>">价格<span class="arrow_up"></span><span class="arrow_down"></span></a>
				</li>
				<li class="<?php if($_GET[sort] == 'sales_sum'): ?>on<?php endif; ?>">
					<a href="<?php echo urldecode(U('Mobile/Goods/goodsList',array_merge($filter_param,array('sort'=>'sales_sum')),''));?>">销量<span class="arrow_up"></span><span class="arrow_down"></span></a>
				</li>
				<li class="">
					<a  class="show_type  show_list">&nbsp;</a>
				</li>
			</ul>
		</section>
		<section class="content">
			<div class="touchweb-com_searchListBox" id="goods_list" style="margin-top: 10px;">
			<?php if(empty($goods_list)): ?><p>抱歉暂时没有相关结果，换个筛选条件试试吧</p>
  <?php else: ?> 
   <?php if(is_array($goods_list)): foreach($goods_list as $k=>$vo): ?><li>
					<a href="<?php echo U('Mobile/Goods/goodsInfo',array('id'=>$vo[goods_id]));?>" class="item">
						<div class="pic_box">
							<img src="<?php echo (goods_thum_images($vo["goods_id"],400,400)); ?>">
						</div>
						<div class="title_box"><?php echo ($vo["goods_name"]); ?></div>
						<div class="add_car_out">
							<div class="price_box">
								<span class="new_price"><i>￥<?php echo ($vo["shop_price"]); ?></i></span>
							</div>
							<div class="comment_box">已售<?php echo get_goods_sale_num($vo['goods_id']);?></div>
							<div class="add_car" onClick="AjaxAddCart(<?php echo ($vo[goods_id]); ?>,1,0);">加入购物车</div>								
						</div>		
					</a>
				</li><?php endforeach; endif; endif; ?>
			</div>
			<?php if(count($goods_list)>=10){ ?>
			<div class="load-more-out" onclick="ajax_sourch_submit()">
				<div class="load-more" id="more" data-status="1">加载更多</div>
			</div>
			<?php } ?>
		</section>
		<!-- <nav class="mui-bar mui-bar-tab">
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
</nav> -->
		<script>
var  page = 1;
 /*** ajax 提交表单 查询订单列表结果*/  
 function ajax_sourch_submit()
 {	 	 	 
        page += 1;
		$.ajax({
			type : "GET",
			url:"<?php echo urldecode(U('Mobile/Goods/goodsList',array_merge($filter_param,array('sort'=>$_GET[sort],'sort_asc'=>$_GET[sort_asc])),''));?>/is_ajax/1/p/"+page,//+tab,
//			data : $('#filter_form').serialize(),// 你的formid 搜索表单 序列化提交
			success: function(data)
			{
				if($.trim(data) == '')
					$('.load-more').html("没有更多"); 
				else
				    $("#goods_list").append(data);
			}
		}); 
 } 

  $(".show_type").click(function(){
            $("#goods_list").toggleClass("openList");
            $(".show_type").toggleClass("show_list");
        })
</script>
	</body>

</html>