<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="content-language" content="zh-cn" />
<meta name="renderer" content="webkit|ie-comp|ie-stand" />
<meta http-equiv="Cache-control" content="public" max-age="no-cache" />
<title>详情-<?php echo ($tpshop_config['shop_info_store_title']); ?></title>
<meta http-equiv="keywords" content="<?php echo ($tpshop_config['shop_info_store_keyword']); ?>" />
<meta name="description" content="<?php echo ($tpshop_config['shop_info_store_desc']); ?>" />
<link rel="stylesheet" type="text/css" href="/Template/pc/soubao/Static/css/help.css"/>
 
<!--[if lt IE 9]>
        <script src="js/html5.js"></script>
        <script src="js/ie9.js"></script>
        <link rel="stylesheet" type="text/css" href="css/ie.css"/>
        <![endif]-->
</head>
<body>
<!--------头部开始-------------->
<link href="/Template/pc/soubao/Static/css/common_www.css" rel="stylesheet" type="text/css" />
<link href="/Template/pc/soubao/Static/css/public.css" rel="stylesheet" type="text/css" />
<link href="/Template/pc/soubao/Static/css/default.css" rel="stylesheet" type="text/css" />
<link href="/Template/pc/soubao/Static/css/art_skin_order.css" rel="stylesheet" type="text/css" />
<link href="/Template/pc/soubao/Static/css/common.css" rel="stylesheet" type="text/css" />
<link href="/Template/pc/soubao/Static/css/message.index.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="/Template/pc/soubao/Static/css/minicart.css">
<script type="text/javascript" src="/Template/pc/soubao/Static/js/jquery-1.9.0.min.js"></script>
<script src="/Public/js/global.js"></script>
<!--[if lt IE 9]>
		<script src="js/html5.js"></script>
<![endif]-->
<style type="text/css">
#global-topbar .topbar-right #msg_center {
	background: none;
}
.topbar-right #msg_center .tips {
	position: absolute;
	left: -30px;
	top: 28px;
	min-width: 70px;
	max-width: 132px;
	height: 20px;
 *line-height: 19px;
	border-radius: 2px;
	padding: 0px 20px 0 10px;
	background: #666;
	color: #fff;/*display: none;*/
}
#msg_center .tips .tip-cnt {
	color: #fff;
	text-decoration: none;
}
#msg_center .tips .tip-cnt span {
	display: block;
	white-space: nowrap;
	overflow: hidden;
	text-overflow: ellipsis;
}
.tips .tip-t {
	position: absolute;
	left: 72px;
	top: -11px;
	width: 0;
	height: 0;
	font-size: 0;
	border-width: 6px;
	border-style: dashed dashed solid dashed;
	border-color: transparent transparent #666 transparent;
}
.tips .tip-times {
	position: absolute;
	display: block;
	right: 5px;
	top: 0px;
	font-size: 16px;
	font-style: normal;
	color: #bfb5b5;
	cursor: pointer;
}
.tips .tip-times:hover {
	color: #fff;
}
#global-topbar .topbar-right #msg_center .num {
	color: #f00;
}
#show_category {
	float:left
}
.catagories {
	display:none
}
#show_category:hover .catagories {
	display:block
}
.catagory-detail {
	display:none;
	min-height:456px
}
#global-nav .catagories li:hover {
	margin-right: -10px;
	color: #fff;
	background: #f22e00;
}
#global-nav .catagories li:hover h3 {
	color:#FFF
}
#global-nav .catagories li h3 a:hover {
	color:#FFF
}
ul.catagories li:hover:after {
	content:"";
	position:absolute;
	border-right:2px solid #f22e00;
	right:-2px;
	height:30px;
	z-index:199;
}
ul.catagories li:hover .catagory-detail {
	display:block
}
.icon-feiniu:before{
	content:'';
	background-image:none;
	display:none;
}
</style>
<div id="global-topbar">
  <div class="topbar-wrapper clearfix">
    <ul class="topbar-left">
      <li class="dropdown my-location">
        <span class="current-place"></span>
        <i class="icon-location icon-down"></i> </li>
    </ul>
    <ul class="topbar-right" id="topbar-right">
      <li id="wellcome_wording"><a href="<?php echo U('Home/user/index');?>"><?php echo ($user['nickname']); ?></a></li>
      <li id="link_signin" style="display: none;"></li>
      <?php if($user_id > 0): ?><li id="link_signup"><a href="<?php echo U('Home/user/logout');?>" class="signup target_no">[退出]</a></li><?php endif; ?>
      <li><a href="<?php echo U('Home/user/index');?>">我的TPshop</a></li>
      <li><a href="<?php echo U('Home/Article/detail',array('article_id'=>17));?>" target="_blank">帮助中心</a></li>
    </ul>
  </div>
