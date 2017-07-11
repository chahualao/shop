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
        <h1 class="mui-title">管理收货地址</h1>
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
    </header>
    <div style="margin-top: 54px;"></div>
    <?php if(is_array($lists)): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><div class="my_pub-address">	
    	<div class="my_pub-address-top">
    		<span class="my_pub-address-top-l"><?php echo ($list["consignee"]); ?></span>
    		<span class="my_pub-address-top-r"><?php echo ($list["mobile"]); ?></span>
    	</div>
    	<div class="my_pub-address-mid">
    		<?php echo ($region_list[$list['province']]['name']); ?>，<?php echo ($region_list[$list['city']]['name']); ?>，<?php echo ($region_list[$list['district']]['name']); ?>，<?php echo ($list["address"]); ?>
    	</div>	
    	<div class="my_pub-address-foot">
    		<div class="my_pub-address-foot-l">
    		    <label>
    		    	<input name="address" type="radio" onclick="setDefault(<?php echo ($list["address_id"]); ?>)" <?php if($list[is_default] == 1): ?>checked><i>√</i><span>默认地址</span><?php else: ?>><i>√</i><span>设为默认</span><?php endif; ?>
    		    </label>    		    
    		</div>
    		<div class="my_pub-address-foot-r">
    		    <a href="<?php echo U('/Mobile/User/edit_address',array('id'=>$list[address_id],'source'=>$_GET['source']));?>">编辑</a>
    		    <a class="addressDel" href="javascript:;" onclick="delAddress(<?php echo ($list["address_id"]); ?>);">删除</a>    		    
    		</div>
    	</div>
    </div><?php endforeach; endif; else: echo "" ;endif; ?>

    <a href="<?php echo U('/Mobile/User/add_address',array('source'=>$_GET['source']));?>">
    	<input type="button" class="btn_black_center btn_address" value="添加新地址" />
    </a>
    
    <script src="/Public/static/vendor/mui/mui.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="/Public/static/vendor/jquery/jquery-3.1.1.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="/Public/static/mobile/js/public.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript">
    mui.init()    
   //删除地址
   function delAddress(id){
        mui.confirm('确定要删除该地址吗？','亲',['取消','确认'],function (e) {
                
                if(e.index==1){
                    location.href="<?php echo U('Mobile/User/del_address');?>?id="+id;
                }
            },'div')
   }
   //设置为默认地址
   function setDefault(id){
    var a =$("input[name='address']").index(this);
    $("input[name='address']").removeAttr('checked','checked');
    $(this).attr('checked','checked');
    $("label").find("span").html("设为默认");   
    $("label").eq(a).find("span").html("默认地址");

    location.href = "<?php echo U('Mobile/User/set_default');?>?id="+id;
   }
   
    
    </script>
</body>
</html>