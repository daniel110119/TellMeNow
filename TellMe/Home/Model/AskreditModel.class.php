<?php
namespace Home\Model;
use Think\Model\RelationModel;
    #他人再编辑 -》问题表-》用户信息表   t_askRedit   ->  t_ask  -> t_userinfo
class AskreditModel extends RelationModel
{
	
	protected $_auto= array(
			array('edittime','edittimeDate',3,'callback'),
			
	
	);
	function edittimeDate(){
		return date("Y-m-d H:i:s");
	}

   
   protected $_link = array(
           'userinfo'=> array(
               'mapping_type'=>self::BELONGS_TO,
               'foreign_key'=>'uid',
           		'as_fields' => 'nickname,website,url,reputation'
           )
      );
}

?>