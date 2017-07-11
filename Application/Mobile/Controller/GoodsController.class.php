<?php
/**
 * 
 * ============================================================================
 * 
 * 
 * ----------------------------------------------------------------------------
 *
 *
 * ============================================================================
 * 
 */
namespace Mobile\Controller;
use Think\AjaxPage;
use Think\Page;
class GoodsController extends MobileBaseController {
    public function index(){
        
        $this->redirect('goodsList');
    }

    /**
     * 分类列表显示
     */
    public function categoryList(){
        
        $this->display();
    }

    /**
     * 商品列表页
     */
    public function goodsList(){
        //动态设置模板配置
        /*C('VIEW_PATH','./Template/mobile/');
        C('DEFAULT_THEME','new');*/
    	
    	$filter_param = array(); // 帅选数组
    	$id = I('get.id',0); // 当前分类id
    	$brand_id = I('brand_id',0);
    	$spec = I('spec',0); // 规格
    	$attr = I('attr',''); // 属性
    	$sort = I('sort','goods_id'); // 排序
    	$sort_asc = I('sort_asc','desc'); // 排序
    	$price = I('price',''); // 价钱
    	//$start_price = trim(I('start_price','0')); // 输入框价钱
    	//$end_price = trim(I('end_price','0')); // 输入框价钱
    	//if($start_price && $end_price) $price = $start_price.'-'.$end_price; // 如果输入框有价钱 则使用输入框的价钱   	 
    	$filter_param['id'] = $id; //加入帅选条件中
    	$brand_id  && ($filter_param['brand_id'] = $brand_id); //加入帅选条件中
    	$spec  && ($filter_param['spec'] = $spec); //加入帅选条件中
    	$attr  && ($filter_param['attr'] = $attr); //加入帅选条件中
    	$price  && ($filter_param['price'] = $price); //加入帅选条件中
         
    	$goodsLogic = new \Home\Logic\GoodsLogic(); // 前台商品操作逻辑类
    	// 分类菜单显示
    	$goodsCate = M('GoodsCategory')->where("id = $id")->find();// 当前分类
    	//($goodsCate['level'] == 1) && header('Location:'.U('Home/Channel/index',array('cat_id'=>$id))); //一级分类跳转至大分类馆
    	$cateArr = $goodsLogic->get_goods_cate($goodsCate);
    	 
    	// 帅选 品牌 规格 属性 价格
    	$cat_id_arr = getCatGrandson ($id);
    	$filter_goods_id = M('goods')->where("is_on_sale=1 and cat_id in(".  implode(',', $cat_id_arr).") ")->cache(true,10)->getField("goods_id",true);
    	// 过滤帅选的结果集里面找商品
    	if($brand_id || $price)// 品牌或者价格
    	{
    		$goods_id_1 = $goodsLogic->getGoodsIdByBrandPrice($brand_id,$price); // 根据 品牌 或者 价格范围 查找所有商品id
    		$filter_goods_id = array_intersect($filter_goods_id,$goods_id_1); // 获取多个帅选条件的结果 的交集
    	}
    	if($spec)// 规格
    	{
    		$goods_id_2 = $goodsLogic->getGoodsIdBySpec($spec); // 根据 规格 查找当所有商品id
    		$filter_goods_id = array_intersect($filter_goods_id,$goods_id_2); // 获取多个帅选条件的结果 的交集
    	}
    	if($attr)// 属性
    	{
    		$goods_id_3 = $goodsLogic->getGoodsIdByAttr($attr); // 根据 规格 查找当所有商品id
    		$filter_goods_id = array_intersect($filter_goods_id,$goods_id_3); // 获取多个帅选条件的结果 的交集
    	}
    	 
    	$filter_menu  = $goodsLogic->get_filter_menu($filter_param,'goodsList'); // 获取显示的帅选菜单
    	$filter_price = $goodsLogic->get_filter_price($filter_goods_id,$filter_param,'goodsList'); // 帅选的价格期间
    	$filter_brand = $goodsLogic->get_filter_brand($filter_goods_id,$filter_param,'goodsList',1); // 获取指定分类下的帅选品牌
    	$filter_spec  = $goodsLogic->get_filter_spec($filter_goods_id,$filter_param,'goodsList',1); // 获取指定分类下的帅选规格
    	$filter_attr  = $goodsLogic->get_filter_attr($filter_goods_id,$filter_param,'goodsList',1); // 获取指定分类下的帅选属性
    	
    	$count = count($filter_goods_id);
    	$page = new Page($count,10);
    	if($count > 0)
    	{
    		$goods_list = M('goods')->where("goods_id in (".  implode(',', $filter_goods_id).")")->order("$sort $sort_asc")->limit($page->firstRow.','.$page->listRows)->select();
    		$filter_goods_id2 = get_arr_column($goods_list, 'goods_id');
    		if($filter_goods_id2)
    			$goods_images = M('goods_images')->where("goods_id in (".  implode(',', $filter_goods_id2).")")->cache(true)->select();
    	}
    	$goods_category = M('goods_category')->where('is_show=1')->cache(true)->getField('id,name,parent_id,level'); // 键值分类数组
    	$this->assign('goods_list',$goods_list);
    	$this->assign('goods_category',$goods_category);
    	$this->assign('goods_images',$goods_images);  // 相册图片
    	$this->assign('filter_menu',$filter_menu);  // 帅选菜单
    	$this->assign('filter_spec',$filter_spec);  // 帅选规格
    	$this->assign('filter_attr',$filter_attr);  // 帅选属性
    	$this->assign('filter_brand',$filter_brand);// 列表页帅选属性 - 商品品牌
    	$this->assign('filter_price',$filter_price);// 帅选的价格期间
    	$this->assign('goodsCate',$goodsCate);
    	$this->assign('cateArr',$cateArr);
    	$this->assign('filter_param',$filter_param); // 帅选条件
    	$this->assign('cat_id',$id);
    	$this->assign('page',$page);// 赋值分页输出
    	$this->assign('sort_asc', $sort_asc == 'asc' ? 'desc' : 'asc');
    	C('TOKEN_ON',false);
        
        if($_GET['is_ajax']){
            
            $this->display('getmoregoodslist');
        }else{
            $this->display('list');
        }
    }

