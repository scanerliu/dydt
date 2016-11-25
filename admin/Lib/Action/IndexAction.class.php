<?php
class IndexAction extends beginAction {
    function index(){
      $this->assign('name',$_SESSION['admin_name']);
	 $m=M('admin_user');
	 $where['name']= $_SESSION['admin_name'];
	 $loginTime =  $m->where($where)->getField('loginTime') ;
	 $this->assign('loginTime', date("Y年m月d日 h:i:sa ",$loginTime)); 
 	 $data=M("admin_user")->where("name	= '$_SESSION[admin_name]'")->find();
     $this->assign('admin_user',$data); 
      $this->display();
    }
	
	
	
	
	
	function  indexFunlogout(){
		 $_SESSION=array();
		  $data['time']=time();
		   $data['remark']='用户退出';
		   M('record')->add($data);
 		  $this->success('已经退出后台管理系统', __APP__ .'/login/login');  
		}
 	
	
	
	
	
	
}