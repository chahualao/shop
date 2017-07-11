<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
	<title><?php echo ($goods["goods_name"]); ?>_<?php echo ($tpshop_config["shop_info_store_title"]); ?></title>
	<link href="/Public/static/vendor/mui/mui.min.css" rel="stylesheet"/>
	<link rel="stylesheet" href="/Public/static/mobile/css/iconfont.css" />
	<link rel="stylesheet" href="/Public/static/mobile/css/public.css" />
	<link rel="stylesheet" href="/Public/static/mobile/css/detail.css" />	
	<script src="/Public/static/vendor/jquery/jquery.min.js"></script>
	<script src="/Public/static/vendor/cookie/js.cookie.js"></script>
	<script src="/Public/static/vendor/mui/mui.min.js"></script>
	<script src="/Public/static/mobile/js/detail.js"></script>
	<script src="/Public/static/mobile/js/common.js"></script>
	</head>

	<body>
		<!--头部-->
		<div class="header">
			<div class="h-left">
				<a class="sb-back" href="javascript:history.back(-1)" title="返回"></a>
			</div>
			<div class="h-mid">
				<ul>
					<li>
						<a href="javascript:;" class="on" id="goods_ka1">商品</a>
					</li>
					<li>
						<a href="javascript:;" class="" id="goods_ka2">详情</a>
					</li>
					<li>
						<a href="javascript:;" class="" id="goods_ka3">评价</a>
					</li>
				</ul>
			</div>
			<div class="h-right">
				<aside class="top_bar">
					<div id="show_more">
						<a href="javascript:;"></a>
					</div>
					<a href="/index.php/Mobile/Cart/cart.html" class="show_cart"><em class="global-nav__nav-shop-cart-num" id="tp_cart_info">0</em></a>
				</aside>
			</div>
		</div>
		<!--顶部菜单-->
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
		<div class="line1"></div>
		<div class="content-out" style="display: block;">
		<form name="buy_goods_form" method="post" id="buy_goods_form" >
			<div class="content">
				<!--banner-->
				<div class="banner">
					<div id="slider" class="mui-slider">
						<div class="mui-slider-group">
							<?php if(is_array($goods_images_list)): foreach($goods_images_list as $key=>$pic): ?><!-- 第一张 -->
							<div class="mui-slider-item">
								<a href="javascript:void(0)">
									<img src="<?php echo ($pic["image_url"]); ?>">
								</a>
							</div><?php endforeach; endif; ?>
						</div>
						<div class="mui-slider-indicator">
							<?php if(is_array($goods_images_list)): foreach($goods_images_list as $key=>$pic): ?><div class="mui-indicator"></div><?php endforeach; endif; ?>
						</div>
					</div>
				</div>
				<!--商品标题-->
				<div class="detail-title">
					<?php echo ($goods["goods_name"]); ?>
				</div>
				<!--商品描述-->
				<p class="detail-describe"><?php echo ($goods["goods_remark"]); ?></p>
				<div class="detail-price-out">
					<!--价格-->
					<div class="detail-price">￥<?php echo ($goods["shop_price"]); ?>&nbsp;<del>￥<?php echo ($goods["market_price"]); ?></del></div>
					<!--分享-->
					<!-- <div class="detail-share">分享</div> -->
				</div>
			</div>
			<div class="line"></div>
			<div class="express">
				<div>快递：<span>10.0</span></div>
				<div style="text-align: center;">销量：<span><?php echo ($goods["sale_num"]); ?>笔</span></div>
				<div style="text-align: right;">评价：<span><?php echo empty($goods['comments_count'])?0:$goods['comments_count']; ?>条</span></div>
				<div style="border-bottom: 1px solid #ccc;width: 100%;padding-top: 8px;"></div>
			</div>
			<div class="tag tag-noclick">
				<div class="mui-row">
					<div>
						<li class="mui-table-view-cell "><?php echo ($goods["goods_tags"]); ?></li>
					</div>
					
				</div>
			</div>
			<div class="line2"></div>
			<!-- <div class="discount">
				<img src="/Public/static/mobile/images/discount-icon.png" alt="" style="width: 20px;" />
				<span>全场商品9折</span>
			</div> -->
			<div class="line" style="margin-top: 0px;"></div>
			<div class="lists">
				<ul class="mui-table-view">
					<li class="mui-table-view-cell ">
						<a id="shop-popover-1" class="mui-navigate-right">
							请选择商品属性
						</a>
					</li>
					<!--<li class="mui-table-view-cell " style="border-top: 0px;">
						<a class="mui-navigate-right">
							选择购买数量
						</a>
					</li>-->
					<?php if(count($zuhe_lists)>0){ ?>
					<p class="line" style="margin-top: 0px;height:10px;"></p>
					<li class="mui-table-view-cell" style="border-bottom: 0px;">
						<a class="mui-navigate-right">
							<!-- 组合更优惠 -->
						组合更优惠
						</a>
					</li>
					<div class="zuhe row mui-collapse-content">
						<div class="mui-row">
						<?php if(is_array($zuhe_lists)): foreach($zuhe_lists as $k=>$vo): ?><div onclick="oPzuhe();">
								<li>
									<img src="<?php echo ($vo["original_img"]); ?>" class="zuhe-img1" alt="" />
									<p class="mui-row-p1"><?php echo ($vo["goods_name"]); ?></p>
									<p class="mui-row-p2">￥<?php echo ($vo["shop_price"]); ?></p>
									<img src="/Public/static/mobile/images/zuhe-icon.png" class="zuhe-img2" alt="" />
								</li>
							</div><?php endforeach; endif; ?>
						</div>
					</div>
					<?php } ?>
					<div class="line" style="margin-top: 0px;height:10px;"></div>
				</ul>
			</div>
			<div class="product">
				<div class="product-introduction">图文详情</div>
				<div class="product-div">
					<?php echo htmlspecialchars_decode($goods['goods_content']); ?>
				</div>
			</div>
			<div class="line" style="margin-top: 0px;"></div>
			<div class="product product3">
				<div class="product-introduction">热门商品</div>
				<div class="product-div" style="padding: 0px;">
					<ul class="mui-row" style="padding-right: 0px;">
						<?php
 $md5_key = md5("select * from __PREFIX__goods where is_hot=1 order by sort limit 9"); $result_name = $sql_result_v = S("sql_".$md5_key); if(empty($sql_result_v)) { $Model = new \Think\Model(); $result_name = $sql_result_v = $Model->query("select * from __PREFIX__goods where is_hot=1 order by sort limit 9"); S("sql_".$md5_key,$sql_result_v,31104000); } foreach($sql_result_v as $k=>$v): ?><div class="commodity">
							<a href="<?php echo U('Mobile/Goods/goodsInfo',array('id'=>$v[goods_id]));?>"><li>
								<img src="<?php echo (goods_thum_images($v["goods_id"],400,400)); ?>" alt="" />
								<p class="product-div-p1"><?php echo ($v["goods_name"]); ?></p>
								<p class="product-div-p2">￥<?php echo ($v["shop_price"]); ?></p>
								<div class="add_car">加入购物车</div>
							</li></a>
						</div><?php endforeach; ?>
					</ul>
				</div>
			</div>
			<div id="shop-popover">
				<div class="shop-popover">
					<div class="shop-popover-close">
						<img src="/Public/static/mobile/images/shop-popover-close.png" />
					</div>
					<img src="<?php echo (goods_thum_images($goods["goods_id"],100,100)); ?>" alt="" class="thumb" id="spec_img_obj" />
					<div class="shop-popover-div">
						<span id="goods_price">￥<?php echo ($goods["shop_price"]); ?></span>
						<!-- <del>￥<?php echo ($goods["market_price"]); ?></del> -->
					</div>
					<div class="shop-select-title">选择 <span>型号</span> <span>颜色分类</span></div>
					<div class="">
						<div class="shop-popover-content ">
							<?php if(is_array($filter_spec)): foreach($filter_spec as $key=>$spec): ?><div class="tag-alert">
								<?php echo ($key); ?>
								<div class="tag tag-click">
									<div class="mui-row">
										<?php if(is_array($spec)): foreach($spec as $k2=>$v2): ?><li class="mui-table-view-cell <?php if($k2 == 0): ?>active<?php endif; ?>" data-img="<?php echo ($v2[src]); ?>" onclick="switch_spec(this);" style="display:block;float:left;margin:4px;">
											<?php echo ($v2[item]); ?>
												<input type="radio" style="display:none;" name="goods_spec[<?php echo ($key); ?>]" value="<?php echo ($v2[item_id]); ?>" <?php if($k2 == 0 ): ?>checked="checked"<?php endif; ?>/>
											</li><?php endforeach; endif; ?>
									</div>
								</div>
							</div><?php endforeach; endif; ?>
							
							<div class="tag-alert ">
								<span style="height: 40px;line-height: 40px;">选择数量</span>
								<div class="mui-numbox">
									<!-- "-"按钮，点击可减小当前数值 -->
									<button class="mui-btn mui-numbox-btn-minus" type="button">-</button>
									<input name="goods_num" class="mui-numbox-input" type="number" value="1" id="goods_num" />
									<input type="hidden" name="goods_id" value="<?php echo ($goods["goods_id"]); ?>"/>
									<!-- "+"按钮，点击可增大当前数值 -->
									<button class="mui-btn mui-numbox-btn-plus" type="button">+</button>
								</div>
							</div>
							<p class="confirm" id="confirm_btn">确定</p>
						</div>
					</div>
				</div>
			</div>
			<div class="modal"></div>
		</form>
		</div>

		<!--详情-->
		<div class="content-out">
			<div class="product_desc">
				<?php echo htmlspecialchars_decode($goods['goods_content']); ?>
			</div>
		</div>
		<!--评价-->
		<div class="content-out">
			<div class="comment_list" id="commentList">
				
			</div>
		</div>
		<!--底部导航-->