    /**
     * 商品列表页 ajax 翻页请求 搜索
     */
    public function ajaxGoodsList() {
        //动态设置模板配置
        C('VIEW_PATH','./Template/mobile/');
        C('DEFAULT_THEME','new');
        $where ='';

        $cat_id  = I("id",0); // 所选择的商品分类id
        if($cat_id > 0)
        {
            $grandson_ids = getCatGrandson($cat_id);
            $where .= " WHERE cat_id in(".  implode(',', $grandson_ids).") "; // 初始化搜索条件
        }

        $Model  = new \Think\Model();
        $result = $Model->query("select count(1) as count from __PREFIX__goods $where ");
        $count = $result[0]['count'];
        $page = new AjaxPage($count,10);

        $order = " order by goods_id desc"; // 排序
        $limit = " limit ".$page->firstRow.','.$page->listRows;
        $list = $Model->query("select *  from __PREFIX__goods $where $order $limit");

        $this->assign('lists',$list);
        $html = $this->fetch('ajaxGoodsList'); //$this->display('ajax_goods_list');
       exit($html);
    }

    /**
     * 商品详情页
     */
    public function goodsInfo(){
        
        C('TOKEN_ON',true);        
        $goodsLogic = new \Home\Logic\GoodsLogic();
        $goods_id = I("get.id");
        $goods = M('Goods')->where("goods_id = $goods_id")->find();
        

        if(empty($goods)){
        	$this->tp404('此商品不存在或者已下架');
        }

        //记录商品的分类ID 用来做猜你喜欢
        $tmp_cid =cookie('click_goods_cid');
        if (!empty($tmp_cid)) {
            
            cookie('click_goods_cid',$tmp_cid.','.$goods['cat_id']); 
        }else{
          cookie('click_goods_cid',$goods['cat_id']);  
        }
        

        if($goods['brand_id']){
            $brnad = M('brand')->where("id =".$goods['brand_id'])->find();
            $goods['brand_name'] = $brnad['name'];
        }
        $goods_images_list = M('GoodsImages')->where("goods_id = $goods_id")->select(); // 商品 图册        
        $goods_attribute = M('GoodsAttribute')->getField('attr_id,attr_name'); // 查询属性
        $goods_attr_list = M('GoodsAttr')->where("goods_id = $goods_id")->select(); // 查询商品属性表                        
		$filter_spec = $goodsLogic->get_spec($goods_id);  
         
        $spec_goods_price  = M('spec_goods_price')->where("goods_id = $goods_id")->getField("key,price,store_count"); // 规格 对应 价格 库存表
        M('Goods')->where("goods_id=$goods_id")->save(array('click_count'=>$goods['click_count']+1 )); //统计点击数
        $commentStatistics = $goodsLogic->commentStatistics($goods_id);// 获取某个商品的评论统计     
        $this->assign('spec_goods_price', json_encode($spec_goods_price,true)); // 规格 对应 价格 库存表
      	$goods['sale_num'] = M('order_goods')->where("goods_id=$goods_id and is_send=1")->count();
        
        //商品促销
        if($goods['prom_type'] == 1)
        {
            $prom_goods = M('prom_goods')->where("id = {$goods['prom_id']}  AND is_close=0")->find();
            $this->assign('prom_goods',$prom_goods);// 商品促销
			$goods['flash_sale'] = get_goods_promotion($goods['goods_id']);
			$flash_sale = M('flash_sale')->where("id = {$goods['prom_id']}")->find();
			$this->assign('flash_sale',$flash_sale);
        }         
        //组合商品
        $map['goods_id'] = array('in',explode(',', $goods['zuhe_goods_id']));
        $zuhe_lists = M('Goods')->where($map)->limit(3)->select();
        $this->assign('zuhe_lists',$zuhe_lists);
        $this->assign('commentStatistics',$commentStatistics);//评论概览
        $this->assign('goods_attribute',$goods_attribute);//属性值     
        $this->assign('goods_attr_list',$goods_attr_list);//属性列表
        $this->assign('filter_spec',$filter_spec);//规格参数
        $this->assign('goods_images_list',$goods_images_list);//商品缩略图
    	$goods['discount'] = round($goods['shop_price']/$goods['market_price'],2)*10;
        //商品评论数
        $goods['comments_count'] = M('Comment')->where("goods_id=$goods_id")->count();
        $this->assign('goods',$goods);
        $this->display();
    }

