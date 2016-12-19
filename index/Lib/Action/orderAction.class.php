<?php
// 本类由系统自动生成，仅供测试用途
class orderAction extends commonAction
{
    public function orderList()
    {
        if (!$_SESSION['user_id']) {
            $this->error('请先登录', '/');
        }
        $where['confirm'] = array('neq',2) ;
        $where['user_id'] = $_SESSION['user_id'];
        if ($_GET['status']) {
            $where['status'] = $_GET['status'];
        }
        if ($_GET['order_key_word']) {
            $where['order_num'] = $_GET['order_key_word'];
        }
        import('ORG.Util.Page');
        // 导入分页类
        $count = M('order')->where($where)->count();
        // 查询满足要求的总记录数
        $Page = new Page($count, 10);
        // 实例化分页类 传入总记录数和每页显示的记录数
        $show = $Page->show();
        // 分页显示输出
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $list = M('order')->order('order_id desc')->where($where)->limit($Page->firstRow . ',' . $Page->listRows)->select();
        for ($i = 0; $i < count($list); $i++) {
            $where = '';
            $where['order_id'] = $list[$i]['order_id'];
            $list[$i]['product'] = M('order_product')->where($where)->select();
            //查询 对改商品是否 已经 评论了  beg
            for ($n = 0; $n < count($list[$i]['product']); $n++) {
                $where = '';
                $where['product_id'] = $list[$i]['product'][$n]['product_id'];
                $where['order_id'] = $list[$i]['order_id'];
                if (M('comment_right')->where($where)->count()) :
                    $list[$i]['product'][$n]['is_have_comment_right'] = 1;
                endif;
				  if (M('return')->where($where)->count()) :
                    $list[$i]['product'][$n]['is_return'] = 1;
                endif;
 				$where['status']=4;
			    if (M('return')->where($where)->count()) :
                    $list[$i]['product'][$n]['is_return'] = 2;
                endif;
				
            }
        }
        //查询 对改商品是否 已经 评论了 end;
        $this->assign('list', $list);
        // 赋值数据集
        $this->assign('page', $show);
        // 赋值分页输出
        $this->display();
    }
    public function orderListFunorderDel()
    {
        //可以取消订单，当状态为未付款时，可以取消订单。
        if (!$_SESSION['user_id']) {
            $this->error('请先登录', '/account/login');
        }
        $where['order_id'] = $_GET['order_id'];
        $where['user_id'] = $_SESSION['user_id'];
        $data = M('order')->where($where)->find();
        if ($data['status'] != 1) {
            //status 订单状态 1 未付款，2. 已结付款.待发货 3.已经发货。待确认 4.确认收货 ，待评价5.已经评价
            $this->error('请刷新页面', '/order/orderList');
        }
        M('order')->where($where)->delete();
		/*取消已经使用代金券 beg*/
		    $where='';
			$where['order_id']= $_GET['order_id'];
			$where['user_id']=  $_SESSION['user_id'];
			 $data='';
			 $data['is_use']=1;
 			M('coupon')->where($where)->save($data);
  		/*取消已经使用代金券 end*/
        $this->success('修改成功','/order/orderList');
    }
    public function cart_to_order()
    {
        if (!$_SESSION['user_id']) {
            redirect('/account/login' );
        }
 //       $where['user_id'] = $_SESSION['user_id'];
//        M('shopping_cart')->where($where)->delete();
  		redirect('/order/orderFunAdd/product_id/' . $_GET['product_id'] . '/product_num/' . $_GET['product_num']);
     }
    public function orderFunAdd() /* 订单添加*/
    {
         if (!$_SESSION['user_id']) {
           redirect('/account/login' );
         }
 		 /*用户锁定 beg*/
		$var=M('user')->where("user_id=$_SESSION[user_id]")->getField('lock');
		 if($var==1){
		    $this->error('该用户已经被锁定');
 		   }
		 $var='';
	     /*用户锁定 end*/
         //--资质审核 beg
        $where['user_id'] = $_SESSION['user_id'];
        //$data = M('user')->where($where)->getField('is_authentication');
        $data = M('user')->where($where)->find();
        if ($data['is_authentication'] != 1) {
            $this->error('资质没有审核', '/userinfo/authentication');
        }
        
        $aptitudes = $data['aptitudes'];//会员经营范围
        $aptitudeArr = array();
        if(!empty($aptitudes)){
            $aptitudes = str_replace("[", '', $aptitudes);
            $aptitudeArr = explode("]", $aptitudes);
        }
        //控销药品
        $au_vip = $data['is_vip'];
        $where = '';
        $data = '';
        //--资质审核 end
        //--过滤不存在的商品 beg
        //$_GET['product_id'] = '1,2,23,24';
        //$_GET['product_num'] = '3,4,5,6';
        $product_num = $_GET['product_num'];
        $product_num = explode(',', $product_num);
        $product_id = $_GET['product_id'];
        $product_id = explode(',', $product_id);
        for ($i = 0, $n = count($product_id); $i < $n; $i++) {
            $where['product_id'] = $product_id[$i];
            if (!M('product')->where($where)->count()) {
                unset($product_id[$i]);
                unset($product_num[$i]);
            }
            $product  = M('product')->where($where)->find();
            if(!in_array($product['aptitudes'], $aptitudeArr)){
                   $this->error($product['title'].' 的药品种类不在经营范围内！');
            }
            //控销药品购买限制
            if($product['ptype']==2 && $au_vip!=1){
                   $this->error($product['title'].' 是控销药品，请先升级成为平台大客户！','/userinfo/vip');
            }
			if(  M('product')->where($where)->getField('frame') != 1 ){
				    unset($product_id[$i]);
                    unset($product_num[$i]);
 				} 
			 
 			 if(   M('product')->where($where)->getField('stock')<=0   ): 
			        unset($product_id[$i]);
                    unset($product_num[$i]);
			  elseif(  M('product')->where($where)->getField('stock') <= $product_num[$i] ):	
					 $product_num[$i]=M('product')->where($where)->getField('stock');
    		 endif;
           }
        $product_id = implode(',', $product_id);
        $product_id = explode(',', $product_id);
        $product_num = implode(',', $product_num);
        $product_num = explode(',', $product_num);
        for ($i = 0; $i < count($product_num); $i++) {
            if (!preg_match('/^[1-9][0-9]*$/', $product_num[$i])) {
                $this->error('商品数量错误', '/');
            }
        }
        //--过滤不存在的商品 end
        if (!$product_id[0]) {
            //-- 当 过滤完后 没有可以使用的商品的情况
            $this->error('没有有效的商品', '/');
        }
		/*流水号 beg*/
                //先更新流水号，再查询
                $sql = "update system set serial_number=serial_number+1 where system_id = 1";
                $Model = M();
                $result = $Model->query($sql);
                
		$serial_number['serial_number']=M('system')->getField('serial_number');
//		$serial_number['serial_number']++;
//		M('system')->where("system_id=1")->save($serial_number);
	     /*流水号 end*/
        $data['order_num'] ="ZSM".date('Ymd').$serial_number['serial_number'];
        $data['express_fee'] = $this->orderFunExpress_fee(); /*查询快递费*/
        $data['time'] = time();
        $data['user_id'] = $_SESSION['user_id'];
        $data['status'] = 1;
		$data['confirm'] =2;
        M('order')->add($data);
         $where = '';
        $where['order_num'] = $data['order_num'];
        $order_id = M('order')->where($where)->getField('order_id');
        for ($i = 0; $i < count($product_id); $i++) {
            $data = '';
            $where = '';
            $data['product_num'] = $product_num[$i];
            $data['order_id'] = $order_id;
            $data['product_id'] = $product_id[$i];
            $where['product_id'] = $product_id[$i];
            $data['title'] = M('product')->where($where)->getField('title');
            $data['subhead'] = M('product')->where($where)->getField('subhead');
            if (M('product')->where($where)->getField('is_discount')) {
                $data['price'] = M('product')->where($where)->getField('price3');
            } else {
                $data['price'] = M('product')->where($where)->getField('price2');
            }
            $data['img'] = M('product_img')->where($where)->getField('img');
            $data['total_price'] = $data['price'] * $data['product_num'];
              M('order_product')->add($data);
        }
        $this->orderFunAdd_total($order_id);
        //计算总价
 		 redirect('/order/contract/order_id/' . $order_id);
      }
	  
