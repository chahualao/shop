<?php
//获取猜你喜欢数据
function maybeYouLike($limit=5,$p=1){
	//历史搜索词
	$search_keywords = cookie('guess_keywords');
	$click_goods_cid = cookie('guess_goods_cid');
	
	//没有得到用户行为的时候就返回热卖产品
	if (empty($search_keywords) && empty($click_goods_cid)) {
		$hot = M('goods')->where("is_hot=1 and is_on_sale=1")->page($p,$limit)->cache(true,TPSHOP_CACHE_TIME)->select();
		return $hot ? $hot : '';
	}else{

		//查询条件
		$map = array();
		if (!empty($search_keywords)) {
			$map="is_on_sale=1 and keywords like '%$search_keywords%'";
		}
		if (!empty($click_goods_cid)) {
			$click_goods_cid = '('.$click_goods_cid.')';
			$map="is_on_sale=1 and cat_id in $click_goods_cid";
		}
		if (!empty($click_goods_cid) && !empty($search_keywords)) {
			$click_goods_cid = '('.$click_goods_cid.')';
			$map="is_on_sale=1 and (cat_id in $click_goods_cid or keywords like '%$search_keywords%')";	
		}
		return M('goods')->where($map)->page($p,$limit)->cache(true,TPSHOP_CACHE_TIME)->select();
	}

}

//获取产品销量
function get_goods_sale_num($gid){
	$goods = M('order_goods')->where('goods_id='.$gid)->select();
	return count($goods);
}
