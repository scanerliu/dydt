<?php
class ordermanageAction extends commonAction
{
    public function browse_record()
    {
        $user_id = session('user_id');
        import("ORG.Util.String"); 
        import('ORG.Util.Page');// 导入分页类
        $count = M()->table(array('history'=>'a','product'=>'b'))->where('b.product_id=a.product_id and a.user_id='.$user_id)->count();// 查询满足要求的总记录数 $map表示查询条件
        $Page = new Page($count,20);// 实例化分页类 传入总记录数
        $show = $Page->show();// 分页显示输出
        // 进行分页数据查询
        $his = M()->table(array('history'=>'a','product'=>'b'))->where('b.product_id=a.product_id and a.user_id='.$user_id)->order('a.time desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        if ($his) {
            for ($i=0; $i < count($his); $i++) { 
                $his[$i]['img'] = M('product_img')->where('product_id='.$his[$i]['product_id'])->getfield('img');
                $his[$i]['title'] = mb_substr($his[$i]['title'],0,8,'utf-8');
                $his[$i]['subhead'] = mb_substr($his[$i]['subhead'],0,10,'utf-8');
            }
        }
        $this->assign('his',$his);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->display(); // 输出模板
    }

    public function my_collection()
    {
        $user_id = session('user_id');
        import('ORG.Util.Page');// 导入分页类
        $count = M()->table(array('favorite'=>'a','product'=>'b'))->where('b.product_id=a.product_id and a.user_id='.$user_id)->count();// 查询满足要求的总记录数 $map表示查询条件
        $Page = new Page($count,20);// 实例化分页类 传入总记录数
        $show = $Page->show();// 分页显示输出
        // 进行分页数据查询
        $col = M()->table(array('favorite'=>'a','product'=>'b'))->where('b.product_id=a.product_id and a.user_id='.$user_id)->limit($Page->firstRow.','.$Page->listRows)->select();
        if ($col) {
            for ($i=0; $i < count($col); $i++) { 
                $col[$i]['img'] = M('product_img')->where('product_id='.$col[$i]['product_id'])->getfield('img');
                $col[$i]['title'] = mb_substr($col[$i]['subhead'],0,10,'utf-8');
                $col[$i]['subhead'] = mb_substr($col[$i]['subhead'],0,10,'utf-8');
            }
        }
        $this->assign('col',$col);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->display(); // 输出模板
    }

    public function del_mycol()
    {
        $id=$_GET['id'];
        M('favorite')->where('favorite_id='.$id)->delete();
		echo "<script>alert('移出收藏夹成功!');window.location.href='/ordermanage/my_collection/';</script>";
				exit;
        //$this->success("移出收藏夹成功！");
    }
    public function receiving_address()
    {
    	$user_id = session('user_id');
    	// $count = M('receiving_address')->where('user_id='.$user_id)->count();
    	$address = M('receiving_address')->where('user_id='.$user_id)->find();
    	// $this->assign('count',$count);
    	$this->assign('address',$address);
        $this->display();
    }

    public function save_receiving_address()
    {
    	$user_id = session('user_id');
        $data['user_id'] = session('user_id');
        $data['postcode'] = $_POST['postcode'];
        $data['address'] = $_POST['address'];
        $data['name'] = $_POST['name'];
        $data['quhao'] = $_POST['quhao'];
        $data['home_phone'] = $_POST['home_phone'];
        $data['mobile_phone'] = $_POST['mobile_phone'];
        if ($_POST['s_province']=="省份" || $_POST['s_city']=="地级市" || $_POST['s_county']=="市、县级市") {
            $data['city1'] = M('receiving_address')->where('user_id='.$user_id)->getfield('city1');
            $data['city2'] = M('receiving_address')->where('user_id='.$user_id)->getfield('city2');
            $data['city3'] = M('receiving_address')->where('user_id='.$user_id)->getfield('city3'); 
        } else {
            $data['city1'] = $_POST['s_province'];
            $data['city2'] = $_POST['s_city'];
            $data['city3'] = $_POST['s_county'];
        }
        $ad = M('receiving_address')->where('user_id='.$user_id)->select();
        if ($ad) {
            M('receiving_address')->where('user_id='.$user_id)->save($data);
        } else {
            M('receiving_address')->where('user_id='.$user_id)->add($data);
        }
 		$this->express_fee_change(); /*当改变收货地址的时候，快递费也发生改变*/
  		$this->success("保存成功！");	
    }


	    function  express_fee_change(){/*当改变收货地址的时候，快递费也发生改变*/
			   $where['user_id']=$_SESSION['user_id'];
			   $where2['area']=M('receiving_address')->where($where)->getField('city1');	
			   if(  M('express_fee')->where($where2)->count() ){
			      $data['express_fee']=M('express_fee')->where($where2)->getField('fee');
 				   }
				 else{
				$data['express_fee']=M('system')->getField('express_fee');	 
					 }  
				$where='';	 
				$where['status']=1; 	 
			    $where['user_id']=$_SESSION['user_id'];
				M('order')->where($where)->save($data);
  			}
	  








    public function shop_cart()
    {
        if (session('user_id')) {
            $user_id = session('user_id');
        } else {
            redirect('/account/login');
        }
        $list = M()->table(array('shopping_cart'=>'a','product'=>'b'))->where('b.product_id=a.product_id and a.user_id='.$user_id)->select();
        for ($i=0; $i < count($list); $i++) { 
            $list[$i]['img'] = M('product_img')->where('product_id='.$list[$i]['product_id'])->getfield('img');
        }
        $this->assign('list',$list);
        $this->display();
    }
    public function del_shop_cart()
    {
        $user_id = session('user_id');
        $product_id = $_GET['id'];
        M('shopping_cart')->where('product_id='.$product_id.' and user_id='.$user_id)->delete();
        $this->success("删除成功！");
    }

    public function add_mycol()
    {
        $data['user_id'] = session('user_id');
        $data['product_id'] = $_GET['id'];
        $sql = M('favorite')->where($data)->select();
        if ($sql) {
            $this->error("您的收藏夹中已存在该商品，请勿重复添加！");
        } else {
             M('favorite')->add($data);
            $this->success("加入收藏夹成功！");
        }  
    }
    // public function delete_address()
    // {
    // 	$id = $_GET['id'];
    // 	$result = M('receiving_address')->where('id='.$id)->delete();
    // 	if ($result) {
    // 		$this->success("删除地址成功！");
    // 	} else {
    // 		$this->error("删除地址失败！");
    // 	}
    // }

    // public function moren_address()
    // {
    //     $user_id = session('user_id');
    //     $id = $_GET['id'];
    //     $save['moren']=1;
    //     $data['moren']=0;
    //     $aa = M('receiving_address')->where('user_id='.$user_id.' and moren=1')->save($data);
    //     $bb = M('receiving_address')->where('user_id='.$user_id.' and id='.$id)->save($save);
    //     var_dump(M('receiving_address')->getlastsql());
    //     var_dump($aa);exit;
    //     $this->success("设为默认成功！");
    // }
}