<div class="footer_nav">
	<ul>
		<li class="bian">
			<a href="/index.php/Mobile/Index/index.html"><em class="goods_nav1"></em><span>首页</span></a>
		</li>
		<li class="bian">
			<a href="tel:"><em class="goods_nav2"></em><span>客服</span></a>
		</li>
		<li>
			<a href="javascript:collect_goods(119)" id="favorite_add"><em class="goods_nav3"></em><span>收藏</span></a>
		</li>
	</ul>
	<dl>
		<dd class="flow">
			<a class="button active_button" href="javascript:void(0);" onclick="AjaxAddCart(<?php echo ($goods['goods_id']); ?>,1,0);">加入购物车</a>
		</dd>
		<dd class="goumai">
			<a style="display:block;" href="javascript:void(0);" onclick="AjaxAddCart(<?php echo ($goods['goods_id']); ?>,1,1);">立即购买</a>
		</dd>
	</dl>
</div>
<script type="text/javascript">
// 点击收藏商品
function collect_goods(goods_id){
	$.ajax({
		type : "GET",
		dataType: "json",
		url:"/index.php?m=Home&c=goods&a=collect_goods&goods_id="+goods_id,//+tab,
		success: function(data){
			mui.confirm(data.msg,'提示',['确定'],function(e){
						    	if (e.index == 0) {
						    		
						    	}else{
						    		
						    	}
						    },'div');
			//alert(data.msg);
		}
	});
}
</script>
		<!-- 微信浏览器 调用微信 分享js-->
		<?php if($signPackage != null): ?><script type="text/javascript" src="/Template/mobile/new/Static/js/jquery.js"></script>
