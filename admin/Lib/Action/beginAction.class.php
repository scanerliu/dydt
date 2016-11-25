<?php
class beginAction extends Action
{
    function _initialize()
    {
        if (!$_SESSION['admin_name']) {
            $this->Redirect('/login/login');
        }
        $this->auto_do();
        /*网站的自动收货，打折商品自动 还原等操作*/
		 $this->record(); //操作日志
      }
	
	
	
	  public function run(&$params) {
        
        foreach ($_GET as $k=>$v){
            if(!is_array($v)){
                if (!mb_check_encoding($v, 'utf-8')){
                    $_GET[$k] = iconv('gbk', 'utf-8', $v);
                }
            }else{
                foreach ($_GET['_URL_'] as $key=>$value){
                    if (!mb_check_encoding($value, 'utf-8')){
                        $_GET['_URL_'][$key] = iconv('gbk', 'utf-8', $value);
                    }
                }
            }
        }
        
    }
	
	
	
	
 	  function  record(){ //操作日志
	        $data['time']=time();
			$data['remark']='网站正常访问操作';
		     M('record')->add($data);
		}
	
       public function auto_do()
    {
        /*网站的自动收货，打折商品自动 还原等操作*/
        $now  = time();
        $time = M('system')->getField('atuo_time');
        if ($now > $time + 5) {
            $this->send_out_goods_auto();
            /*自动确认收货*/
            $this->productIsDiscountstatus();
            // 更新 数据库 中 哪些商品是否为折扣 商品    只更新了 able_discount=1  的产品的状态    判断 是否为折扣商品 。需要  able_discount=1     is_discount=1
            $this->stock_reduce();
            /*更新库存*/
            $data['atuo_time']  = time();
            $where['system_id'] = 1;
            M('system')->where($where)->save($data);
        }
    }
	
      public function productIsDiscountstatus()
    {
        // 更新 数据库 中 哪些商品是否为折扣 商品    只更新了 able_discount=1  的产品的状态    判断 是否为折扣商品 。需要  able_discount=1     is_discount=1
        $where['able_discount'] = 1;
        $data                   = M('product')->where($where)->field('product_id')->select();
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
        $data2['is_discount']    = '';
        M('product')->where($where3)->save($data2);
    }
     public function contenFunIsDiscount($product_id)
    {
        //判断 商品是否是 为 折扣商品
        $where['able_discount'] = 1;
        $where['product_id']    = $product_id;
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
       public function send_out_goods_auto()
    {
        //自动确认收货
        $where['status'] = 3;
        $data            = M('order')->where($where)->field('endtime,order_id,need_pay')->select();
        $system          = M('system')->where('system_id=1')->find();
        for ($i = 0; $i < count($data); $i++) {
            if (time() - $data[$i]['endtime'] > 0) {
                $where             = '';
                $where['order_id'] = $data[$i]['order_id'];
                $data2['status']   = 4;
                $data2['time4']    = time();
                M('order')->where($where)->save($data2);
                $this->comment_right($data[$i]['order_id']);
                /*积分真加 beg*/
                $data2['points_add'] = floor($data[$i]['need_pay']) * $system['get_cash'];
                M('order')->where('order_id=' . $data[$i]['order_id'])->save($data2);
                /*积分真加 end*/
            }
        }
    }
     function stock_reduce()
    {
        /*自动库存减少*/
        $Model = new Model(); // 实例化一个model对象 没有对应任何数据表
        $data  = $Model->query("select product_id  , product_num   from `order_product`  where order_id  in (  select  order_id  from  `order`  where  status = 2   and stock_reduce <> 1)");
        for ($i = 0; $i < count($data); $i++) {
            $data2['stock']    = M('product')->where("product_id=" . $data[$i]['product_id'])->getField('stock') - $data[$i]['product_num'];
            $data2['sell_num'] = M('product')->where("product_id=" . $data[$i]['product_id'])->getField('sell_num') + 1;
            M('product')->where("product_id={$data[$i]['product_id']}")->save($data2);
        }
        $time = time();
        $Model->execute("update `order` set stock_reduce=1 , time2=$time where  stock_reduce<>1 and status <> 1 ");
    }
     public function comment_right($order_id)
    {
        //给与评论权限
        $where['order_id'] = $order_id;
        $data              = M('order_product')->where($where)->Field('product_id')->select();
        for ($i = 0; $i < count($data); $i++) {
            $data2['product_id'] = $data[$i]['product_id'];
            $data2['user_id']    = $_SESSION['user_id'];
            $data2['order_id']   = $order_id;
            M('comment_right')->add($data2);
        }
    }
}