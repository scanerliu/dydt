<?php
class manageAction extends beginAction
{
    public function user()
	{
		if ($_GET['key']==1) {
			$_GET['keyword']=iconv("gb2312","utf-8",$_GET['keyword']);
        	$where['name'] = array('like','%'.$_GET['keyword'].'%');
        } elseif ($_GET['key']==2) {
        	$_GET['keyword']=iconv("gb2312","utf-8",$_GET['keyword']);
        	$where['real_name'] = array('like','%'.$_GET['keyword'].'%');
        } else{
        	$where['mobile_phone'] = array('like','%'.$_GET['keyword'].'%');
        }
		
		import('ORG.Util.Page');// 导入分页类
		$count = M('user')->where($where)->count();// 查询满足要求的总记录数 $map表示查询条件

	    $Page = new Page($count,20);// 实例化分页类 传入总记录数
	    $show = $Page->show();// 分页显示输出
		$list = M('user')->where($where)->limit($Page->firstRow.','.$Page->listRows)->select();
		for ($i=0; $i < count($list); $i++) { 
			$list[$i]['doc'] = M('document_user')->where('user_id='.$list[$i]['user_id'])->count();

			$doc = M('document_user')->where('user_id='.$list[$i]['user_id'])->select();
			for ($j=0; $j < count($doc); $j++) { 
				if ($doc[$j]['status']==0) {
	            	$list[$i]['er'] = "待审核";
	            	break;
	            } else if ($doc[$j]['status']==2) {
	            	$list[$i]['er'] = "审核未通过";
	            	break;
	            } else {
	            	$days=abs((strtotime(date("Y-m-d"))-strtotime($doc[$j]['lose_date']))/86400);
					if (date("Y-m-d")>$doc[$j]['lose_date']) {
		                $list[$i]['er'] = "已过期";
		                break;
		            } elseif ($days<=90) {
		                $list[$i]['er'] = "即将过期";
		                break;
		            } else {
		            	$list[$i]['er'] = "审核已通过";
		            }
	            }
			}
			$sum = M('order')->field('SUM(total) as sum')->where('user_id='.$list[$i]['user_id'].' and status!=1')->select();
			$list[$i]['sum_i'] = floor($sum[0]['sum']);

			$sum_re = M('return')->field('SUM(back) as sum_re')->where('user_id='.$list[$i]['user_id'].' and status=4')->select();
			$sum_j = M('order')->field('SUM(points_reduce) as sum_j')->where('user_id='.$list[$i]['user_id'].' and status!=1')->select();
			$surplus = $sum[0]['sum']-$sum_re[0]['sum_re']-($sum_j[0]['sum_j']/100);
			$list[$i]['surplus'] = floor($surplus);
		}
	    $this->assign('page',$show);// 赋值分页输出
	    $this->assign('list',$list);// 赋值分页输出

	    $this->assign('keyword',$_GET['keyword']);
        $this->assign('keyv',$_GET['key']);
		$this->display();
	}

	public function del_user()
	{
		M('user')->where('user_id='.$_GET['id'])->delete();
		$this->success("已删除企业信息！");
	}

	public function user_info()
	{
		$info = M('user')->where('user_id='.$_POST['userid'])->find();
		$this->ajaxReturn($info);
	}
	public function save_pwd()
	{
		if ($_POST['password']) {
			$data['password'] = md5(md5($_POST['password']));
		}
		$data['jgbm'] = $_POST['jgbm'];
		$data['jgmc'] = $_POST['jgmc'];
		$data['jgdz'] = $_POST['jgdz'];
		$data['jgdj'] = $_POST['jgdj'];
		$data['lxfs'] = $_POST['lxfs'];
		$data['zzxx'] = $_POST['zzxx'];
		$data['xkzxx'] = $_POST['xkzxx'];
		$data['rzxx'] = $_POST['rzxx'];
		
		M('user')->where('user_id='.$_POST['userid'])->save($data);
		$this->ajaxReturn(3);
	}
	public function lock()
	{
		$data['lock']=1;
		M('user')->where('user_id='.$_GET['id'])->save($data);
		$this->success("已暂停服务");  
	}

	public function lock_off()
	{
		$data['lock']=0;
		M('user')->where('user_id='.$_GET['id'])->save($data);
		$this->success("已开启服务");
	}

