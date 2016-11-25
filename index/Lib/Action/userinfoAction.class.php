<?php
class userinfoAction extends commonAction
{
    public function info()
    {
 		
        if (session('user_id')) {
            $user_id = session('user_id');
            $info = M('user')->where('user_id='.$user_id)->find();
            $this->assign('info',$info);
            $this->display();
        } else {
           redirect('/', 3, '您还没有登录，页面正跳转到首页...');
        }
        
    }

    public function ma_info()
    {
        if (session('user_id')) {
            $user_id = $_GET['id'];
            $info = M('user')->where('user_id='.$user_id)->find();
            $doc_user = M('document_user')->where('user_id='.$user_id)->select();
            $this->assign('doc_user',$doc_user);
            $doc = M('document')->select();
            $this->assign('doc',$doc);
            $this->assign('info',$info);
            $this->display('info');
        } else {
           redirect('/', 3, '您还没有登录，页面正跳转到首页...');
        }
    }

    public function alter_pwd()
    {
        if (session('user_id')) {
    	   $this->display();   
        } else {
           redirect('/', 3, '您还没有登录，页面正跳转到首页...');
        } 
    }

    public function save_pwd()
    {
      $user_id = session('user_id') ;
      if(IS_POST){
        $pwd_old = md5(md5($_POST['pwd_old']));
        $pwd_new_one = md5(md5($_POST['pwd_new_one']));
        $pwd_new_two = md5(md5($_POST['pwd_new_two']));
        if ($_POST['pwd_old']=="" || $_POST['pwd_new_one']=="" || $_POST['pwd_new_two']=="") {
            echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />'; 
            echo "<script>alert('密码不能为空！');window.location.href='/userinfo/alter_pwd';</script>";
            // $this->error("密码不能为空！");
        } else if($pwd_new_one != $pwd_new_two) {
            echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />'; 
            echo "<script>alert('新密码不一致!');window.location.href='/userinfo/alter_pwd';</script>";
            // $this->error("新密码不一致！");
        } else if (strlen($pwd_new_one)>16 || strlen($pwd_new_one)<6) {
            echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />'; 
            echo "<script>alert('请将密码控制在6-16位之间！');window.location.href='/userinfo/alter_pwd';</script>";
        } else {
          $pwd = M('user')->where('user_id='.$user_id)->getfield('password');
            if ($pwd == $pwd_old) {
              $save['password'] = $pwd_new_one;
              $sql=M('user')->where('user_id='.$user_id)->save($save);
              unset($_SESSION['user_id']);
              echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />'; 
              echo "<script>alert('修改密码成功，请重新登录!');window.location.href='/account/login';</script>";
              // $this->success("修改密码成功！");
            } else {
                echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />'; 
                echo "<script>alert('原密码错误!');window.location.href='/userinfo/alter_pwd';</script>";
                // $this->error("原密码错误！");
            }
        }
      }
    }

