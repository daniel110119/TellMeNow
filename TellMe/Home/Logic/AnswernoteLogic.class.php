<?php
namespace Home\Logic;

use Think\Model;

class AnswernoteLogic extends Model
{
	 /*作者：YD
	 作用： 查询回复的备注
	 依赖关系；
	 参数：回复AID 
	 返回值：   $arr */
        function QueryAllAnswernote($aid){
            $m =D('Answernote');
            return $m->relation(true)->where("id=$aid")->select();
        }
        /*作者：YD
        作用：创建回复备注
        依赖关系；
        参数：$content,$publishtime,$uid,$answerid,$c
        返回值：*/
        function CreateAnswernote($data){
        	$m =D('Answernote');  	
        	 if($m->create($data)){
        	 	return $m->add();
        	 }   	

        }
}

?>