<?php
/* vim: set expandtab tabstop=4 shiftwidth=4: */
// +----------------------------------------------------------------------+
// | PHP version 5                                                        |
// +----------------------------------------------------------------------+
// | Copyright (c) 1997-2004 The PHP Group                                |
// +----------------------------------------------------------------------+
// | This source file is subject to version 3.0 of the PHP license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.php.net/license/3_0.txt.                                  |
// | If you did not receive a copy of the PHP license and are unable to   |
// | obtain it through the world-wide-web, please send a note to          |
// | license@php.net so we can mail you a copy immediately.               |
// +----------------------------------------------------------------------+
// | Authors: Original Author <author@example.com>                        |
// |          Your Name <you@example.com>                                 |
// +----------------------------------------------------------------------+
//
// $Id:$

class orderAction extends beginAction {
    public function orderList() {
        $where['confirm'] = array(
            'neq',
            2
        );
        if ($_GET['status']) {
            $where['status'] = $_GET['status'];
        }
        if ($_GET['keyword']) {
            $attribute_id = '';
            $Model = new Model();
            $data = $Model->query("select DISTINCT  order_id from `order` left join `user` on user.user_id= order.user_id where(user.real_name like '%{$_GET['keyword']}%' )  ");
            for ($i = 0; $i < count($data); $i++):
                $order_id = "$order_id,'{$data[$i][order_id]}'";
            endfor;
            $data = $Model->query("select  DISTINCT  order.order_id from `order` left join `order_product` on order.order_id= order_product.order_id   left join `product` on order_product.product_id= product.product_id  where  product.title  like '%{$_GET['keyword']}%' ");
            for ($i = 0; $i < count($data); $i++):
                $order_id = "$order_id,'{$data[$i][order_id]}'";
            endfor;
            $order_id = substr($order_id, 1);
            if ($order_id):
                $order_id = "or order_id in ( $order_id )";
            endif;
            $where['_string'] = "real_address    like '%{$_GET['keyword']}%'  or   order_num like '%{$_GET['keyword']}%'  $order_id";
        }
        if ($_GET['begtime'] and $_GET['endtime']) {
            $begtime = strtotime($_GET['begtime']);
            $endtime = strtotime($_GET['endtime']) + 24 * 60 * 60;
            $where['time' . $_GET['time']] = array(
                'between',
                "$begtime,$endtime"
            );
        }
        if ($_GET['begtime'] and !$_GET['endtime']) {
            $begtime = strtotime($_GET['begtime']);
            $where['time' . $_GET['time']] = array(
                'egt',
                $begtime
            );
        }
        if ($_GET['endtime'] and !$_GET['begtime']) {
            $endtime = strtotime($_GET['endtime']) + 24 * 60 * 60;
            $where['time' . $_GET['time']] = array(
                'elt',
                $endtime
            );
        }
        import('ORG.Util.Page');
        // 导入分页类
        $this->orderList_fun_sum($where);  //计算已经付款的金额
        $this->orderList_fun_sum2($where);  // 计算已经收货的金额
        $this->orderList_fun_sum3($where); //计算待发货的金额
        $count = M('order')->Distinct(true)->where($where)->count();
        //$this->error('asfdsdf','',1000);
        // 查询满足要求的总记录数
        $Page = new Page($count, 10);
        // 实例化分页类 传入总记录数和每页显示的记录数
        $show = $Page->show();
        // 分页显示输出
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $list = M('order')->Distinct(true)->where($where)->order('time desc')->limit($Page->firstRow . ',' . $Page->listRows)->join("left join `user` on user.user_id=order.user_id ")->order("order_id desc")->select();
        // 赋值数据集
 		
		for($i=0;$i<count($list);$i++):
		   $list[$i][pro]=M("order_product")->where("order_id={$list[$i][order_id]}")->select();
 		   for($n=0;$n<count($list[$i][pro]);$n++):
		        $list[$i][pro][$n]['guige']=M("product_attribute_list")->where("attribute_id=3 and product_id={$list[$i][pro][$n][product_id]}")->getField('value'); /*规格*/
 		        $list[$i][pro][$n]['changjia']=M("product_attribute_list")->where("attribute_id=4 and product_id={$list[$i][pro][$n][product_id]}")->getField('value');  /*厂家*/
			    $list[$i][pro][$n]['huohao']=M("product_attribute_list")->where("attribute_id=1 and product_id={$list[$i][pro][$n][product_id]}")->getField('value');  /*货号*/
			    $list[$i][pro][$n]['peihao']=M("product_attribute_list")->where("attribute_id=2 and product_id={$list[$i][pro][$n][product_id]}")->getField('value');  /*批准文号*/
               endfor;
            endfor;
          $this->assign('list', $list);
        // 输出模板
        $this->assign('page', $show);
        // 赋值分页输出
        $this->display();
    }
	
	
		
	
    function orderList_fun_sum($where) { //计算已经付款的金额
        if ($where['_string']) {
            $where['_string'] = $where['_string'] . " and  status  in (2,3,4,5)";
        } else {
            $where['_string'] = "status  in (2,3,4,5)";
        }
        $data = M('order')->Distinct(true)->where($where)->sum('need_pay');
        $this->assign('num', $data);
    }
    function orderList_fun_sum2($where) { // 计算已经收货的金额
        if ($where['_string']) {
            $where['_string'] = $where['_string'] . " and  status  in (3,4,5)";
        } else {
            $where['_string'] = "status  in (3,4,5)";
        }
        $data = M('order')->Distinct(true)->where($where)->sum('need_pay');
        $this->assign('num2', $data);
    }
    function orderList_fun_sum3($where) { //计算待发货的金额
        if ($where['_string']) {
            $where['_string'] = $where['_string'] . " and  status  in (2)";
        } else {
            $where['_string'] = "status  in (2)";
        }
        $data = M('order')->Distinct(true)->where($where)->sum('need_pay');
        $this->assign('num3', $data);
    }
    function order_excel() {
        include '/PHPExcel/PHPExcel.php';
        //创建对象
        $excel = new PHPExcel();
        //Excel表格式,这里简略写了8列
        $letter = array(
            'A',
            'B',
            'C',
            'D',
            'E',
            'F',
            'G',
            'H',
            'I',
            'j'
        );
        //表头数组
        $tableheader = array(
            '订单号',
            '拍下商品的时间',
            '付款时间',
            '发货时间',
            '确认时间',
            '评价时间',
            '总金额',
            '实际付款金额',
            '当前状态',
            '用户名称'
        );
        //填充表头信息
        for ($i = 0; $i < count($tableheader); $i++) {
            $excel->getActiveSheet()->setCellValue("$letter[$i]1", "$tableheader[$i]");
        }
        $excel->getActiveSheet()->getColumnDimension('A')->setWidth(50);
        //表格数组
        if ($_GET['status']) {
            $where['status'] = $_GET['status'];
        }
        if ($_GET['keyword']) {
            $attribute_id = '';
            $Model = new Model();
            $data = $Model->query("select DISTINCT  order_id from `order` left join `user` on user.user_id= order.user_id where(user.name like '%{$_GET['keyword']}%' )  ");
            for ($i = 0; $i < count($data); $i++):
                $order_id = "$order_id,'{$data[$i][order_id]}'";
            endfor;
            $data = $Model->query("select  DISTINCT  order.order_id from `order` left join `order_product` on order.order_id= order_product.order_id   left join `product` on order_product.product_id= product.product_id  where  product.title  like '%{$_GET['keyword']}%' ");
            for ($i = 0; $i < count($data); $i++):
                $order_id = "$order_id,'{$data[$i][order_id]}'";
            endfor;
            $order_id = substr($order_id, 1);
            if ($order_id):
                $order_id = "or order_id in ( $order_id )";
            endif;
            $where['_string'] = "real_address    like '%{$_GET['keyword']}%'  or   order_num like '%{$_GET['keyword']}%'  $order_id";
        }
        if ($_GET['begtime'] and $_GET['endtime']) {
            $begtime = strtotime($_GET['begtime']);
            $endtime = strtotime($_GET['endtime']) + 24 * 60 * 60;
            $where['time' . $_GET['time']] = array(
                'between',
                "$begtime,$endtime"
            );
        }
        if ($_GET['begtime'] and !$_GET['endtime']) {
            $begtime = strtotime($_GET['begtime']);
            $where['time' . $_GET['time']] = array(
                'egt',
                $begtime
            );
        }
        if ($_GET['endtime'] and !$_GET['begtime']) {
            $endtime = strtotime($_GET['endtime']) + 24 * 60 * 60;
            $where['time' . $_GET['time']] = array(
                'elt',
                $endtime
            );
        }
        $list = M('order')->Distinct(true)->where($where)->select();
        for ($i = 0; $i < count($list); $i++) {
            $data[$i]['order_num'] = $list[$i]['order_num'];
            $data[$i]['time'] = date('Y-m-d H:i:s', $list[$i]['time']);
            $data[$i]['time2'] = date('Y-m-d H:i:s', $list[$i]['time2']);
            $data[$i]['time3'] = date('Y-m-d H:i:s', $list[$i]['time3']);
            $data[$i]['time4'] = date('Y-m-d H:i:s', $list[$i]['time4']);
            $data[$i]['time5'] = date('Y-m-d H:i:s', $list[$i]['time5']);
            $data[$i]['total'] = $list[$i]['total'];
            $data[$i]['need_pay'] = $list[$i]['need_pay'];
            if ($list[$i]['status'] == 1) {
                $data[$i]['status'] = '未付款';
            }
            if ($list[$i]['status'] == 2) {
                $data[$i]['status'] = '待发货 ';
            }
            if ($list[$i]['status'] == 3) {
                $data[$i]['status'] = '待确认';
            }
            if ($list[$i]['status'] == 4) {
                $data[$i]['status'] = '待评价';
            }
            if ($list[$i]['status'] == 5) {
                $data[$i]['status'] = '已经评价';
            }
            $data[$i]['name'] = M('user')->where("user_id={$list[$i]['user_id']}")->getField('name');
        }
        //填充表格信息
        for ($i = 2; $i <= count($data) + 1; $i++) {
            $j = 0;
            foreach ($data[$i - 2] as $key => $value) {
                $excel->getActiveSheet()->setCellValue("$letter[$j]$i", "$value");
                $j++;
            }
        }
        //创建Excel输入对象
        $write = new PHPExcel_Writer_Excel5($excel);
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
        header("Content-Type:application/force-download");
        header("Content-Type:application/vnd.ms-execl");
        header("Content-Type:application/octet-stream");
        header("Content-Type:application/download");;
        header('Content-Disposition:attachment;filename="excel.xls"');
        header("Content-Transfer-Encoding:binary");
        $write->save('php://output');
    }
    public function orderDetail() {
        $where['order_id'] = $_GET['order_id'];
        $data = M('order')->where($where)->find();
        $this->assign('orderDetail', $data);
        //订单的信息
        $where = '';
        $where['user_id'] = $data['user_id'];
        $data = M('receiving_address')->where($where)->find();
        $this->assign('receiving_address', $data);
        //收货地址  状态为1 的时候的 订单地址
        $data = M('user')->where($where)->find();
        $this->assign('user', $data);
        //用户的信息
        $where = '';
        $where['order_id'] = $_GET['order_id'];
        $data = M('order_product')->where($where)->select();
		
		 	  for($n=0;$n<count($data);$n++):
		       $data[$n]['guige']=M("product_attribute_list")->where("attribute_id=3 and product_id={$data[$n][product_id]}")->getField('value'); /*规格*/
 		        $data[$n]['changjia']=M("product_attribute_list")->where("attribute_id=4 and product_id={$data[$n][product_id]}")->getField('value');  /*厂家*/
			    $data[$n]['huohao']=M("product_attribute_list")->where("attribute_id=1 and product_id={$data[$n][product_id]}")->getField('value');  /*货号*/
			   $data[$n]['peihao']=M("product_attribute_list")->where("attribute_id=2 and product_id={$data[$n][product_id]}")->getField('value');  /*批准文号*/
               endfor;
		
		
        //查询 对改商品是否 已经 评论了  beg
        for ($n = 0; $n < count($data); $n++) {
            $where = '';
            $where['product_id'] = $data[$n]['product_id'];
            $where['order_id'] = $_GET['order_id'];
            if (M('comment_right')->where($where)->count()) {
                $data[$n]['is_have_comment_right'] = 1;
            }
        }
        //查询 对改商品是否 已经 评论了
        $this->assign('order_product', $data);
        //产品列表
        $this->display();
    }
    public function send_out_goods() {
        //发货
		if(!$_POST['transport_code']   ){
			$this->error(' 运单号不能为空');
			}
         $where['order_id'] = $_GET['order_id'];
         $data['status'] = 3;
        $data['time3'] = time();
        $data['endtime'] = time() + 10 * 24 * 60 * 60;
        $data['transport_company'] = $_POST['transport_company'];
        $data['transport_code'] = $_POST['transport_code'];
        M('order')->where($where)->save($data);
        $where = '';
        $where['order_id'] = $_GET['order_id'];
        $data = M('order')->join('left join user on user.user_id= order.user_id')->where($where)->Distinct(true)->field('mobile_phone,order_num')->find();
        $data['transport_code'] = $_POST['transport_code'];
        //$data = $data['mobile_phone'];
        $this->yanzhengma($data);
		$data='';
		$data2='';
		$data=M("order_product")->where("order_id=$_GET[order_id]")->select();
		for($i=0;$i<count($data);$i++):
		     $data2[serial_number]= $_POST["serial_number_{$data[$i][product_id]}"];
  		     M("order_product")->where("product_id={$data[$i][product_id]} and  order_id=$_GET[order_id]")->save($data2);
          endfor;
		 $data='';
		 $data2='';
      $this->success('发货成功');
    }
	
	
 
	
	
	
	
