<?php
namespace Home\Model;
use Think\Model\RelationModel;

class AnswerModel extends RelationModel {
	protected $_auto=array(
			array('publishTime','getDate',3,'callback')
	);
	function getDate(){
		return date("Y-m-d G:i:s");
	}
    #回复-》回复备注-》用户信息-》回复赞踩    t_answer  ->  t_answerNote ->  t_userinfo -> t_ans_opt
	protected $_link = array(
	       'answernote'=>array(
	           'mapping_type' =>self::HAS_MANY,
	           'foreign_key' => 'answerid'
	        ),
	       'userinfo'=>array(
    	       'mapping_type' =>self::BELONGS_TO,
    	       'foreign_key' => 'uid',
	       		'as_fields'=>'nickname,url,reputation,website'
	        ),
	        'ansOpt'=>array(
    	        'mapping_type' =>self::HAS_MANY,
    	        'foreign_key' => 'answerid'
	        ),
// 			
	       
	);	
}

?>