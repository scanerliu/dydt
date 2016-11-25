 <?php
// 本类由系统自动生成，仅供测试用途
class companyAction extends commonAction {
           function  company(){
           	
			       
	       	$gold_manu=M('gold_manu')->select();
			$this->assign('gold_manu',$gold_manu);
			
	        $this->display();




			}


			



}