</div>
<div class="wrapper clearfix" id="global-header">
  <div id="hd-banner" class="wrapper"> 
    <!--
		<a href="" target="_blank"><img src="/Template/pc/soubao/Static/images/201602261202471456459367_kk-0.jpg" width="1220" height="60" alt""></a>
	--> 
  </div>
  <div id="headerall" class="wrapper clearfix"> <a href="/" title="首页" class="logohref">
    <h1 id="hd-logo" class="icon-feiniu">
      <img src="<?php echo ($tpshop_config['shop_info_store_logo']); ?>"/>
    </h1>
    </a>
<!--搜索框-->
    <div id="hd-search">
      <div class="search-form">
		<form name="sourch_form" id="sourch_form" method="post" action="<?php echo U("/Home/Goods/search");?>">
		  <input type="text" data-role="input-search" autocomplete="off" class="search-keyword"  name="q" id="q" value="<?php echo ($_POST['search_key']); ?>" placeholder="搜索关键字"/>
          <button class="btn-search" type="submit"onclick="if($.trim($('#q').val()) != '') $('#sourch_form').submit();">搜索</button>
        </form>
      </div>
      <div class="hd-hot-keywords">
        <ul id="hotsearch">
        	<?php if(is_array($tpshop_config["hot_keywords"])): foreach($tpshop_config["hot_keywords"] as $k=>$wd): ?><li><a href="<?php echo U('Home/Goods/search',array('q'=>$wd));?>" <?php if($k == 0): ?>class="ht"<?php endif; ?>><?php echo ($wd); ?></a></li><?php endforeach; endif; ?>          
        </ul>
      </div>
    </div>
<!--搜索框  end -->    
    <!--鼠标移动上去 显示购物车-->
    <div id="hd-my-cart">
      <span class="icon-cart-gwc">
      <span class="quantity col888"><b><em class="cart_quantity"></em></b></span>
      </span>
      <p class="icon-cart-hd">我的购物车</p>
      <div id="show_minicart" style="display:none;">
            <?php if(count($cartList) == 0): ?><div id="content_test">
                  <div id="minicart" class="ui_poptip minicart minicartContent">
                    <div class="ui_poptip_container">
                      <div class="ui_poptip_arrow poptip_up"></div>
                      <div class="ui_poptip_content">
                        <span class="nop emptycart">购物车中没有TPshop商品哟！</span>
                      </div>
                    </div>
                  </div>
                </div>
            <?php else: ?>
                <div id="content_test">
                  <div class="ui_poptip minicart minicartContent" id="minicart">
                    <div class="ui_poptip_container">
                      <div class="ui_poptip_arrow poptip_up"></div>
                      <div class="ui_poptip_content">
                        <div class="mini_product">
                          <p class="mini_tit">最新加入商品</p>
                          <div class="cart_con js_cart_top">
                            <?php if(is_array($cartList)): foreach($cartList as $k=>$v): ?><div class="one_active js_camp_list">
                                <ul class="ul_product   js_cart_pro_list" cart_id="798325">
                                  <li><a class="pdetail" href=""><img src="<?php echo (goods_thum_images($v["goods_id"],60,60)); ?>">
                                    <p>
                                      <span class="name"><?php echo ($v[goods_name]); ?></span>
                                      <span class="price"><em class="symbol">¥</em><?php echo ($v[goods_price]); ?></span>
                                    </p>
                                    </a>
                                    <div class="mini_op">                                    
                                    <a class="delete js_delete" onclick="header_cart_del(<?php echo ($v["id"]); ?>);" href="javascript:void(0);">删除</a>
                                    </div>
                                  </li>
                                </ul>
                              </div><?php endforeach; endif; ?>
                          </div>
                          <div class="mini_total clearfix">
                            <p class="cart_num">共<span class="num" id="total_qty"><?php echo ($cart_total_price[anum]); ?></span>件商品</p>
                            <p class="cart_total">
                              <span class="tit">共计</span>
                              <span class="price"><em class="symbol">¥</em>
                              <span id="total_pay"><?php echo ($cart_total_price[total_fee]); ?></span>
                              </span>
                            </p>
                          </div>
                          <p class="cart_bot"><a class="cart_buy" href="<?php echo U('Home/Cart/cart');?>">去购物车结算</a></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div><?php endif; ?>       
      </div>
    </div>
    <!--鼠标移动上去 显示购物车 end--> 
  </div>
  <div id="header"></div>
