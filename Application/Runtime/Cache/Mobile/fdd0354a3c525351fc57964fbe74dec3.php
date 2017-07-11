<?php if (!defined('THINK_PATH')) exit(); if(is_array($goods_list)): foreach($goods_list as $k=>$vo): ?><li>
		<a href="<?php echo U('Mobile/Goods/goodsInfo',array('id'=>$vo[goods_id]));?>" class="item">
			<div class="pic_box">
				<img src="<?php echo (goods_thum_images($vo["goods_id"],400,400)); ?>">
			</div>
			<div class="title_box"><?php echo ($vo["goods_name"]); ?></div>
			<div class="add_car_out">
				<div class="price_box">
					<span class="new_price"><i>￥<?php echo ($vo["shop_price"]); ?></i></span>
				</div>
				<div class="comment_box">已售0</div>
				<div class="add_car" onClick="AjaxAddCart(<?php echo ($vo[goods_id]); ?>,1,0);">加入购物车</div>								
			</div>		
		</a>
	</li><?php endforeach; endif; ?>