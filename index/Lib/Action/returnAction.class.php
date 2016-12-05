<?php
class returnAction extends commonAction
{
	public function return_one()
	{
		$where['order_id']=$_GET['order_id'];
		$where['product_id']=$_GET['product_id'];
		$id=$_GET['id'];
		if ($id) {
			$return=M('return')->where('return_id='.$id)->find();
			$this->assign('return',$return);
		}
		
		$re = M('return')->where('order_id='.$_GET['order_id'].' and product_id='.$_GET['product_id'].' and status=0')->find();
		if ($re) {
			$this->error("请勿重复申请退货！");
		} else {
			$list = M('order_product')->where($where)->find();
			$list_p = M('product')->where('product_id='.$_GET['product_id'])->find();
			$list_or = M('order')->where('order_id='.$_GET['order_id'])->find();
			$this->assign('list_or',$list_or);
			$this->assign('list',$list);
			$this->assign('list_p',$list_p);
			$this->display();
		}
		
	}

	public function add_return()
	{
		$data['user_id']=session('user_id');
		$data['money']=$_POST['price'];
		$data['fruit']=$_POST['fruit'];
		$data['is_back']=$_POST['is_back'];
		$id=$_POST['r_id'];
		$data['note']=$_POST['note'];
		$data['cause']=$_POST['cause'];
		$data['order_num']=$_POST['order_num'];
		$data['order_id']=$_POST['order_id'];
		$data['product_id']=$_POST['product_id'];
		$data['date']=strtotime(date('Y-m-d H:i:s'));
		$data['status']=0;
		$max=$_POST['max'];
		if ($max<$_POST['price']) {
			echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />'; 
			echo "<script language=Javascript>alert('退款金额超过了最大退款金额！');window.location.href='javascript:history.go(-1);';</script>"; 
			exit;
		}
		import('ORG.Net.UploadFile');
        $upload = new UploadFile();
        // 实例化上传类
        $upload->maxSize = 3145728;
        // 设置附件上传大小
        $upload->allowExts = array('jpg', 'gif', 'png', 'jpeg');
        // 设置附件上传类型
        $save_path = './Uploads/';
        $ymd = date("Ymd");
        $file_path = "images/".$ymd . "/";
        $save_path .= $file_path;
        if (!file_exists($save_path)) {
                mkdir($save_path);
        }
        $upload->savePath = $save_path;
        //$upload->saveRule = '';
        // 设置附件上传目录
        if ($upload->upload()) {
            $info = $upload->getUploadFileInfo();
            $data['ph'] = $file_path.$info[0]['savename'];
        }
        
		if ($data['money']==""|| $data['cause']=="" || $data['note']=="") {
			$this->error("提交失败，请确认信息完整！");
		} else if($id)	{
			M('return')->where('return_id='.$id)->save($data);
			$this->success('提交成功！','/return/return_two/order_id/'.$data['order_id'].'/product_id/'.$data['product_id']);
		} else{
			M('return')->add($data);
			$this->success('提交成功！','/return/return_two/order_id/'.$data['order_id'].'/product_id/'.$data['product_id']);
		}
		
	}

	public function return_two()
	{
		$where['order_id']=$_GET['order_id'];
		$where['product_id']=$_GET['product_id'];
		$list=M('order_product')->where($where)->find();
		$list_p=M('product')->where('product_id='.$_GET['product_id'])->find();
		$list_or=M('order')->where('order_id='.$_GET['order_id'])->find();
		$this->assign('list_or',$list_or);
		$this->assign('list',$list);
		$this->assign('list_p',$list_p);
		$this->display();
	}

	public function return_three()
	{
		$where['order_id']=$_GET['order_id'];
		$where['product_id']=$_GET['product_id'];
		$list=M('order_product')->where($where)->find();
		$list_p=M('product')->where('product_id='.$_GET['product_id'])->find();
		$list_or=M('order')->where('order_id='.$_GET['order_id'])->find();
		$this->assign('list_or',$list_or);
		$this->assign('list',$list);
		$this->assign('list_p',$list_p);
		$this->display();
	}

	public function return_err()
	{
		$where['order_id']=$_GET['order_id'];
		$where['product_id']=$_GET['product_id'];
		$id=$_GET['id'];
		$list=M('order_product')->where($where)->find();
		$list_p=M('product')->where('product_id='.$_GET['product_id'])->find();
		$list_or=M('order')->where('order_id='.$_GET['order_id'])->find();
		$return=M('return')->where('return_id='.$id)->find();
		$this->assign('return',$return);
		$this->assign('list_or',$list_or);
		$this->assign('list',$list);
		$this->assign('list_p',$list_p);
		$this->display();
	}

	public function del_return()
	{
		$id=$_GET['id'];
		M('return')->where('return_id='.$id)->delete();
		$this->success("删除记录成功！");
	}

	public function return_list()
	{
		$user_id=session('user_id');
		 if (!$_SESSION['user_id']) {
            $this->error('请先登录', '/');
        }
		import('ORG.Util.Page');// 导入分页类
        $count = M('return')->where('user_id='.session('user_id'))->count();// 查询满足要求的总记录数 $map表示查询条件
        $Page = new Page($count,9);// 实例化分页类 传入总记录数
        $show = $Page->show();// 分页显示输出
		$list=M()->table(array('return'=>'a','product'=>'b'))->where('b.product_id=a.product_id and a.user_id='.$user_id)->order('a.date desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		for ($i=0; $i < count($list); $i++) { 
			$list[$i]['img']=M('product_img')->where('product_id='.$list[$i]['product_id'])->getfield('img');
		}
		$this->assign('list',$list);
		$this->assign('page',$show);// 赋值分页输出
		$this->display();
	}

	public function sta()
	{
		$id=$_GET['id'];
		if ($id) {
			$where['return_id']=$id;
		} else {
			$where['order_id']=$_GET['order_id'];
			$where['product_id']=$_GET['product_id'];
		}
		$status=M('return')->where($where)->getfield('status');
		if ($status==0) {
			redirect('/return/return_two/order_id/'.$_GET['order_id'].'/product_id/'.$_GET['product_id']);
		} else if ($status==1) {
			redirect('/return/return_three/order_id/'.$_GET['order_id'].'/product_id/'.$_GET['product_id']);
		} else if ($status==3){
			redirect('/return/return_one/order_id/'.$_GET['order_id'].'/product_id/'.$_GET['product_id'].'/id/'.$id);
		} 
	}

	public function return_over()
	{
		$id=$_GET['id'];
		$data['status']=3;
		M('return')->where('return_id='.$id)->save($data);
		$this->success("取消申请成功！");
	}

	public function express()
	{
		$id=$_GET['id'];
		$ex = M('return')->where('return_id='.$id)->find();
		$list=M()->table(array('return'=>'a','product'=>'b'))->where('b.product_id=a.product_id and a.return_id='.$id)->find();
		$list['img']=M('product_img')->where('product_id='.$list['product_id'])->getfield('img');
		$this->assign('ex',$ex);
		$this->assign('list',$list);
		$this->display();
	}

	public function save_ex()
	{
		$data['express']=$_POST['express'];
		$data['express_num']=$_POST['express_num'];
		$data['beizhu']=$_POST['beizhu'];
		$where['return_id']=$_POST['return_id'];
		if ($_POST['express']=="" || $_POST['express_num']=="") {
			$this->error("请确认信息完整！");
		} else {
			M('return')->where($where)->save($data);
			$this->success("提交成功！",'/return/return_list');
		}
		
	}
}