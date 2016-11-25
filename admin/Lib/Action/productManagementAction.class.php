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
class productManagementAction extends beginAction {
    //  --   分类管理 beg--
    public function productClassify() {
        $where['fid'] = '';
        $data = M('product_classify')->where($where)->select();
        for ($i = 0; $i < count($data); $i++) {
            $where = '';
            $where['fid'] = $data[$i]['product_classify_id'];
            $data[$i]['class2'] = M('product_classify')->where($where)->select();
            for ($n = 0; $n < count($data[$i]['class2']); $n++) {
                $where = '';
                $where['fid'] = $data[$i]['class2'][$n]['product_classify_id'];
                $data[$i]['class2'][$n]['class3'] = M('product_classify')->where($where)->select();
                for ($n2 = 0; $n2 < count($data[$i]['class2'][$n]['class3']); $n2++):
                    $where = '';
                    $where['class3'] = $data[$i]['class2'][$n]['class3'][$n2]['product_classify_id'];
                    $data[$i]['class2'][$n]['class3'][$n2]['num'] = M('product')->where($where)->count();
                endfor;
            }
        }
        $this->assign('class', $data);
        $this->display();
    }
    public function productClassifyFunDel() {
        //删除分类
        $where['product_classify_id'] = $_GET['product_classify_id'];
        M('product_classify')->where($where)->delete();
        $where = '';
        $where['class1'] = $_GET['product_classify_id'];
        $where['class2'] = $_GET['product_classify_id'];
        $where['class3'] = $_GET['product_classify_id'];
        $where['_logic'] = 'or';
        $data3 = M('product')->where($where)->delete();
        $this->success('删除成功');
    }
    public function productClassifyAdd() {
        //添加分类
        $where['fid'] = '';
        $data = M('product_classify')->where($where)->select();
        for ($i = 0; $i < count($data); $i++) {
            $where = '';
            $where['fid'] = $data[$i]['product_classify_id'];
            $data[$i]['class2'] = M('product_classify')->where($where)->select();
            for ($n = 0; $n < count($data[$i]['class2']); $n++) {
                $where = '';
                $where['fid'] = $data[$i]['class2'][$n]['product_classify_id'];
                $data[$i]['class2'][$n]['class3'] = M('product_classify')->where($where)->select();
            }
        }
        $this->assign('class', $data);
        $this->display();
    }
    public function productClassifyAddFun() {
        //添加分类方法
        $data['fid'] = $_POST['fid'];
        $data['title'] = $_POST['title'];
        M('product_classify')->add($data);
        $this->success('添加成功');
    }
    public function productClassifySave() {
        // 修改类名称
        $where['product_classify_id'] = $_GET['product_classify_id'];
        $data = M('product_classify')->where($where)->getField('title');
        $this->assign('data', $data);
        $this->display();
    }
    public function productClassifySaveFun() {
        // 修改类名称
        $where['product_classify_id'] = $_GET['product_classify_id'];
        $data['title'] = $_POST['title'];
        M('product_classify')->where($where)->save($data);
        $this->success('修改成功');
    }
    //  --   分类管理  end------
    //  --   属性 beg--
    public function attributeList() {
        //属性列表
        if ($_GET['product_classify_id']) {
            $where['product_classify_id'] = $_GET['product_classify_id'];
        } else {
            $where['product_classify_id'] = '';
        }
        $list = M('product_attribute')->where($where)->select();
        $this->assign('list', $list);
        if ($_GET['product_classify_id']) {
            $where2['product_classify_id'] = $_GET['product_classify_id'];
            $data = M('product_classify')->where($where2)->getField('title');
            $this->assign('weiz', $data);
        }
        $this->display();
    }
    public function attributeListFunDel() {
        $where['attribute_id'] = $_GET['attribute_id'];
        M('product_attribute')->where($where)->delete();
        M('product_attribute_list')->where($where)->delete();
        $this->success('删除成功');
    }
    public function attributeAdd() {
        $this->display();
    }
    public function attributeAddFun() {
        $data = $_POST;
        if ($_GET['product_classify_id']) {
            $data['product_classify_id'] = $_GET['product_classify_id'];
        }
        $data['time_rand'] = time() . rand(0, 10000);
        M('product_attribute')->add($data);
        // 向已经存在的商品 属性列表中添加默认数据  beg
        $where = '';
        $where['time_rand'] = $data['time_rand'];
        $data2['attribute_id'] = M('product_attribute')->where($where)->getField('attribute_id');
        if (M('product_attribute')->where($where)->getField('is_select') == 2) {
            $data2['value'] = explode('/', M('product_attribute')->where($where)->getField('value'));
            $data2['value'] = $data2['value'][0];
        }
        $where = '';
        if (!$_GET['product_classify_id']) {
            $data3 = M('product')->select();
        } else {
            $where['class1'] = $_GET['product_classify_id'];
            $where['class2'] = $_GET['product_classify_id'];
            $where['class3'] = $_GET['product_classify_id'];
            $where['_logic'] = 'or';
            $data3 = M('product')->where($where)->select();
        }
        for ($i = 0; $i < count($data3); $i++) {
            $data2['product_id'] = $data3[$i]['product_id'];
            M('product_attribute_list')->add($data2);
        }
        // 向已经存在的商品 属性列表中添加默认数据  end
        $this->success('修改成功');
    }
    public function attributeSave() {
        $where['attribute_id'] = $_GET['attribute_id'];
        $data = M('product_attribute')->where($where)->find();
        $this->assign('data', $data);
        $this->display();
    }
    public function attributeSaveFun() {
        $data = $_POST;
        $where['attribute_id'] = $_GET['attribute_id'];
        M('product_attribute')->where($where)->save($data);
        $this->success('修改成功');
    }
    //  --   属性 end--
    //  --   产品  beg--
    public function productList() {
        //分类 beg
        $where['fid'] = '';
        $data = M('product_classify')->where($where)->select();
        for ($i = 0; $i < count($data); $i++) {
            $where = '';
            $where['fid'] = $data[$i]['product_classify_id'];
            $data[$i]['class2'] = M('product_classify')->where($where)->select();
            for ($n = 0; $n < count($data[$i]['class2']); $n++) {
                $where = '';
                $where['fid'] = $data[$i]['class2'][$n]['product_classify_id'];
                $data[$i]['class2'][$n]['class3'] = M('product_classify')->where($where)->select();
            }
        }
        $this->assign('class', $data);
        //分类 end
        $where = '';
        /*查询库存不足的商品*/
        if ($_GET['stock']) {
            $where['stock'] = array(
                'lt',
                100
            );
        }
        $where['_string'] = '';
        if ($_GET['class']) {
            $where['_string'] = " or class1='$_GET[class]'  or  class2='$_GET[class]'  or  class3='$_GET[class]'";
        }
        if ($_GET['keyword']) {
 	    $Model = new Model();
        $data=$Model->query("select  distinct product_id from  product_attribute_list  where   attribute_id in ('1','2','4')  and  value like '%$_GET[keyword]%'     ");
 	    $attribute_id='';
	    for( $i=0;$i<count($data);$i++):
		   $attribute_id="$attribute_id,'{$data[$i][product_id]}'";
 		endfor;
		$attribute_id=substr($attribute_id,1);	
  		if($attribute_id):
		     $attribute_id=" or product_id in ( $attribute_id )";
		 endif;
         $where['_string'] = $where['_string'] . "$attribute_id  or  title  like '%$_GET[keyword]%'   or  subhead  like '%$_GET[keyword]%'  ";
            }
        /*attribute_id=1 货号   attribute_id=2 批准文号    attribute_id=4 厂家  */
 		$where['_string'] =trim($where['_string']);
        $where['_string'] = substr($where['_string'],3);
		
		
         if (!$where['_string']) {
            unset($where['_string']);
        }
        if ($_GET['frame']) {
            $where['frame'] = $_GET['frame'];
        }
        import('ORG.Util.Page');
        // 导入分页类
        $count = M('product')->where($where)->Distinct(true)->count();
        // 查询满足要求的总记录数
        $Page = new Page($count, 25);
        // 实例化分页类 传入总记录数和每页显示的记录数
        $show = $Page->show();
        // 分页显示输出
        $list = M('product')->where($where)->limit($Page->firstRow . ',' . $Page->listRows)->Distinct(true)->select();
  		
        for ($i = 0; $i < count($list); $i++) {
            $where = '';
            $where['product_id'] = $list[$i]['product_id'];
            $list[$i]['imgFirst'] = M('product_img')->where($where)->find();
            $list[$i]['imgFirst'] = $list[$i]['imgFirst']['img'];
        }
        for ($i = 0; $i < count($list); $i++) {
            /*attribute_id=1 货号   attribute_id=2 批准文号    attribute_id=4 厂家  */
            $where = '';
            $where['product_id'] = $list[$i]['product_id'];
            $where['attribute_id'] = 1;
            $list[$i]['serialNumber'] = M('product_attribute_list')->where($where)->getField('value'); /*货号*/
            $where['attribute_id'] = 2;
            $list[$i]['approveNumber'] = M('product_attribute_list')->where($where)->getField('value'); /*批准文号*/
            $where['attribute_id'] = 4;
            $list[$i]['company'] = M('product_attribute_list')->where($where)->getField('value'); /*厂家*/
        }
        $this->assign('list', $list);
        // 赋值数据集
        $this->assign('page', $show);
        // 赋值分页输出
        $this->display();
    }
    function productListExcel() { /*导出产品数据-excel*/
        $where = '';
        $where['_string'] = '';
        if ($_GET['class']) {
            $where['_string'] = " or class1='$_GET[class]'  or  class2='$_GET[class]'  or  class3='$_GET[class]'";
        }
      
 		 if ($_GET['keyword']) {
 	    $Model = new Model();
        $data=$Model->query("select  distinct product_id from  product_attribute_list  where   attribute_id in ('1','2','4')  and  value like '%$_GET[keyword]%'     ");
 	    $attribute_id='';
	    for( $i=0;$i<count($data);$i++):
		   $attribute_id="$attribute_id,'{$data[$i][product_id]}'";
 		endfor;
		$attribute_id=substr($attribute_id,1);	
  		if($attribute_id):
		     $attribute_id=" or product_id in ( $attribute_id )";
		 endif;
         $where['_string'] = $where['_string'] . "$attribute_id  or  title  like '%$_GET[keyword]%'   or  subhead  like '%$_GET[keyword]%'  ";
            }
        /*attribute_id=1 货号   attribute_id=2 批准文号    attribute_id=4 厂家  */
 		$where['_string'] =trim($where['_string']);
        $where['_string'] = substr($where['_string'],3);
		
		
		
		
		
		
		
        if (!$where['_string']) {
            unset($where['_string']);
        }
        if ($_GET['frame']) {
            $where['frame'] = $_GET['frame'];
        }
        $list = M('product')->where($where)->Distinct(true)->field('product_id,title,subhead,price1,price2,price3,frame,stock')->select();
        for ($i = 0; $i < count($list); $i++) {
            /*attribute_id=1 货号   attribute_id=2 批准文号    attribute_id=4 厂家  */
            $where = '';
            $where['product_id'] = $list[$i]['product_id'];
            $where['attribute_id'] = 1;
            $list[$i]['serialNumber'] = M('product_attribute_list')->where($where)->getField('value'); /*货号*/
            $where['attribute_id'] = 2;
            $list[$i]['approveNumber'] = M('product_attribute_list')->where($where)->getField('value'); /*批准文号*/
            $where['attribute_id'] = 4;
            $list[$i]['company'] = M('product_attribute_list')->where($where)->getField('value'); /*厂家*/
			if( $list[$i]['frame']==1){
				$list[$i]['frame']='上架';
				}
				if( $list[$i]['frame']==2){
				$list[$i]['frame']='下架';
				}
				if( $list[$i]['frame']==3){
				$list[$i]['frame']='锁定';
				}	
        }
        $data = $list;
        //引入PHPExcel库文件（路径根据自己情况）
        include '/phpexcel/PHPExcel.php';
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
			'J',
			'K'
        );
        //表头数组
        $tableheader = array(
            '商品id',
            '商品名',
            '通用名称',
			'原价',
			'现价',
			'打折价',
			'状态',
			'库存',
            '货号',
            '批准文号',
            '厂家'
          );
        //填充表头信息
        for ($i = 0; $i < count($tableheader); $i++) {
            $excel->getActiveSheet()->setCellValue("$letter[$i]1", "$tableheader[$i]");
        }
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(100);
        $excel->getActiveSheet()->getColumnDimension('C')->setWidth(100);
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
    public function productListFunDel() {
        $m = M('product');
        $selId = explode(',', $_GET['id']);
        for ($i = 0; $i < count($selId, 0); $i++) {
            $where['product_id'] = $selId[$i];
            $m->where($where)->delete();
        }
        $this->success('删除成功');
    }
    public function productAdd() {
        if (!$_GET['class2']) {
            $this->error('请选择子类后再提交');
        }
        //--- 自定义属性  beg
        $where['product_classify_id'] = '';
        $data = M('product_attribute')->where($where)->select();
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['value'] = explode('/', $data[$i]['value']);
        }
        $this->assign('class', $data);
        //公共属性
        $where['product_classify_id'] = $_GET['class1'];
        $data = M('product_attribute')->where($where)->select();
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['value'] = explode('/', $data[$i]['value']);
        }
        $this->assign('class1', $data);
        //大类属性
        $where['product_classify_id'] = $_GET['class2'];
        $data = M('product_attribute')->where($where)->select();
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['value'] = explode('/', $data[$i]['value']);
        }
        $this->assign('class2', $data);
        //小类属性
        $where['product_classify_id'] = $_GET['class3'];
        $data = M('product_attribute')->where($where)->select();
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['value'] = explode('/', $data[$i]['value']);
        }
        $this->assign('class3', $data);
        
        //厂家列表
        $data = M('gold_manu')->order('gold_name asc')->select();
        $this->assign('managelist', $data);
        //子类属性
        //--- 自定义属性  end
        $this->display();
    }
    public function productAddFunDo() {
		if(!$_POST['1']){
			$this->error('货号不能为空');
			}
		  if(  M('product_attribute_list')->where("attribute_id=1 and value= $_POST[1] ")->count()  ){
		     $this->error('该货号已经存在');
	     }
         import('ORG.Net.UploadFile');
        $upload = new UploadFile();
        // 实例化上传类
        $upload->maxSize = 3145728;
        // 设置附件上传大小
        $upload->allowExts = array(
            'jpg',
            'gif',
            'png',
            'jpeg'
        );
        // 设置附件上传类型
        $upload->savePath = './Uploads/';
	    $upload->saveRule = '';
        // 设置附件上传目录
        if (!$upload->upload()) {
            // 上传错误提示错误信息
            $this->error($upload->getErrorMsg());
        } else {
            // 上传成功 获取上传文件信息
            $info = $upload->getUploadFileInfo();
        }
        $data['class3'] = $_GET['class2'];
        $data['class2'] = M('product_classify')->where("product_classify_id=" . $_GET['class2'])->getField('fid');
        $data['class1'] = M('product_classify')->where("product_classify_id=" . $data['class2'])->getField('fid');
        $data['title'] = $_POST['title'];
        $data['subhead'] = $_POST['subhead'];
        if ($_POST['is_recommend']) {
            $data['is_recommend'] = $_POST['is_recommend'];
        }
        if ($_POST['able_discount']) {
            $data['able_discount'] = $_POST['able_discount'];
        }
        $data['price1'] = $_POST['price1'];
        $data['price2'] = $_POST['price2'];
        $data['price3'] = $_POST['price3'];
	    $data['qualification'] = $_POST['qualification'];
        if ($_POST['discount_beg_time']) {
            $data['discount_beg_time'] = strtotime($_POST['discount_beg_time']);
        }
        if ($_POST['discount_end_time']) {
            $data['discount_end_time'] = strtotime($_POST['discount_end_time']);
        }
        $data['introduction'] = $_POST['introduction'];
        $data['product_group'] = $_POST['product_group'];
        $data['time'] = time();
        $data['frame'] = $_POST['frame'];
        $data['stock'] = $_POST['stock'];
        $data['manu_id'] = $_POST['manu_id'];
        M('product')->add($data);
        $data_var1 = $data['time'];
        // 获取 product_id beg
        $where = '';
        $where['time'] = $data['time'];
        $where['title'] = $_POST['title'];
        $where['subhead'] = $_POST['subhead'];
        $data = M('product')->where($where)->getField('product_id');
        // 获取 product_id end
        $this->productAddFunDo_part_attribute($data);
        //--- 自定义属性
        $where = '';
        $data = '';
        $where['time'] = $data_var1;
        $data = M('product')->where($where)->find();
        $data2['product_id'] = $data['product_id'];
        for ($i = 0; $i < count($info); $i++) {
            $data2['img'] = $info[$i]['savename'];
            M('product_img')->add($data2);
        }
        $this->success('数据保存成功');
    }
    public function productAddFunDo_part_attribute($product_id) {
        // 处理 productAddFunDo 中自定义属性
        $where['product_classify_id'] = '';
        $data = M('product_attribute')->where($where)->select();
        for ($i = 0; $i < count($data); $i++) {
            $data2 = '';
            $data2['product_id'] = $product_id;
            $data2['attribute_id'] = $data[$i]['attribute_id'];
            $data2['value'] = $_POST[$data2['attribute_id']];
            M('product_attribute_list')->add($data2);
        }
        $where['product_classify_id'] = $_GET['class1'];
        $data = M('product_attribute')->where($where)->select();
        for ($i = 0; $i < count($data); $i++) {
            $data2 = '';
            $data2['product_id'] = $product_id;
            $data2['attribute_id'] = $data[$i]['attribute_id'];
            $data2['value'] = $_POST[$data2['attribute_id']];
            M('product_attribute_list')->add($data2);
        }
        $where['product_classify_id'] = $_GET['class2'];
        $data = M('product_attribute')->where($where)->select();
        for ($i = 0; $i < count($data); $i++) {
            $data2 = '';
            $data2['product_id'] = $product_id;
            $data2['attribute_id'] = $data[$i]['attribute_id'];
            $data2['value'] = $_POST[$data2['attribute_id']];
            M('product_attribute_list')->add($data2);
        }
        $where['product_classify_id'] = $_GET['class3'];
        $data = M('product_attribute')->where($where)->select();
        for ($i = 0; $i < count($data); $i++) {
            $data2 = '';
            $data2['product_id'] = $product_id;
            $data2['attribute_id'] = $data[$i]['attribute_id'];
            $data2['value'] = $_POST[$data2['attribute_id']];
            M('product_attribute_list')->add($data2);
        }
    }
	
	
    public function productSave() {
        $where['product_id'] = $_GET['product_id'];
        $data = M('product')->where($where)->find();
        $this->assign('data', $data);
        $data = M('product_img')->where($where)->select();
        $this->assign('data_img', $data);
        //--- 自定义属性  beg
        $where = '';
        $where['product_id'] = $_GET['product_id'];
        $data = M('product_attribute_list')->join('left join  product_attribute  on product_attribute.attribute_id  = product_attribute_list.attribute_id')->Distinct(true)->field('product_attribute_list.*,product_attribute.title,product_attribute.is_select,product_attribute.value as value2')->where($where)->select();
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['value2'] = explode('/', $data[$i]['value2']);
        }
        $this->assign('class', $data);
        //--- 自定义属性  end
        //厂家列表
        $data = M('gold_manu')->order('gold_name asc')->select();
        $this->assign('managelist', $data);
        
        $this->display();
    }
    public function productSaveFunDelImg() {
        $where['product_img_id'] = $_GET['product_img_id'];
        M('product_img')->where($where)->delete();
        $this->success('删除成功');
    }
    public function productSaveFunDo() {
      	if(!$_POST['1']){
			$this->error('货号不能为空');
			}
		  if(  M('product_attribute_list')->where("attribute_id=1 and value= $_POST[1] and  product_id!={$_GET['product_id']} ")->count()  ){
		     $this->error('该货号已经存在');
	     }
         $where['product_id'] = $_GET['product_id'];
        $data['title'] = $_POST['title'];
        $data['subhead'] = $_POST['subhead'];
        $data['is_recommend'] = $_POST['is_recommend'];
        $data['able_discount'] = $_POST['able_discount'];
        $data['price1'] = $_POST['price1'];
        $data['price2'] = $_POST['price2'];
        $data['price3'] = $_POST['price3'];
        if ($_POST['discount_beg_time']) {
            $data['discount_beg_time'] = strtotime($_POST['discount_beg_time']);
        } else {
            $data['discount_beg_time'] = '';
        }
        if ($_POST['discount_end_time']) {
            $data['discount_end_time'] = strtotime($_POST['discount_end_time']);
        } else {
            $data['discount_end_time'] = '';
        }
        $data['introduction'] = $_POST['introduction'];
        $data['qualification'] = $_POST['qualification'];
        $data['product_group'] = $_POST['product_group'];
        $data['stock'] = $_POST['stock'];
        $data['manu_id'] = $_POST['manu_id'];
        $data['frame'] = $_POST['frame'];
        $data['time'] = time();
        M('product')->where($where)->save($data);
        //--- 自定义属性  beg
        $where = '';
        $where['product_id'] = $_GET['product_id'];
        $data = M('product_attribute_list')->where($where)->select();
        for ($i = 0; $i < count($data); $i++) {
            $where['attribute_id'] = $data[$i]['attribute_id'];
            $data['value'] = $_POST[$data[$i]['attribute_id']];
             M('product_attribute_list')->where($where)->save($data);
        }
        //--- 自定义属性  end
        // 判断是否有文件上传
        for ($i = 0; $i < count($_FILES['file']['name']); $i++) {
            if ($_FILES['file']['name'][$i]) {
                $is_img_upload = 1;
                break;
            }
        }
        if ($is_img_upload) {
            import('ORG.Net.UploadFile');
            $upload = new UploadFile();
            // 实例化上传类
            $upload->maxSize = 3145728;
            // 设置附件上传大小
            $upload->allowExts = array(
                'jpg',
                'gif',
                'png',
                'jpeg'
            );
            // 设置附件上传类型
            $upload->savePath = './Uploads/';
			$upload->saveRule = '';
            // 设置附件上传目录
            if (!$upload->upload()) {
                // 上传错误提示错误信息
                $this->error($upload->getErrorMsg());
            } else {
                // 上传成功 获取上传文件信息
                $info = $upload->getUploadFileInfo();
            }
            $data2['product_id'] = $_GET['product_id'];
            for ($i = 0; $i < count($info); $i++) {
                $data2['img'] = $info[$i]['savename'];
                M('product_img')->add($data2);
            }
        }
        M('product')->where($where)->save($data);
        $this->success('数据保存成功');
    }
    public function recommend() {
 	    $where['_string'] = '';
		
 	  if ($_GET['keyword']) {
 	    $Model = new Model();
        $data=$Model->query("select  distinct product_id from  product_attribute_list  where   attribute_id in ('1','2','4')  and  value like '%$_GET[keyword]%'     ");
 	    $attribute_id='';
	    for( $i=0;$i<count($data);$i++):
		   $attribute_id="$attribute_id,'{$data[$i][product_id]}'";
 		endfor;
		$attribute_id=substr($attribute_id,1);	
  		if($attribute_id):
		     $attribute_id=" or product_id in ( $attribute_id )";
		 endif;
         $where['_string'] = $where['_string'] . "$attribute_id  or  title  like '%$_GET[keyword]%'   or  subhead  like '%$_GET[keyword]%'  ";
            }
        /*attribute_id=1 货号   attribute_id=2 批准文号    attribute_id=4 厂家  */
 		$where['_string'] =trim($where['_string']);
        $where['_string'] = substr($where['_string'],3);
	 
         if (!$where['_string']) {
            unset($where['_string']);
        }	
 		
		$where['frame'] = 1;
        $where['is_recommend'] = 1;
        $data = M('product')->where($where)->select();
		$where='';
          for ($i = 0; $i < count($data); $i++) {
            $where['product_id'] = $data[$i]['product_id'];
            $data[$i]['img'] = M('product_img')->where($where)->getField('img');
          }
		 
        $this->assign('data', $data);
        $this->display();
    }
    public function recommendFun() {
        $where['product_id'] = $_GET['product_id'];
        $data['is_recommend'] = '';
        M('product')->where($where)->save($data);
        $this->success('修改成功');
    }
    public function discount() {
		  $where['_string'] = '';
      
	   if ($_GET['keyword']) {
 	    $Model = new Model();
        $data=$Model->query("select  distinct product_id from  product_attribute_list  where   attribute_id in ('1','2','4')  and  value like '%$_GET[keyword]%'     ");
 	    $attribute_id='';
	    for( $i=0;$i<count($data);$i++):
		   $attribute_id="$attribute_id,'{$data[$i][product_id]}'";
 		endfor;
		$attribute_id=substr($attribute_id,1);	
  		if($attribute_id):
		     $attribute_id=" or product_id in ( $attribute_id )";
		 endif;
         $where['_string'] = $where['_string'] . "$attribute_id  or  title  like '%$_GET[keyword]%'   or  subhead  like '%$_GET[keyword]%'  ";
            }
        /*attribute_id=1 货号   attribute_id=2 批准文号    attribute_id=4 厂家  */
 		$where['_string'] =trim($where['_string']);
        $where['_string'] = substr($where['_string'],3);
 		
 		
        if (!$where['_string']) {
            unset($where['_string']);
        }	
 		
		$where['frame'] = 1;
        $where['able_discount'] = 1;
        $where['price3'] = array(
            'neq',
            ''
        );
        $where['discount_beg_time'] = array(
            'neq',
            ''
        );
        $where['discount_end_time'] = array(
            'neq',
            ''
        );
        $where['discount_end_time'] = array(
            'gt',
            (time() - 60 * 60 * 24)
        );
        $data = M('product')->where($where)->select();
        $where = '';
        for ($i = 0; $i < count($data); $i++) {
            $where['product_id'] = $data[$i]['product_id'];
            $data[$i]['img'] = M('product_img')->where($where)->getField('img');
        }
        $this->assign('data', $data);
        $this->display();
    }
    function discountFun() { //取消打折
        $where['product_id'] = $_GET['product_id'];
        $data['able_discount'] = 0;
        M('product')->where($where)->save($data);
        $this->success('修改成功');
    }
    function sellRecord() { /*销售记录*/
        $this->sellRecord_part_count(); /*销售记录中的订单列表*/
        $this->sellRecord_part_orderList(); /*销售记录中的订单列表*/
        $this->display();
    }
    function sellRecordExcel() { /*导出销售数据-excel*/
        include '/PHPExcel/PHPExcel.php';
        //创建对象
        $excel = new PHPExcel();
        //Excel表格式,这里简略写了8列
        $letter = array(
            'A',
            'B',
            'C',
            'D'
        );
        //表头数组
        $tableheader = array(
            '订单号',
            '消费金额',
            '数量',
            '确认收货时间'
        );
        //填充表头信息
        for ($i = 0; $i < count($tableheader); $i++) {
            $excel->getActiveSheet()->setCellValue("$letter[$i]1", "$tableheader[$i]");
        }
        $excel->getActiveSheet()->getColumnDimension('A')->setWidth(100);
        $excel->getActiveSheet()->getColumnDimension('D')->setWidth(100);
        //表格数组
        if ($_GET['begtime'] and $_GET['endtime']) {
            $begtime = strtotime($_GET['begtime']);
            $endtime = strtotime($_GET['endtime']) + 24 * 60 * 60;
            $where['time4'] = array(
                'between',
                "$begtime,$endtime"
            );
        }
        if ($_GET['begtime'] and !$_GET['endtime']) {
            $begtime = strtotime($_GET['begtime']);
            $where['time4'] = array(
                'egt',
                $begtime
            );
        }
        if ($_GET['endtime'] and !$_GET['begtime']) {
            $endtime = strtotime($_GET['endtime']) + 24 * 60 * 60;
            $where['time4'] = array(
                'elt',
                $endtime
            );
        }
        $where['_string'] = "product_id= $_GET[product_id] and  order.order_id in  ( select  order.order_id  from  `order`  where  status =4  or  status =5)";
        $data = M('order')->join('left join  `order_product`  on order.order_id  = order_product.order_id')->where($where)->Distinct(true)->field('order.order_num,order_product.total_price,product_num,time4')->order('time4 desc')->select();
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['time4'] = date("Y-m-d h:i:sa", $data[$i]['time4']);
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
    function sellRecord_part_count() { /*销售记录中的销量 金额统计*/
        if ($_GET['begtime'] and $_GET['endtime']) {
            $begtime = strtotime($_GET['begtime']);
            $endtime = strtotime($_GET['endtime']) + 24 * 60 * 60;
            $string_time = " and ( time4 between $begtime and  $endtime)";
        }
        if ($_GET['begtime'] and !$_GET['endtime']) {
            $begtime = strtotime($_GET['begtime']);
            $string_time = " and  time4 >= $begtime";
        }
        if (!$_GET['begtime'] and $_GET['endtime']) {
            $endtime = strtotime($_GET['endtime']) + 24 * 60 * 60;
            $string_time = " and  time4 <= $endtime";
        }
        $data = M('product')->where("product_id= " . $_GET['product_id'])->getField('title');
        $this->assign('title', $data); /*产品名称*/
        $where['_string'] = "product_id= $_GET[product_id] and  order_id in  ( select  order_id  from  `order`  where ( status =4  or  status =5 ) $string_time    ) ";
        $data = M('order_product')->where($where)->sum('total_price');
        $this->assign('total_price', $data); /*总销售金额*/
        $data = M('order_product')->where($where)->sum('product_num');
        $this->assign('product_num', $data); /*销量*/
    }
    function sellRecord_part_orderList() { /*销售记录中的订单列表*/
        if ($_GET['begtime'] and $_GET['endtime']) {
            $begtime = strtotime($_GET['begtime']);
            $endtime = strtotime($_GET['endtime']) + 24 * 60 * 60;
            $where['time4'] = array(
                'between',
                "$begtime,$endtime"
            );
        }
        if ($_GET['begtime'] and !$_GET['endtime']) {
            $begtime = strtotime($_GET['begtime']);
            $where['time4'] = array(
                'egt',
                $begtime
            );
        }
        if ($_GET['endtime'] and !$_GET['begtime']) {
            $endtime = strtotime($_GET['endtime']) + 24 * 60 * 60;
            $where['time4'] = array(
                'elt',
                $endtime
            );
        }
        $where['_string'] = "product_id= $_GET[product_id] and  order.order_id in  ( select  order.order_id  from  `order`  where  status <> 1 )";
        import('ORG.Util.Page'); // 导入分页类
        $count = M('order')->join('left join  `order_product`  on order.order_id  = order_product.order_id')->where($where)->Distinct(true)->field('order.order_num,order.order_id,product_num')->count(); // 查询满足要求的总记录数
        $Page = new Page($count, 25); // 实例化分页类 传入总记录数和每页显示的记录数
        $show = $Page->show(); // 分页显示输出
        $list = M('order')->join('left join  `order_product`  on order.order_id  = order_product.order_id')->where($where)->Distinct(true)->field('order.order_num,order.order_id,order_product.total_price,product_num,time4')->order('time4 desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $this->assign('list', $list); // 赋值数据集
        $this->assign('page', $show); // 赋值分页输出
        $this->assign('order', $data); /*订单信息*/
    }
}