</div>
<nav id="global-nav" class="clearfix">
  <div class="wrapper">
    <div id="show_category">
      <span class="catagories-title"><i class="icon"></i><a style="color:#fff;text-decoration:none;" href="javascript:void(0);" >全部商品分类</a></span>
      <ul class="catagories">
        <?php if(is_array($goods_category_tree)): foreach($goods_category_tree as $k=>$v): ?><li cate_id="C24640">
            <span class="icon-drink"></span>
            <h3 class="catagory"><a href="<?php echo U('Home/Goods/goodsList',array('id'=>$v[id]));?>"><?php echo ($v[name]); ?></a></h3>
            <div class="catagory-detail clearfix cate_loading">
              <div class="sub-item J_cate_item hide">
                <div class="col fl">
                  <?php if(is_array($v[tmenu])): foreach($v[tmenu] as $k2=>$v2): if(($k2 % 3) == 0): ?><dl class="fixed">
                        <dt> <a href="<?php echo U('Home/Goods/goodsList',array('id'=>$v2[id]));?>"><?php echo ($v2[name]); ?></a> </dt>
                        <dd>
                          <?php if(is_array($v2[sub_menu])): foreach($v2[sub_menu] as $k3=>$v3): ?><a href="<?php echo U('Home/Goods/goodsList',array('id'=>$v3[id]));?>"><?php echo ($v3[name]); ?></a><?php endforeach; endif; ?>
                        </dd>
                      </dl><?php endif; endforeach; endif; ?>
                </div>
                <div class="col fl">
                  <?php if(is_array($v[tmenu])): foreach($v[tmenu] as $k2=>$v2): if(($k2 % 3) == 1): ?><dl class="fixed">
                        <dt> <a href="<?php echo U('Home/Goods/goodsList',array('id'=>$v2[id]));?>"><?php echo ($v2[name]); ?></a> </dt>
                        <dd>
                          <?php if(is_array($v2[sub_menu])): foreach($v2[sub_menu] as $k3=>$v3): ?><a href="<?php echo U('Home/Goods/goodsList',array('id'=>$v3[id]));?>"><?php echo ($v3[name]); ?></a><?php endforeach; endif; ?>
                        </dd>
                      </dl><?php endif; endforeach; endif; ?>
                </div>
                <div class="col fl">
                  <?php if(is_array($v[tmenu])): foreach($v[tmenu] as $k2=>$v2): if(($k2 % 3) == 2): ?><dl class="fixed">
                        <dt> <a href="<?php echo U('Home/Goods/goodsList',array('id'=>$v2[id]));?>"><?php echo ($v2[name]); ?></a> </dt>
                        <dd>
                          <?php if(is_array($v2[sub_menu])): foreach($v2[sub_menu] as $k3=>$v3): ?><a href="<?php echo U('Home/Goods/goodsList',array('id'=>$v3[id]));?>"><?php echo ($v3[name]); ?></a><?php endforeach; endif; ?>
                        </dd>
                      </dl><?php endif; endforeach; endif; ?>
                </div>
                <div class="col brand fl">
                  <ul class="fixed">
                   <?php if(is_array($v["brand"])): $i = 0; $__LIST__ = $v["brand"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$br): $mod = ($i % 2 );++$i;?><li class="lst" <?php if(($mod) == "1"): ?>even<?php endif; ?>>
	                  	<a href="" target="_blank">
	                  	<img class="nav-prod" src="/Template/pc/soubao/Static/images/loading.gif" alt="" data-images="<?php echo ($br["logo"]); ?>" height="40" width="80"></a>
	                  </li><?php endforeach; endif; else: echo "" ;endif; ?> 
                  </ul>
                  <!--分类商品图片-->
                      <a class="ad mt15" href="<?php echo U('Home/Goods/goodsList',array('id'=>$v[id]));?>"> 
	                      <img src="<?php echo ($v[image]); ?>" height="150" width="210"> 
                      </a> 
                  <!--分类商品图片 end-->                     
                  </div>
              </div>
            </div>
          </li><?php endforeach; endif; ?>
      </ul>
    </div>
    <ul class="horizontal-nav">
      <li is_fresh="0"><a class="" href="/">
        <span>首页</span>
        <i class=""></i></a></li>
      <?php
 $md5_key = md5("SELECT * FROM `__PREFIX__navigation` where is_show = 1 ORDER BY `sort` DESC"); $result_name = $sql_result_v = S("sql_".$md5_key); if(empty($sql_result_v)) { $Model = new \Think\Model(); $result_name = $sql_result_v = $Model->query("SELECT * FROM `__PREFIX__navigation` where is_show = 1 ORDER BY `sort` DESC"); S("sql_".$md5_key,$sql_result_v,31104000); } foreach($sql_result_v as $k=>$v): ?><li is_fresh="0"> 
          <a <?php if($v[is_new] == 1): ?>target="_blank"<?php endif; ?>href="<?php echo ($v[url]); ?>" >
          <span><?php echo ($v[name]); ?></span>
          <i class=""></i> </a> </li><?php endforeach; ?>
    </ul>
  </div>
