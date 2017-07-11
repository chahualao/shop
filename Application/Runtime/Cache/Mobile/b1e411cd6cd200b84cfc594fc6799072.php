<?php if (!defined('THINK_PATH')) exit(); if($maybeyoulike != '' ): if(is_array($maybeyoulike)): foreach($maybeyoulike as $k=>$v): ?><div class="recommend-content">
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
			<p class="describe-content"><?php echo ($v["goods_remark"]); ?></p>
			<div class="describe-price-out">
				<p class="describe-price">￥<?php echo ($v["shop_price"]); ?></p>
				<a href="<?php echo U('Mobile/Goods/goodsInfo',array('id'=>$v['goods_id']));?>"><div class="shop-buy">购买</div></a>
				<div class="shop-cart" onclick="AjaxAddCart(<?php echo ($v["goods_id"]); ?>,1,0);">加入购物车</div>
			</div>
		</div>
	</div><?php endforeach; endif; endif; ?>