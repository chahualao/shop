<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>瑞和家商城</title>
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <link rel="stylesheet" type="text/css" href="/Public/static/vendor/mui/mui.min.css"/>
    <link rel="stylesheet" type="text/css" href="/Public/static/mobile/css/public.css"/>
    <link rel="stylesheet" type="text/css" href="/Public/static/mobile/css/rehoming.css"/>
    <style type="text/css">
    	select{
    		width: 20% !important;
    		height: 49px;
    		margin-right: 6px;
    		/*border: 1px solid #ccc !important; */		
    	}
    </style>
</head>
<body style="background-color: #FBFBFB;">
	<header class="mui-bar mui-bar-nav pub-head">	<!--头部导航-->
        <a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left pub-head-back"></a>
        <h1 class="mui-title">添加新地址</h1>
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
    <form action="<?php echo U('Mobile/User/add_address');?>" method="post" onSubmit="return checkForm()">
	<div class="my_pub-white-box"><!--白底内容盒子-->
    	<div class="my_pub-content-box-row mui-clearfix mui-input-row">
			<span class="pub-t">收货人</span>
			<input type="text" class="pub-txt mui-input-clear" name="consignee" placeholder="请输入收货人名字" maxlength="16" autofocus />
		</div>
		<div class="my_pub-content-box-row mui-clearfix mui-input-row">
			<span class="pub-t">联系电话</span>
			<input type="tel" name="mobile" class="pub-txt mui-input-clear" placeholder="请输入联系电话" maxlength="16"/>
		</div>
		<div class="my_pub-content-box-row mui-clearfix" style="height: auto;">
			<span class="pub-t">所在地区</span>
			<input name='country' value='1' type="hidden">
			<select class="province_select"  name="province" id="province" onChange="get_city(this)">
                      <option value="0">请选择</option>
                        <?php if(is_array($province)): $i = 0; $__LIST__ = $province;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$p): $mod = ($i % 2 );++$i;?><option <?php if($address['province'] == $p['id']): ?>selected<?php endif; ?>  value="<?php echo ($p["id"]); ?>"><?php echo ($p["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                 </select>
                <select name="city" id="city" onChange="get_area(this)">
                    <option  value="0">请选择</option>
                    <?php if(is_array($city)): $i = 0; $__LIST__ = $city;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$p): $mod = ($i % 2 );++$i;?><option <?php if($address['city'] == $p['id']): ?>selected<?php endif; ?>  value="<?php echo ($p["id"]); ?>"><?php echo ($p["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
                <select name="district" id="district" onChange="get_twon(this)">
                    <option  value="0">请选择</option>
                    <?php if(is_array($district)): $i = 0; $__LIST__ = $district;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$p): $mod = ($i % 2 );++$i;?><option <?php if($address['district'] == $p['id']): ?>selected<?php endif; ?>  value="<?php echo ($p["id"]); ?>"><?php echo ($p["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                </select>                 
                <select class="di-bl fl seauii" name="twon" id="twon" <?php if($address['twon'] > 0 ): ?>style="display:block;"<?php else: ?>style="display:none;"<?php endif; ?>>
                    <?php if(is_array($twon)): $i = 0; $__LIST__ = $twon;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$p): $mod = ($i % 2 );++$i;?><option <?php if($address['twon'] == $p['id']): ?>selected<?php endif; ?>  value="<?php echo ($p["id"]); ?>"><?php echo ($p["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                </select> 
		</div>
		<div class="div-txt">
			<textarea name="address" style="overflow:hidden;width: 100%;border: none;font-size: 14px;" placeholder="请填写详细地址"><?php echo ($address["address"]); ?></textarea>
		</div>
	</div>
	<input type="submit" class="btn_black_center " value="确定" onclick=""/>
	<a href="javascript:history.back(-1)">
		<input type="button" class="btn_black_center " value="取消" onclick=""/>
	</a>
	</form>
    <script src="/Public/static/vendor/mui/mui.min.js" type="text/javascript" charset="utf-8"></script>    
    <script src="/Public/static/vendor/jquery/jquery-3.1.1.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="/Public/static/mobile/js/area.js" type="text/javascript" charset="utf-8"></script>
    <script src="/Public/static/mobile/js/public.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript">
    mui.init();/*mui框架初始化*/
	//_init_area();/*地址三联动初始化*/
	
	(function($){
		/*textarea自适应高度*/
	  	$.fn.autoTextarea = function(options) {
		    var defaults={
		      maxHeight:null,
		      minHeight:$(this).height()
	    };
	    var opts = $.extend({},defaults,options);
	    return $(this).each(function() {
	      $(this).bind("paste cut keydown keyup focus blur",function(){
	        var height,style=this.style;
	        this.style.height = opts.minHeight + 'px';
	        if (this.scrollHeight > opts.minHeight) {
	          if (opts.maxHeight && this.scrollHeight > opts.maxHeight) {
	            height = opts.maxHeight;
	            style.overflowY = 'scroll';
	          } else {
	            height = this.scrollHeight;
	            style.overflowY = 'hidden';
	          }
	          style.height = height + 'px';
	        }
	      });
	    });
	  };
	})(jQuery);
// 
   /**
 * 获取省份
 */
function get_province(){
    var url = '/index.php?m=Admin&c=Api&a=getRegion&level=1&parent_id=0';
    $.ajax({
        type : "GET",
        url  : url,
        error: function(request) {
            alert("服务器繁忙, 请联系管理员!");
            return;
        },
        success: function(v) {
            v = '<option value="0">选择省份</option>'+ v;          
            $('#province').empty().html(v);
        }
    });
}


/**
 * 获取城市
 * @param t  省份select对象
 */
function get_city(t){
    var parent_id = $(t).val();
    if(!parent_id > 0){
        return;
    }
    $('#twon').empty().css('display','none');
    var url = '/index.php?m=Home&c=Api&a=getRegion&level=2&parent_id='+ parent_id;
    $.ajax({
        type : "GET",
        url  : url,
        error: function(request) {
            alert("服务器繁忙, 请联系管理员!");
            return;
        },
        success: function(v) {
            v = '<option value="0">选择城市</option>'+ v;          
            $('#city').empty().html(v);
        }
    });
}

/**
 * 获取地区
 * @param t  城市select对象
 */
function get_area(t){
    var parent_id = $(t).val();
    if(!parent_id > 0){
        return;
    }
    var url = '/index.php?m=Home&c=Api&a=getRegion&level=3&parent_id='+ parent_id;
    $.ajax({
        type : "GET",
        url  : url,
        error: function(request) {
            alert("服务器繁忙, 请联系管理员!");
            return;
        },
        success: function(v) {
            v = '<option>选择区域</option>'+ v;
            $('#district').empty().html(v);
        }
    });
}
// 获取最后一级乡镇
function get_twon(obj){
    var parent_id = $(obj).val();
    var url = '/index.php?m=Home&c=Api&a=getTwon&parent_id='+ parent_id;
    $.ajax({
        type : "GET",
        url  : url,
        success: function(res) {
        	if(parseInt(res) == 0){
        		$('#twon').empty().css('display','none');
        	}else{
        		$('#twon').css('display','block');
        		$('#twon').empty().html(res);
        	}
        }
    });
}
function checkForm(){
        var consignee = $('input[name="consignee"]').val();
        var province = $('select[name="province"]').find('option:selected').val();
        var city = $('select[name="city"]').find('option:selected').val();
        var district = $('select[name="district"]').find('option:selected').val();
        var address = $('input[name="address"]').val();
        var mobile = $('input[name="mobile"]').val();
        var error = '';
        if(consignee == ''){
            error += '收货人不能为空 <br/>';
        }
        if(province==0){
            error += '请选择省份 <br/>';
        }
        if(city==0){
            error += '请选择城市 <br/>';
        }
        if(district==0){
            error += '请选择区域 <br/>';
        }
        if(address == ''){
            error += '请填写地址 <br/>';
        }
        if(mobile==''){
            error += '手机号码格式有误 <br/>';
		}
        if(error){
        	mui.confirm(error,'提示',['确认'],function (e) {
                
                if(e.index==0){
                   
                }
            },'div')
            return false;
        }
			 
        return true;
    }
	 
    </script>
</body>
</html>