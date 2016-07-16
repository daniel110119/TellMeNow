<?php
namespace Home\Logic;
use Think\Model;

class AskLogic extends Model
{
    
    
     function QueryAllAsk($assign,$page=false,$orderby=false,$mysort=false,$limit=
      false,$like=false){
         $m = D('Ask');       
         strtolower($orderby);
          if(stristr($orderby,'operationdate')){
             $orderby= str_ireplace('operationdate','(If(editTime<answerTime,answerTime,editTime))',$orderby);
          }

         if(is_array($assign)){          
             $str =array("DATEDIFF(now(),$assign[0])<=$assign[1]");
         }else{
          $str = $assign;
         }
        if($like){

          $likes=array("%$like%","$like%","%$like",$like);
      
          for($i=0;$i<=3;$i++){           
            $arr = $m->relation(array('userinfo','answer','tag'))->page($page)->where("content like BINARY '$likes[$i]' or title like BINARY '$likes[$i]'")->select();           
            if(count($arr)>0){
              break;
            }
          }          
        }else{
         $arr = $limit?$m->relation(array('userinfo','answer','tag'))->page($page)->where($str)->order($orderby)->limit($limit)->select():$m->relation(array('userinfo','answer','tag'))->page($page)->where($str)->order($orderby)->select();
        }
       		foreach($arr as &$val){
       			$id = $val['id'];
       			$uid = $val['uid'];
       			$sql = "select tu.nickname,ta.publishTime from t_answer as ta join t_userinfo as tu on(ta.uid=tu.id) where ta.aid = $id group by ta.publishTime desc limit 1";
       			$v =  $this->query($sql);
        		$sq2 = "select tb.url,count(tb.badgeType) as BadgeType from t_user_badge as ub join t_badge as tb on(ub.bid=tb.id) where ub.uid=$uid group by tb.badgeType";
				$v2 =  $this->query($sq2);
       			$val['AnswerNickName']=$v[0]['nickname'];
       			$val['AnswerPublishTime']=$v[0]['publishtime'];
       			$val['ZanResult']=$val['zan'] - $val['cai'];
       			$val['Badge'] = $v2;
       			foreach($val['tag'] as &$vv){
       				$vv = $vv['tagname'];
       			}
       		}
       		return $mysort?setsort($arr,$mysort):$arr;
        }
		

      function AddAsk($data,$tag){   //多个标签名可用数组传递
      	$m=D('Ask');
      	$m->startTrans();     //事务开启
      	$flag = false;
      	if($m->create($data)){
       		$Result =  $m->add();	
      		if(is_array($tag)){
      			foreach($tag as $v){
      				$flag = $this->execute("insert into t_ask_tag(askid,tagid) values($Result,$v)");
      			}
      		}else{
      				$flag = $this->execute("insert into t_ask_tag(askid,tagid) values($Result,$tag)");
      		}
      		if($flag){
      		    $m->commit();
      		    return true;
      		}else{
      		    $m->rollback();
      		    return false;
      		}	
      	}else{
      		return false;
      	}
      }
      
      
      
      function Askupdate($Aid,$Uid,$Data){
         
          $m=D('Ask');
          $tagid = $Data['Tagid'];
          $flag = false;
          $score =$m->where("id=$Aid")->select();
          if( $score[0]['uid']!= $Uid){          	
              return false;
          }
          if(array_key_exists('Tagid', $Data)){
             $m->startTrans();
             $sa = $m->where("id=$Aid")->save($Data);
              $del = $this->execute("DELETE FROM `t_ask_tag` WHERE askid =  $Aid");
                if(is_array($tagid)){
                    foreach($tagid as $v){
                        $flag = $this->execute("insert into t_ask_tag(askid,tagid) values($Aid,$v)");           
                            if(!$flag){
                                $m->rollback();
                                return false;
                            }
                    }             
              }else{
                  return false;
              }
          }else{
             $m->where("id=$Aid")->save($Data);
             return true;
          }
          if($flag && $sa && $del){               
              $m->commit();
                return true;
          }else{               
              $m->rollback(); 
              return false;
          }
          
          
      }
      
      function Addadopt($askid,$answerid){
          $m = D('Ask');
          $arr = $this->query("select uid from t_answer where id = $answerid");
          $Result = $arr[0]['uid'];       
          return $m->where("id=$askid")->save(array('adoptid'=>$Result));
      }
     
      function Addviewcount($aid){
          $m = D('Ask');
          #setInc和setDec方法  自增 自减
           return   $m->where("id=$aid")->setInc('viewcount');
      }
      
     function AddUpOrDown($aid,$uid,$data){
         $m = D('Ask');
         $m->startTrans();
         $date= date("Y-m-d H:i:s");
         $flag = $this->execute("insert into t_ask_opt(uid,askid,votetime) values($uid,$aid,'$date')");		
         $sa = false;
         if($data>0){
         	$num= $m->where("id = $aid")->getField('zan');
           $sa = $m->where("id=$aid")->save(array('zan'=>$num+1));
   
         }else{
         	$num= $m->where("id = $aid")->getField('cai');
           $sa = $m->where("id = $aid")->save(array('cai'=>$num+1));
         }
        
         if($flag && $sa){
             $m->commit();
             return ture;
         }else{
             $m->rollback();
             return false;
         }
     }

     
     function Askinfoshow($Aid){
     	$Ask = D('Ask');
     	$Answer = D('Answer');
     	$Ansnote = D('Answernote');
     	$arr = $Ask->relation(array('userinfo','asknote','tag'))->where("id=$Aid")->select();
     	$arr2 = $Answer->relation('userinfo')->where("aid=$Aid")->select();
     	foreach($arr2 as &$v){
     		$vl = $v['id'];
     		$Ans= $Ansnote->relation('userinfo')->where("answerid = $vl ")->select();	
     		if(count($Ans)>0){
     		 $v['answernote']=$Ans;
     		}else{
     			$v['answernote']=0;
     		}
     	}
     	
     		foreach($arr[0]['tag'] as &$vv){
     			$vv=$vv['tagname'];
     		}
    
     		foreach($arr[0]['asknote'] as &$vv){
     		$uid = $vv['uid'];
     		$nickname = $this->query("select nickname from t_userinfo where id = $uid");
     		$vv['nickname']=$nickname[0]['nickname'];
     		}
     	
     	$arr[0]['answer']=$arr2;
     	 return $arr;
     }
     
    
}

?>