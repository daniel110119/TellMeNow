<?php
namespace Home\Common;
use Think\Controller;
#权限公共方法
class CommonController extends Controller {
	protected $rights;
	function __construct(){
		$id = session("Uid");	
		$this->refreshRights($id);
	}
	
	function checkRights($optionName){
		$optionName = substr($optionName,strpos($optionName,'::')+2);	
		return in_array(array('rightsname'=>$optionName),S("rights"));
	}
	
	function refreshRights($id){ 	
		if(!empty($id)){
			$m = M();
			$this->rights = $m->query("select rightsName from t_rights where grade <= (select reputation from  t_userInfo where id = $id)");
			S("rights",$this->rights);
		}else{
			S("rights",null);
		}
		
	}
	
}

?>