<?php
namespace Home\Logic;
use Think\Model;

class UserLogic extends Model
{
    function AllUser($page=false){
    	echo $page;
        $m = D('User');
       return $page?$m->relation(true)->page("$page")->select():$m->relation(true)->select();
    }
    function RegUser(){
    	$m = D('User');
   		$arr = array();
    	$arr['username']=I("get.username");
    	$arr['userinfo']=array('regDate'=>date("Y-m-d H:i:s"));
    	
    	$m->relation('userinfo')->add($arr);
//     	if($m->create(I("get."))){		
//     		$m->relation('userinfo')->add();
//     		return true;
//     	}else{ 		
//     		return $m->getError();
//     	}
    }
}

?>
