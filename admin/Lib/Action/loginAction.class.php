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

class loginAction extends Action {
    function login() {
        $this->display();
    }
    function loginFunAjaxName() { // ajax  验证用户名
        $m = M('admin_user');
        $where = "name ='" . $_POST['name'] . "'";
        if ($m->where($where)->count()) {
            echo 1;
        }
    }
    function loginFunAjaxCode() { // ajax  验证 验证码
        if ($_SESSION['verify'] == md5($_POST['code'])) {
            echo 1;
        }
    }
    function loginFunAjaxPassword() { // ajax  验证 密码
        $m = M('admin_user');
        $where['password'] = md5(md5($_POST['password']));
        $where['name'] = $_POST['name'];
        if ($m->where($where)->count()) {
            echo 1;
        }
		else{
			$this->record();  //操作日志 记录 密码输错的情况
 		}
     }
 	
    function loginFundo() { //处理 提交的数据
        if ($_SESSION['verify'] == md5($_POST['code'])) {
            $codeJudge = 1;
        }
        $m = M('admin_user');
        $where['password'] = md5(md5($_POST['password']));
        $where['name'] = $_POST['name'];
        if ($m->where($where)->count()) {
            $passwordJudge = 1;
        }
        if ($passwordJudge and $codeJudge) {
            $_SESSION = array();
            $lifeTime = 8 * 60 * 60;
            if ($_POST['sessionName']) {
                setcookie(session_name() , session_id() , time() + $lifeTime, "/");
            }
            $_SESSION['admin_name'] = $_POST['name'];
            $m2 = M('admin_user'); //登录时间
            $date2['loginTime'] = time();
            $where2['name'] = $_POST['name'];
            $m2->where($where2)->save($date2);
			$this->record2();//操作日志 记录 登录成功的状况
            $this->success('后台登录成功', __APP__ . '/Index/index');
        } else {
            $this->error('登陆失败', __APP__ . '/login/login');
        }
    }
    function verify() {
        import('ORG.Util.Image');
        Image::buildImageVerify();
    }
	
	   function  record(){ //操作日志 记录 密码输错的情况
	        $data['time']=time();
 			$data['remark']='用户密码输入错误';
			$data['is_dangerous']=1;
		     M('record')->add($data);
		}
	
	  	function  record2(){ //操作日志 记录 登录成功的状况
	        $data['time']=time();
 			$data['remark']='用户登录';
 		     M('record')->add($data);
		}
	
	
	
	
}

