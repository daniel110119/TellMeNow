<?php
namespace Home\Service;

use Think\Model;

class AskreditService extends Model
{
	function AllAskredit(){
		$Logic = D('Askredit','Logic');
		return $Logic->queryAllAskredit();
	}
	
	/* 
	*作者：lugege
	*作用：查询他人对当前用户 问题的修改情况  按照 isAccept状态查询 0未执行任何操作 1已查看并不同意 2同意
	*依赖关系：
	*参数：uid
	*返回：数据资源
	*/
	function GainRedit(){
		$uid=1;
		$Logic = D('Askredit','Logic');
		return $Logic->GainRedit($uid);
	}
	
	/*
	*作者：lugege
	*作用：其他用户对问题二次操作
	*依赖关系：AskreditLogic
	*参数：data{
	*	uid
	*	aid
	*	aftercontent
	*}
	*返回：布尔值
	*/
	function Addredit(){
		$data=array('uid'=>3,'aid'=>3,'aftercontent'=>'h22hah');
		$Logic = D('Askredit','Logic');
		return $Logic->Addredit($data);
	}
	
	/* 
	*作者：lugege
	*作用：同意&不同意 他人修改 修改原问题内容    并更改isAccept状态
	*依赖关系：
	*参数：reditid 'y'or'n' 
	*返回：布尔值
	*/
	function Agree(){
		$reditid = 2;
		$select = 'y';	
		$Logic = D('Askredit','Logic');
		return $Logic->Agree($reditid,$select);
	}
	
	
	
	/* 
	*作者：lugege
	*作用：高权限下 立即对问题进行修改 并更改isAccept状态
	*依赖关系：
	*参数：data{
	*	aid
	*	aftercontent
	*}
	*返回：布尔值
	*/
	function PowerOperate($data){
		$data=array('uid'=>5,'aid'=>24,'aftercontent'=>'2a4');
		$Logic = D('Askredit','Logic');
		return $Logic->PowerOperate($data);
	}
	

	
}

?>