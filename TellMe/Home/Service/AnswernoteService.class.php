<?php
namespace Home\Service;

use Think\Model;

class AnswernoteService extends Model
{
	/*作者：YD
	 作用：查询回复的备注
	依赖关系；
	参数：   回复ID
	返回值：   结果集   */
	function AllAnswerNote($aid){
		$Logic = D('Answernote','Logic');
		return $Logic->QueryAllAnswernote($aid);
	}
	/*作者：YD
	 作用：创建回复备注
	依赖关系；
	参数： $content 内容   	$publishtime  时间   $uid 备注人 
	 $answerid  回复ID  $c 0 匿名1 不匿名      是否匿名  
	返回值：              */
	function CreateAnswerNote(){
		 extract(I());
	    $Logic = D('Answernote','Logic');
		return $Logic->CreateAnswernote($data);
	}
}

?>