<?php
namespace Home\Model;
use Think\Model\RelationModel;

class AskModel extends RelationModel {
	
	protected $_auto = array(
		array('publishTime','CreateNowDate',3,'callback'),
	);
	
	
	function CreateNowDate(){
		return date("Y-m-d H:i:s");
	}
	
	
    #问题-》用户信息-》问题赞踩    t_ask  -> t_askNote ->  t_userinfo -> t_ask_opt
	protected $_link = array(
	       'asknote'=>array(
	           'mapping_type' =>self::HAS_MANY,
    	        'foreign_key' => 'aid'
	        ),
	       'userinfo'=>array(
    	       'mapping_type' =>self::BELONGS_TO,
    	       'foreign_key' => 'uid',
	       		'as_fields'=>'nickname,url,reputation,website'
	        ),
	        'askOpt'=>array(
    	        'mapping_type' =>self::HAS_MANY,
    	        'foreign_key' => 'askid'
	        ),
	        'answer'=>array(
	            'mapping_type' =>self::HAS_MANY,
	             'foreign_key' => 'aid',
	        ),
			'tag' => array(
					'mapping_type' => self::MANY_TO_MANY,
					'relation_table' => 't_ask_tag',
					'foreign_key' =>'askid',
					'relation_foreign_key' => 'tagid',
					'mapping_fields' =>'tagname',
					'as_fields'=>'tagname'
			)
	);	
}

?>