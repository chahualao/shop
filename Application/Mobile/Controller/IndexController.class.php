<?php
/**
 * 
 */ 
namespace Mobile\Controller;
class IndexController extends MobileBaseController {

    public function index(){
        //没有绑定手机号
        if (isset($_SESSION['openid'])) {
            $mobile = M('users')->where(array('openid'=>$_SESSION['openid']))->find();
            $mobile = $mobile['mobile']; 
            if(empty($mobile)){
                $this->redirect('/Mobile/User/mobileinfo');
            }
        }
        //头部广告位
        $adv =  M('ad')->where(time()." >= start_time and ".time()." <= end_time and enabled=1")->order('orderby desc,ad_id')->limit(3)->select();
        $this->assign('adv',$adv);

        //团购 显示5条信息
        $Groupon = M('GroupBuy')->where(time()." >= start_time and ".time()." <= end_time ")->order('sort desc,goods_id')->limit(5)->select();

        $this->assign('Groupon',$Groupon);

        //促销商品 prom_type=3

        $promotion = M('prom_goods')->where('star=1')->order('sort desc,id')->limit(3)->select();
        
        foreach ($promotion as $value) {
            $id =  $value['id'];
            $promotion['goods_lists'][$id] = M('goods')->where("is_on_sale=1 and prom_id=$id and prom_type=3")->order('goods_id desc')->select();
        }
        
        $this->assign('promotion',$promotion);

        //专场 提取商品促销模块中春节专场 prom_id=2 prom_type=3
        //如果去掉，可以删除掉促销模块中的春节专场，或者编辑春节专场 去掉里面的所有商品
        $special = M('goods')->where('is_on_sale=1 and prom_id=2 and prom_type=3')->order('goods_id desc')->limit(3)->select();
        $this->assign('special',$special);
        
        //新品上市 提取商品促销模块中新品上市 prom_id=3 prom_type=3
        $new_products = M('goods')->where('is_on_sale=1 and prom_id=3 and prom_type=3')->order('goods_id desc')->limit(5)->select();
        $this->assign('new_products',$new_products);

        //达人推荐 提取商品促销模块中达人推荐 prom_id=4 prom_type=3
        //这里只提取一条信息 前台是一条信息三张图片
        /*$recommendation = M('goods')->where('is_on_sale=1 and prom_id=4 and prom_type=3')->order('goods_id DESC')->limit(1)->cache(true,TPSHOP_CACHE_TIME)->select();*/
        $recommendation = M('goods')->where('is_on_sale=1 and prom_id=4 and prom_type=3')->order('goods_id desc')->limit(1)->select();
        if(isset($recommendation[0]['goods_id'])){
            $gid = $recommendation[0]['goods_id'];
            $goods_images_list = M('GoodsImages')->where("goods_id = $gid")->select();
            $prom = M('prom_goods')->where('id=4')->find();
            $recommendation = array(
                    'goods_id'=>$recommendation[0]['goods_id'],
                    'goods_images_list'=> $goods_images_list,
                    'goods_name'=>$recommendation[0]['goods_name'],
                    'desc'=>htmlspecialchars_decode($prom['description']),
                );   
        }else{
            $recommendation = '';
        }

        $this->assign('recommendation',$recommendation);
        //dump($like);
        //猜你喜欢
        $like = maybeYouLike(5,1);
        $this->assign('maybeyoulike',$like);
        

       /* //热卖商品
        $hot_goods = M('goods')->where("is_hot=1 and is_on_sale=1")->order('goods_id DESC')->limit(20)->cache(true,TPSHOP_CACHE_TIME)->select();
        $this->assign('hot_goods',$hot_goods);
        */

        //分类
        $goods_category = M('goods_category')->where('level=1')->order('sort_order')->limit(9)->cache(true,60)->select();
        $this->assign('goods_category',$goods_category);

        /*//首页推荐商品
        $favourite_goods = M('goods')->where("is_recommend=1 and is_on_sale=1")->order('goods_id DESC')->limit(20)->cache(true,TPSHOP_CACHE_TIME)->select();
        $this->assign('favourite_goods',$favourite_goods);*/

        $this->display('index');
    }

    /**
     * 分类列表显示
     */
    public function categoryList(){
            //动态设置模板配置
            C('VIEW_PATH','./Template/mobile/');
            C('DEFAULT_THEME','new');
        $this->display();
    }

    /**
     * 模板列表
     */
    public function mobanlist(){
        $arr = glob("D:/wamp/www/svn_tpshop/mobile--html/*.html");
        foreach($arr as $key => $val)
        {
            $html = end(explode('/', $val));
            echo "<a href='http://www.php.com/svn_tpshop/mobile--html/{$html}' target='_blank'>{$html}</a> <br/>";            
        }        
    }
    
    /**
     * 商品列表页
     */
    public function goodsList(){
        $goodsLogic = new \Home\Logic\GoodsLogic(); // 前台商品操作逻辑类
        $id = I('get.id',0); // 当前分类id
        $lists = getCatGrandson($id);
        $this->assign('lists',$lists);
        $this->display();
    }
    //获得更多猜你喜欢
    public function getyoulikemore(){
    	$p = I('p',1);
    	$this->assign('maybeyoulike',maybeYouLike(5,$p));
    	$this->display();
    }
}