	public function integration()
	{
		$user_id = $_GET['id'];
		import('ORG.Util.Page');// 导入分页类
        $count = M('order')->where('user_id='.$user_id)->count();
        $Page = new Page($count,9);// 实例化分页类 传入总记录数
        $show = $Page->show();// 分页显示输出
        $list = M('order')->where('user_id='.$user_id.' and status!=1')->limit($Page->firstRow.','.$Page->listRows)->select();
        for ($i=0; $i < count($list); $i++) { 
            $list[$i]['p'] = M('order_product')->where('order_id='.$list[$i]['order_id'])->limit($Page->firstRow.','.$Page->listRows)->select();
            for ($j=0; $j < count($list[$i]['p']); $j++) { 
                $sum += $list[$i]['p'][$j]['total_price'];
                $return = M('return')->where('order_id='.$list[$i]['p'][$j]['order_id'].' and product_id='.$list[$i]['p'][$j]['product_id'].' and status=4')->getfield('back');
                if($return){
                    $list[$i]['p'][$j]['return'] = $return;
                } else {
                    $list[$i]['p'][$j]['return'] = 0;
                }
                $sum-=$list[$i]['p'][$j]['return'];
            }

            $sum+=$list[$i]['express_fee'];
            $sum-=$list[$i]['points_reduce']/100;
            $sum=floor($sum);
        }

        $sum_all = M('order')->field('SUM(total) as sum')->where('user_id='.$user_id.' and status!=1')->select();
		$this->assign('sum_all',$sum_all[0]['sum']);

        $this->assign('sum',$sum);
        $this->assign('list',$list);
        $this->assign('page',$show);
		$this->display();
	}

	public function suggest_cl()
	{
		$data['status']=1;
		$data['back']=$_GET['name'];
		$data['back_date']=time();
		$data['back_admin']=session('admin_name');
		M('suggest')->where('id='.$_GET['id'])->save($data);
		$this->success("回复成功！");
	}
	public function suggest()
	{
		if ($_GET['status'] != null || $_GET['status'] != "") {
            $where['status'] = $_GET['status']-1;
        }

        if ($_GET['key']==1) {
        	$user_id="";
        	$_GET['keyword']=iconv("gb2312","utf-8",$_GET['keyword']);
        	$w['name'] = array('like','%'.$_GET['keyword'].'%');
        	$user = M('user')->where($w)->select();
        	for ($i=0; $i < count($user); $i++) {
        		if ($i==0) {
        			$user_id.=$user[$i]['user_id'];
        		} else {
        			$user_id.=",".$user[$i]['user_id'];
        		}
        	}
        	$where['user_id']=array('in',$user_id);
        	
        } elseif ($_GET['key']==2) {
        	$where['mobile_phone'] = array('like','%'.$_GET['keyword'].'%');
        } else{
        	$_GET['keyword']=iconv("gb2312","utf-8",$_GET['keyword']);
        	$where['note'] = array('like','%'.$_GET['keyword'].'%');
        }
		import('ORG.Util.Page');// 导入分页类
		$count = M('suggest')->where($where)->count();// 查询满足要求的总记录数 $map表示查询条件
	    $Page = new Page($count,10);// 实例化分页类 传入总记录数
	    $show = $Page->show();// 分页显示输出
		$list = M('suggest')->where($where)->order('status')->limit($Page->firstRow.','.$Page->listRows)->select();
		for ($i=0; $i < count($list); $i++) { 
			$list[$i]['user_name']=M('user')->where('user_id='.$list[$i]['user_id'])->getfield('name');
		}
	    $this->assign('page',$show);// 赋值分页输出
		$this->assign('list',$list);

		$this->assign('keyword',$_GET['keyword']);
        $this->assign('keyv',$_GET['key']);
		$this->display();
	}

	public function document()
	{
		$list=M('document')->order('identity')->select();
		$this->assign('list',$list);
		$this->display();
	}

	public function del_doc()
	{
		$id=$_GET['id'];
		M('document')->where('id='.$id)->delete();
		$this->success("删除成功！");
	}