    /**
     * 组合购买
     */
    public function zuhe_info(){
        $zuhe_goods_id = I('zid');
        $zuhe_goods_id =  explode(',', $zuhe_goods_id);
        //从高到低排序 同时商品查询也必须根据goods_id从高到低输出 不然组合商品规格数据会对不上号
        rsort($zuhe_goods_id);
        //查询条件
        $map['goods_id'] = array('in',$zuhe_goods_id);
        //从高到低输出
        $zuhe_lists = M('Goods')->where($map)->order('goods_id desc')->select();
        $this->assign('zuhe_lists',$zuhe_lists);
        //规格参数
        $goodsLogic = new \Home\Logic\GoodsLogic(); 
        //循环经过降序排序后的goods_id  查询出规格
        foreach ($zuhe_goods_id as $gid) {
              $filter_spec[] = $goodsLogic->get_spec($gid);
              //获取
              $spec_goods_price_temp[]=M('spec_goods_price')->where("goods_id=$gid")->field("key,price,store_count")->select();
          }  
        $this->assign('filter_spec',$filter_spec);
        // 规格 对应 价格 库存表
        $spec_goods_price  = $spec_goods_price_temp;
        $this->assign('spec_goods_price',$spec_goods_price); 
        /*//商品促销
        if($goods['prom_type'] == 1)
        {
            $prom_goods = M('prom_goods')->where("id = {$goods['prom_id']}  AND is_close=0")->find();
            $this->assign('prom_goods',$prom_goods);// 商品促销
            $goods['flash_sale'] = get_goods_promotion($goods['goods_id']);
            $flash_sale = M('flash_sale')->where("id = {$goods['prom_id']}")->find();
            $this->assign('flash_sale',$flash_sale);
        }*/

        
        $this->display();
    }