<script src="/Public/js/global.js"></script>
<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script type="text/javascript">

<?php if(ACTION_NAME == 'goodsInfo'): ?>var shareTitle = "<?php echo ($goods['goods_name']); ?>";
  var ShareLink = "http://<?php echo ($_SERVER[HTTP_HOST]); ?>/index.php?m=Mobile&c=Goods&a=goodsInfo&id=<?php echo ($goods[goods_id]); ?>"; //默认分享链接
  var ShareImgUrl = "http://<?php echo ($_SERVER[HTTP_HOST]); echo (goods_thum_images($goods[goods_id],400,400)); ?>"; // 分享图标
<?php elseif(ACTION_NAME == 'group'): ?>
  var shareTitle = "<?php echo ($goods['goods_name']); ?>";
  var ShareLink = "http://<?php echo ($_SERVER[HTTP_HOST]); ?>/index.php?m=Mobile&c=Activity&a=group&id=<?php echo ($goods[goods_id]); ?>"; //默认分享链接
  var ShareImgUrl = "http://<?php echo ($_SERVER[HTTP_HOST]); echo (goods_thum_images($goods[goods_id],400,400)); ?>"; // 分享图标
<?php else: ?>
  var shareTitle = "<?php echo ($tpshop_config['shop_info_store_title']); ?>";
  var ShareLink = "http://<?php echo ($_SERVER[HTTP_HOST]); ?>/index.php?m=Mobile&c=Index&a=index"; //默认分享链接
  var ShareImgUrl = "http://<?php echo ($_SERVER[HTTP_HOST]); echo ($tpshop_config['shop_info_store_logo']); ?>"; // 分享图标<?php endif; ?>

