<?php
class accountAction extends commonAction
{
    public function register()
    {
        $this->display();
    }

    public function is_name()
    {
        $name = $_POST['name'];
        $is_name = M('user')->where("name='".$name."'")->find();
        if ($is_name) {
            $is = 1;
        } else {
            $is = 0;
        }
        $this->ajaxReturn($is);
    }
    public function yzm()
    {
        $is=M('user')->where("mobile_phone='".$_POST['tel']."'")->find();
        if ($is) {
            $this->ajaxReturn(2);
        } else {
            for ($i=0;$i<6;$i++)//生成验证码
            {
                $num=mt_rand(0,9);
                $checkstr.=$num;
            }
            $phonenumber = $_POST['tel'];
            $text="验证码：".$checkstr."，请即时输入。请妥善保存，确保帐号安全。";
            $text = iconv("utf-8","gb2312",$text);
            $ch = curl_init("http://www.10086x.com/sends.asp?user=zsmyzm&passw=zsm123456&text=".$text."&mobiles=".$phonenumber."&SEQ=1000") ;  
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true) ; // 获取数据返回  
            curl_setopt($ch, CURLOPT_BINARYTRANSFER, true) ; // 在启用 CURLOPT_RETURNTRANSFER 时候将获取数据返回  
            $output = curl_exec($ch) ;
            session('zcyzm',$checkstr);
        } 
    }
    public function registerFunDo()
    {
        if ($_SESSION['zcyzm'] != $_POST['code']) {
            echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />'; 
			echo "<script>alert('验证码错误');window.location.href='javascript:history.go(-1)';</script>";
			exit;
        }
        $where['name'] = $_POST['name'];
        if (M('user')->where($where)->count() != 0) {
            echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />'; 
			echo "<script>alert('该用户名已经注册');window.location.href='javascript:history.go(-1)';</script>";
			exit;
        }
        $data['name'] = $_POST['name'];
        $data['mobile_phone'] = $_POST['tel'];
        $data['password'] = md5(md5($_POST['password']));
		$data['img'] = 'touxiang.jpg';
        $data['identity'] = $_POST['identity'];
		
        M('user')->add($data);
        $where = array();
        $where['name'] = $_POST['name'];
        $data = M('user')->where($where)->find();
        $_SESSION['user_id'] = $data['user_id'];
        $this->success('注册成功', '/');
    }
    public function login()
    {
        $this->display();
    }
    public function loginFunDo()
    {
        $wheren['name'] = $_POST['name'];
        $is = M('user')->where($wheren)->find();
        if ($is['e_time'] && time()-$is['e_time']<300) {
            echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
            echo "<script>alert('您已连续5次输入错误的账号密码，5分钟不能进行登录操作。');window.location.href='javascript:history.go(-1)';</script>";
        } else {
            $where['name'] = $_POST['name'];
            $where['password'] = md5(md5($_POST['password']));
            if (M('user')->where($where)->count() != 1) {
                if ($is['e_count']<5) {
                    $save['e_count'] = $is['e_count']+1;
                    M('user')->where($wheren)->save($save);
                } else {
                    $save1['e_time'] = time();
                    $save1['e_count'] = 0;
                    M('user')->where($wheren)->save($save1);
                }
                echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
    			echo "<script>alert('用户名或者密码错误，连续错误5次将锁定账号5分钟不能登录！');window.location.href='javascript:history.go(-1)';</script>";
    			exit;
            } else {
                $save2['e_count'] = 0;
                $save2['e_time'] = null;
                M('user')->where($wheren)->save($save2);
            }
            $where = array();
            $where['name'] = $_POST['name'];
            $data = M('user')->where($where)->find();
            $_SESSION['user_id'] = $data['user_id'];
            if ($_SESSION['user_id']) {
                $identity = M('user')->where('user_id='.$_SESSION['user_id'])->getfield('identity');
                $type_c=M('document')->where("status=1 and (identity=0 or identity=".$identity.")")->select();
                for ($i=0; $i < count($type_c); $i++) { 
                    $type_m[$i] = $type_c[$i]['doc_type'];
                }
                $type_m=implode("','", $type_m);

                $user_c=M('document_user')->where("user_id=".$_SESSION['user_id']." and status=1 and doc_type in('".$type_m."')")->select();
                if ($user_c) {
                    for ($p=0; $p < count($user_c); $p++) { 
                        if (date("Y-m-d")>$user_c[$p]['lose_date'] || $user_c[$p]['status'] != 1) {
                            M('user')->where('user_id='.$_SESSION['user_id'])->setField('is_authentication',0);
                            break;
                        }
                    }
                }
            }
            $lifeTime = 8 * 60 * 60;
            if ($_POST['session']) {
                setcookie(session_name(), session_id(), time() + $lifeTime, '/');
            }
    		redirect('/');
        }
	}
	public function logout() {
        unset($_SESSION['user_id']);
        redirect('/');
    }
	/**
     * 忘记密码
     */
	public function forget_pwd() {
        $get_identify = $_SESSION['get_identify'];
        if(IS_POST){
            $identify = $_POST['identify'];
            $password = md5(md5($_POST['password']));
            $password1 = md5(md5($_POST['password1']));
            $phonenumber = $_POST['phonenumber'];
            $res = M('user')->where('mobile_phone ='.$phonenumber)->find();
            if($res) {
                if($identify == $get_identify) {
                    if($password != $password1){
                        $this->error('两次密码输入不一致，请重新输入！');
                    } else {
                        if (strlen($_POST['password']) < 6 || strlen($_POST['password']) > 16) {
                            echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />'; 
                            echo "<script>alert('请将密码控制在6-16位之间');window.location.href='javascript:history.go(-1)';</script>";
                            exit;
                        } else {
                            $result = M('user')->where(array('mobile_phone' => $phonenumber))->save(array('password' => $password));
                            if($result){
                                $this->success('修改密码成功！','__APP__/account/login');
                            }
                        }  
                    }
                } else {
                    $this->error('验证码错误！');
                }
            } else {
                $this->error('您还未注册！');
            }
        }
        $this->display();
    }

	public function yanzhengma()
    {
        for ($i=0;$i<6;$i++)//生成验证码
        {
            $num=mt_rand(0,9);
            $checkstr.=$num;
        }
        $phonenumber = $_POST['phonenumber'];
        $text="验证码：".$checkstr."，请即时输入。请妥善保存，确保帐号安全。";
        $text = iconv("utf-8","gb2312",$text);
        $ch = curl_init("http://www.10086x.com/sends.asp?user=zsmyzm&passw=zsm123456&text=".$text."&mobiles=".$phonenumber."&SEQ=1000") ;  
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true) ; // 获取数据返回  
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, true) ; // 在启用 CURLOPT_RETURNTRANSFER 时候将获取数据返回  
        $output = curl_exec($ch) ;
        session('get_identify',$checkstr);
        $this->ajaxReturn(array('status' => $output));
    }
	
	
	function certificate(){  /*数字证书验证*/
	    if(!$_SERVER[CERT_SERIALNUMBER]):
		    $this->error('数字证书未安装');
	    endif;
	    if( !M('user')->where("cert_serialnumber='$_SERVER[CERT_SERIALNUMBER]'")->count() ){
 		  $this->error('该数字证书没有被绑定，请在个人中心-会员信息页面进行帮定');
		}
		else{
		   $data=M('user')->where("cert_serialnumber='$_SERVER[CERT_SERIALNUMBER]'")->getField('user_id');
	       $_SESSION['user_id']=$data;
		   redirect('/');
		}
    }
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}