	     function contract(){ /*电子合同*/
		    $this->orderDetail_status_check(1);
			 $data['contract']=M("system")->getField('contract');
			 $data['time']=time();
		     $this->assign('data',$data);
			//$this->display();
		   redirect('/order/orderDetail/order_id/' . $_GET[order_id]);
	      }
		  
		  function contractFunDo(){ /*电子合同提交*/
		    $this->orderDetail_status_check(1);
			$data['contract_1']= M("system")->getField('contract');
		    $data['contract_2']=$_POST[imageData];
			$data['contract_3']=time();
            M()->query(" UPDATE  `order`  SET  `contract_1` = '$data[contract_1]',`contract_2` =  '$data[contract_2]',`contract_3` =  '$data[contract_3]' WHERE  `order`.`order_id` =$_GET[order_id]; ");		
   			redirect('/order/orderDetail/order_id/' . $_GET[order_id]);
  	      }
 	        
 	  
	    function contract2(){ /*已经签订的电子合同*/
 			$data=M("order")->where("order_id=$_GET[order_id]")->find();
		    $this->assign('data',$data);
			$this->display();
	      }
	  
	  
	  
	  
	   function orderFunExpress_fee(){/*查询快递费*/
 			   $where['user_id']=$_SESSION['user_id'];
			   $where2['area']=M('receiving_address')->where($where)->getField('city1');	
 			   if(  M('express_fee')->where($where2)->count() ){
				       $data=M('express_fee')->where($where2)->getField('fee');
 				   }
				 else{
				$data=M('system')->getField('express_fee');	 
					 }  
  				return 	$data;
 			}
	  
	  
     public function orderFunAdd_total($order_id)
    {
          //计算总价
        $where['order_id'] = $order_id;
        $data = M('order')->where($where)->find();
        $toal = $data['express_fee'];
        //总价
        $data = M('order_product')->where($where)->select();
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['total_price'] = $data[$i]['price'] * $data[$i]['product_num'];
            $toal = $toal + $data[$i]['total_price'];
        }
        $data2['total'] = $toal;
		