var is_distribut = getCookie('is_distribut'); // 是否分销代理
var user_id = getCookie('user_id'); // 当前用户id
//alert(is_distribut+'=='+user_id);

// 如果已经登录了, 并且是分销商
if(parseInt(is_distribut) == 1 && parseInt(user_id) > 0)
{									
	ShareLink = ShareLink + "&first_leader="+user_id;									
}										


// 微信配置
wx.config({
    debug: false, 
    appId: "<?php echo ($signPackage['appId']); ?>", 
    timestamp: '<?php echo ($signPackage["timestamp"]); ?>', 
    nonceStr: '<?php echo ($signPackage["nonceStr"]); ?>', 
    signature: '<?php echo ($signPackage["signature"]); ?>',
    jsApiList: ['onMenuShareTimeline', 'onMenuShareAppMessage','onMenuShareQQ','onMenuShareQZone','hideOptionMenu'] // 功能列表，我们要使用JS-SDK的什么功能
});

// config信息验证后会执行ready方法，所有接口调用都必须在config接口获得结果之后，config是一个客户端的异步操作，所以如果需要在 页面加载时就调用相关接口，则须把相关接口放在ready函数中调用来确保正确执行。对于用户触发时才调用的接口，则可以直接调用，不需要放在ready 函数中。
wx.ready(function(){
    // 获取"分享到朋友圈"按钮点击状态及自定义分享内容接口
    wx.onMenuShareTimeline({
        title: shareTitle, // 分享标题
        link:ShareLink,
        imgUrl:ShareImgUrl // 分享图标
    });

    // 获取"分享给朋友"按钮点击状态及自定义分享内容接口
    wx.onMenuShareAppMessage({
        title: shareTitle, // 分享标题
        desc: "<?php echo ($tpshop_config['shop_info_store_desc']); ?>", // 分享描述
        link:ShareLink,
        imgUrl:ShareImgUrl // 分享图标
    });
	// 分享到QQ
	wx.onMenuShareQQ({
        title: shareTitle, // 分享标题
        desc: "<?php echo ($tpshop_config['shop_info_store_desc']); ?>", // 分享描述
        link:ShareLink,
        imgUrl:ShareImgUrl // 分享图标
	});	
	// 分享到QQ空间
	wx.onMenuShareQZone({
        title: shareTitle, // 分享标题
        desc: "<?php echo ($tpshop_config['shop_info_store_desc']); ?>", // 分享描述
        link:ShareLink,
        imgUrl:ShareImgUrl // 分享图标
	});

   <?php if(CONTROLLER_NAME == 'User'): ?>wx.hideOptionMenu();  // 用户中心 隐藏微信菜单<?php endif; ?>
	
});
</script>


