<?php
namespace Home\Model;
use Think\Model\RelationModel;

class UserModel extends RelationModel {
	protected $_validate=array(
// 			array('username','require','用户名必须',1),
// 			array('username','','账号已存在',1,'unique',1),	
// 			array('password','require','密码必须'),
// 			array('email','require','邮箱必须'),
// 			array('nickname','require','昵称必须'),
// 			array('phone','/^(138|135|133|130|158) (\d){8}$/','手机号格式错误'),
// 			array('email','email','邮箱格式出错',1),
// 			array('password','8,30','密码长度小于8位',0,'length')
	);
	protected $_auto= array(
			array('password','md5',3,'function'),
			
	);
			
	

	#用户信息
	protected $_link = array(	
		'userinfo' => array(
				'mapping_type' => self::HAS_ONE,
				'foreign_key' => 'id'						
		)	
	);
	
	
}
?>