		$data=M('system')->where("system_id=1")->find();
		$data2['remark']='';//备注信息
   		/*打折 beg*/
		  if($data['discount']){
 		     $data2['total']=$data2['total']*$data['discount']/100;
		     $data2['remark']= $data2['remark']."该商品已经获得{$data['discount']}折优惠&nbsp;&nbsp;&nbsp;";
		    }
 		/*打折 end*/
  		/*满xx 减 xx beg*/
	     if( $data['reduce_money1']  and  $data['reduce_money2']  and   $data['reduce_money1']> $data['reduce_money2'] )
	        $n=floor($data2['total']/$data['reduce_money1']);
  	      if($n):
		     $data2['total']=$data2['total']- $n*$data['reduce_money2'];
		     $data2['remark']= $data2['remark']."该商品已经参与满{$data['reduce_money1']}减{$data['reduce_money2']}活动&nbsp;&nbsp;&nbsp;";
 		  endif;
		/*满xx 减 xx end*/
         M('order')->where($where)->save($data2);
    }
	
	
     public function orderDetail()
    {
        if (!$_SESSION['user_id']) {
            $this->error('请先登录', '/');
        }
		/*优惠券的相关信息  beg*/
	   	 $where='';
		 $where['is_use']=array('neq',1);
		 $where['user_id'] = $_SESSION['user_id'];
  		 $time_end=time()-24*60*60;
		 $time=time();
  		 $where['_string']="endtime >= $time_end   and  begtime<= $time ";
 		 $data = M('coupon')->where($where)->select();
 		 $this->assign('coupon', $data);
		/*优惠券的相关信息 end*/
	   /*系统相关信息  beg*/
         $data = M('system')->where('system_id=1')->find();
 	     $this->assign('system', $data);
 		/*系统相关信息 end*/
  		$where='';
        $where['order_id'] = $_GET['order_id'];
        $where['user_id'] = $_SESSION['user_id'];
        $data = M('order')->where($where)->find();
        if (!$data['status']) {
            //status 订单状态 1 未付款，2. 已结付款.待发货 3.已经发货。待确认 4.确认收货 ，待评价5.已经评价
            $this->error('用户权限不正确', '/order/orderList');
        }
         $this->assign('orderDetail', $data);
        //订单的信息
  		
         $status = $data['status'];
		  $confirm = $data['confirm'];
        if ($status == 3) {
            /*剩余收货时间*/
            $remainingTime = $data['endtime'] - time();
            $remainingTime_day = floor($remainingTime / 60 / 60 / 24);
            $remainingTime_day_remian = $remainingTime % (60 * 60 * 24);
            $remainingTime_hour = floor($remainingTime_day_remian / 60 / 60);
            $remainingTime_hour_remian = $remainingTime_day_remian % (60 * 60);
            $remainingTime_minute = floor($remainingTime_hour_remian / 60);
            $remainingTime_minute_remian = $remainingTime_hour_remian % 60;
            $remainingTime = $remainingTime_day . '天' . $remainingTime_hour . '小时' . $remainingTime_minute . '分钟' . $remainingTime_minute_remian . '秒';
            $this->assign('remainingTime', $remainingTime);
        }
        if ($confirm == 2) {
            //收货地址  状态为1 的时候的 订单地址
            $where = '';
            $where['user_id'] = $data['user_id'];
            $data = M('receiving_address')->where($where)->find();
            $this->assign('receiving_address', $data);
        }
        if ($status == 1) {
            //可以使用的积分
            $this->assign('data_points', $this->data_points());
        }
        $where = '';
        $where['order_id'] = $_GET['order_id'];
        $data = M('order_product')->where($where)->select();
        if ($status == 4) {
            //查询 对改商品是否 已经 评论了
            for ($n = 0; $n < count($data); $n++) {
                $where = '';
                /**/
                $where['product_id'] = $data[$n]['product_id'];
                $where['order_id'] = $_GET['order_id'];
                if (M('comment_right')->where($where)->count()) {
                    $data[$n]['is_have_comment_right'] = 1;
                }
            }
        }
        //查询 该商品是否处在 退换货 流程中  beg
        for ($n = 0; $n < count($data); $n++) {
            $where = '';
            $where['product_id'] = $data[$n]['product_id'];
            $where['order_id'] = $_GET['order_id'];
            if (M('return')->where($where)->count()) {
                $data[$n]['is_return'] = 1;
            }
			$where['status']=4;
		    if (M('return')->where($where)->count()) :
                  $data[$n]['is_return'] = 2;
               endif;
			
        }
        //查询 该商品是否处在 退换货 流程中  end
        $this->assign('order_product', $data);
        //产品列表
        $this->display();
    }
	
	public function orderDetailFunConfirm(){ /* 确认订单*/
		  $this->orderDetail_status_check(1);
          //订单详情 相关页面的 状态验证
		  $this->orderDetailFunConfirm_address_full();  // 验证 地址是否完整
 		  /*优惠券相关 beg*/
		  $coupon=0;// 优惠券的金额
		  if($_POST['coupon_id']):
			  $where['user_id']=$_SESSION['user_id'];
			  for( $i=0;$i<count($_POST['coupon_id']);$i++){
			       $where['coupon_id']=$_POST['coupon_id'][$i];
				   $data['is_use']=1;
				   M('coupon')->where($where)->save($data);
				   $data=M('coupon')->where($where)-> getField('num');
				   $coupon=$coupon+$data;
				   $data3=M('order')->where("order_id=$_GET[order_id]")->getField('remark');
				   $data5['remark']=$data3."&nbsp;&nbsp;已经使用 优惠券 $data 元";
				   M('order')->where("order_id=$_GET[order_id]")->save($data5);
   			    }
    	  endif;
		  $data='';
		  $data3='';
		  $data5='';
 		  $where='';
		  /*优惠券相关end*/
		  $data=M('order')->where("order_id=$_GET[order_id]")->find();
		  $system=M('system')->where("system_id=1")->find();
 		   $data2['confirm']='';
		    $data2['real_address']=$this->orderDetailFunConfirm_address();  // 查询地址
 		   if( ($data['total']-$coupon) <= 0  ){
			   $data2['need_pay']=0;
			   $data2['points_reduce']=0;
			   }
			 else{ 
			    if( ( $data['total']-$coupon-$this->data_points()* $system['use_cash']/100 ) >=0  ):
				   $data2['need_pay']=  $data['total']-$coupon-$this->data_points()* $system['use_cash']/100;
				   $data2['points_reduce']=$this->data_points();
				 else: 
				 $data2['need_pay']=0;
				 $data2['points_reduce']=$data['total']-$coupon;
  				endif;
			 } 
 			 
           M('order')->where("order_id=$_GET[order_id]")->save($data2);
		   /*清空购物车 beg */
		    M('shopping_cart')->where("user_id=$_SESSION[user_id]")->delete();
  		   /*清空购物车end*/
		   
 		 redirect($_SERVER['HTTP_REFERER'] );
   		}
 	
	 function  orderDetailFunConfirm_address(){    // 查询地址
         $where = '';
        $where['user_id'] = $_SESSION['user_id'];
        $data2 = M('receiving_address')->where($where)->find();
        $data['real_address'] = $data2['city1'] . $data2['city2'] . $data2['city3'] . $data2['address'] . '&nbsp;邮编' . $data2['postcode'] . '&nbsp;收货人' . $data2['name'] . '&nbsp;电话 ' . $data2['mobile_phone'] . '&nbsp;座机' . $data2['quhao'] . '-' . $data2['home_phone'];
		return  $data['real_address'];
 		}
 	
		 function  orderDetailFunConfirm_address_full(){ // 验证 地址是否完整
         $where = '';
        $where['user_id'] = $_SESSION['user_id'];
        $data2 = M('receiving_address')->where($where)->find();
		if(!$data2['city1'] or   !$data2['city2']  or    !$data2['city3']  or    !$data2['address']  or  !$data2['name']   or    !$data2['mobile_phone']  ){
			$this->error('地址不完整');
 		 }
  		 }
	
	
	
	
    public function data_points()
    {
        //可以使用的积分
        $where['user_id'] = $_SESSION['user_id'];
        $data_points_add = M('order')->where($where)->sum('points_add');
        $data_points_reduce = M('order')->where($where)->sum('points_reduce');
        $data_points = $data_points_add - $data_points_reduce;
        return $data_points;
    }
    public function orderDetail_2()
    {
        $this->orderDetail_status_check(1);
        //订单详情 相关页面的 状态验证
        $where['order_id'] = $_GET['order_id'];
        $data = M('order')->where($where)->find();
        $this->assign('data', $data);
         $this->display();
    }
    public function orderDetail_2FunPay()
    {
        $this->orderDetail_status_check(1);
        //订单详情 相关页面的 状态验证
         $where['order_id'] = $_GET['order_id'];
         $data_need_pay = M('order')->where($where)->getField('need_pay');
        if ($data_need_pay==0) {
			 $this->orderDetail_2FunPay_part1();
          } else {
            $this->orderDetail_2FunPay_part2();
        }
    }
 	
    public function orderDetail_status_check($status)
    {
        //订单详情 相关页面的 状态验证
        if (!$_SESSION['user_id']) {
            $this->error('请先登录', '/');
        }
        $where['order_id'] = $_GET['order_id'];
        $where['user_id'] = $_SESSION['user_id'];
        $data = M('order')->where($where)->find();
        if ($data['status'] != $status) {
            //status 订单状态 1 未付款，2. 已结付款.待发货 3.已经发货。待确认 4.确认收货 ，待评价5.已经评价
            $this->error('请刷新页面', '/order/orderList');
        }
    }
    public function orderDetail_2FunPay_part1()
    {
        //积分大于 总价
        $this->orderDetail_status_check(1);
        //订单详情 相关页面的 状态验证
        $data = '';
        $data['status'] = 2;	
        $data['time2'] = time();
        $where['order_id'] = $_GET['order_id'];
        M('order')->where($where)->save($data);
		redirect(  '/order/orderDetail2_mid/order_id/' . $_GET['order_id'] );
    }
	
	
    public function orderDetail_2FunPay_part2() /*到orderDetail_2FunPay_part2 中去 提交表单,并且更新数据，但是不更新积分增加*/
    {     
	$this->orderDetail_status_check(1);
   	/*orderDetail_2FunPay_part2 提交的数据 获取 beg*/
        $paymenthod = $_POST['paymethod']; //支付方式 1-银联支付，2-支付宝支付，3-微信支付
        if($paymenthod==2){//支付宝支付
            vendor('Alipay.Corefunction');
            vendor('Alipay.Notify');
            vendor('Alipay.RsaFunction');
            vendor('Alipay.Submit');
            $orderp = M('order')->where("order_id=".$_GET['order_id'])->find();
//            $order['orderId']= $orderp['order_num'];    
//            $data2['txnTime']=date('YmdHis',time());
//            $data2['txnAmt'] = M('order')->where("order_id=".$_GET['order_id'])->getField('need_pay')*100;
//            $this->assign('order',$order);
//            $this->display('orderDetail_alipay');
            $alipay_config=C('alipay_config');
            //商户订单号，商户网站订单系统中唯一订单号，必填
            $out_trade_no = $orderp['order_num'];
            //订单名称，必填
            $subject = "药品采购货款支付";
            //付款金额，必填
            $total_fee = $orderp['need_pay'];
            //商品描述，可空
            $body = "";
            //构造要请求的参数数组，无需改动
            $parameter = array(
                            "service"       => $alipay_config['service'],
                            "partner"       => $alipay_config['partner'],
                            "seller_id"  => $alipay_config['seller_id'],
                            "payment_type"	=> $alipay_config['payment_type'],
                            "notify_url"	=> $alipay_config['notify_url'],
                            "return_url"	=> $alipay_config['return_url'],
                            "anti_phishing_key"=>$alipay_config['anti_phishing_key'],
                            "exter_invoke_ip"=>$alipay_config['exter_invoke_ip'],
                            "out_trade_no"	=> $out_trade_no,
                            "subject"	=> $subject,
                            "total_fee"	=> $total_fee,
                            "body"	=> $body,
                            "_input_charset"	=> trim(strtolower($alipay_config['input_charset']))
                            //其他业务参数根据在线开发文档，添加参数.文档地址:https://doc.open.alipay.com/doc2/detail.htm?spm=a219a.7629140.0.0.kiX33I&treeId=62&articleId=103740&docType=1
                    //如"参数名"=>"参数值"
            );
            //建立请求
            $alipaySubmit = new AlipaySubmit($alipay_config);
            $html_text = $alipaySubmit->buildRequestForm($parameter,"get", "确认");
            echo $html_text;
        }else if($paymenthod==3){//微信支付
            $orderp = M('order')->where("order_id=".$_GET['order_id'])->find();
            $this->assign('order',$orderp);
            $this->display('orderDetail_2FunPay_wxpay');
        }else{//银联支付
	    $data2['orderId']= M('order')->where("order_id=".$_GET['order_id'])->getField('order_num');    
            $data2['txnTime']=date('YmdHis',time());
            $data2['txnAmt'] = M('order')->where("order_id=".$_GET['order_id'])->getField('need_pay')*100;
            $this->assign('data',$data2);
            $this->display('orderDetail_2FunPay_part2');
        }
    }
    
    public function getwxpaycode(){
        //$this->orderDetail_status_check(1);
        ini_set("max_execution_time", "120");
        vendor('wxpay.WxPayApi');
        vendor('wxpay.WxPayNativePay');
        vendor('wxpay.WxPayData');
        vendor('wxpay.WxPayException');
        vendor('wxpay.WxPayNotify');
        vendor('wxpay.WxPayConfig');
        vendor('phpqrcode.phpqrcode');
        $orderp = M('order')->where("order_id=".$_GET['order_id'])->find();
        if($orderp['status']!=1){//订单状态为非支付状态
            exit;
        }
        $input = new WxPayUnifiedOrder();
        $input->SetBody("药品采购款");
//        $input->SetAttach("");
        $orderno = rand(100000,999999).$orderp['order_num'];
        $input->SetOut_trade_no($orderno);
        $input->SetTotal_fee($orderp['need_pay']*100);
//        $input->SetTime_start(date("YmdHis"));
//        $input->SetTime_expire(date("YmdHis", time() + 600));
//        $input->SetGoods_tag("test");
        $input->SetNotify_url("https://www.dtyd.com.cn/notify/wxpaynotify");
        $input->SetTrade_type("NATIVE");
        $input->SetProduct_id($orderp['order_num']);
        Log::write('wxpay codeurl xml：'.$input->ToXml(), Log::ERR);
        $notify = new NativePay();
        $result = $notify->GetPayUrl($input);
        Log::write('wxpay codeurl：'.json_encode($result), Log::ERR);
        $url = $result["code_url"];
        $object = new QRcode();
        $object->png($url, false, 3, 4, 2);
        ini_set("max_execution_time", "30");
    }
 
    public function orderDetail2_mid()
    {
        $this->orderDetail_status_check(2);
        //订单详情 相关页面的 状态验证
        $where['order_id'] = $_GET['order_id'];
        $data = M('order')->where($where)->find();
        $this->assign('data', $data);
        $this->display();
    }
    public function orderDetail4_mid()
    {
         $this->orderDetail_status_check(3);
 		$system=M('system')->where('system_id=1')->find();
 		/*积分真加 beg*/
		 $data=M('order')->where('order_id='.$_GET['order_id'])->find();
		 $data2['points_add'] = floor($data['need_pay'])*$system['get_cash'];
		 M('order')->where('order_id='.$_GET['order_id'])->save($data2);
	     $data='';
	     $data2='';
	    /*积分真加 end*/
        $where['order_id'] = $_GET['order_id'];
        $data['status'] = 4;
        $data['time4'] = time();
        M('order')->where($where)->save($data);
        $this->comment_right($_GET['order_id']);
        //给与评论权限
        $where = '';
        $where['order_id'] = $_GET['order_id'];
        $data = M('order')->where($where)->find();
        $this->assign('data', $data);
        $this->display();
    }
	
	
    public function comment_right($order_id)
    {
        //给与评论权限
        $where['order_id'] = $order_id;
        $data = M('order_product')->where($where)->select();
        for ($i = 0; $i < count($data); $i++) {
            $data2['product_id'] = $data[$i]['product_id'];
            $data2['user_id'] = $_SESSION['user_id'];
            $data2['order_id'] = $order_id;
            M('comment_right')->add($data2);
        }
    }
	
	
 
		 
		 
		 
		 






}