	public function add_doc()
	{
		if (M('document')->where("doc_type='".$_GET['doc_type']."'")->find()) {
			echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />'; 
			echo "<script>alert('该认证已存在，请确认后再添加！');window.location.href='javascript:history.go(-1)';</script>";
			exit;
		} else {
			$data['doc_type']=iconv("gb2312","utf-8",$_GET['doc_type']);
			$data['status']=0;
			M('document')->add($data);
			$this->success("添加成功！");
		}	
	}

	public function up_doc($value='')
	{
		$id=$_GET['id'];
		$data['status']=1;
		M('document')->where('id='.$id)->save($data);
		$this->success("操作成功！");
	}

	public function down_doc()
	{
		$id=$_GET['id'];
		$data['status']=0;
		M('document')->where('id='.$id)->save($data);
		$this->success("操作成功！");
	}

	public function doc_ids()
	{
		$id = $_GET['id'];
		$data['identity'] = $_GET['identity'];
		M('document')->where('id='.$id)->save($data);
		$this->success("操作成功！");
	}
	public function login_uesr()
	{
		$user_id = $_GET['id'];
		$_SESSION['user_id'] = $user_id;
		$this->success("页面跳转中...",'/userinfo/info',3);
	}
	
	public function return_back()
	{
		if ($_GET['status'] != null || $_GET['status'] != "") {
			if ($_GET['status']==6) {
				$where['status'] = array('in','2,4');
			} else{
				$where['status'] = $_GET['status']-1;
			}
		}

		if ($_GET['key']==1) {
        	$where['order_num'] = array('like','%'.$_GET['keyword'].'%');
        } elseif ($_GET['key']==2) {
        	$user_id="";
        	$_GET['keyword']=iconv("gb2312","utf-8",$_GET['keyword']);
        	$w['name'] = array('like','%'.$_GET['keyword'].'%');
        	$user = M('user')->where($w)->select();
        	for ($i=0; $i < count($user); $i++) {
        		if ($i==0) {
        			$user_id.=$user[$i]['user_id'];
        		} else {
        			$user_id.=",".$user[$i]['user_id'];
        		}
        	}
        	$where['user_id']=array('in',$user_id);
        } elseif ($_GET['key']==3) {
        	$where['date'] = array('BETWEEN',array(strtotime($_GET['date1']),strtotime($_GET['date2'])));
        } elseif ($_GET['key']==4) {
        	$user_id="";
        	$_GET['keyword']=iconv("gb2312","utf-8",$_GET['keyword']);
        	$w['real_name'] = array('like','%'.$_GET['keyword'].'%');
        	$user = M('user')->where($w)->select();
        	for ($i=0; $i < count($user); $i++) {
        		if ($i==0) {
        			$user_id.=$user[$i]['user_id'];
        		} else {
        			$user_id.=",".$user[$i]['user_id'];
        		}
        	}
        	$where['user_id']=array('in',$user_id);
        } else {
        	$user_id="";
        	$w['mobile_phone'] = array('like','%'.$_GET['keyword'].'%');
        	$user = M('user')->where($w)->select();
        	for ($i=0; $i < count($user); $i++) {
        		if ($i==0) {
        			$user_id.=$user[$i]['user_id'];
        		} else {
        			$user_id.=",".$user[$i]['user_id'];
        		}
        	}
        	$where['user_id']=array('in',$user_id);
        }

		import('ORG.Util.Page');// 导入分页类
		$count = M('return')->where($where)->count();// 查询满足要求的总记录数 $map表示查询条件
	    $Page = new Page($count,9);// 实例化分页类 传入总记录数
	    $show = $Page->show();// 分页显示输出
		$list = M('return')->where($where)->order('date desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		for ($i=0; $i < count($list); $i++) { 
			$list[$i]['title']=M('product')->where('product_id='.$list[$i]['product_id'])->getfield('title');
			$list[$i]['subhead']=M('product')->where('product_id='.$list[$i]['product_id'])->getfield('subhead');
			$list[$i]['img']=M('product_img')->where('product_id='.$list[$i]['product_id'])->getfield('img');
			$list[$i]['total_price']=M('order_product')->where('order_id='.$list[$i]['order_id'])->getfield('total_price');
			$list[$i]['user_name'] = M('user')->where('user_id='.$list[$i]['user_id'])->getfield('name');
		}
	    $this->assign('page',$show);// 赋值分页输出
		$this->assign('list',$list);

		$this->assign('keyv',$_GET['key']);
		$this->assign('keyword',$_GET['keyword']);
		$this->assign('date1',$_GET['date1']);
		$this->assign('date2',$_GET['date2']);
		$this->display();
	}

