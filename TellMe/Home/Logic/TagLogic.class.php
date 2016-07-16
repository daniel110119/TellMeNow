<?php
namespace Home\Logic;

use Think\Model;

class TagLogic extends Model
{
        function QueryAllTag(){
            $m = D('Tag');
           return  $m->relation('ask')->select();
        }
        function AddAsk(){
        	$m= D('Tag');
        	return $m->relation(true)->add();
        }
}

?>