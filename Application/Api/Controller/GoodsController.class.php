<?php
/**
 * 
 */
namespace Api\Controller;
//use Think\AjaxPage;
use Think\Controller;
//use Api\Logic\goods;

class GoodsController extends Controller{

	/**
	 * 获取商品列表 含有页数据
	 */
	public function get(){
	
		//商品ID
    	$except_goods_id = I('except_gid');
    	//分类ID
    	$cat_id = I('cat_id');
    	//品牌ID
    	$brand_id = I('brand_id');
    	//关键词
    	$keywords = I('keywords');

        //每页显示数量
        $listRows = I('listRows',10);

        //具体ID的商品信息
        $good_ids = I('good_ids',0);

        //要返回的数据
        $data = array(
            'code' => '0',//错误代码 0为没有错误
            'msg'   => '',//错误信息提示
            'data' =>array(),//返回的数据 
        );

		$GoodsLogic = new \Api\Logic\Goods;
        //获取品牌列表
    	$brandList = $GoodsLogic->getSortBrands();
        $data['data']['brandList'] = $brandList;
    	//获取分类列表
    	$categoryList = $GoodsLogic->getSortCategory();
        $data['data']['categoryList'] = $categoryList;
    	
    	
    	$where = ' is_on_sale = 1 and store_count > 0 ';//搜索条件
    	if(!empty($goods_id)){
    		$where .= " and goods_id not in ($except_goods_id) ";
    	}
    	
    	if($cat_id){
    		$this->assign('cat_id',$cat_id);
    		$grandson_ids = getCatGrandson($cat_id);
    		$where = " $where  and cat_id in(".  implode(',', $grandson_ids).") "; // 初始化搜索条件
    	}
    	if($brand_id){
    		$this->assign('brand_id',$brand_id);
    		$where = "$where and brand_id = ".$brand_id;
    	}
    	if(!empty($keywords))
    	{
    		$where = "$where and (goods_name like '%".$keywords."%' or keywords like '%".$keywords."%')" ;
    	}

        //想获取具体商品的信息
        if ($good_ids) {
            $goodsList = M('goods')->where("is_on_sale = 1 and store_count > 0 and goods_id  in ($good_ids)")->order('goods_id DESC')->select();
        }else{
            $count = M('goods')->where($where)->count();
        
            $Page  = new \Think\PageForApi($count,$listRows);
            $goodsList = M('goods')->where($where)->order('goods_id DESC')->limit($Page->firstRow.','.$Page->listRows)->select();
            $pagehtmlstring = $Page->show();//分页显示输出内容
            //分页字符串
            $data['data']['pagehtmlstring'] = $pagehtmlstring;
        }

    	//商品列表
        $data['data']['goodsList'] = $goodsList;
    	
        //返回数据
        $this->ajaxReturn($data,'jsonp');
	}
}