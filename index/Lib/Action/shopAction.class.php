<?php
// 本类由系统自动生成，仅供测试用途
class shopAction extends commonAction
{
    public function content()
    {
 		
         $this->content_part_product_detail();
        //产品详情
        $this->content_part_product_img();
        //产品图片
        $this->assign('contentFunIsDiscount', $this->contenFunIsDiscount($_GET['product_id']));
        //判断产品是否  当前是否为折扣商品
 				
        $this->content_part_product_group();
        //最优搭配
        $this->content_part_product_other();
        //同类的其他商品
        $this->content_part_weiz();
        //产品路径
        $this->content_history();
        //浏览历史
        $this->content_part_commentFunIsCan();
        //是否有评论的权限
        $this->content_part_comment();
        //评论的列表
		$this->shopList_part_hotSell(); /*热销 商品*/
        $this->display();
    }
    public function content_history()
    {
        //浏览历史
        if (!$_SESSION['user_id']) {
            return;
        }
        $where['user_id'] = $_SESSION['user_id'];
        $where['product_id'] = $_GET['product_id'];
        if (M('history')->where($where)->count()) {
            $time = M('history')->where($where)->order('time desc')->getField('time');
            if (time() - $time < 60 * 60 * 6) {
                return;
            } else {
                $data['time'] = time();
                $data['user_id'] = $_SESSION['user_id'];
                $data['product_id'] = $_GET['product_id'];
                M('history')->add($data);
            }
        } else {
            $data['time'] = time();
            $data['user_id'] = $_SESSION['user_id'];
            $data['product_id'] = $_GET['product_id'];
            M('history')->add($data);
        }
    }
    public function content_part_weiz()
    {
        //产品路径
        $where['product_id'] = $_GET['product_id'];
        $data = M('product')->where($where)->find();
        $where2['product_classify_id'] = $data['class1'];
        $data['class1Title'] = M('product_classify')->where($where2)->getField('title');
        $where2 = '';
        $where2['product_classify_id'] = $data['class2'];
        $data['class2Title'] = M('product_classify')->where($where2)->getField('title');
        $where2 = '';
        $where2['product_classify_id'] = $data['class3'];
        $data['class3Title'] = M('product_classify')->where($where2)->getField('title');
        $this->assign('content_part_weiz', $data);
    }
    public function shopping_cart_add()
    {
        //购物车添加
        if (!$_SESSION['user_id']) {
			 redirect('/account/login' );
          }
 		
        $data['user_id'] = $_SESSION['user_id'];
        $data['product_id'] = $_GET['product_id'];
        if (M('shopping_cart')->where($data)->count()) {
            $num = M('shopping_cart')->where($data)->getField('num');
            if (!$_GET['num']) {
                $data2['num'] = $num + 1;
                M('shopping_cart')->where($data)->save($data2);
            } else {
                (int) $_GET['num'];
                if (!($_GET['num'] > 0)) {
                    $this->error('数据不合法');
                }
                $data2['num'] = $num + $_GET['num'];
                M('shopping_cart')->where($data)->save($data2);
            }
        } else {
            if (!$_GET['num']) {
                $data['num'] = 1;
            } else {
                $data['num'] = $_GET['num'];
            }
            M('shopping_cart')->add($data);
        }
      redirect($_SERVER['HTTP_REFERER'] );
     }
    public function favorite_add()
    {
        //关注添加
        if (!$_SESSION['user_id']) {
            $this->error('请先登录');
        }
        $data['user_id'] = $_SESSION['user_id'];
        $data['product_id'] = $_GET['product_id'];
        M('favorite')->add($data);
        $this->success('关注成功');
    }
    public function favorite_delete()
    {
        //取消关注
        if (!$_SESSION['user_id']) {
            $this->error('请先登录');
        }
        $where['user_id'] = $_SESSION['user_id'];
        $where['product_id'] = $_GET['product_id'];
        M('favorite')->where($where)->delete();
        $this->success('取消成功');
    }
    public function content_part_product_detail()
    {
        //产品详情
		   /*快递费查询*/
		$data=M('express_fee')->select();
	     $this->assign('express_fee', $data);
		
        $where['product_id'] = $_GET['product_id'];
        $data = M('product')->where($where)->find();
        $pmanner = M('gold_manu')->where("gold_id=".$data['manu_id'])->find();
        $data['manu_name'] = $pmanner['gold_name'];
        $this->assign('product_detail', $data);
        $where = '';
        $where['product_id'] = $_GET['product_id'];
        $where['product_attribute.is_top'] = 1;
        $data = M('product_attribute_list')->join('left join  product_attribute on product_attribute.attribute_id  = product_attribute_list.attribute_id')->where($where)->Distinct(true)->field('product_attribute_list.*,product_attribute.title')->select();
          $this->assign('product_detail1', $data);
		  
 		  
        //头部的自定义属性 头部的
        $where = '';
        $where['product_id'] = $_GET['product_id'];
        $data = M('product_attribute_list')->join('left join  product_attribute on product_attribute.attribute_id  = product_attribute_list.attribute_id')->where($where)->Distinct(true)->field('product_attribute_list.*,title')->select();
        $this->assign('product_detail2', $data);
    }
    public function content_part_product_img()
    {
        //产品图片
        $where['product_id'] = $_GET['product_id'];
        $data = M('product_img')->where($where)->select();
        $this->assign('product_img', $data);
    }
    public function content_part_product_group()
    {
        //最优搭配
        $where['product_id'] = $_GET['product_id'];
        $data = M('product')->where($where)->find();
        $data = $data['product_group'];
        $data = explode('/', $data);
        for ($i = 0; $i < count($data); $i++) {
            //避免出现不存在的 产品 beg
            $where['product_id'] = $data[$i];
            if (!M('product')->where($where)->count()) {
                continue;
            }
            $where = '';
            //避免出现不存在的 产品 end
            $where['product_id'] = $data[$i];
            $data3 = M('product')->where($where)->find();
            $data2[$i]['title'] = $data3['title'];
            //判断 最优搭配中的 商品是否是 为 折扣商品 ,然后 获取价格
            if ($this->contenFunIsDiscount($data[$i])) {
                $data2[$i]['price'] = $data3['price3'];
            } else {
                $data2[$i]['price'] = $data3['price2'];
            }
            $data2[$i]['price1'] = $data3['price1'];
            $data2[$i]['product_id'] = $data[$i];
            //获取第一张图片
            $data2[$i]['img'] = M('product_img')->where($where)->getField('img');
            $data2[$i]['product_id'] = $data3['product_id'];
            if ($i == 4) {
                break;
            }
        }
        $this->assign('product_group', $data2);
    }
    public function content_part_product_group_add()
    {
        //  最优搭配商品加入购物车
        $selId = explode(',', $_GET['id']);
        for ($i = 0; $i < count($selId, 0); $i++) {
            if (!$_SESSION['user_id']) {
                $this->error('请先登录');
            }
            $data['user_id'] = $_SESSION['user_id'];
            $data['product_id'] = $selId[$i];
            if (M('shopping_cart')->where($data)->count()) {
                $num = M('shopping_cart')->where($data)->getField('num');
                $data2['num'] = $num + 1;
                M('shopping_cart')->where($data)->save($data2);
            } else {
                $data['num'] = 1;
                M('shopping_cart')->add($data);
            }
        }
        $this->success('添加成功');
    }
    public function contenFunIsDiscount($product_id)
    {
        //判断 商品是否是 为 折扣商品
        $where['able_discount'] = '1';
        $where['product_id'] = $product_id;
        if (!M('product')->where($where)->count()) {
            return 0;
        }
        $data = M('product')->where($where)->find();
        if (!$data['discount_beg_time'] or !$data['discount_end_time']) {
            return 0;
        }
        if (time() < $data['discount_beg_time']) {
            return 0;
        }
        if (time() > $data['discount_end_time'] + 60 * 60 * 24) {
            return 0;
        }
        if (!$data['price3']) {
            return 0;
        }
        return 1;
    }
    public function content_part_product_other()
    {
        // 其他同类商品
        $where['product_id'] = $_GET['product_id'];
        $data = M('product')->where($where)->find();
        $where = '';
		$where['stock'] = array('gt',0);
		$where['frame'] = 1;
        $where['class1'] = $data['class1'];
        $where['class2'] = $data['class2'];
        $where['class3'] = $data['class3'];
        $where['product_id'] = array('neq', $_GET['product_id']);
        $data = M('product')->where($where)->limit(9)->select();
        $this->assign('content_part_product_other', $data);
    }
    public function content_part_comment()
    {
        $where['product_id'] = $_GET['product_id'];
        if ($_GET['class_comment'] == 2) {
            $where['_string'] = 'score=5 or score=4';
        }
        if ($_GET['class_comment'] == 3) {
            $where['_string'] = 'score=3';
        }
        if ($_GET['class_comment'] == 4) {
            $where['_string'] = 'score=2 or score=1';
        }
        if ($_GET['class_comment'] == 5) {
            $where['comment_img'] = array('neq', '');
        }
        import('ORG.Util.Page');
        // 导入分页类
        $count = M('comment')->where($where)->count();
        // 查询满足要求的总记录数
        $Page = new Page($count, 25);
        // 实例化分页类 传入总记录数和每页显示的记录数
        $show = $Page->show();
        // 分页显示输出
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $list = M('comment')->join('left join  user on user.user_id  = comment.user_id')->where($where)->order('comment_id desc')->Distinct(true)->field('comment.*,user.name,user.img,user.name')->limit($Page->firstRow . ',' . $Page->listRows)->select();
          $this->assign('content_part_comment_list', $list);
        // 赋值数据集
        $this->assign('content_part_comment_page', $show);
        // 赋值分页输出
        $this->content_part_comment_count();
    }
    public function content_part_comment_count()
    {
        //评论的5中状况下面的数据条数
        $where['product_id'] = $_GET['product_id'];
        $count = M('comment')->where($where)->count();
        $this->assign('content_part_comment_count_1', $count);
        $where = '';
        $where['product_id'] = $_GET['product_id'];
        $where['_string'] = 'score=5 or score=4';
        $count = M('comment')->where($where)->count();
        $this->assign('content_part_comment_count_2', $count);
        $where = '';
        $where['product_id'] = $_GET['product_id'];
        $where['_string'] = 'score=3';
        $count = M('comment')->where($where)->count();
        $this->assign('content_part_comment_count_3', $count);
        $where = '';
        $where['product_id'] = $_GET['product_id'];
        $where['_string'] = 'score=2 or score=1';
        $count = M('comment')->where($where)->count();
        $this->assign('content_part_comment_count_4', $count);
        $where = '';
        $where['product_id'] = $_GET['product_id'];
        $where['comment_img'] = array('neq', '');
        $count = M('comment')->where($where)->count();
        $this->assign('content_part_comment_count_5', $count);
    }
    public function content_part_commentFunIsCan()
    {
        //是否有评论的权限
        $where['product_id'] = $_GET['product_id'];
        $where['user_id'] = $_SESSION['user_id'];
		$where['order_id'] = $_GET['order_id'];
        if (!M('comment_right')->where($where)->count()) {
            $content_part_commentFunIsCan = 0;
        } else {
            $content_part_commentFunIsCan = 1;
        }
         $this->assign('content_part_commentFunIsCan', $content_part_commentFunIsCan);
    }
	
	
 
 
	