</nav>
<script>
/**
* 鼠标移动端到头部购物车上面 就ajax 加载
*/
// 鼠标是否移动到了上方
var header_cart_list_over = 0;
var cart_cn = getCookie('cn');
$("#hd-my-cart").hover(function(){
   $("#show_minicart").show(); // 显示购物车列表			
      if(header_cart_list_over == 1) return false;
       header_cart_list_over = 1;
   		$.ajax({
   			type : "GET",
   			url:"/index.php?m=Home&c=Cart&a=header_cart_list&template=header_cart_list2",//+tab,
   			success: function(data){	
   				//cart_cn = getCookie('cn');
   			 	$("#hd-my-cart > #show_minicart").html(data);							
   			}
   		});	
},function(){
	 (typeof(t) == "undefined") || clearTimeout(t); 	 
	 t = setTimeout(function () { 
			header_cart_list_over = 0; /// 标识鼠标已经离开	        
	  }, 2000);		
      $("#show_minicart").hide();//  隐藏购物车列表
});

$('.cart_quantity').html(cart_cn);

$(document).ready(function(){
	var cart_cn = getCookie('cn');
	$('.cart_quantity').html(cart_cn);
})
// ajax 删除购物车的商品
function header_cart_del(ids)
{
	$.ajax({
		type : "POST",
		url:"<?php echo U('Home/Cart/ajaxDelCart');?>",//+tab,
		data:{ids:ids}, // 
	    dataType:'json',		
		success: function(data){
		  // alert(data.msg);
		   if(data.status == 1)				
			{
				header_cart_list_over = 0; /// 标识鼠标已经离开
				$("#hd-my-cart > .icon-cart-hd").trigger('mouseenter');	 // 无法触发 hover 改为 trigger('mouseenter');//hover修改为mouseenter/mouseleave/mouseover/mouseout
			}
		}
	});
}
</script>
<!--------头部结束--------------> 
<!--E头部-->
<div style="clear: both; height:45px"></div>
<div id="pageContent" class="pageContent">
  <div class="hc-warp" id="page">  
    <div class="hc-crumbs"><a class="p-fb" href="" target="_blank">帮助中心</a>&gt; <a><?php echo ($cat_name); ?></a> </div>
    <div class="hc-column">
    <?php
 $md5_key = md5("select * from `__PREFIX__article_cat` where cat_id in(1,2,3,4,7)"); $result_name = $sql_result_v = S("sql_".$md5_key); if(empty($sql_result_v)) { $Model = new \Think\Model(); $result_name = $sql_result_v = $Model->query("select * from `__PREFIX__article_cat` where cat_id in(1,2,3,4,7)"); S("sql_".$md5_key,$sql_result_v,31104000); } foreach($sql_result_v as $k=>$v): ?><div class="hc-column-box">
        <h2><a href="" target="_self"><?php echo ($v[cat_name]); ?></a></h2>
        <ul>
         <?php
 $md5_key = md5("select * from `__PREFIX__article` where cat_id = $v[cat_id]"); $result_name = $sql_result_v2 = S("sql_".$md5_key); if(empty($sql_result_v2)) { $Model = new \Think\Model(); $result_name = $sql_result_v2 = $Model->query("select * from `__PREFIX__article` where cat_id = $v[cat_id]"); S("sql_".$md5_key,$sql_result_v2,31104000); } foreach($sql_result_v2 as $k2=>$v2): ?><li><a href="<?php echo U('Home/Article/detail',array('article_id'=>$v2[article_id]));?>"><?php echo ($v2[title]); ?></a></li><?php endforeach; ?> 
        </ul>
      </div><?php endforeach; ?>
    </div>
        <!--可编辑区域开始-->
    <div id="content"> <!--可编辑区域开始-->
      <div style="width: 1050px; overflow: hidden; font-family: Verdana,Helvetica; float: right;">
        <div style="border: 1px solid rgb(233, 234, 236); margin-bottom: 25px;">
          <h2 style="height: 34px; line-height: 34px; border-bottom-color: rgb(233, 234, 236); border-bottom-width: 1px; border-bottom-style: solid;"> <span style="color: rgb(60, 60, 60); padding-top: 4px; padding-bottom: 4px; padding-left: 10px; font-size: 14px; font-weight: bold; border-left-color: rgb(242, 46, 0); border-left-width: 3px; border-left-style: solid;"><?php echo ($article["title"]); ?></span></h2>
          <div style="padding: 20px 30px 0px; color: rgb(60, 60, 60); font-size: 12px;">
			   <?php echo (htmlspecialchars_decode($article["content"])); ?>
          </div>
        </div>
      </div>
      <!--可编辑区域结束--> </div>
    <!--可编辑区域结束-->  
    </div>
