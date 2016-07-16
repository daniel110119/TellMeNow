<?php
namespace Home\service;
use Think\Model;
class UserService extends Model
{
 /* 
 *作者：Lu
 *作用：查询所有用户
 *依赖关系：
 *参数：分页 默认不分页 "页数,显示最大数"
 *返回：
 */
   function Users($page=false){
       $Logic = D('User','Logic');
       return $Logic->AllUser($page);
   }

   
   /* 
  *作者：lugege
  *作用：注册用户
  *依赖关系：
  *参数：用户数据
  *返回：布尔值
  */
   function Reg($data){
   		$Logic = D('User','Logic');
   		return $Logic->RegUser();
   }
  /* 
  *作者：lugege
  *作用：用户登录
  *依赖关系：
  *参数：用户数据
  *返回：布尔值
  */
   function Login($data){
   	
   }
   
   /* 
   *作者：lugege
   *作用：用户更新信息
   *依赖关系：
   *参数：用户数据
   *返回：布尔值
   */
   function UpDataInfo($data){
   	
   	
   }
   /* 
   *作者：lugege
   *作用：用户声望更新
   *依赖关系：
   *参数：声望数据
   *返回：布尔值
   */
   function UpReputation($data){
   	
   }
   
   /* 
   *作者：lugege
   *作用：显示用户主页
   *依赖关系：
   *参数：Uid
   *返回：
   */
   
   function showUserPage($Uid=FALSE){
   		$Uid = $Uid?$Uid:session("Uid");
   }
   
}

?>