    public function content_part_commentFunAdd()
    {
         //用户评论提交
        $where['product_id'] = $_GET['product_id'];
        $where['user_id'] = $_SESSION['user_id'];
		$where['order_id'] = $_GET['order_id'];
        if (!M('comment_right')->where($where)->count()) {
            $this->error('权限错误');
        } else {
            M('comment_right')->where($where)->delete();
            $data['product_id'] = $_GET['product_id'];
            $data['user_id'] = $_SESSION['user_id'];
            $data['time'] = time();
            $data['score'] = $_POST['score'];
            $data['content'] = $_POST['content'];
		    $data['order_id'] =$_GET['order_id'];
             if ($_FILES['file']['name']) {
                import('ORG.Net.UploadFile');
                $upload = new UploadFile();
                // 实例化上传类
                $upload->maxSize = 3145728;
                // 设置附件上传大小
                $upload->allowExts = array('jpg', 'gif', 'png', 'jpeg');
                // 设置附件上传类型
                $upload->savePath = './Uploads/';
                // 设置附件上传目录
                if (!$upload->upload()) {
                    // 上传错误提示错误信息
                    $this->error($upload->getErrorMsg());
                } else {
                    // 上传成功 获取上传文件信息
                    $info = $upload->getUploadFileInfo();
                }
                $data['comment_img'] = $info[0]['savename'];
            }
            M('comment')->add($data);
        }
		
		
		
		$where='';
		$where['order_id']=$_GET['order_id'];
   		if(!(M('comment_right')->where($where)->count())){
 			$data='';
	        $data['status']=5;
			$data['time5']=time();;
	   	    M('order')->where($where)->save($data); 	
 			}
 		  
          $this->success('添加成功');
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
	
    public function shopList()
    {	 
	
	     $this->run();
         $this->shopList_part_recommend();
        //推荐的商品
        $this->shopList_part_search();
        //搜索条件
         $this->shopList_part_search_list();
         //产品列表
        $this->shopList_part_search_discount();
        //猜您需要-显示内容为折扣商品
 		 $this->shopList_part_hotSell(); /*热销 商品*/
           $this->display();
    }
 
 	function shopList_part_hotSell(){  /*热销 商品*/
   	 $Model = new Model(); // 实例化一个model对象 没有对应任何数据表
	$data=$Model->query("select DISTINCT  product_id, title,price3,price2,price1,sell_num  from product  order by sell_num desc  limit 7");
 	
  	 for ($i = 0; $i < count($data); $i++) {
            if ($data[$i]['is_discount'] == 1) {
                $data[$i]['price'] = $data[$i]['price3'];
            } else {
                $data[$i]['price'] = $data[$i]['price2'];
            }
            $where = '';
            $where['product_id'] = $data[$i]['product_id'];
            $data[$i]['img'] = M('product_img')->where($where)->getField('img');
         }	 
 		$this->assign('shopList_part_hotSell',$data);
   	}
	
    public function shopList_part_search_discount()
    {
        //猜您需要-显示内容为折扣商品
		$where['frame'] = 1;
		$where['stock'] = array('gt',0);
        $where['is_discount'] = '1';
        $data = M('product')->where($where)->limit(5)->select();
        for ($i = 0; $i < count($data); $i++) {
            $where['product_id'] = $data[$i]['product_id'];
            $data[$i]['img'] = M('product_img')->where($where)->getField('img');
        }
        $this->assign('shopList_part_search_discount', $data);
    }
    public function shopList_part_recommend()
    {
        //推荐的商品
		$where['stock']=array('gt',0);
		$where['frame']=1;
        $where['is_recommend'] = '1';
        $data = M('product')->where($where)->limit(4)->select();
        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i]['is_discount'] == 1) {
                $data[$i]['price'] = $data[$i]['price3'];
            } else {
                $data[$i]['price'] = $data[$i]['price2'];
            }
            $where = '';
            $where['product_id'] = $data[$i]['product_id'];
            $data[$i]['img'] = M('product_img')->where($where)->getField('img');
        }
        $this->assign('shopList_part_recommend', $data);
    }
	
	
    public function shopList_part_search()
    {
        //搜索条件
        $where['fid'] = '';
        $data = M('product_classify')->where($where)->select();
        $this->assign('search_class1', $data);
        if ($_GET['class1']) {
            $where = '';
            $where['fid'] = $_GET['class1'];
            $data = M('product_classify')->where($where)->select();
            $this->assign('search_class2', $data);
        }
        if ($_GET['class2']) {
            $where = '';
            $where['fid'] = $_GET['class2'];
            $data = M('product_classify')->where($where)->select();
            $this->assign('search_class3', $data);
        }
    
    }
 
     public function shopList_part_search_list()
    {
        // 产品列表
          if ($_GET['class1']) {
            $where['class1'] = $_GET['class1'];
        }
        if ($_GET['class2']) {
            $where['class2'] = $_GET['class2'];
        }
        if ($_GET['class3']) {
            $where['class3'] = $_GET['class3'];
        }
        if ($_GET['keyword']) {
 	    /*拆分查询语句 beg*/		
	    $Model = new Model();
        $data=$Model->query("select distinct  product_id from  product_attribute_list  where   attribute_id in ('6','2','4')  and  value like '$_GET[keyword]%'     ");
	    $attribute_id='';
	    for( $i=0;$i<count($data);$i++):
		   $attribute_id="$attribute_id,'{$data[$i][product_id]}'";
 		endfor;
		$attribute_id=substr($attribute_id,1);
		 if($attribute_id):
		     $attribute_id=" or product_id in ( $attribute_id ) ";
		 endif;
		 /*拆分查询语句 end*/	
   	     $where['_string'] = "(title like '{$_GET['keyword']}%') $attribute_id"; 
          $this->assign('keyword', '&nbsp;&nbsp;&nbsp;查询的关键字为' . $_GET['keyword']);
        }
        $where['is_discount'] = '';
        $order = 'time';
         if ($_GET['order']==2) {
            $order = 'price2';
        }
		 if ($_GET['order']==1) {
            $order = 'sell_num desc';
        }
         if ($_GET['price_min'] and $_GET['price_max']) {
            $where['price2'] = array('between', array((double) $_GET['price_min'], (double) $_GET['price_max']));
        }
        if ($_GET['price_min'] and !$_GET['price_max']) {
            $where['price2'] = array('egt', $_GET['price_min']);
        }
        if (!$_GET['price_min'] and $_GET['price_max']) {
            $where['price2'] = array('elt', $_GET['price_max']);
        }
  		$where['stock']=array('gt',0);
		$where['frame']=1;
        import('ORG.Util.Page');// 导入分页类
        $count=M('product')->where($where)->Distinct(true)->order($order)->count();
         $Page=new Page($count,20);// 实例化分页类 传入总记录数和每页显示的记录数
        $show=$Page->show();// 分页显示输出
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $list = M('product')->where($where)->Distinct(true)->order($order)->limit($Page->firstRow.','.$Page->listRows) ->select();
         $this->assign('page',$show);// 赋值分页输出
         for ($i = 0; $i < count($list); $i++) {
            //获取图片
            $where = '';
            $where['product_id'] = $list[$i]['product_id'];
            $list[$i]['img'] = M('product_img')->where($where)->getField('img');
           }
          for ($i = 0; $i < count($list); $i++) {
            //判断是否 已经关注
            $where = '';
            $where['product_id'] = $list[$i]['product_id'];
            $where['user_id'] = $_SESSION['user_id'];
            if (M('favorite')->where($where)->count()) {
                $list[$i]['isFavorite'] = 1;
            } else {
                $list[$i]['isFavorite'] = 0;
            }
        }
        $this->assign('list',$list);// 赋值数据集
     }
	 
	 
    public function discount()
    {
		$where['stock']=array('gt',0);
		$where['frame']=1;
        $where['able_discount'] = '1';
        $where['is_discount'] = '1';
        import('ORG.Util.Page');
        // 导入分页类
        $count = M('product')->where($where)->count();
        // 查询满足要求的总记录数
        $Page = new Page($count, 25);
        // 实例化分页类 传入总记录数和每页显示的记录数
        $show = $Page->show();
        // 分页显示输出
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $list = M('product')->where($where)->limit($Page->firstRow . ',' . $Page->listRows)->select();
        for ($i = 0; $i < count($list); $i++) {
            $where = '';
            $where['product_id'] = $list[$i]['product_id'];
            $list[$i]['img'] = M('product_img')->where($where)->getField('img');
            $remainingTime = $list[$i]['discount_end_time'] + 60 * 60 * 24 - time();
            $remainingTime_day = floor($remainingTime / 60 / 60 / 24);
            $remainingTime_day_remian = $remainingTime % (60 * 60 * 24);
            $remainingTime_hour = floor($remainingTime_day_remian / 60 / 60);
            $remainingTime_hour_remian = $remainingTime_day_remian % (60 * 60);
            $remainingTime_minute = floor($remainingTime_hour_remian / 60);
            $remainingTime_minute_remian = $remainingTime_hour_remian % 60;
            $remainingTime = $remainingTime_day . '天' . $remainingTime_hour . '小时' . $remainingTime_minute . '分钟' . $remainingTime_minute_remian . '秒';
            $list[$i]['remainingTime'] = $remainingTime;
        }
        $this->assign('list', $list);
        // 赋值数据集
        $this->assign('page', $show);
        // 赋值分页输出
        $this->display();
    }
}