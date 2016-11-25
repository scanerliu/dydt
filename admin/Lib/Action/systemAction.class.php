<?php
class systemAction extends beginAction {
  function _initialize()
    {
    if ( $_SESSION['admin_name'] != 'root' ) {
          $this->Redirect('/login/login');
        }
		R('begin/run'); 
      }
	  
	  
     function base(){
 	 $m=M('system');
	 $data=$m->find();
	 $this->assign('data', $data); 
     $this->display();
    }
	
	 function baseFunUpload(){
	 $m=M('system');
	 
	 $data['title']=$_POST['title'];
	 $data['keywords']=$_POST['keywords']; 
	 $data['description']=$_POST['description']; 
	 $data['link']= $_POST['link'];
	 $data['qq']= $_POST['qq'];
	 $data['search_keyword']= $_POST['search_keyword'];
	 $data['weibo']= $_POST['weibo'];
	 $data['tel']= $_POST['tel'];
	 $data['express_fee']= $_POST['express_fee'];
	  $data['discount']= $_POST['discount'];
	  $data['reduce_money1']= $_POST['reduce_money1'];
	  $data['reduce_money2']= $_POST['reduce_money2'];
 	  $data['get_cash']= $_POST['get_cash'];
	  $data['use_cash']= $_POST['use_cash'];	
	  $data['service_charge']= $_POST['service_charge'];
	  $data['contract']= $_POST['contract'];	 
	 
     $where['system_id']=1;
      $m->where($where)->save($data);
     $this->success('修改成功');
    }
	

  function password (){
     $this->display();
    }
	
  function passwordFunSave(){
     $m=M('admin_user');
	 $where['name']='root';
	 $where['password']= md5(md5($_POST['oldPassword']));
	 $count=$m->where($where)->count();
	 if( $count!=1){
	   $this->error('密码错误');	 
		}
		 
     $where='';	 
	 $where['name']='root';
 	 $data['password']=md5(md5($_POST['newPassword']));
	  $m->where($where)->save($data);
     $this->success('修改成功');
    }
	
	

     function expressFeeList(){  /*快递费列表*/
	     $data=M('express_fee')->select();
		 $this->assign('data',$data);
  		  $this->display();
 		 }
 
    function expressFeeListFunAdd(){  /*快递费列表 新增 修改*/
	      $where['area']=$_POST['area'];
		  if( M('express_fee')->where($where)->count() ){
			 $data['fee']=$_POST['fee'];
			  M('express_fee')->where($where)->save($data);
			}
		  else{
			 $data['area']=$_POST['area'];  
			 $data['fee']=$_POST['fee']; 
			  M('express_fee')->add($data);
			 }
   		  $this->success('添加成功');
  	 }
     function expressFeeListFunDel(){  /*快递费删除*/
	       $where['area']=$_GET['area'];
 	       M('express_fee')->where($where)->delete();
    	   $this->success('修改成功');
  	 }
 
 
    function  recordList(){
		if($_GET['is_dangerous']):
		  $where="is_dangerous=1";
		endif;
 		import('ORG.Util.Page');// 导入分页类
		$count      = M('record')->where($where)->count();// 查询满足要求的总记录数
		$Page       = new Page($count,25);// 实例化分页类 传入总记录数和每页显示的记录数
		$show       = $Page->show();// 分页显示输出
		// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = M('record')->where($where)->order('record_id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
 		$this->assign('list',$list);// 赋值数据集
		$this->assign('page',$show);// 赋值分页输出
		$this->display(); // 输出模板
   }
    
 
   function Database(){ //数据库还原 备份
         $db_save_time=M('system')->getField('db_save_time'); 
		$this->assign('db_save_time',$db_save_time); 
  	    $this->display();
	   }
 
    function admin_right(){  /*管理员权限设置*/
		$data=M("admin_user")->where("name != 'root' ")->select();
		$this->assign('list',$data);
  		$this->display();
		}
 
 
      function admin_rightFun_add(){  /*管理员新增*/
	     if(  M("admin_user")->where("name= $_POST[name]")->count() ){
               $this->error('该用户已经存在');
 			 }
            $data[name]=$_POST[name];
            $data[password]=md5(md5($_POST[password]));
			$data[right1]=$_POST[right1];
			$data[right2]=$_POST[right2];
			$data[right3]=$_POST[right3];
			$data[right4]=$_POST[right4];
			$data[right5]=$_POST[right5];
			$data[right6]=$_POST[right6];
		    M("admin_user")->add($data);
         	redirect($_SERVER['HTTP_REFERER'] );
 		}
 
 
 
       function admin_rightFun_del(){  /*管理员删除*/
	        M("admin_user")->where("name='$_GET[name]'")->delete();
           redirect($_SERVER['HTTP_REFERER'] );
 		}
 
 
 
 
 
 
 
 
 
 
	
}



 
 