    public function save_info()
    {
        $user_id = session('user_id');
    	if (IS_POST) {
            $data['real_name'] = $_POST['real_name'];
            $data['sex'] = $_POST['sex'];
            $data['birthday'] = $_POST['birthday'];
            $data['mobile_phone'] = $_POST['mobile_phone'];
            $data['email'] = $_POST['email'];
            $data['address'] = $_POST['address'];
            $data['home_phone'] = $_POST['home_phone'];
			if(M('user')->where("user_id != $_SESSION[user_id] and  cert_serialnumber= '$_POST[cert_serialnumber]'") ->count()  ):
			  $this->error('该数字证书已经被绑定');  /*数字证书 用于数字证书登录*/
			endif;
             $data['cert_serialnumber'] = $_POST['cert_serialnumber'];
            $data['marriage'] = $_POST['marriage'];
            $data['city1'] = $_POST['prov'];
            $data['city2'] = $_POST['city'];
            $data['city3'] = $_POST['dist'];
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
                $data['img'] = $_POST['img_h'];
                // $this->error($upload->getErrorMsg());
            } else {
                // 上传成功 获取上传文件信息
                $info = $upload->getUploadFileInfo();
                $data['img'] = $info[0]['savename'];
            }
            // var_dump($data);exit;
        M('user')->where('user_id='.$user_id)->save($data);
        $this->success("保存成功!");
      } 
    }

    public function authentication()
    {
        if (session('user_id')) {
            $user_id = session('user_id');
            $identity = M('user')->where('user_id='.$user_id)->getfield('identity');

            $doc_user = M('document_user')->where('user_id='.$user_id)->select();
			
            for ($i=0; $i < count($doc_user); $i++) { 
			        if(  substr($doc_user[$i]['doc_type'],-8,8)=='(必要)'):
 					  $doc_user[$i]['doc_type2']= "<i style='color:red; font-style:normal'>{$doc_user[$i]['doc_type']}</i>";
					  else:  $doc_user[$i]['doc_type2']= $doc_user[$i]['doc_type'];
 					  endif;
					  
					  
                 $type[$i] = $doc_user[$i]['doc_type'];
                $doc_user[$i]['m'] = M('document')->where("doc_type='".$doc_user[$i]['doc_type']."'")->getfield('status');
                $days=abs((strtotime(date("Y-m-d"))-strtotime($doc_user[$i]['lose_date']))/86400);
                if (date("Y-m-d")>$doc_user[$i]['lose_date']) {
                    $doc_user[$i]['er'] = "此认证已过期";
                } elseif ($days<=90) {
                    $doc_user[$i]['er'] = "此认证将于".$days."天后过期";
                }   
            }
			
            $type=implode("','", $type);
			
             $doc_m = M('document')->where("status=1 and (identity=0 or identity=".$identity.")")->select();
            for ($i=0; $i < count($doc_m); $i++) { 
                $type_m[$i] = $doc_m[$i]['doc_type']."(必要)";
            }
            $type_m=implode("','", $type_m);

            $doc_d = M('document')->where("doc_type not in('".$type."') and (identity=0 or identity=".$identity.")")->select();
            $count_u=M('document_user')->where("user_id=".$user_id." and status=1 and doc_type in('".$type_m."')")->count();
  			
            $count=M('document_user')->where("user_id=".$user_id." and doc_type in('".$type_m."')")->count();
            $count_d=M('document')->where("status=1 and (identity=0 or identity=".$identity.")")->count();

            $count_au=M('document_user')->where("user_id=".$user_id)->count();
            $count_ad=M('document')->where('identity=0 or identity='.$identity)->count();
			
			 
            if ($count_u==$count_d) {
                $status=1;
            } else if ($count==$count_d) {
                $status=2;
            }
            if ($count_au==$count_ad) {
                $st=3;
            }
 			
            $this->assign('st',$st);
            $this->assign('status',$status);
            $this->assign('doc_user',$doc_user);
            $this->assign('doc_d',$doc_d);
            $this->display();
        } else {
           redirect('/', 3, '您还没有登录，页面正跳转到首页...');
        }
    }

    public function up()
    {
        if (IS_POST) {
            $user_id = session('user_id');
            $data['doc_type']=$_POST['doc_type'];
            $data['get_date']=$_POST['get_date'];
            $data['lose_date']=$_POST['lose_date'];
            if ($_POST['get_date']>$_POST['lose_date'] || $_POST['get_date']==$_POST['lose_date']) {
                $this->error("请正确选择证件有效日期!");
            }
            $data['user_id'] = $user_id;
            $data['name']=$_POST['name'];
            $data['status']=0;
            $data['date']=strtotime(date('Y-m-d H:i:s'));
            if ($data['doc_type']=="请选择" || $data['get_date']=="" || $data['lose_date']=="" || $data['name']=="") {
                $this->error("请确认信息完整!");
            } else{
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
                $data['img'] = $info[0]['savename'];
                M('document_user')->add($data);
                $this->success("上传成功!");
            } 
        }
    }

    public function del_doc()
    {
        $user_id = session('user_id');
        $id=$_GET['id'];
        $data['is_authentication']=0;
        M('document_user')->where('id='.$id)->delete();
        M('user')->where('user_id='.$user_id)->save($data);
        $this->success("删除认证成功!");
    }
}