</div>
<div style="clear: both;"></div>
<footer>
  <div id="ft-service-infr"  class="move-down">
    <div class="wrapper">
      <dl class="contact-infr">
        <dd class="phone-num icon-phone"><i class="icon-tel"></i>客服电话</dd>
        <!--dd>CEO邮箱：<a href="mailto:ceo@feiyu.com" target="_blank">CEO@feiyu.com</a></dd-->
        <dd><a href="javascript:void(0);"><?php echo ($tpshop_config['shop_info_phone']); ?></a></dd>
      </dl>
     <?php
 $md5_key = md5("select * from `__PREFIX__article_cat` where cat_id in(1,2,3,4,7)"); $result_name = $sql_result_v = S("sql_".$md5_key); if(empty($sql_result_v)) { $Model = new \Think\Model(); $result_name = $sql_result_v = $Model->query("select * from `__PREFIX__article_cat` where cat_id in(1,2,3,4,7)"); S("sql_".$md5_key,$sql_result_v,31104000); } foreach($sql_result_v as $k=>$v): ?><dl class="nav-service">
        <dt><?php echo ($v[cat_name]); ?></dt>
        <?php
 $md5_key = md5("select * from `__PREFIX__article` where cat_id = $v[cat_id]"); $result_name = $sql_result_v2 = S("sql_".$md5_key); if(empty($sql_result_v2)) { $Model = new \Think\Model(); $result_name = $sql_result_v2 = $Model->query("select * from `__PREFIX__article` where cat_id = $v[cat_id]"); S("sql_".$md5_key,$sql_result_v2,31104000); } foreach($sql_result_v2 as $k2=>$v2): ?><dd><a href="<?php echo U('Home/Article/detail',array('article_id'=>$v2[article_id]));?>"><?php echo ($v2[title]); ?></a></dd><?php endforeach; ?>
      </dl><?php endforeach; ?>
    </div>
  </div>
  <div class="wrapper" id="global-footer" style="width: 100%;">
    <p class="copyright">Copyright © 2016-2025 <?php echo ($tpshop_config['shop_info_store_name']); ?>  版权所有 保留一切权利 备案号:<?php echo ($tpshop_config['shop_info_record_no']); ?></p>
    <dl class="authentic">
      <a target="_blank" href="" taregt="_blank"><dd class="sgs"></dd></a>
      <a target="_blank" href="" taregt="_blank"><dd class="zx110"></dd></a>
      <a target="_blank" href="" taregt="_blank"><img src="/Template/pc/soubao/Static/images/time_cnnic.jpg"></a>
      <a target="_blank" href="" taregt="_blank" class="aqlm"><img src="/Template/pc/soubao/Static/images/aqlm.jpg"></a>
    </dl>
  </div>
  <!-- /#global-footer --> 
</footer> 
</body>
</html>