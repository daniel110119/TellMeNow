<?php
namespace Home\Model;

use Think\Model\RelationModel;

class AnswernoteModel extends RelationModel
{
	
   protected $_auto=array(
   		   array('publishtime','getDate',1,'callback')
   		);
       function getDate(){
      	   return date("Y-m-d G:i:s");
      	               }

   
   
   
   protected $_link = array(
            'userinfo'=>array(
                'mapping_type' =>self::BELONGS_TO,
                'foreign_key' => 'uid',
            	'as_fields'=>'nickname'
            )
     );
}

?>