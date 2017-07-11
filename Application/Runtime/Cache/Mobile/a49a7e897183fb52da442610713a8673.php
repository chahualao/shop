<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html >
<html>
<head>
<meta name="Generator" content="TPSHOP v1.1" />
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<meta name="format-detection" content="telephone=no" />
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-touch-fullscreen" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="applicable-device" content="mobile">
<title><?php echo ($tpshop_config['shop_info_store_title']); ?></title>
<meta http-equiv="keywords" content="<?php echo ($tpshop_config['shop_info_store_keyword']); ?>" />
<meta name="description" content="<?php echo ($tpshop_config['shop_info_store_desc']); ?>" />
<meta name="Keywords" content="TPshop触屏版  TPshop 手机版" />
<meta name="Description" content="TPshop触屏版   TPshop商城 "/>
<link rel="stylesheet" href="/Template/mobile/new/Static/css/public.css">
<link rel="stylesheet" href="/Template/mobile/new/Static/css/user.css">
<script type="text/javascript" src="/Template/mobile/new/Static/js/jquery.js"></script>
<script src="/Public/js/global.js"></script>
<script src="/Public/js/mobile_common.js"></script>
<script type="text/javascript" src="/Template/mobile/new/Static/js/modernizr.js"></script>
<script type="text/javascript" src="/Template/mobile/new/Static/js/layer.js" ></script>
</head>

<link rel="stylesheet" href="/Public/static/mobile/css/iconfont.css" />
<link rel="stylesheet" href="/Public/static/vendor/mui/mui.min.css" />
<link rel="stylesheet" href="/Public/static/mobile/css/public.css" />
<script src="/Template/mobile/new/Static/js/common.js"></script>
<body>   
<style type="text/css">
.load-more {
    background: #4a4a4a;
    padding: 8px 10px;
    width: 100%;
    margin: 0 auto;
    font-size: 14px;
    text-align: center;
    line-height: 20px;
    color: #fff;
}
.load-more-out {
	margin: 0px 10px;
    margin-top: 10px;
}
</style>   
<header>
      <div class="tab_nav">
        <div class="header">
          <div class="h-left"><a class="sb-back" href="javascript:history.back(-1)" title="返回"></a></div>
          <div class="h-mid">我的评价</div>
          <div class="h-right">
            <aside class="top_bar">
              <div onClick="show_menu();$('#close_btn').addClass('hid');" id="show_more"><a href="javascript:;"></a> </div>
            </aside>
          </div>
        </div>
      </div>
</header>
<script type="text/javascript" src="/Template/mobile/new/Static/js/mobile.js" ></script>
<div class="goods_nav hid" id="menu">
      <div class="Triangle">
        <h2></h2>
      </div>
      <ul>
        <li><a href="<?php echo U('Index/index');?>"><span class="menu1"></span><i>首页</i></a></li>
        <li><a href="<?php echo U('Goods/categoryList');?>"><span class="menu2"></span><i>分类</i></a></li>
        <li><a href="<?php echo U('Cart/cart');?>"><span class="menu3"></span><i>购物车</i></a></li>
        <li style=" border:0;"><a href="<?php echo U('User/index');?>"><span class="menu4"></span><i>我的</i></a></li>
   </ul>
 </div> 
