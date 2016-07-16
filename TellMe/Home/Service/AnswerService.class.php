<?php
namespace Home\service;
use Think\Model;

class AnswerService extends Model
{
	/*作者：
	作用：取出所有回复
	依赖关系；
	参数：  ask id   显示数$page
	返回值：      arr    */
        function AllAnswer(){
        	$aid=1;
        $Logic = D('Answer','Logic');
        return $Logic->QueryAllAnswer($aid,$page);
        }
    /*作者：
    作用：创建回复
    依赖关系；
    参数：  ASK ID
    返回值：                */
         function CreateAnswer(){
         	$Logic = D('Answer','Logic');
          extract(I());
         	return $Logic->CreateAnswer($data);
         } 
         
  
         /*作者：
          作用：回复的赞
         依赖关系； 
         参数：  回复ID   $c 赞 还是踩   1  -1
         返回值：*/
         function AnswerZanCai($ansid,$c){
         	extract(I());    	
         	$Logic = D('Answer','Logic');
       
         	return $Logic->AnswerZanCai($uid,$ansid,$data);
         }
 
   /*作者：
   作用：修改问题
   依赖关系；
   参数：问题ID
   返回值：*/
          function ModifAnswer(){
          	$Logic = D('Answer','Logic');
          	$data=array(
          			'uid'=>1,
          			'content'=>'asdasd',
          			'ansid'=>4    	
          	);
          	return $Logic->ModifAnswer($data);
          }
          /*作者：
          作用： 查询用户的回复
          依赖关系；
          参数：Uid
          
          返回值：*/
          function AllAnswerByUserId($uid,$showpage,$page){
          	$uid=1;
          	$Logic = D('Answer','Logic');
          	return $Logic->AllAnswerByUserId($uid,$page);
          }
}

?>