	public function return_ok()
	{
		$id=$_GET['id'];
		$data['status']=1;
		$data['back']="审核通过";
		M('return')->where('return_id='.$id)->save($data);
		$this->success("操作成功！");
	}
	public function back_money()
	{
		$id=$_GET['id'];
		$data['status']=4;
		$data['back']=$_GET['name'];
		M('return')->where('return_id='.$id)->save($data);
		$this->success("操作成功！");
	}
	public function return_no()
	{
		$id=$_GET['id'];
		$data['back']=$_GET['name'];
		$data['status']=2;
		M('return')->where('return_id='.$id)->save($data);
		$this->success("操作成功！");
	}

	// public function certification_audit()
	// {
 //        if ($_GET['status'] != null || $_GET['status'] != "") {
 //            $where['status'] = $_GET['status']-1;
 //        }
 //        if ($_GET['id']) {
 //        	$where['user_id'] = $_GET['id'];
 //        }
 //        if ($_GET['key']==1) {
 //        	$user_id="";
 //        	$w['name'] = array('like','%'.$_GET['keyword'].'%');
 //        	$user = M('user')->where($w)->select();
 //        	for ($i=0; $i < count($user); $i++) {
 //        		if ($i==0) {
 //        			$user_id.=$user[$i]['user_id'];
 //        		} else {
 //        			$user_id.=",".$user[$i]['user_id'];
 //        		}
 //        	}
 //        	$where['user_id']=array('in',$user_id);
 //        } else {
 //        	$where['name'] = array('like','%'.$_GET['keyword'].'%');
 //        }
 //        import('ORG.Util.Page');// 导入分页类
	// 	$count = M('document_user')->where($where)->count();// 查询满足要求的总记录数 $map表示查询条件
	//     $Page = new Page($count,20);// 实例化分页类 传入总记录数
	//     $show = $Page->show();// 分页显示输出
	// 	$list = M('document_user')->where($where)->order('date desc')->limit($Page->firstRow.','.$Page->listRows)->select();
	// 	for ($i=0; $i < count($list); $i++) { 
	// 		$days=abs((strtotime(date("Y-m-d"))-strtotime($list[$i]['lose_date']))/86400);
	// 		if (date("Y-m-d")>$list[$i]['lose_date']) {
 //                $list[$i]['er'] = "已过期";
 //            } elseif ($days<=90) {
 //                $list[$i]['er'] = "将于".$days."天后过期";
 //            }
 //            $list[$i]['user_name'] = M('user')->where('user_id='.$list[$i]['user_id'])->getfield('name');
	// 	}
	// 	$this->assign('page',$show);// 赋值分页输出
	// 	$this->assign('list',$list);

	// 	$this->assign('keyv',$_GET['key']);
	// 	$this->assign('keyword',$_GET['keyword']);
	// 	$this->display();
	// }

	public function audit_ok()
	{
		$id=$_GET['id'];
		$data['status']=1;
		$data['back']='审核通过';
		M('document_user')->where('id='.$id)->save($data);
 
		
 		$user_id=M('document_user')->where('id='.$id)->getfield('user_id');
 		$identity = M('user')->where('user_id='.$user_id)->getfield('identity');
 		$doc_m = M('document')->where("status=1 and (identity=0 or identity=".$identity.")")->select();
        for ($i=0; $i < count($doc_m); $i++) { 
            $type_m[$i] = "{$doc_m[$i]['doc_type']}(必要)";
        }
         $type_m=implode("','", $type_m);
  		 $type_c=M('document')->where("status=1 and (identity=0 or identity=".$identity.")")->count();
 		 $user_c=M('document_user')->where("user_id=$user_id and status=1 and doc_type in('".$type_m."')")->count();
 	 
  		if ($type_c==$user_c) {
			$da['is_authentication']=1;
			M('user')->where('user_id='.$user_id)->save($da);
			$this->success("已通过该申请！该用户已申请并通过所有(必要)认证！");
		} else{
			$this->success("已通过该申请！");
		}	
 	}