<!--微信关注提醒 start-->
<?php if($_SESSION['subscribe']== 0): ?><button class="guide" onclick="follow_wx()">关注公众号</button>
<style type="text/css">
.guide{width:20px;height:100px;text-align: center;border-radius: 8px ;font-size:12px;padding:8px 0;border:1px solid #adadab;color:#000000;background-color: #fff;position: fixed;right: 6px;bottom: 200px;white-space: normal;z-index: 100000000}
#cover{display:none;position:absolute;left:0;top:0;z-index:18888;background-color:#000000;opacity:0.7;}
#guide{display:none;position:absolute;top:5px;z-index:19999;}
#guide img{width: 70%;height: auto;display: block;margin: 0 auto;margin-top: 10px;}
</style>
<script type="text/javascript" src="/Template/mobile/new/Static/js/layer.js" ></script>
<script type="text/javascript">

  // 关注微信公众号二维码	 
function follow_wx()
{
	layer.open({
		type : 1,  
		title: '关注公众号',
		content: '<img src="<?php echo ($wechat_config['qr']); ?>" width="200">',
		style: ''
	});
}
 
</script><?php endif; ?>
<!--微信关注提醒  end--><?php endif; ?>
	</body>

	<script>
		mui('body').on('shown', '.mui-popover', function(e) {
			//console.log('shown', e.detail.id);//detail为当前popover元素
		});
		mui('body').on('hidden', '.mui-popover', function(e) {
			//console.log('hidden', e.detail.id);//detail为当前popover元素
		});
		$("#shop-popover-1").click(function() {
			$("#shop-popover").show();
			$(".modal").show();
			$("body").addClass("modal-open");
		})
		$(".modal").click(function() {
			$("#shop-popover").hide();
			$(".modal").hide();
			$("body").removeClass("modal-open");
		})
		$(".shop-popover-close").click(function() {
			$("#shop-popover").hide();
			$(".modal").hide();
			$("body").removeClass("modal-open");
		})
		$("#confirm_btn").click(
			function(){
			$("#shop-popover").hide();
			$(".modal").hide();
			$("body").removeClass("modal-open");
			}
		)
		function switch_spec(spec)
		{
		    $(spec).siblings().removeClass('active');
		    $(spec).addClass('active');
			$(spec).siblings().children('input').prop('checked',false);
			$(spec).children('input').prop('checked',true);	
		    //更新商品价格
		    get_goods_price();
		    //更新图片
		    $("#spec_img_obj").attr('src',$(spec).attr('data-img'));
		}

		function get_goods_price()
		{
			var goods_price = <?php echo ($goods["shop_price"]); ?>; // 商品起始价
			var store_count = <?php echo ($goods["store_count"]); ?>; // 商品起始库存	
			var spec_goods_price = <?php echo ($spec_goods_price); ?>;  // 规格 对应 价格 库存表   
			//alert(spec_goods_price['11_55_102']['price']);	
			// 如果有属性选择项
			//console.log(spec_goods_price);
			if(spec_goods_price != null)
			{
				goods_spec_arr = new Array();
				$("input[name^='goods_spec']:checked").each(function(){
					 goods_spec_arr.push($(this).val());
				});    
				var spec_key = goods_spec_arr.sort(sortNumber).join('_');  //排序后组合成 key	
				goods_price = spec_goods_price[spec_key]['price']; // 找到对应规格的价格		
				store_count = spec_goods_price[spec_key]['store_count']; // 找到对应规格的库存
			}
			
			var goods_num = parseInt($("#goods_num").val()); 
			// 库存不足的情况
			if(goods_num > store_count)
			{
			   goods_num = store_count;
			   alert('库存仅剩 '+store_count+' 件');
			   $("#goods_num").val(goods_num);
			}
		    var flash_sale_price = parseFloat("<?php echo ($goods['flash_sale']['price']); ?>");
		    (flash_sale_price > 0) && (goods_price = flash_sale_price);
			$("#goods_price").html('￥'+goods_price); // 变动价格显示

		}

		function sortNumber(a,b) 
		{ 
			return a - b; 
		} 

		function ajaxComment(commentType,page){
		    $.ajax({
		        type : "GET",
		        url:"/index.php?m=Mobile&c=goods&a=ajaxComment&goods_id=<?php echo ($goods['goods_id']); ?>&commentType="+commentType+"&p="+page,//+tab,
		        success: function(data){
		            $("#commentList").empty().append(data);
		           /* var myPhotoSwipe = $("#gallery a").photoSwipe({ 
		        		enableMouseWheel: false, 
		        		enableKeyboard: false, 
		        		allowUserZoom: false, 
		        		loop:false
		        	});*/
		        }
		    });
		}

		//组合购买
		function oPzuhe(){
			//当前商品直接加入购物车
			$.ajax({
	            type : "POST",
	            url:"/index.php?m=Home&c=Cart&a=ajaxAddCart",
	            data : $('#buy_goods_form').serialize(),// 你的formid 搜索表单 序列化提交                        
				dataType:'json',
	            success: function(data){	
					// 加入购物车后再跳转到 购物车页面
				    if(data.status < 0)
					{
						mui.confirm(data.msg,'提示',['再给一次机会', '尝试重新加载'],function(e){
						    	if (e.index == 0) {
						    		oPzuhe();
						    	}else{
						    		location.href = window.location.href;
						    	}
						    },'div');
						return false;
					}else{
						cart_num = parseInt($('#tp_cart_info').html())+parseInt($('#number').val());
				    	$('#tp_cart_info').html(cart_num);
				    	//进入组合页面
				    	location.href="<?php echo U('Mobile/Goods/zuhe_info',array('gid'=>$goods['goods_id'],'zid'=>$goods['zuhe_goods_id']));?>";
					}
	            }
        	});  
		}

		$(document).ready(function() {
				var cart_cn = Cookies.get('cn');
				if (cart_cn == '') {
					$.ajax({
						type: "GET",
						url: "/index.php?m=Home&c=Cart&a=header_cart_list", //+tab,
						success: function(data) {
							cart_cn = Cookies.get('cn');
						}
					});
				}
				$('#tp_cart_info').html(cart_cn);

				//加载评论
				ajaxComment(1,1);
		});

	</script>
</html>