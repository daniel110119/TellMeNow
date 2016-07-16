<?php
namespace Home\Service;

use Think\Model;

class TagService extends Model
{
	/* 
	*作者：lugege
	*作用：按照标签名进行指定查找操作  排序  分页
	*依赖关系：
	*参数：排序模式 指定标签
	*返回:查询数据
	*/
	function AssignQuery($tagname,$orderby= false,$page = false){
		
	}
	
	
	
	/* 
	*作者：lugege
	*作用：查询标签 并列举出 每个标签其对应的问题数量
	*依赖关系：
	*参数：
	*返回：查询数据
	*/
    function AllTag(){
            $Logic = D('Tag','Logic');  
            return FE( $Logic->QueryAllTag(),'ask');
        }
        
        
    /* 
    *作者：lugege
    *作用：用户自定义标签
    *依赖关系：
    *参数：tag数据
    *返回：
    */   
     function AddTag($data){
     	
     }
    
}

?>