	public function audit_no()
	{
		$m = M('document_user')->where('id='.$_GET['id'])->find();

		$data['status']=2;
		$data['back']=iconv("gb2312","utf-8",$_GET['name']);
		M('document_user')->where('id='.$_GET['id'])->save($data);

		M('user')->where('user_id='.$m['user_id'])->setField('is_authentication',0);
		$this->success("已拒绝通过该申请！");
	}
	/*yss物流查询*/
	public function logistics()
	{
		$typeCom = $_GET["transport_company"];//获得快递公司
		$typeNu = $_GET["transport_code"];//获得快递单号
		if(isset($typeCom)&&isset($typeNu)){
			$AppKey='dee19f1123760151';
			$url= 'http://www.kuaidi100.com/applyurl?key='.$AppKey.'&com='.$typeCom.'&nu='.$typeNu;
			if(function_exists('curl_init') == 1){
				$curl = curl_init();
				curl_setopt ($curl, CURLOPT_URL, $url);
				curl_setopt ($curl, CURLOPT_HEADER,0);
				curl_setopt ($curl, CURLOPT_RETURNTRANSFER,1);
				curl_setopt ($curl,CURLOPT_USERAGENT,$_SERVER['HTTP_USER_AGENT']);
				curl_setopt ($curl, CURLOPT_TIMEOUT,5);
				$get_content = curl_exec($curl);
				curl_close ($curl);
			}else{
				include("snoopy.php");
				$snoopy = new snoopy();
				$snoopy->referer ='google';
				$snoopy->fetch($url);
				$get_content = $snoopy->results;
			}
			$get_content=iconv('UTF-8','GB2312//IGNORE', $get_content);
			$this->assign('get_content',$get_content);
			//print_r('<iframe src="'.$get_content.'" width="580"height="380"><br/>' . $powered);
		}else{
 		}
		$this->display();
	}

	public function doc_content()
	{
        if ($_GET['status'] != null || $_GET['status'] != "") {
            $where['status'] = $_GET['status']-1;
        }
        if ($_GET['id']) {
        	$where['user_id'] = $_GET['id'];
        }
        if ($_GET['key']==1) {
        	$user_id="";
        	$w['name'] = array('like','%'.$_GET['keyword'].'%');
        	$user = M('user')->where($w)->select();
        	for ($i=0; $i < count($user); $i++) {
        		if ($i==0) {
        			$user_id.=$user[$i]['user_id'];
        		} else {
        			$user_id.=",".$user[$i]['user_id'];
        		}
        	}
        	$where['user_id']=array('in',$user_id);
        } else {
        	$where['name'] = array('like','%'.$_GET['keyword'].'%');
        }
        import('ORG.Util.Page');// 导入分页类
		$count = M('document_user')->where($where)->count();// 查询满足要求的总记录数 $map表示查询条件
	    $Page = new Page($count,20);// 实例化分页类 传入总记录数
	    $show = $Page->show();// 分页显示输出
		$list = M('document_user')->where($where)->order('date desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		for ($i=0; $i < count($list); $i++) { 
			$days=abs((strtotime(date("Y-m-d"))-strtotime($list[$i]['lose_date']))/86400);
			if (date("Y-m-d")>$list[$i]['lose_date']) {
                $list[$i]['er'] = "此认证已过期";
            } elseif ($days<=90) {
                $list[$i]['er'] = "此认证将于".$days."天后过期";
            }
            $list[$i]['user_name'] = M('user')->where('user_id='.$list[$i]['user_id'])->getfield('name');
		}
		$this->assign('page',$show);// 赋值分页输出
		$this->assign('list',$list);

		$this->assign('keyv',$_GET['key']);
		$this->assign('keyword',$_GET['keyword']);
                
            //经营范围
            $data = M('user')->where('user_id='.$_GET['id'])->find();
            $aptitudes = $data['aptitudes'];
            $aptitudeArr = array();
            if(!empty($aptitudes)){
                $aptitudes = str_replace("[", '', $aptitudes);
                $aptitudeArr = explode("]", $aptitudes);
            }
            $this->assign('aptitudeArr',$aptitudeArr);
            $where = '';
            $data = M('aptitude')->where($where)->select();
            for($i=0;$i<count($data);$i++){
                if(in_array($data[$i]['id'], $aptitudeArr)){
                    $data[$i]['checked'] =1;
                }else{ 
                    $data[$i]['checked'] =0;
                }
            }            
            $this->assign('aptitudelist',$data);
            $this->assign('user_id',$_GET['id']);
                
		$this->display();
	}
        
