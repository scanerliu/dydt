<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends commonAction
{
  
 	function url_cache_get($url){
		  cache(array('type'=>'File','expire'=>1));
 		   if(cache($url)){
 			  return(cache($url)); 
		   } 
		   else{
			 $data= file_get_contents($url);  
		     cache($url,$data);
	     	 return($data); 
	       }
  		}
		
	function index(){
		
		//  测试用，批量上传数据 beg
		
		/*用户批量上传 beg   test1 到  test50  密码 123*/     
//		  for($i=1;$i<51;$i++):
//		     $data['name']="test".$i;
//		     $data['password']= "d9b1d7db4cd6e70935368a1efb10e377";
//			 $data['real_name']="测试".$i;
//			 $data['sex']='男';
//			 $data['marriage']='已婚';
//		     $data['birthday']='2015-12-11';
//		     $data['mobile_phone']='15825936077';
//		     $data['email']='wqe123@163.com';
//		     $data['city1']='北京';
//		     $data['city2']='东城区';
//		     $data['city3']='';
//		     $data['address']='红旗河沟';
//		     $data['home_phone']='123123';
//			 $data['img']='touxiang.jpg';
//		     $data['is_authentication']=1;
//		     $data['identity']=1;
//			 M('user')->add($data);
//            endfor;
  
		/*用户批量上传 end */



 
		
/*产品上传相关 beg*/
		
/*		$data2='';
		for( $i=0;$i<8000;$i++){
			$data2['title']='商品'.$i;
			$data2['subhead']='商品'.$i;
			$data2['price1']='120.00';
			$data2['price2']='20.00';
			$data2['introduction']='测试';			
			$data2['time']='1452843650';		
			$data2['class1']='1';	
			$data2['class2']='22';	
			$data2['class3']='89';	
			$data2['frame']='1';
			$data2['stock']='999';		
 			$data2['rand']=rand(1,4294967);
 			M('product')->add($data2);
			$where3['rand']=$data2['rand'];
			$data3['product_id']=M('product')->where($where3)->getField('product_id');
			 $data3['img']='56796c9814c39.jpg';
 			 M('product_img')->add($data3);
			 $data4['product_id']=$data3['product_id'];
			  $data4['value']=$i;
 			 $data4['attribute_id']=1;
			  M('product_attribute_list')->add($data4);
			   $data4['attribute_id']=2;
			  M('product_attribute_list')->add($data4);
			 $data4['attribute_id']=3;
			  M('product_attribute_list')->add($data4);
			   $data4['attribute_id']=4;
			  M('product_attribute_list')->add($data4);
			  $data4['attribute_id']=5;
			  M('product_attribute_list')->add($data4);
 			   $data4['attribute_id']=6;
			  M('product_attribute_list')->add($data4);
   		  } 		  
 		  exit();
		  */
		  
		  
   
 /*产品上传相关 end*/
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		      /*订单相关 beg*/
//			   $aa=time();
//		  for($i=0;$i<3000;$i++){
//  			  $data='';
//			  $data['real_address']='天津市天津市河西区';
//			   $data['time']='1453793403'; 
//			   $data['express_fee']='22'; 
//			  
//		       $data['order_num']=$aa.$i; 
//		      $data['user_id']=1;
//			   $data['status']=1;
//			$data['total']=75;
//		    $data['points_reduce']=0;
//		    $data['need_pay']=97;
//		    M('order')->add($data);
//		   $data2='';
//		  $data2['order_id']=M('order')->where("order_num={$data['order_num']}")->getField('order_id');
//		  $data2['product_id']=158;
//		  $data2['price']=75.00;
//		   $data2['subhead']='欧莱雅男士套装8重功效套装2';
//		   $data2['title']='欧莱雅男士套装8重功效套装';
//		   $data2['product_num']=1;
//		    $data2['img']='567970e3a33a4.jpg';
//		    $data2['total_price']=75;
//			M('order_product ')->add($data2);
// 		   }
		   
		   /*订单相关 end*/
		  
 			   
 			//  测试用，批量上传数据 end   
    	 //$this->assign('index_cache',$this->url_cache_get("http://$_SERVER[SERVER_NAME]/Index/index_cache"));	
             $this->index_cache();
 		 $this->display();	
 		}  	
	
	
    public function index_cache()
    {  
  		 
  	  /*获得代金券的提示框 beg*/
	    if($_SESSION['user_id']){
		      $data=M('coupon')->where("user_id=$_SESSION[user_id]  and  is_get<> 2")->select();	
			  $this->assign('coupon',$data);
			  $data='';
			  $data['is_get']=2;
			  M('coupon')->where("user_id=$_SESSION[user_id]  and  is_get<> 2")->save($data);
  			}
 	    /*获得代金券的提示框 end*/
 		
 		$list1=M('arccontent')->where('class_child_id=141')->order('article_id desc')->select();
		$this->assign('list1',$list1);
		$list2=M('arccontent')->where('class_child_id=142')->order('article_id desc')->select();
		$this->assign('list2',$list2);
		$list3=M('arccontent')->where('class_child_id=143')->order('article_id desc')->select();
		$this->assign('list3',$list3);
 		
 		
  		
		$this->index_part_inform();
        //通知
         $this->index_part_banner();
        //banner
        $this->index_part_ad1();
        //banner下面的广告图
 	  
        $this->index_part_recommend();
        //推荐商品
        $this->index_part_discount();
        //打折的商品
        $this->index_part_ad2();
        //产品目录右侧 的广告图
		  $this->index_part_productList();
        //产品目录右侧 的广告图
		 $this->index_part_goldCompany();  
		 //金牌厂家
//         $this->display('index_cache');
    }
	
	function index_part_inform(){
		$where['father_id']=1;
		$data=M('notice_announcement')->where($where)->limit(5)->select();
		$this->assign('index_part_inform1',$data);
		$where['father_id']=2;
		$data=M('notice_announcement')->where($where)->limit(5)->select();
		$this->assign('index_part_inform2',$data);
	    $where['father_id']=3;
		$data=M('notice_announcement')->where($where)->limit(5)->select();
		$this->assign('index_part_inform3',$data);
 	}
	
	
    public function index_part_banner()
    {
        $data = M('index_banner')->select();
        $this->assign('index_banner', $data);
    }
    public function index_part_ad1()
    {
        $data = M('index_ad1')->select();
        $this->assign('index_ad1', $data);
    }
    public function index_part_recommend()
    {
        //推荐的商品
		$where['frame'] = 1;
		$where['stock'] =array('gt',0);
         $where['is_recommend'] = '1';
        $data = M('product')->where($where)->limit(5)->select();
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
        $this->assign('index_part_recommend', $data);
    }
    public function index_part_discount()
    {
        //打折的商品
		$where['frame'] = 1;
		$where['stock'] =array('gt',0);
        $where['able_discount'] = '1';
        $where['is_discount'] = '1';
        $data = M('product')->where($where)->limit(3)->select();
        for ($i = 0; $i < count($data); $i++) {
            $where = '';
            $where['product_id'] = $data[$i]['product_id'];
            $data[$i]['img'] = M('product_img')->where($where)->getField('img');
        }
        $this->assign('index_part_discount', $data);
    }
    public function index_part_ad2()
    {
        //产品目录右侧 的广告图
        $data = M('index_ad2')->select();
        $this->assign('index_ad2', $data);
    }
	function index_part_productList(){
		//产品列表
	   $where['fid']='';
	   $data=M('product_classify')->where($where)->select();
	   for($i=0;$i<count($data);$i++){
		    $where['fid']=$data[$i]['product_classify_id'];
		      $data2=M('product_classify')->where($where)->select();
		      $data[$i]['class2']=$data2;
 			  $where3['class1']=$data[$i]['product_classify_id'];
	 		  $where3['is_discount']=array('neq',1);
			  $where3['frame'] = 1;
	          $where3['stock'] =array('gt',0);
 			  $data3=M('product')->where($where3)->order("index_show desc, sort_by desc")->limit(8)->select();
              $data[$i]['product']=$data3;
			  for( $n=0;$n<count($data[$i]['product']);$n++):
  			  $where4['product_id']=$data[$i]['product'][$n]['product_id'];
			  $data[$i]['product'][$n]['img']=M('product_img')->where($where4)->getField('img');
			  endfor;
   		  }
		   $this->assign('index_part_productList', $data);
		}
	
	 function index_part_goldCompany(){  //金牌厂家
		       $data=M('gold_manu')->limit(16)->select();
		       $this->assign('index_part_goldCompany',$data);
 		 }
   	
		 function certificate(){  //证书图片页面
 		     $this->display();
   		 }
	
	
	
	
	
	
	
	
	
	
}