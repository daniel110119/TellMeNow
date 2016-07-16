<?php
namespace Home\Controller;
use Think\Controller;

class TestController extends Controller {
	function index(){
		dump(date("Y-m-d H:i:s"));
	}
	
	function User(){
		$service = D('User','Service');
		print_r($service ->reg());
	}

	function Ask(){
			session('Uid','10');
			$Service = D('Ask','Service');
			$Ask=M('Ask');
			$count = $Ask->count('id');			
			$r=$Service->AllAsk(I('p').',2');
			$this->assign('list',$r);//
			$Page = new \Think\Page($count,2);
			
			$Page->setConfig('header','问题分页');
			$Page->setConfig('prev','上一页');
			$Page->setConfig('next','下一页');
			$Page->setConfig('last','最后一页');
			$Page->setConfig('theme',' %UP_PAGE%  %DOWN_PAGE%  %LINK_PAGE% %END% %TOTAL_ROW% %TOTAL_PAGE% %FIRST% %NOW_PAGE% %HEADER%');
			$show= $Page->show();
 			$this->assign('page',$show);
 			$this->display('index');
		}
		function AllAsk(){
			$Service = D('Ask','Service');
			$this->ajaxReturn($Service->AllAsk());
		}
		function Addask(){		
			$m = D('Ask','Service');
			$this->ajaxReturn($m->AddAsk()?'操作成功':'操作失败');
		}
        function AskUpdate(){
            $m = D('Ask','Service');
            print_r($m->Askupdate()?'操作成功':'操作失败');
        }
		function AddAsknote(){
		    $m = D('Asknote','Service');
		    print_r($m->AddAsknote()?'操作成功':'操作失败');
		}
		function Addanswernote(){
		    $m = D('Answernote','Service');
		    print_r($m->CreateAnswerNote()?'操作成功':'操作失败');
		}
		function Addanswer(){
			 $m = D('Answer','Service');
		    print_r($m->CreateAnswer()?'操作成功':'操作失败');
		}
		function Addviewcount(){
		    $m = D('Ask','Service');
		    print_r($m->Addviewcount()?'操作成功':'操作失败');
		}
		function AddUpOrDown(){
		    $m = D('Ask','Service');
		    $this->ajaxReturn($m->AddUpOrDown());
		}
		function AnswerZanCai(){
			$Service = D('Answer','Service');
			$this->ajaxReturn($Service->AnswerZanCai());
			 
		}
		function Tag(){
			$Service = D('Tag','Service');
			$this->ajaxReturn($Service->AllTag());
		}
		
		function AskRedit(){
			$Service = D('Askredit','Service');
			print_r($Service->PowerOperate()?'操作成功':'操作失败');
	
		}
		function AskNote(){
			$Service=D('Asknote','Service');
			print_r($Service->QueryAsknote());
			 
		}
		function AnswerNote(){
			$Service=D('Answernote','Service');
			print_r($Service->AllAnswernNote());
			 
		}
		function Askinfoshow(){
			$Service=D('Ask','Service');
// 			print_r($Service->Askinfoshow());
			$this->ajaxReturn($Service->Askinfoshow());
		
		}
	
}

?>