        public function saveaptitude()
	{
            $user_id =  $_POST['cuser_id'];
            $aptitudeids = $_POST['aptitudeids'];
            $aptitude = '';
            $count = count($aptitudeids);
            if($count >0 ){
                for($i=0;$i<$count;$i++){
                    $aptitude .="[".$aptitudeids[$i]."]";
                }
            }
            $data['aptitudes']=$aptitude;
            
            $identity = M('user')->where('user_id='.$user_id)->getfield('identity');
            $doc_m = M('document')->where("status=1 and (identity=0 or identity=".$identity.")")->select();
            for ($i=0; $i < count($doc_m); $i++) { 
                $type_m[$i] = "{$doc_m[$i]['doc_type']}(必要)";
            }
            $type_m=implode("','", $type_m);
            $type_c=M('document')->where("status=1 and (identity=0 or identity=".$identity.")")->count();
            $user_c=M('document_user')->where("user_id=$user_id and status=1 and doc_type in('".$type_m."')")->count();
            if ($type_c==$user_c) {
                $data['is_authentication']=1;
            } 
            
            M('user')->where('user_id='.$user_id)->save($data);
            $this->success("客户经营种类保存成功!");
	}

	 function download()
    {
    	if ($_GET['id']) {
    		$where['id'] = array('in',$_GET['id']);
    	}
    	$list = M('document_user')->where($where)->select();
        for ($i=0; $i < count($list); $i++) { 
			$days=abs((strtotime(date("Y-m-d"))-strtotime($list[$i]['lose_date']))/86400);
			if (date("Y-m-d")>$list[$i]['lose_date']) {
                $list[$i]['er'] = "此认证已过期";
            } elseif ($days<=90) {
                $list[$i]['er'] = "此认证将于".$days."天后过期";
            }
            $list[$i]['user_name'] = M('user')->where('user_id='.$list[$i]['user_id'])->getfield('name');
		}
		
        header("Content-Type:   application/msword");       
		header("Content-Disposition:   attachment;   filename=资质认证-".$list[0]['user_name'].".doc"); //指定文件名称  
		header("Pragma:   no-cache");
		header("Expires:   0");
		$html  = '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
		$html .= '<table border="1" cellspacing="2" cellpadding="2" width="90%" align="center">';
		$html .= '<tr bgcolor="#cccccc"><td>用户名</td>
			      <td>证件持有者姓名</td>
			      <td>认证类型</td>
			      <td>证件有效日期</td>
			      <td>提交时间</td>
			      <td>备注</td>
			      <td>图片</td></tr>';
		for ($i=0; $i < count($list); $i++) { 
			$html .= "<tr><td>".$list[$i]['user_name']."</td>";
			$html .= "<td>".$list[$i]['name']."</td>";
			$html .= "<td>".$list[$i]['doc_type']."</td>";
			$html .= "<td>".$list[$i]['get_date']." 至 ".$list[$i]['lose_date']."</td>";
			$html .= "<td>".date('Y-m-d H:i:s',$list[$i]['date'])."</td>";
			$html .= "<td>".$list[$i]['er']."</td>";
			// $html .= "<td><a href='http://pc.dtyd.com.cn/Uploads/".$list[$i]['img']."'>http://pc.dtyd.com.cn/Uploads/".$list[$i]['img']."</a></td>";
			if ($list[$i]['img']) {
				$html .= "<td>图".$i."</td>";
			} else {
				$html .= "<td>无图</td>";
			}
			
			// $html .= "<tr><td height:20px;width:20px;><img src='http://pc.dtyd.com.cn/Uploads/".$list[$i]['img']."'></td></tr>";
		}
		$html .= '</tr></table>';
		$html .= '<table cellspacing="2" cellpadding="2" width="60%" align="center">';
		for ($i=0; $i < count($list); $i++) { 
			if ($list[$i]['img']) {
				$html .= "<a href='https://pc.dtyd.com.cn/Uploads/{$list[$i]['img']}'>图片</a><br>";
				$html .= "图".$i;
			}
		}
		$html .= '</tr></table>';
		echo  $html;
    }
}