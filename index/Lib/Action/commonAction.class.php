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
// 本类由系统自动生成，仅供测试用途
class commonAction extends Action {
    public function system_info() {
        $m = M('system');
        $data = $m->find();
        $data['search_keyword'] = explode('/', $data['search_keyword']);
        $this->assign('top_content', $data);
    }
    public function _initialize() {
           
         $this->system_info();
        //查询头部信息
        $where['user_id'] = $_SESSION['user_id'];
        $data = M('user')->where($where)->find();
        $this->assign('top', $data);
        //---头部的产品目录
        $this->top_class();
        //购物车 里面有多少种商品
        $this->shopping_cart_sum();
          $this->auto_do(); /*网站的自动收货，打折商品自动 还原等操作*/
  		if( $_SESSION['user_id']){
			 setcookie(session_name(),session_id(),60*60+time(),'/');
	       }
		   
		  
     }
	
 	
    public function auto_do() { /*网站的自动收货，打折商品自动 还原等操作*/
        $now = time();
        $time = M('system')->getField('atuo_time');
        if ($now > $time + 5) {
			
            $this->send_out_goods_auto(); /*自动确认收货*/
			
             $this->productIsDiscountstatus();
            // 更新 数据库 中 哪些商品是否为折扣 商品    只更新了 able_discount=1  的产品的状态    判断 是否为折扣商品 。需要  able_discount=1     is_discount=1
           
              
			 $this->stock_reduce(); /*更新库存*/
			 
			 
            $data['atuo_time'] = time();
            $where['system_id'] = 1;
            M('system')->where($where)->save($data);
        }
    }
	
	
	
    public function productIsDiscountstatus() {
        // 更新 数据库 中 哪些商品是否为折扣 商品    只更新了 able_discount=1  的产品的状态    判断 是否为折扣商品 。需要  able_discount=1     is_discount=1
		
 		$where['able_discount'] = '1';
         $data = M('product')->where($where)->field('product_id')->select();	 
  
        for ($i = 0; $i < count($data); $i++) {
			
            if ($this->contenFunIsDiscount($data[$i]['product_id'])) {
                $data2['is_discount'] = 1;
                $where2['product_id'] = $data[$i]['product_id'];
				  
                M('product')->where($where2)->save($data2);
				   
            } else {
                $data2['is_discount'] = '';
                $where2['product_id'] = $data[$i]['product_id'];
                M('product')->where($where2)->save($data2);
 
             }
			
        }
        $where3['able_discount'] = '';
	    $where3['is_discount'] = '1';
        $data2['is_discount'] = '';
        M('product')->where($where3)->save($data2);
 
		
    }
	
	
	
    public function contenFunIsDiscount($product_id) {
        //判断 商品是否是 为 折扣商品
        $where['able_discount'] = '1';
        $where['product_id'] = $product_id;
        if (!M('product')->where($where)->count()) {
            return 0;
        }
        $data = M('product')->where($where)->field('discount_beg_time,discount_end_time,price3')->select();
        if (!$data[0]['discount_beg_time'] or !$data[0]['discount_end_time']) {
            return 0;
        }
        if (time() < $data[0]['discount_beg_time']) {
            return 0;
        }
        if (time() > $data[0]['discount_end_time'] + 60 * 60 * 24) {
            return 0;
        }
        if (!$data[0]['price3']) {
            return 0;
        }
        return 1;
    }
	
	
	
    public function send_out_goods_auto() {
        //自动确认收货
        $where['status'] = 3;
        $data = M('order')->where($where)->field('endtime,order_id,need_pay')->select();
        $system = M('system')->where('system_id=1')->find();
        for ($i = 0; $i < count($data); $i++) {
            if (time() - $data[$i]['endtime'] > 0) {
                 $where = '';
                $where['order_id'] = $data[$i]['order_id'];
                $data2['status'] = 4;
                $data2['time4'] = time();
                M('order')->where($where)->save($data2);
                $this->comment_right($data[$i]['order_id']);
                /*积分真加 beg*/
                 $data2['points_add'] = floor($data[$i]['need_pay'] ) * $system['get_cash'];
                 M('order')->where('order_id=' . $data[$i]['order_id'])->save($data2);
                 /*积分真加 end*/
            }
        }
    }
	
 	
	
 function stock_reduce() { /*自动库存减少*/
        
	    /*拆分查询语句 beg*/		
	    $Model = new Model();
        $data=$Model->query(" select  order_id  from  `order`  where  status = 2   and stock_reduce <> 1 ");
	    $order_id='';
	    for( $i=0;$i<count($data);$i++):
		   $order_id="$order_id,'{$data[$i][order_id]}'";
 		endfor;
 		$order_id=',';
		$order_id=substr($order_id,1);
 		 if(!$order_id):
		     $order_id=0;
	    endif;
		 /*拆分查询语句 end*/	
  
         $Model = new Model(); // 实例化一个model对象 没有对应任何数据表
        $data = $Model->query("select product_id  , product_num   from `order_product`  where order_id  in (  $order_id )");
       
		for ($i = 0; $i < count($data); $i++) {
            $data2['stock'] = M('product')->where("product_id=" . $data[$i]['product_id'])->getField('stock') - $data[$i]['product_num'];
            $data2['sell_num'] = M('product')->where("product_id=" . $data[$i]['product_id'])->getField('sell_num') + 1;
            M('product')->where("product_id={$data[$i]['product_id']}")->save($data2);
        }
        $time = time();
		  $Model->execute("update `order` set stock_reduce=1 , time2=$time where  stock_reduce='' and status <> 1 ");
				

    }
	
	
	

	
    public function comment_right($order_id) {
        //给与评论权限
        $where['order_id'] = $order_id;
        $data = M('order_product')->where($where)->Field('product_id')->select();
        for ($i = 0; $i < count($data); $i++) {
            $data2['product_id'] = $data[$i]['product_id'];
            $data2['user_id'] = $_SESSION['user_id'];
            $data2['order_id'] = $order_id;
            M('comment_right')->add($data2);
        }
    }
	
	
	
	
	
    //---头部的产品目录
    public function top_class() {
        $where['fid'] = '';
        $data = M('product_classify')->where($where)->select();
        //  获取第1级 栏目的信息
        for ($i = 0; $i < count($data); $i++) {
            $where2['fid'] = $data[$i]['product_classify_id'];
            $data2 = M('product_classify')->where($where2)->select();
            $data[$i]['class_1'] = $data2;
            //获取第二级 栏目的信息
            for ($i2 = 0; $i2 < count($data[$i]['class_1']); $i2++) {
                $where3['fid'] = $data[$i]['class_1'][$i2]['product_classify_id'];
                $data3 = M('product_classify')->where($where3)->select();
                $data[$i]['class_1'][$i2]['class_2'] = $data3;
            }
        }
        $this->assign('top_class', $data);
    }
    //购物车 里面有多少种商品
    public function shopping_cart_sum() {
        if ($_SESSION['user_id']) {
            $where['user_id'] = $_SESSION['user_id'];
            $data = M('shopping_cart')->where($where)->count();
        } else {
            $data = 0;
        }
        $this->assign('shopping_cart_sum', $data);
    }
    public function verify() {
        import('ORG.Util.Image');
        Image::buildImageVerify();
    }
    public function p($data) {
        echo '<pre>';
        var_dump($data);
    }
}

