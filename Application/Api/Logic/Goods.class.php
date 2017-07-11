<?php
/**
 * 商品逻辑类
 */
namespace Api\Logic;

use Think\Model\RelationModel;

class Goods extends RelationModel{

	/**
     *  获取排好序的品牌列表    
     */
    function getSortBrands()
    {
        $brandList =  M("Brand")->select();
        $brandIdArr =  M("Brand")->where("name in (select `name` from `".C('DB_PREFIX')."brand` group by name having COUNT(id) > 1)")->getField('id,cat_id'); 
        $goodsCategoryArr = M('goodsCategory')->where("level = 1")->getField('id,name');
        $nameList = array();

        foreach($brandList as $k => $v)
        {
            
            $name = getFirstCharter($v['name']) .'  --   '. $v['name']; // 前面加上拼音首字母            
            
            if(array_key_exists($v['id'],$brandIdArr) && $v['cat_id']) // 如果有双重品牌的 则加上分类名称            
                    $name .= ' ( '. $goodsCategoryArr[$v['cat_id']] . ' ) ';            
                
            $nameList[] = $v['name'] = $name; 
            $brandList[$k] = $v;
        }

        array_multisort($nameList,SORT_STRING,SORT_ASC,$brandList); 

        return $brandList;
    }

    /**
     *  获取排好序的分类列表     
     */
    function getSortCategory()
    {
        $categoryList =  M("GoodsCategory")->getField('id,name,parent_id,level');
        $nameList = array();
        foreach($categoryList as $k => $v)
        {
            
            //$str_pad = str_pad('',($v[level] * 5),'-',STR_PAD_LEFT);
            $name = getFirstCharter($v['name']) .' '. $v['name']; // 前面加上拼音首字母            
            //$name = getFirstCharter($v['name']) .' '. $v['name'].' '.$v['level']; // 前面加上拼音首字母            
            /*
            // 找他老爸
            $parent_id = $v['parent_id']; 
            if($parent_id)
                $name .= '--'.$categoryList[$parent_id]['name'];
            // 找他 爷爷
            $parent_id = $categoryList[$v['parent_id']]['parent_id'];
            if($parent_id)
                $name .= '--'.$categoryList[$parent_id]['name'];            
            */
            $nameList[] = $v['name'] = $name; 
            $categoryList[$k] = $v;
        } 
                
        array_multisort($nameList,SORT_STRING,SORT_ASC,$categoryList); 

        return $categoryList;
    }      
}