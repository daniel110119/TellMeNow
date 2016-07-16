<?php
namespace Home\Logic;

use Think\Model;

class AsknoteLogic extends Model
{
	
    function AllAskNote(){
        $m = D('Asknote');
        return $m ->Relation(true)->select();
    }
    

    function QueryAsknote($aid){
    	$m = D('Asknote');
    	return $m->relation(true)->where("aid=$aid")->order('publishtime desc')->select();
    }
    
    
    function AddAsknote($data){
    	$m = D('Asknote');
    	if($m->create($data)){
    		return $m->add();
    	}else{
    		return exit($m->geterror());
    	}
    	
    }
}

?>