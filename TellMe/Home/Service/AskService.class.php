<?php
namespace Home\service;
use Think\Model;



class AskService extends Model
{
	private  $Uid;
	private  $Logic;
	function __construct(){
		$this->Uid =  session('Uid');
		$this->$Logic = D('Ask','Logic');
		  
	}
	
	
	/*
	 *作者：lugege
	 *作用：对问题添加浏览量
	 *依赖关系：
	 *参数：Aid
	 *返回：布尔值
	 */
	function Addviewcount(){
	     return $this->$Logic->Addviewcount(1);
	}
	
	
	/* 
	*作者：lugege	
	*作用：查询所有问题
	*依赖关系：
	*参数： 指定查找[时间字段名,天数]  分页  "页数,显示最大数" 数据库排序Sort=>  1操作时间排序  2赞踩排序 3浏览量 4悬赏 5发布时间 6最近回复 7修改时间 ,asc desc    合并数据排序 array('排序字段','rsort') 默认sort
	*返回：所有问题 对应回复数 的数组
	*/
	
	function AllAsk($page){	
 //          $assign = array('answertime',30);
// //            $assign ='viewcount<=700';
//               $orderby = 'Time desc';  #可以是用zan-cai 原数据库排序 #固定Time是按操作时间排序
// //            $mysort = array('ReaultZan','rsort');
                 $sort = '1,asc';          
                 $sort = I('sort')?I('sort'):$sort;            
                 extract(I());
			 	
                $result = explode(',',$sort);    
            switch($result[0]){
                case 1:
                      $orderby = 'operationdate '.$result[1];            #操作时间排序
                    break;
                case 2:
                      $orderby ='zan-cai '.$result[1];          #赞-踩 排序
                    break;
                case 3:
                     $orderby ='viewcount '.$result[1];         #浏览量
                    break;
                case 4:
                    $orderby ='bounty '.$result[1];
                    $assign = 'bounty is not null';
                              #悬赏额度
                    break; 
                case 5:
                    $orderby ='publishTime '.$result[1];          #发布时间
                    break;
                case 6:
                    $orderby ='answerTime '.$result[1];           #最近回复
                    break;
                case 7:
                    $orderby ='editTime '.$result[1];           #修改时间
                    break;
                
            }
	
	           $a = $this->$Logic->QueryAllAsk($assign,$page,$orderby,$mysort,$limit,$like);
  		    return FE($a,'answer');     	
        }
	
        
    /* 
     *作者：lugege
     *作用：添加问题
     *依赖关系：
     *参数:问题相关数据 标签id多个Id用数字书写
     *返回：布尔值
     */

    function AddAsk(){
//         $data = array('title'=>'dfsfdsdsa','content'=>'waafdfds123eqwe');
//         $tagid = 1;
		extract(I());
    	return $this->$Logic->AddAsk($data,$tagid);
    	
    }
    

    
    
    
    /* 
    *作者：lugege
    *作用：用户修改自己问题
    *依赖关系：
    *参数：Aid Uid必须要Uid用于判断是否是自己的问题
    *返回：布尔值
    */
  function Askupdate(){
      $Aid = 1;
      $Uid = 1;     //后期取$this->Uid
      $Data = array('title'=>'PshP','content'=>'myphp','Tagid'=>array(2));
      return $this->$Logic->Askupdate($Aid,$Uid,$Data);
  }
	
  /* 
  *作者：lugege
  *作用:问题采纳
  *依赖关系：
  *参数：askid answerid 
  *返回：布尔值
  */
	
  function Addadopt(){
  	return $this->$Logic->Addadopt(1,2);
  }
  

  
  /* 
    *作者：lugege
    *作用：Up or down
    *依赖关系：
    *参数：Aid Uid Data
    *返回：布尔值
    */
    function AddUpOrDown(){
    	extract(I());    	
        return $this->$Logic->AddUpOrDown($aid,$uid,$data);
    }
    

    
    
   /* 
   *作者：lugege
   *作用：问题的问题 备注 回复 回复备注
   *依赖关系：
   *参数：Aid
   *返回：
   */
    function Askinfoshow(){
    	$Aid=I('Aid');
    	return $this->$logic->Askinfoshow($Aid);
    }
   

 
}

?>