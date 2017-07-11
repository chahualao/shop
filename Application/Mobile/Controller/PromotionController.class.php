<?php

/**
 * 促销活动
 */
namespace Mobile\Controller;
class PromotionController extends MobileBaseController {

	 public function _initialize()
    {
        parent::_initialize();

        //没有绑定手机号
        if (isset($_SESSION['openid'])) {
            $mobile = M('users')->where(array('openid'=>$_SESSION['openid']))->find();
            $mobile = $mobile['mobile']; 
            if(empty($mobile)){
                $this->redirect('/Mobile/User/mobileinfo');
            }
        }
    }

	public function index(){
		//活动ID
		$pid = I('pid')+0;
		$protomain = M('prom_goods')->where("id=$pid and end_time > ".(time()-86400))->find();
		//提取描述中的第一张图片
		$preg_str = htmlspecialchars_decode($protomain['description']);
		preg_match('/<\s*img\s+[^>]*?src\s*=\s*(\'|\")(.*?)\\1[^>]*?\/?\s*>/i',$preg_str,$match);
		if($match){
			$protomain['extra_img_url'] = $match[2];
		}
		if(!$protomain){
			$this->error("抱歉，此次活动已过期。",U('Mobile/Index/index'));
		}else{
			//获取商品信息
			$goods = M('goods')->where("is_on_sale=1 and prom_id=$pid and prom_type=3")->order('goods_id desc')->limit(6)->select();
			$this->assign('protomain',$protomain);
			$this->assign('goods',$goods);
			$this->display();
		}

	}

	//获取更多
	public function get_more_lists(){
		//活动ID
		$pid = I('pid')+0;
		$p = I('p',1);
		$goods = M('goods')->where("is_on_sale=1 and prom_id=$pid and prom_type=3")->order('goods_id desc')->page($p,6)->select();
		$this->assign('more_lists',$goods);
		$this->display('special_get_more');
	}
}