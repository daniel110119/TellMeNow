<?php
namespace Home\Logic;

use Think\Model;

class AskreditLogic extends Model
{
    function queryAllAskredit(){
       $m = D('Askredit');
       return $m->relation('ask')->where('uid=2')->select();
    }
    
    function GainRedit($uid){
    	$m = D('Askredit');
    	$score = $this->query("select id from t_ask where uid=4");
    	$Result = array();
    	foreach($score as &$val){
    		foreach($val as $v){
    			$a =$m->field('id,edittime,aftercontent,isaccept,uid')->relation('userinfo')->where("aid=$v")->select();
    				if($a!=null){
    					array_push($Result,$a[0]);
    				}	
    		}
    	}
    	return setsort($Result);
    	
    }
    
    function Addredit($data){
    	$m = D('Askredit');
    	if($m->create($data)){
    		return $m->add();
    		
    	}else{
    		return false;
    	}
    	
    	
    }
    
    function Agree($reditid,$select){
    	//状态查询 0未执行任何操作 1已查看并不同意 2同意
    	$m = D('Askredit');
    	$m->startTrans();
    	if($select=='y'){
    		$sv = $m->where("id=$reditid")->setField('isAccept',2);
    		$flag = $m->field('aid,edittime,aftercontent')->where("id=$reditid")->select();
    		$flag=$flag[0];
    		extract($flag);
    		$s = $this->execute("update t_ask set content='$aftercontent',editTime= '$edittime' where id=$aid");
    	}else{
    		$sv = $m->where("id=$reditid")->setField('isAccept',1);
    		return true;
    	}
    	
    	if($m && $s){
    		$m->commit();
    		return true;
    	}else{
    		$m->rollback();
    		return false;
    	}
    }

    
    function PowerOperate($data){
    	$m = D('Askredit');
    	if($m->create($data)){
    		$id= $m->add();    	
    	}else{
    		return false;
    	}
    	return $this->Agree($id,'y');
    }
}

?>