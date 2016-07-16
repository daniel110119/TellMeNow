<?php
namespace Home\Service;
use Think\Model;

class AsknoteService extends Model
{
    function AllAskNote(){
        $Logic = D('Asknote','Logic');
        return $Logic->AllAskNote();
    }
    
    /* 
    *作者：lugege
    *作用：根据问题id显示出问题备注 已经备注 及其备注者信息
    *依赖关系：
    *参数：Aid
    *返回：数据资源
    */
    
    function QueryAsknote(){
    	$aid = 2;
    	$Logic = D('Asknote','Logic');
    	return $Logic->QueryAsknote($aid);
    }
    
    /* 
    *作者：lugege
    *作用：添加新的问题备注
    *依赖关系：
    *参数：data={
    *	aid    问题id
    *	content 内容
    *}
    *返回：布尔值
    */
    function AddAsknote(){
    	// $data=array('aid'=>2,'uid'=>1,'content'=>'hahaha');
        extract(I()); 
    	$Logic = D('Asknote','Logic');
    	return $Logic->AddAsknote($data);
    }
    
    
}

?>