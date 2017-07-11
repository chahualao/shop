<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html >
<html>
<head>
<meta name="Generator" content="tpshop" />
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width">
<title>收货地址-<?php echo ($tpshop_config['shop_info_store_title']); ?></title>
<meta http-equiv="keywords" content="<?php echo ($tpshop_config['shop_info_store_keyword']); ?>" />
<meta name="description" content="<?php echo ($tpshop_config['shop_info_store_desc']); ?>" />
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
<link rel="stylesheet" type="text/css" href="/Public/static/vendor/mui/mui.min.css"/>
<link rel="stylesheet" href="/Template/mobile/new/Static/css/public.css">
<link rel="stylesheet" href="/Template/mobile/new/Static/css/user.css">

<script src="/Public/js/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="/Template/mobile/new/Static/js/layer.js" ></script>
<script src="/Public/js/global.js"></script>
<script src="/Public/js/mobile_common.js"></script>
<script src="/Public/static/vendor/mui/mui.min.js" type="text/javascript" charset="utf-8"></script>
</head>
<style type="text/css">
  .addressmone ul li span{color: #000;}
</style>
<body>
      <header>
      <div class="tab_nav">
        <div class="header">
          <div class="h-left"><a class="sb-back" href="javascript:history.back(-1)" title="返回"></a></div>
          <div class="h-mid">地址管理</div>
          <div class="h-right">
            <!-- <aside class="top_bar">
              <div onClick="show_menu();$('#close_btn').addClass('hid');" id="show_more"><a href="javascript:;"></a> </div>
            </aside> -->
            <span style="font-size: 16px; padding-right: 0;" onclick="$('form').submit();">保存</span>
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
						
<div class="addressmone">
  <form action="<?php echo U('Mobile/User/edit_address');?>" method="post" onSubmit="return checkForm()">
	<ul>
       <li>
    	<span>收货人</span>  
        <input name="consignee" id="consignee" type="text" value="<?php echo ($address["consignee"]); ?>" maxlength="12" placeholder="收货人姓名"/>
		</li>
    <style type="text/css">
      .addressmone ul li select{width:18%;font-size: 14px;text-align: center;font-family: microsoft yahei}
      form span{font-size: 14px;color: #000;}
      .addressmone ul li input{font-size: 14px;font-family: microsoft yahei}
    </style>          
       <li>
          <span style="width:15%">地区</span>  
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
        	</li>
          
           <li>
			<span>手机</span> 
            <input type="text" name="mobile" value="<?php echo ($address["mobile"]); ?>" onpaste="this.value=this.value.replace(/[^\d-]/g,'')" onKeyUp="this.value=this.value.replace(/[^\d-]/g,'')" maxlength="15" placeholder="手机号码"/>
	        </li>
           <li>
         <span>详细地址</span> <input type="text"  name="address" id="address" placeholder="详细地址" maxlength="100" value="<?php echo ($address["address"]); ?>"/>
         </li>
            <li>
	        </li>
    	</ul>
            <div style=" height:12px"></div>
            <p><a href="javascript:void(0);" onClick="deladd(<?php echo ($address[address_id]); ?>)" style="padding: 10px 10px;
    font-size: 14px;
    color: red;
    background-color: #fff;
    cursor: pointer;">删除地址</a></p>
		
                <input type="hidden" name="id" value="<?php echo ($address["address_id"]); ?>" />
		 
    </form>
</div>        </div>
<script src="/Public/js/validate2.js"></script>
<script>
//初始化Mui
    mui.init();
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
        if(!checkMobile(mobile)){
            error += '手机号码格式有误 <br/>';
		}
        if(error){
		    mui.confirm(error,'提示',['确认'],function (e) {
                
                if(e.index==0){
                   return false;
                }
            },'div')
            return false;
        }
			 
        return true;
    }
    
    //删除地址
function deladd(id){
  mui.confirm('确定要删除该地址吗？','提示',['确认'],function (e) {
                
                if(e.index==0){
                   location.href="<?php echo U('/Mobile/User/del_address');?>?id="+id;
                }
            },'div')
  
}
</script> 
</body>
</html>