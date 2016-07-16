<?php
namespace Home\Controller;
use Home\Common\CommonController;
class IndexController extends CommonController {

	
	function index(){
		$id = session("id",1);
		
	}

    function cai(){    	
    	if(!$this->checkRights(__METHOD__)){
    		die('权限不够');
    	}
    		echo '权限达成';

    }
    function caii(){
    	if(!$this->checkRights(__METHOD__)){
    		die('权限不够');
    	}	
    		echo '权限达成';
    	
    }
}