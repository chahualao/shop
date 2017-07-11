<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title><?php echo ($tpshop_config['shop_info_store_title']); ?></title>
    <meta http-equiv="keywords" content="<?php echo ($tpshop_config['shop_info_store_keyword']); ?>" />
	<meta name="description" content="<?php echo ($tpshop_config['shop_info_store_desc']); ?>" />
    <link href="/Public/static/vendor/mui/mui.min.css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="/Public/static/vendor/swiper/swiper.min.css"/>
    <link rel="stylesheet" type="text/css" href="/Public/static/mobile/css/public.css"/>

    <link href="/Public/static/mobile/css/homePage.css" rel="stylesheet" />
    <link rel="stylesheet" href="/Public/static/mobile/css/iconfont.css" />
    <link rel="stylesheet" href="/Public/static/vendor/dropload/dropload.css">
    <link rel="stylesheet" type="text/css" href="/Public/static/mobile/css/search.css"/>
<script src="http://apps.bdimg.com/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="/Public/static/vendor/mui/mui.min.js"></script>
<script src="/Public/static/vendor/swiper/swiper.min.js"></script>
<script src="/Public/static/vendor/dropload/dropload.min.js"></script>
<!-- <script src="/Public/static/vendor/layer/layer-min.js"></script> -->
<script src="/Public/static/mobile/js/common.js"></script>
<script src="/Public/static/mobile/js/public.js"></script>
</head>
<body>
<div id="wraper">
	<!--搜索框-->
	<div class="mui-input-row mui-search">
		<img src="/Public/static/mobile/images/search-logo.png" alt="" class="search-logo"/>
		<img src="/Public/static/mobile/images/searchicon.png" alt="" / class="search-icon">
	</div>
	<!--banner-->
	<div id="slider" class="mui-slider" >
	  <div class="mui-slider-group mui-slider-loop">
	    <!-- 额外增加的一个节点(循环轮播：第一个节点是最后一张轮播) -->
	    <div class="mui-slider-item mui-slider-item-duplicate">
	      <a href="<?php echo ($adv[2]['ad_link']); ?>" <?php if($adv[2]['target'] == 1): ?>target="_blank"<?php endif; ?> >
	        <img src="<?php echo ($adv[2]['ad_code']); ?>">
	      </a>
	    </div>
	    <?php if(is_array($adv)): foreach($adv as $k=>$v): ?><div class="mui-slider-item">
	      <a href="<?php echo ($v["ad_link"]); ?>" <?php if($v['target'] == 1): ?>target="_blank"<?php endif; ?> >
	        <img src="<?php echo ($v['ad_code']); ?>">
	      </a>
	    </div><?php endforeach; endif; ?>
	    <!-- 额外增加的一个节点(循环轮播：最后一个节点是第一张轮播) -->
	    <div class="mui-slider-item mui-slider-item-duplicate">
	      <a href="<?php echo ($adv[0]['ad_link']); ?>" <?php if($adv[0]['target'] == 1): ?>target="_blank"<?php endif; ?> >
	        <img src="<?php echo ($adv[0]['ad_code']); ?>">
	      </a>
	    </div>
	  </div>
	  <div class="mui-slider-indicator">
	    <div class="mui-indicator mui-active"></div>
	    <div class="mui-indicator"></div>
	    <div class="mui-indicator"></div>
	  </div>
	</div>
	<?php if(!empty($Groupon)): ?><!--左右滑动-->
	<div id="new-arrival" class="mui-text-center">
		<div class="new-arrival-inner">限时团购 <span class="new-arrival-span">|</span> <span class="new-arrival-span2">现代简约风</span></div>
		<div class="swiper-container">
	        <div class="swiper-wrapper">
	        	
	        	<?php if(is_array($Groupon)): foreach($Groupon as $k=>$v): ?><div class="swiper-slide">
	            	<div class="mui-text-center fl">
						<a href="<?php echo U('Activity/group',array('id'=>$v['goods_id']));?>"><img src="<?php echo (goods_thum_images($v["goods_id"],400,400)); ?>" alt="" /></a>
						<p class="swiper-wrapper-p1"><?php if($v['title'] != ''): echo ($v["title"]); else: echo ($v["goods_name"]); endif; ?></p>
						<p class="swiper-wrapper-p2"><?php echo ($v["price"]); ?> 元</p>
					</div>
	            </div><?php endforeach; endif; ?>
				
	        </div>
	   </div>
		<a href="<?php echo U('Activity/group_list');?>" class="new-arrival-a">查看所有团购></a>
	</div><?php endif; ?>

	<!--促销模块-->	
	<?php if(!empty($promotion)): ?><!--春季专场轮播-->
		<?php if(!empty($promotion[0])): ?><div class="mui-text-center" id="special-performance">
			<div class="new-arrival-inner"><?php echo ($promotion[0]['name']); ?> <span class="new-arrival-span">|</span> <span class="new-arrival-span2"><?php echo ($promotion[0]['sub_name']); ?></span></div>
			<div id="slider2" class="mui-slider" >
			  <div class="mui-slider-group mui-slider-loop">
			    
			    <?php if($promotion['goods_lists'][$promotion[0]['id']] != '' ): if(is_array($promotion['goods_lists'][$promotion[0]['id']])): foreach($promotion['goods_lists'][$promotion[0]['id']] as $k=>$v): ?><div class="mui-slider-item">
			      <a href="<?php echo U('Mobile/Goods/goodsInfo',array('id'=>$v['goods_id']));?>">
			        <img src="<?php echo (goods_thum_images($v["goods_id"],800,800)); ?>">
			      </a>
			    </div><?php endforeach; endif; endif; ?>
			    
			  </div>
			  <div class="mui-slider-indicator">
			   <?php if(is_array($promotion['goods_lists'][$promotion[0]['id']])): foreach($promotion['goods_lists'][$promotion[0]['id']] as $k=>$v): ?><div class="mui-indicator" style="margin:1px;"></div><?php endforeach; endif; ?>
			  </div>
			</div>
		</div><?php endif; ?>
		<?php if(!empty($promotion[1])): ?><!--新品上市-->
		<div id="new-arrival2" class="mui-text-center">
			<div class="new-arrival-inner"><?php echo ($promotion[1]['name']); ?> <span class="new-arrival-span">|</span> <span class="new-arrival-span2"><?php echo ($promotion[1]['sub_name']); ?></span></div>
			<div class="swiper-container">
		        <div class="swiper-wrapper">
		        	<?php if($promotion['goods_lists'][$promotion[1]['id']] != '' ): if(is_array($promotion['goods_lists'][$promotion[1]['id']])): foreach($promotion['goods_lists'][$promotion[1]['id']] as $k=>$v): ?><div class="swiper-slide">
		            	<div class="mui-text-center fl">
							<a href="<?php echo U('Mobile/Goods/goodsInfo',array('id'=>$v['goods_id']));?>">
							<img src="<?php echo (goods_thum_images($v["goods_id"],400,400)); ?>" alt="" /></a>
							<p class="swiper-wrapper-p1"><?php echo ($v["goods_name"]); ?></p>
							<p class="swiper-wrapper-p2">￥<?php echo ($v["shop_price"]); ?></p>
						</div>
		            </div><?php endforeach; endif; endif; ?>
		        </div>
		   </div>
			<a href="<?php echo U('Mobile/Goods/goodsList',array('is_new'=>1));?>" class="new-arrival-a">查看所有新品> </a>
		</div><?php endif; ?>
		<?php if(!empty($promotion[2])): ?><!--达人推荐-->
		<div class="recommend mui-text-center">
			<div class="new-arrival-inner"><?php echo ($promotion[2]['name']); ?> <span class="new-arrival-span">|</span> <span class="new-arrival-span2"><?php echo ($promotion[2]['sub_name']); ?></span></div>
			<div class="recommend-content">
				<div class="mui-slider" >
				  <div class="mui-slider-group">
				    <?php if($promotion['goods_lists'][$promotion[2]['id']] != '' ): if(is_array($promotion['goods_lists'][$promotion[2]['id']])): foreach($promotion['goods_lists'][$promotion[2]['id']] as $k=>$v): ?><div class="mui-slider-item">
				      <a href="<?php echo U('Mobile/Goods/goodsInfo',array('id'=>$v['goods_id']));?>">
			        	<img src="<?php echo (goods_thum_images($v["goods_id"],400,400)); ?>">
			      	  </a>
				    </div><?php endforeach; endif; endif; ?>
				    
				  </div>
				  <div class="mui-slider-indicator">
				  	<?php if(is_array($promotion['goods_lists'][$promotion[2]['id']])): foreach($promotion['goods_lists'][$promotion[2]['id']] as $k=>$v): ?><div class="mui-indicator"></div><?php endforeach; endif; ?>
				  </div>
				</div>
				<div class="describe">
					<p class="describe-title"><?php echo ($promotion['goods_lists'][$promotion[2]['id']][0]['goods_name']); ?></p>
					<p class="describe-content"><?php echo (htmlspecialchars_decode($promotion[2]['description'])); ?></p>
					<div class="describe-price-out">
						<p class="describe-price">￥<?php echo ($promotion['goods_lists'][$promotion[2]['id']][0]['shop_price']); ?></p>
						<a href="<?php echo U('Mobile/Goods/goodsInfo',array('id'=>$promotion['goods_lists'][$promotion[2]['id']][0]['goods_id']));?>"><div class="shop-buy">购买</div></a>
						<div class="shop-cart" onclick="AjaxAddCart(<?php echo ($promotion['goods_lists'][$promotion[2]['id']][0]['goods_id']); ?>,1,0);">加入购物车</div>
					</div>
				</div>
			</div>	
		</div><?php endif; endif; ?>

	<!--猜你喜欢-->	
	<div class="mui-text-center" style="background: #fbfbfb;">
		<div class="new-arrival-inner">猜你喜欢 <!-- <span class="new-arrival-span">|</span> <span class="new-arrival-span2">超高性价比</span> --></div>
	</div>
	<!--下拉刷新容器-->
	<div id="pullrefresh" class="mui-content ">
		<!--<div class="mui-scroll">-->
			<!--数据列表-->
			<div class="mui-table-view mui-table-view-chevron" style="margin-top: 0px;">
				<div class="content">
				    <div class="lists">
				    	<?php if($maybeyoulike != '' ): if(is_array($maybeyoulike)): foreach($maybeyoulike as $k=>$v): ?><div class="recommend-content">
							<div class="swiper-container2">
						       <div class="swiper-wrapper">
						        <?php $v_g_id = $v['goods_id']; $imglist = M('GoodsImages')->where("goods_id = '$v_g_id' ")->limit(3)->select(); ?>
						        <?php if(is_array($imglist)): foreach($imglist as $key=>$vo): ?><div class="swiper-slide">
						            	<a href="<?php echo U('Mobile/Goods/goodsInfo',array('id'=>$v_g_id));?>"><img src="<?php echo ($vo["image_url"]); ?>" ></a>
						            </div><?php endforeach; endif; ?>    
						        </div>
						        <!-- Add Pagination -->
						        <div class="swiper-pagination"></div>
						    </div>
						   	<div class="describe">
								<p class="describe-title"><?php echo ($v["goods_name"]); ?></p>
								<p class="describe-content">
								<?php echo ($v['goods_remark']); ?>
								</p>
								<div class="describe-price-out">
									<p class="describe-price">￥<?php echo ($v["shop_price"]); ?></p>
									<a href="<?php echo U('Mobile/Goods/goodsInfo',array('id'=>$v['goods_id']));?>"><div class="shop-buy">购买</div></a>
									<div class="shop-cart" onclick="AjaxAddCart(<?php echo ($v["goods_id"]); ?>,1,0);">加入购物车</div>
								</div>
							</div>
						</div><?php endforeach; endif; endif; ?>
				    </div>
				    <div>
						<!--<div > 加载更多 </div>-->  
						<div class="load-more" id="more" data="2">加载更多</div>
					</div>
				</div>
			</div>
		<!--</div>-->
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
</div>
<!-- 搜索 -->
<div class="search-content">
	<div class="search">
		<span class="mui-icon mui-icon-search" style="position: absolute;top: 4px;left: 10px;"
		onclick="if($.trim($('#q').val()) != '') $('#sourch_form').submit();"></span>
		<form id="sourch_form" name="sourch_form" method="post" action="<?php echo U('Goods/search');?>"><input type="search" name="q" id="q" value="<?php echo I('q'); ?>" style="padding-left: 40px;text-align: left;" placeholder="请输入关键词"/></form>
			
		<span class="cancel">取消</span>
		<span style="display:none;" class="searchIn" onclick="if($.trim($('#q').val()) != '') $('#sourch_form').submit();">搜索</span>
	</div>
	<div class="hot-search">
		<span>热门搜索</span>
		<ul>
			<?php if(is_array($tpshop_config["hot_keywords"])): foreach($tpshop_config["hot_keywords"] as $k=>$wd): ?><li><a href="<?php echo U('Goods/search',array('q'=>$wd));?>" <?php if($k == 0): ?>class="ht"<?php endif; ?>><?php echo ($wd); ?></a></li><?php endforeach; endif; ?> 
		</ul>
	</div>
</div>
</body>

<script>
//获得slider插件对象
var gallery = mui('#slider');
gallery.slider({
  interval:5000//自动轮播周期，若为0则不自动播放，默认为0；
});
//	swiper左右滑动
var swiper = new Swiper('.swiper-container', {
    slidesPerView: 'auto',
    spaceBetween: 10,
});
var swiper2 = new Swiper('.swiper-container2', {
    pagination: '.swiper-pagination',
    paginationClickable: true
});
$(function(){
	//猜你喜欢
	$("#more").bind('click',function(){
		$(this).html("加载中...");
		var page = parseInt($(this).attr('data'));
		$.ajax({  
		   type: "post",  
		   url: "<?php echo U('Index/getyoulikemore');?>",  
		   data: {p:page},  
		   dataType: "html",  
		   success: function (data) {  
		       if (data) {
		       	   $(".lists").append(data);   
		           $("#more").html("加载更多");
		           $("#more").attr('data',page+1);
		            //重新初始化slide
					var swiper2 = new Swiper('.swiper-container2',{
					        pagination: '.swiper-pagination',
					        paginationClickable: true
					    });
		       } else {  
		          $("#more").html("没有更多");   
		       }    
		   }  
		});
	})
	//搜索

})
</script>
</html>