    /**
     * 商品详情页
     */
    public function detail(){
        //动态设置模板配置
        C('VIEW_PATH','./Template/mobile/');
        C('DEFAULT_THEME','new');
        //  form表单提交
        C('TOKEN_ON',true);
        $goodsLogic = new \Home\Logic\GoodsLogic();
        $goods_id = I("get.id");
        $goods = M('Goods')->where("goods_id = $goods_id")->find();
        $this->assign('goods',$goods);
        $this->display();
    }

    /*
     * 商品评论
     */
    public function comment(){
        //动态设置模板配置
        C('VIEW_PATH','./Template/mobile/');
        C('DEFAULT_THEME','new');
        $goods_id = I("goods_id",'0');
        $this->assign('goods_id',$goods_id);
        $this->display();
    }

    /*
     * ajax获取商品评论
     */
    public function ajaxComment(){  
          
        $goods_id = I("goods_id",'0');        
        $commentType = I('commentType','1'); // 1 全部 2好评 3 中评 4差评
        if($commentType==5){
        	$where = "goods_id = $goods_id and parent_id = 0 and img !=''";
            //审核后才能显示
            //$where = "goods_id = $goods_id and parent_id = 0 and img !='' and is_show=1";
        }else{
        	$typeArr = array('1'=>'0,1,2,3,4,5','2'=>'4,5','3'=>'3','4'=>'0,1,2');
        	$where = "goods_id = $goods_id and parent_id = 0 and ceil((deliver_rank + goods_rank + service_rank) / 3) in($typeArr[$commentType])";
            //审核后才能显示
            //$where = "goods_id = $goods_id and parent_id = 0 and is_show=1 and ceil((deliver_rank + goods_rank + service_rank) / 3) in($typeArr[$commentType])";
        }
        $count = M('Comment')->where($where)->count();                
        
        $page = new AjaxPage($count,5);
        $show = $page->show();        
        $list = M('Comment')->where($where)->order("add_time desc")->limit($page->firstRow.','.$page->listRows)->select();
        $replyList = M('Comment')->where("goods_id = $goods_id and parent_id > 0")->order("add_time desc")->select();
        //审核后才能显示
        //$replyList = M('Comment')->where("goods_id = $goods_id and parent_id > 0 and is_show=1")->order("add_time desc")->select();
        
        foreach($list as $k => $v){
            $list[$k]['img'] = unserialize($v['img']); // 晒单图片            
        }        
        $this->assign('commentlist',$list);// 商品评论
        $this->assign('replyList',$replyList); // 管理员回复
        $this->assign('page',$show);// 赋值分页输出 
        //动态设置模板配置
        C('VIEW_PATH','./Template/mobile/');
        C('DEFAULT_THEME','new');       
        $this->display();        
    }
    
