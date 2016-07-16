<?php
namespace Home\Logic;

use Think\Model;

class AnswerLogic extends Model
{      
	/*作者：YD
	作用：根据问题ID查回复
	依赖关系；
	参数：$aid,$page  显示个数
	返回值： arr   */
       function QueryAllAnswer($aid,$page=false){
           $m = D('Answer');
           $a=$m->page("$page")->where("id=$aid")->relation(array('answernote','userinfo'))->select();
           $score=D('Ask');
           $b= $score->relation('userinfo')->where("id=$aid")->select();
         	print_r(FE($b,$a,'aid')) ;
		   
           
            
       }
     /*作者：YD
     作用：创建回复
     依赖关系；
     参数： $data
     返回值：     是否成功操作     */
      
       	function CreateAnswer($data){
       		$m =D('Answer');
       		if($m->create($data)){
       			return $m->add();
       		}
       	 } 
       	 
     /*作者：YD
     作用：回复赞 踩
     依赖关系；
     参数：回复ID
     返回值：   布尔值 是否操作成功          */
       	 function AnswerZanCai($uid,$ansid,$data){
	       	 $m =D('Answer');
	         $m->startTrans();
	         $date= date("Y-m-d H:i:s");
	         $result = $this->query("select aid from t_answer where id=$ansid");
	         $result = $result[0]['aid'];
	         $flag = $this->execute("insert into t_ans_opt(uid,askid,answerid,votetime) values($uid,$result,$ansid,'$date')");
	         $sa = false;
	         if($data>0){
	           $sa = $m->where("id=$ansid")->setInc('zan');
	         }else{
	           $sa = $m->where("id=$ansid")->setInc('cai');
	         }
	         if($flag && $sa && $result){
	             $m->commit();
	             return ture;
	         }else{
	             $m->rollback();
	             return false;
         }
       	 	
       }
       	 
       	 
    /*作者：YD
    作用：修改answer
    依赖关系；
    参数：新的内容  
    返回值：*/
      	 function ModifAnswer($data){
      	 	extract($data);
      	 	$m=D('Answer');
      	 	if($m->create($data)){   	 
      	 		return $m->where("id=$ansid and uid=$uid")->save();
      	 	}
      	 }
  /*作者：
  作用：
  依赖关系；field
  参数：
  返回值：*/
      	  function AllAnswerByUserId($uid,$page=false){
      	  	$m = D('Answer');
      	  	return $m->page("$page")->where("uid=$uid")->select();    	  	  
      	  }
     
      	 
}

?>