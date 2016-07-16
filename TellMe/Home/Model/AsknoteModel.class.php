<?php
namespace Home\Model;

use Think\Model\RelationModel;

class AsknoteModel extends RelationModel
{
	
	protected $_auto= array(
			array('publishtime','PublishtimeDate',1,'callback'),
				
	);
	function PublishtimeDate(){
		return date("Y-m-d H:i:s");
	}
	
	protected $_link = array(
			'userinfo'=>array(
					'mapping_type' =>self::BELONGS_TO,
					'foreign_key' => 'uid',
					'as_fields'=>'nickname'
			),
	);
}

?>