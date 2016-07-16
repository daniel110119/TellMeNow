<?php
namespace Home\Controller;
use Think\Controller;
    
class UserController extends Controller 
{   
   function Index(){
          $ServiceAsk = D('Ask','Service');
          $Askdata = $ServiceAsk->Allask();
            print_r($Askdata);
          
//           $this->assign('data',$Askdata);
//           $this->display('Show');

    }
    function User(){
        $service = D('User','Service');
        print_r($service ->Users());
    }
   
   
}

?>