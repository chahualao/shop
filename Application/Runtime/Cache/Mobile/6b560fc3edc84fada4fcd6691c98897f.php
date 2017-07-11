<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>瑞和家商城</title>
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <link rel="stylesheet" type="text/css" href="/Public/static/vendor/mui/mui.min.css"/>
    <link rel="stylesheet" type="text/css" href="/Public/static/mobile/css/rehoming.css"/>
    <link rel="stylesheet" type="text/css" href="/Public/static/mobile/css/public.css"/>
</head>
<body style="background-color: #FBFBFB;">
    <header class="mui-bar mui-bar-nav pub-head">	<!--头部导航-->
        <a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left pub-head-back"></a>
        <h1 class="mui-title">个人信息</h1>
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
    <div class="my_pub-content-box">	<!--白底内容盒子-->
    	<div class="my_pub-content-box-row">
    		<span class="my_pub-content-box-row-l">头像</span>
    		<div class="my_pub-content-box-row-r photo-cover"><img src="<?php echo ((isset($user[head_pic]) && ($user[head_pic] !== ""))?($user[head_pic]):'/Template/mobile/new/Static/images/user68.jpg'); ?>" id="myphoto" /></div>
    	</div>
    	<div class="my_pub-content-box-row">
    		<span class="my_pub-content-box-row-l">昵称</span>
    		<div class="my_pub-content-box-row-r" style="color: #666;">
    			<span id="myName"><?php echo ($user['nickname']); ?></span>
    		</div>
    	</div>
    	<a href="<?php echo U('Mobile/User/mobileinfo');?>" class="my-pub-active">
	    	<div class="my_pub-content-box-row">
	    		<span class="my_pub-content-box-row-l">绑定手机号</span>    		
	    		<div class="my_pub-content-box-row-r" style="color: #666;">
	    			<span id="myPhonenum"><?php echo ($user['mobile']); ?></span>
	    			&gt;
	    		</div>     		
	    	</div>
    	</a>
    	<a href="#" class="my-pub-active">
	    	<div class="my_pub-content-box-row">
	    		<span class="my_pub-content-box-row-l">邮箱</span>
	    		<div class="my_pub-content-box-row-r" style="color: #666;"> 
	    			<span id="myEmail"><?php echo ($user["email"]); ?></span>
	    			&gt;
	    		</div>   		
	    	</div>
    	</a>
    	<a href="#" class="my-pub-active">
	    	<div class="my_pub-content-box-row" id="click">
	    		<span class="my_pub-content-box-row-l">性别</span>
	    		<div class="my_pub-content-box-row-r" style="color: #666;"> 
	    			<span id="mySex"><?php if($user['sex']==1) {echo '男';}else{echo '女';} ?> </span>
	    			&gt;
	    		</div>   		
	    	</div>
	    </a>
	    <a href="<?php echo U('Mobile/User/address_list');?>" class="my-pub-active">
	    	<div class="my_pub-content-box-row">
	    		<span class="my_pub-content-box-row-l">我的收货地址</span>
	    		<div class="my_pub-content-box-row-r" style="color: #666;"> 
	    			<span id="myAddress"></span>
	    			&gt;
	    		</div>    		
	    	</div>
    	</a>
    </div>	<!--白底内容盒子结束-->
    <a href="<?php echo U('Mobile/User/logout');?>"><input type="button" name="" id="btn-out" class="btn-out" value="退出登录" /></a>
    
    <script src="/Public/static/vendor/mui/mui.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="/Public/static/vendor/mui/mui.picker.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="/Public/static/vendor/jquery/jquery-3.1.1.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="/Public/static/mobile/js/public.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript">
    mui.init() 
    
    $(function(){
    	//		手机号中4位隐藏
		var phone = $('#myPhonenum').html();
	    var mphone = phone.substr(0,3) + '****' + phone.substr(7);    
	    $('#myPhonenum').text(mphone);
	    
	    
	    $("#click").click(function(){
	    	var picker = new mui.PopPicker();
			picker.setData([{
		    value: "1",
		    text: "男"
		}, {
		    value: "2",
		    text: "女"
		}])
		//picker.pickers[0].setSelectedIndex(4, 2000);
		picker.pickers[0].setSelectedValue('1', 1000);
		picker.show(function(SelectedItem) {
		
			$("#mySex").html(SelectedItem[0].text)
			//提交数据库
			$.ajax({
				type:'post',
				url:'<?php echo U("Mobile/User/ajax_post_data");?>',
				data:{sex:SelectedItem[0].value},
				success:function(data){
					if (!data.status) {
							mui.confirm(data.error,'提示',['确定'],function(e){
					    	if (e.index == 0) {
					    		
					    	}
					    },'div');
					}
				}
			})
		})
	    })
	    
    })
  
    </script>
</body>
</html>