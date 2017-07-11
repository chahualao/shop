<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html >
<html>
<head>
<meta name="Generator" content="tpshop" />
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width">
<title>购物流程-<?php echo ($tpshop_config['shop_info_store_title']); ?></title>
<meta http-equiv="keywords" content="<?php echo ($tpshop_config['shop_info_store_keyword']); ?>" />
<meta name="description" content="<?php echo ($tpshop_config['shop_info_store_desc']); ?>" />
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
<link href="/Public/static/vendor/mui/mui.min.css" rel="stylesheet"/>
<link rel="stylesheet" href="/Template/mobile/new/Static/css/public.css">
<link rel="stylesheet" href="/Template/mobile/new/Static/css/flow.css">
<link rel="stylesheet" href="/Template/mobile/new/Static/css/style_jm.css">
<link rel="stylesheet" href="/Public/static/mobile/css/iconfont.css" />
<link rel="stylesheet" type="text/css" href="/Public/static/mobile/css/public.css"/>
<script type="text/javascript" src="/Template/mobile/new/Static/js/jquery.js"></script>
<script src="/Public/js/global.js"></script>
<script src="/Public/static/mobile/js/public.js"></script>
</head>
<body style="background: rgb(235, 236, 237);position:relative;">
<div class="tab_nav">
    <div class="header">
      <div class="h-left">
        <a class="sb-back" href="javascript:history.back(-1)" title="返回"></a>
      </div>
      <div class="h-mid"> 提交订单      </div>
    </div>
</div>

<div class="screen-wrap fullscreen login">
<form action="<?php echo U('Mobile/Payment/getCode');?>" method="post" name="cart4_form" id="cart4_form">
<div class="content_success " >
    <div class="con-ct   fo-con">
        <h4 class="successtijiao">订单已经提交成功！</h4>
      <ul class="ct-list">
        <li>请您在<span><?php echo ($pay_date); ?></span>前完成支付，否则订单将自动取消！：</li>
        <li >订单号：<em><?php echo ($order['order_sn']); ?></em></li>  
        <li>支付金额：<em>￥<?php echo ($order['order_amount']); ?>元</em></li>         
      </ul>
    </div>
    
   <section class="order-info">
          <div class="order-list">
            <div class="content ptop0">
              <div class="panel panel-default info-box">
                <div class="panel-body" id="pay_div"  >
                  <div class="title" id="zhifutitle" style="border-bottom:1px solid #eeeeee;"> <span class="i-icon-arrow-down i-icon-arrow-up" id="zhifuip"></span> <span class="text">支付方式</span> <a href="javascript:void(0)" title="修改商品列表" class="link">必选</a> <em class="qxz" id="emzhifu">请选择支付方式</em> </div>
                  <ul class="nav nav-list-sidenav" id="zhifu68" style="display:block; border-bottom:none;">
                  <?php if(is_array($paymentList)): foreach($paymentList as $k=>$v): ?><li class="clearfix" name="payment_name">
                      <label>
                          <input type="radio"   value="pay_code=<?php echo ($v['code']); ?>" class="c_checkbox_t" name="pay_radio"  style="margin-top:20px;"/>
                          <div class="fl shipping_title">
	                          <img src="/plugins/<?php echo ($v['type']); ?>/<?php echo ($v['code']); ?>/<?php echo ($v['icon']); ?>" onClick="change_pay(this);" height="40" />
                          </div>
                      </label>
                    </li><?php endforeach; endif; ?> 
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </section>
  <div class="pay-btn">
	<input type="hidden" name="order_id" value="<?php echo ($order['order_id']); ?>" />
    <a href="javascript:void(0);" onClick="pay()" class="sub-btn btnRadius">去支付</a>
  </div>
</div>
</form>
<script>
    $(document).ready(function(){
        $("input[name='pay_radio']").first().trigger('click');
    });
    // 切换支付方式
    function change_pay(obj)
    {
        $(obj).parent().siblings('input[name="pay_radio"]').trigger('click');
    }

    function pay(){
        $('#cart4_form').submit();
        return;
        //微信JS支付
    }
</script> 

</div>
<!-- 底部 -->
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