    function orderDetailFunEnd_order() { // 直接结束订单
        $where['order_id'] = $_GET['order_id'];
        $data['status'] = 5;
        M('order')->where($where)->save($data);
        redirect($_SERVER['HTTP_REFERER']);
    }
    public function yanzhengma($sms) /*短信验证码*/ {
        $text = "您的订单".$sms['order_num']."已经发货,运单号为：".$sms['transport_code']."，请注意查收";
        $text = iconv("utf-8", "gb2312", $text);
        $ch = curl_init("http://www.10086x.com/sends.asp?user=zsmyzm1&passw=zsm123456&text=" . $text . "&mobiles=" . $sms['mobile_phone'] . "&SEQ=1000");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // 获取数据返回
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, true); // 在启用 CURLOPT_RETURNTRANSFER 时候将获取数据返回
        $output = curl_exec($ch);
        Log::write("短信发送：http://www.10086x.com/sends.asp?user=zsmyzm1&passw=zsm123456&text=" . $text . "&mobiles=" . $sms['mobile_phone'] . "&SEQ=1000 ,result =".$output, Log::ERR);
    }
    function coupon() {
        if ($_GET['user_id']) {
            $where['user_id'] = $_GET['user_id'];
        }
        if ($_GET['status'] == 1) { /*未使用*/
            $where['is_use'] = array(
                'neq',
                1
            );
            $where['endtime'] = array(
                'egt',
                time() - 24 * 60 * 60
            );
        }
        if ($_GET['status'] == 2) { /*已使用*/
            $where['is_use'] = array(
                'eq',
                1
            );
        }
        if ($_GET['status'] == 3) { /*已过期*/
            $where['is_use'] = array(
                'neq',
                1
            );
            $where['endtime'] = array(
                'lt',
                time() - 24 * 60 * 60
            );
        }
        import('ORG.Util.Page');
        $count = M('coupon')->where($where)->count();
        // 查询满足要求的总记录数
        $Page = new Page($count, 10);
        // 实例化分页类 传入总记录数和每页显示的记录数
        $show = $Page->show();
        // 分页显示输出
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $list = M('coupon')->Distinct(true)->where($where)->order('coupon_id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
        // 赋值数据集
        for ($i = 0; $i < count($list); $i++):
            if ($list[$i]['is_use'] != 1 and $list[$i]['endtime'] + 24 * 60 * 60 > time()) {
                $list[$i]['status'] = '未使用';
            }
            if ($list[$i]['is_use'] == 1) {
                $list[$i]['status'] = '已过期';
            }
            if ($list[$i]['is_use'] != 1 and $list[$i]['endtime'] + 24 * 60 * 60 < time()) {
                $list[$i]['status'] = '已使用';
            }
        endfor;
        $this->assign('list', $list);
        // 输出模板
        $this->assign('page', $show);
        $this->display();
    }
    function couponFun() {  /*优惠券*/
        $data['begtime'] = strtotime($_POST['begtime']);
        $data['endtime'] = strtotime($_POST['endtime']);
        $data['num'] = $_POST['num'];
        if (!$_POST['user_id']) {
            $data2 = M('user')->select();
            for ($i = 0; $i < count($data2); $i++):
                $data['user_id'] = $data2[$i]['user_id'];
                M('coupon')->add($data);
            endfor;
        } else {
            if (!(M('user')->where("user_id=$_POST[user_id]")->count())):
                $this->error('该用户不存在', '', 1000);
            endif;
            $data['user_id'] = $_POST['user_id'];
            M('coupon')->add($data);
        }
        $this->success('设定成功');
    }
	
	 function message(){ /*用户留言*/
	      if($_GET[keyword]){
	       $where['_string']="user.name like '%$_GET[keyword]%' or  order.order_num  like '%$_GET[keyword]%'   ";
		  }
		  $join="left join user on user.user_id = comment.user_id  left join `order` on order.order_id = comment.order_id";
   		  import('ORG.Util.Page');// 导入分页类
		  $count      = M('comment')->where($where)->join($join)->count();// 查询满足要求的总记录数
		  $Page       = new Page($count,25);// 实例化分页类 传入总记录数和每页显示的记录数
		  $show       = $Page->show();// 分页显示输出
		  // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		  $list = M('comment')->where($where)->join($join)->order('comment_id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
 		  $this->assign('list',$list);// 赋值数据集
		  $this->assign('page',$show);// 赋值分页输出
		  $this->display(); // 输出模板
 	 }
	 
	  function messageFunReply (){  /*用户留言回复*/
		   $data['reply']=$_GET['reply'];
		    M('comment')->where("comment_id=$_GET[comment_id]")->save($data);
 		    redirect($_SERVER['HTTP_REFERER'] );
  		  }
	 
	 
	 	  function messageFunDel (){  /*用户留言删除*/
		   $data['reply']=$_GET['reply'];
		    M('comment')->where("comment_id=$_GET[comment_id]")->delete($data);
 		    redirect($_SERVER['HTTP_REFERER'] );
  		  }
	 
	 
 
	
	
}