<div id="tbh5v0">
<div class="order">      
      <div class="Evaluation">
            <ul>
              <li><a href="<?php echo U('User/comment',array('status'=>-1));?>" class="tab_head <?php if($_GET[status] == -1): ?>on<?php endif; ?>" id="goods_ka1" onClick="setGoodsTab('goods_ka',1,3)">全部评价</a></li>
              <li><a href="<?php echo U('User/comment',array('status'=>0));?>" class="tab_head  <?php if($_GET[status] == 0): ?>on<?php endif; ?>" id="goods_ka2" onClick="setGoodsTab('goods_ka',2,3)">待评价</a></li>
              <li><a href="<?php echo U('User/comment',array('status'=>1));?>" class="tab_head  <?php if($_GET[status] == 1): ?>on<?php endif; ?>" id="goods_ka3" onClick="setGoodsTab('goods_ka',3,3)">已评价</a></li>
            </ul>
      </div>
	<div class="Emain" id="user_goods_ka_1" style="display:block;">
    <?php if(is_array($comment_list)): foreach($comment_list as $k=>$vo): ?><div class="pingjia">
          <h2>购买时间：<?php echo (date('Y-m-d H:i',$vo["add_time"])); ?></h2>
          <dl>
          <dt><img src="<?php echo (goods_thum_images($vo["goods_id"],200,200)); ?>"></dt>
          <dd><span><?php echo ($vo["goods_name"]); ?></span><strong>￥<?php echo ($vo["goods_price"]); ?></strong></dd>
          <dd>
          	<?php if($vo[is_comment] == 0): ?><a class="remark" href="<?php echo U('User/add_comment',array('rec_id'=>$vo[rec_id]));?>">评价订单</a>
          	<?php else: ?>
          	<a class="remark" href="<?php echo U('User/order_detail',array('id'=>$vo[order_id]));?>">查看订单</a><?php endif; ?>
          </dd>
          </dl>
		  <?php if($vo[is_comment] == 1): ?><div class="pj_main">
		       <ul>

		       		<li><em>评价：</em><img src="/Template/mobile/new/Static/images/stars<?php echo ($vo["goods_rank"]); ?>.png"></li>                
                    
		       		<li class="pj_w"><?php echo (htmlspecialchars_decode($vo["content"])); ?></li>
		       </ul>		
				<!--晒单-->
				<?php if($v['img'] != ''): ?><ul>
			       		<li><em>晒单：<?php echo ($vo["comment"]["title"]); ?></em></li>
			       		<li class="pj_w"><?php echo ($vo["comment"]["message"]); ?></li>
			       </ul>
			       <div class="sd_img">
			        <dl id="gallery">
					<?php if(is_array($vo['img'])): foreach($vo['img'] as $key=>$v2): ?><dd><a href="<?php echo ($v2); ?>"><img src="<?php echo ($v2); ?>" width="100px" heigth="100px"></a></dd><?php endforeach; endif; ?>
			        </dl>
			       </div><?php endif; ?>
				<!--管理员回复-->			
				<?php if(is_array($replyList)): foreach($replyList as $key=>$val): ?><ul style="border-top:1px dashed #e5e5e5; padding-top:8px; margin-top:10px">
				       <li><em style=" color:#F60">管理员<?php echo ($val["user_name"]); ?>回复：</em></li>
				       <li class="pj_w" style=" color:#F60; font-size:12px;"><?php echo ($val["content"]); ?></li>
				       </ul><?php endforeach; endif; ?> 
		  	</div><?php endif; ?>                
    </div><?php endforeach; endif; ?> 
</div>      
<?php if(!empty($comment_list)): ?><!--  <div id="getmore" style="font-size:.24rem;text-align: center;color:#888;padding:.25rem .24rem .4rem; clear:both">
  		<a href="javascript:void(0)" onClick="ajax_sourch_submit()">点击加载更多</a>
  </div>   -->
<!--   <div class="load-more-out" onclick="ajax_sourch_submit()">
				<div class="load-more" id="more" data-status="1">加载更多</div>
			</div> -->
			<?php if(count($comment_list)>=10){ ?>
			<div class="load-more-out" onclick="ajax_sourch_submit()">
				<div class="load-more" id="more" data-status="1">加载更多</div>
			</div>
			<?php } endif; ?> 
</div>
<script>
var  page = 1;
 /*** ajax 提交表单 查询订单列表结果*/  
 function ajax_sourch_submit()
 {	 	 	 
        page += 1;
		$.ajax({
			type : "GET",			
			url:"/index.php?m=Mobile&c=User&a=comment&status=<?php echo ($_GET['status']); ?>&is_ajax=1&p="+page,//+tab,
//			url:"<?php echo U('Mobile/User/comment',array('status'=>$_GET['status']),'');?>/is_ajax/1/p/"+page,//+tab,
//			data : $('#filter_form').serialize(),// 你的formid 搜索表单 序列化提交
			success: function(data)
			{
				if($.trim(data) == '')
					$('#getmore').hide();
				else
				    $("#user_goods_ka_1").append(data);
			}
		}); 
 } 
</script>

<script>
function goTop(){
	$('html,body').animate({'scrollTop':0},600);
}
</script>
<a href="javascript:goTop();" class="gotop"><img src="/Template/mobile/new/Static/images/topup.png"></a>
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
</html>