    /*
     * 获取商品规格
     */
    public function goodsAttr(){
        //动态设置模板配置
        C('VIEW_PATH','./Template/mobile/');
        C('DEFAULT_THEME','new');
        $goods_id = I("get.goods_id",'0');
        $goods_attribute = M('GoodsAttribute')->getField('attr_id,attr_name'); // 查询属性
        $goods_attr_list = M('GoodsAttr')->where("goods_id = $goods_id")->select(); // 查询商品属性表
        $this->assign('goods_attr_list',$goods_attr_list);
        $this->assign('goods_attribute',$goods_attribute);
        $this->display();
    }
     /**
     * 商品搜索列表页
     */
    public function search(){
    	
    	$filter_param = array(); // 帅选数组
    	$id = I('get.id',0); // 当前分类id
    	$brand_id = I('brand_id',0);    	    	
    	$sort = I('sort','goods_id'); // 排序
    	$sort_asc = I('sort_asc','desc'); // 排序
    	$price = I('price',''); // 价钱
    	$start_price = trim(I('start_price','0')); // 输入框价钱
    	$end_price = trim(I('end_price','0')); // 输入框价钱
    	if($start_price && $end_price) $price = $start_price.'-'.$end_price; // 如果输入框有价钱 则使用输入框的价钱   	 
    	$filter_param['id'] = $id; //加入帅选条件中
    	$brand_id  && ($filter_param['brand_id'] = $brand_id); //加入帅选条件中    	    	
    	$price  && ($filter_param['price'] = $price); //加入帅选条件中
        $q = urldecode(trim(I('q',''))); // 关键字搜索
        $q  && ($_GET['q'] = $filter_param['q'] = $q); //加入帅选条件中
        //if(empty($q))
        //    $this->error ('请输入搜索关键词');
        //记录用户搜索记录 只记录最后一次输入,用来做猜你喜欢
        cookie('guess_keywords',$q);
        cookie('guess_catid',$id);
        cookie('guess_brand_id',$brand_id);

    	$goodsLogic = new \Home\Logic\GoodsLogic(); // 前台商品操作逻辑类    	     
    	$filter_goods_id = M('goods')->where("is_on_sale=1 and (goods_name like '%{$q}%' or keywords like '%{$q}%')  ")->cache(true,10)->getField("goods_id",true);

    	// 过滤帅选的结果集里面找商品
    	if($brand_id || $price)// 品牌或者价格
    	{
    		$goods_id_1 = $goodsLogic->getGoodsIdByBrandPrice($brand_id,$price); // 根据 品牌 或者 价格范围 查找所有商品id
    		$filter_goods_id = array_intersect($filter_goods_id,$goods_id_1); // 获取多个帅选条件的结果 的交集
    	}
    	  
    	$filter_menu  = $goodsLogic->get_filter_menu($filter_param,'search'); // 获取显示的帅选菜单
    	$filter_price = $goodsLogic->get_filter_price($filter_goods_id,$filter_param,'search'); // 帅选的价格期间
    	$filter_brand = $goodsLogic->get_filter_brand($filter_goods_id,$filter_param,'search',1); // 获取指定分类下的帅选品牌    	 
    	
    	$count = count($filter_goods_id);
    	$page = new Page($count,10);
    	if($count > 0)
    	{
    		$goods_list = M('goods')->where("goods_id in (".  implode(',', $filter_goods_id).")")->order("$sort $sort_asc")->limit($page->firstRow.','.$page->listRows)->select();
    		$filter_goods_id2 = get_arr_column($goods_list, 'goods_id');
    		if($filter_goods_id2)
    			$goods_images = M('goods_images')->where("goods_id in (".  implode(',', $filter_goods_id2).")")->cache(true)->select();
    	}
    	$goods_category = M('goods_category')->where('is_show=1')->cache(true)->getField('id,name,parent_id,level'); // 键值分类数组
    	$this->assign('goods_list',$goods_list);
    	$this->assign('goods_category',$goods_category);
    	$this->assign('goods_images',$goods_images);  // 相册图片
    	$this->assign('filter_menu',$filter_menu);  // 帅选菜单     
    	$this->assign('filter_brand',$filter_brand);// 列表页帅选属性 - 商品品牌
    	$this->assign('filter_price',$filter_price);// 帅选的价格期间
    	$this->assign('goodsCate',$goodsCate);    	
    	$this->assign('filter_param',$filter_param); // 帅选条件    	
    	$this->assign('page',$page);// 赋值分页输出
    	$this->assign('sort_asc', $sort_asc == 'asc' ? 'desc' : 'asc');
    	C('TOKEN_ON',false);
        
        if($_GET['is_ajax'])
            $this->display('getmoregoodslist');
        else
            $this->display();
    }
    
    /**
     * 商品搜索列表页
     */
    public function ajaxSearch()
    {
        //动态设置模板配置
        C('VIEW_PATH','./Template/mobile/');
        C('DEFAULT_THEME','new');
    } 

   
}