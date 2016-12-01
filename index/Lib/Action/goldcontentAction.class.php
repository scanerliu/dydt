 <?php
// 本类由系统自动生成，仅供测试用途
class goldcontentAction extends commonAction {
    function  goldcontent(){
           	$m=M('gold_manu');
           	$gold_id=$_GET['id'];
           	$browse_num=$m->where('gold_id='.$gold_id)->getfield('browse_num');
           	$browse_num=intval($browse_num);
           	$browse_num+=1;
           	$data['browse_num']=$browse_num;
           	$m->where('gold_id='.$gold_id)->save($data);
           	$list=$m->where('gold_id='.$gold_id)->find();
           	$this->assign('goldmanu',$list);
                //搜索厂家药品
                $_GET['manu_id'] = $gold_id;
                $this->shopList_part_search_list();
	        $this->display();
    }
    
     public function shopList_part_search_list()
    {
        // 产品列表
        if ($_GET['class1']) {
            $where['class1'] = $_GET['class1'];
        }
        if ($_GET['manu_id']) {
            $where['manu_id'] = $_GET['manu_id'];
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
	
}