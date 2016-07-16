<?php
namespace Home\Model;
use Think\Model\RelationModel;

final class TagModel extends RelationModel {
	
	protected $_auto = array(
			array('createtime','createtimeDate',1,'callback')
	);
	
	
	function createtimeDate(){
		return date("Y-m-d H:i:s");
	}
	
	
	protected $_link = array(	
			#通过标签到问题
			'ask' => array(
					'mapping_type' => self::MANY_TO_MANY,
					'relation_table' => 't_ask_tag',
					'relation_foreign_key' => 'askid',
					'foreign_key' =>'tagid'
					
			)
			
	);
}

?>