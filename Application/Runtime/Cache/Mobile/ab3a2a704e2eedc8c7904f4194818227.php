<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title></title>
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
<link rel="stylesheet" type="text/css" href="/Public/static/vendor/mui/mui.min.css"/>
<link rel="stylesheet" href="/Public/static/mobile/css/public.css" />
<link rel="stylesheet" href="/Public/static/mobile/css/iconfont.css" />
<link rel="stylesheet" href="/Public/static/mobile/css/category.css" />
<link rel="stylesheet" href="/Public/static/mobile/css/category2.css">
<link rel="stylesheet" href="/Public/static/mobile/css/search.css" />
<script type="text/javascript" src="/Public/static/vendor/mui/mui.min.js"></script>
<script type="text/javascript" src="/Public/static/vendor/jquery/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="/Public/static/mobile/js/category.js"></script>
<script src="/Public/static/mobile/js/public.js"></script>
</head>
<body>
	<div class="content">
		<div class="category-header">
			<i class="active">品类</i>
			<i>品牌</i>
			<!-- <span class="mui-icon mui-icon-search"></span> -->
			<img src="/Public/static/mobile/images/searchicon.png" alt="" / class="search-icon">
		</div>
		<div class="tab-content tab-content2 active">
			<ul>
			<?php if(is_array($goods_category_tree)): foreach($goods_category_tree as $k=>$vo): if($vo[level] == 1): ?><li>
				<a href="<?php echo U('Mobile/Goods/goodsList',array('id'=>$vo['id']));?>"><img src="<?php echo ($vo["image"]); ?>" alt="" /></a>
			</li><?php endif; endforeach; endif; ?>
			</ul>
		</div>
		<div class="tab-content">
			<div id="letter" ></div>
			<div class="sort_box">
				<?php if(is_array($brand_list)): foreach($brand_list as $b_K=>$brand): ?><div class="sort_list">
					<a href="<?php echo U('Mobile/Goods/goodsList',array('brand_id'=>$brand['id']));?>"><div class="num_name"><?php echo ($brand['name']); ?></div></a>
				</div><?php endforeach; endif; ?>
			</div>
			<div class="initials">
				<ul>
					<li><img src="/Public/static/mobile/images/068.png"></li>
				</ul>
			</div>
		</div>
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
<script type="text/javascript" src="/Public/static/vendor/mailList/jquery.charfirst.pinyin.js"></script>
<script type="text/javascript" src="/Public/static/vendor/mailList/sort.js"></script>
</html>