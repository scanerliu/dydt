 <?php
// 本类由系统自动生成，仅供测试用途
class goldcontentAction extends commonAction {
           function  goldcontent(){
           	$m=M('gold_manu');
           	$gold_id=$_GET['id'];
           	$browse_num=$m->where('gold_id='.$gold_id)->getfield('browse_num');
           	$browse_num=intval($browse_num);
           	$browse_num+=1;
           	$data['browse_num']=$browse_num;
           	$m->where('gold_id='.$gold_id)->save($data);
           	$list=$m->where('gold_id='.$gold_id)->find();
           	$this->assign('list',$list);
	        $this->display();
			}


   
 
			

		
		
		
   
   
   
   
   
   
   
   
   
   
	
	
}