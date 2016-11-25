<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title><?php echo ($top_content["title"]); ?></title>
<meta name="Keywords" content="<?php echo ($top_content["keywords"]); ?>" />
<meta name="Description" content="<?php echo ($top_content["description"]); ?>" />
<link rel="stylesheet" href=" __PUBLIC__css/base.css">
<link rel="stylesheet" href="__PUBLIC__css/main.css">
<link rel="stylesheet" href="__PUBLIC__css/other.css">
<script style="text/javascript" src="__PUBLIC__js/jquery-1.11.0.js"></script>
<script style="text/javascript" src="__PUBLIC__js/rich_lee.js"></script>
</head>
<body>
<!-- top -->
<link rel="shortcut icon" href="/favicon.ico"/>
<div class="side">
  <ul>
    <li><a href="/newsmanu/newsmanu/id/124">
      <div class="sidebox"><img src="__PUBLIC__img/side_icon01.png">客服中心</div>
      </a></li>
    <li><a href="/newsmanu/newsmanu/id/124">
      <div class="sidebox"><img src="__PUBLIC__img/side_icon02.png">客户案例</div>
      </a></li>
    <li><a href="tencent://message/?uin=<?php echo ($top_content["qq"]); ?>&Site=真善美&Menu=yes">
      <div class="sidebox"><img src="__PUBLIC__img/side_icon04.png">QQ客服</div>
      </a></li>
    <li><a href="<?php echo ($top_content["weibo"]); ?>">
      <div class="sidebox"><img src="__PUBLIC__img/side_icon03.png">新浪微博</div>
      </a></li>
    <li style="border:none;"><a  onclick="move()"  class="sidetop"><img src="__PUBLIC__img/side_icon05.png"></a></li>
  </ul>
</div>
<script type="text/javascript"> 
function move()
{
    $('html,body').animate({scrollTop:0},500);
}

</script>
 <link rel="stylesheet" href="__PUBLIC__css/style.css">
<div class="top_index" id="top">
  <div class="top_index_middle">
    <div class="top_index_left">
      <ul>
        <li>
          <?php if($_SESSION['user_id'] != null): ?><span style="color:#069"><?php echo ($top["name"]); ?> </span><?php endif; ?>
          您好，欢迎来到单体药店网！</li>
        <?php if($_SESSION['user_id'] == null): ?><li><a href="/account/login">请登录</a></li>
          <li><a href="/account/register">免费注册</a></li><?php endif; ?>
        <?php if($_SESSION['user_id'] != null): ?><li><a href="/account/logout" style="color:#999">[退出]</a></li><?php endif; ?>
      </ul>
    </div>
    <div class="top_index_right">
      <ul>
        <?php if($_SESSION['user_id'] != null): ?><li class="top_index_right_per"> <span></span><!-- 这个span是小图标不能删 --> 
            <a href="/order/orderList">个人中心</a> </li>
          <li class="top_index_right_favor"> <span></span><!-- 这个span是小图标不能删 --> 
            <a href="/ordermanage/my_collection/">收藏夹</a> </li><?php endif; ?>
        <li class="top_index_right_app"> <span></span><!-- 这个span是小图标不能删 --> 
          <a href="/newsmanu/newsmanu/id/74">手机APP</a> </li>
        <li class="top_index_right_contact"> <span></span><!-- 这个span是小图标不能删 --> 
          <a href="tencent://message/?uin=<?php echo ($top_content["qq"]); ?>&Site=真善美&Menu=yes">联系客服</a> </li>
      </ul>
    </div>
  </div>
</div>
<!-- topend --> 
<!-- search -->
<div class="search_index">
  <div class="search_index_left"> <a href="/"> <img src="__PUBLIC__images/logo.png" alt="真善美"> </a> </div>
</div>
<!-- searchend --> 
<!-- nav -->
<div class="my_content"> <img class="reg_img" src="__PUBLIC__img/reg_img.png"  />
  <form id="form" class="reg" action="/account/registerFunDo" method="post">
    <ul>
      <dt>
        <h3>免费注册</h3>
        <span>已有账号？<a href="/account/login">立即登陆</a></span> </dt>
      <dd> <em></em>
        <select id="identity" name="identity" style="height:38px;float:right;border: #e5e5e5 1px solid;font-size:14px;margin-top:1px;margin-left:5px">
          <option value="0">身份</option>
          <option value="1">诊所</option>
          <option value="2">药房</option>
        </select>
        <input type="text" id="name" name="name" style="width:193px" onchange="ss(this)" placeholder="请输入用户名"/>
        <span>用户名：</span>
      </dd>
      <dd id="err" style="display:none">
        <label id="err_lb" style="margin-left:77px;color:red;"></label>
      </dd>
      <dd>
        <input type="button" value="验证码" id="get_code" onclick="getcode()" style="margin-left:5px;width:52px"/>
        <input type="text" id="tel" name="tel" style="width:193px" placeholder="请输入手机号码"/>
        <span>手机号码：</span>
      </dd>
      <dd id="tel_err" style="display:none">
        <label id="tel_err_lb" style="margin-left:77px;color:red;"></label>
      </dd>
      <dd>
        <input type="text" id="code" name="code" placeholder="请输入验证码"/>
        <span>验证码：</span>
      </dd>
      <dd id="code_err" style="display:none">
        <label id="code_err_lb" style="margin-left:77px;color:red;"></label>
      </dd>
      <dd>
        <input type="password" id="password" name="password" placeholder="请输入登录密码"/>
        <span>登陆密码：</span>
      </dd>
      <dd id="pwd_err" style="display:none">
        <label id="pwd_err_lb" style="margin-left:77px;color:red;"></label>
      </dd>
      <dd>
        <input type="password" id="password2" name="password2" placeholder="请再次输入登录密码"/>
        <span>确认密码：</span>
      </dd>
      <dd id="pwdd_err" style="display:none">
        <label id="pwdd_err_lb" style="margin-left:77px;color:red;"></label>
      </dd>
      <dt>
        <input type="button" id="but" onclick="" value="同意协议并注册"   style="background:#BEBEBE" />
        <input style="width:15px;height:15px;" type="checkbox" onclick="arg(this)"/>
        <a href="/newsmanu/newsmanu/id/73" class="reg_sub">《单体药房网用户协议》</a> </dt>
    </ul>
  </form>
  <div class="reg_shadow"></div>
</div>
<script type="text/javascript">



  function ss (s) {
    var name = s.value;
    $.post("/account/is_name",{name:name},function(data){
      if (data==0) {
        $('#err').css('display','none');
      } else {
        $('#err').css('display','block');
        $('#err_lb').html('用户名已存在！');
      };
    });
  }
  function arg (obj) {
    if (obj.checked==true) {
      $('#but').attr('onclick','sub()');
      $('#but').css('background','#58a8e5');
    } else {
      $('#but').attr('onclick','');
      $('#but').css('background','#BEBEBE');
    };
  }
  function getcode () {
    var tel = document.getElementById('tel').value;
    var get_code = document.getElementById('get_code');
    var myreg = /^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1}))+\d{8})$/;
    if(!myreg.test(tel)) {
      alert('请输入正确的手机号！');
    } else {
      send();
      time(get_code);
    }
  }
  var wait = 60;
  function send () {
    var phonenumber = document.getElementById('tel').value;
    $.ajax({
      type: "POST",
      url:'/account/yzm',
      data:{tel:phonenumber},
      success: function(data){
        if(data == 2){
          alert('该手机号已注册！');
        }
      }
    });
  }
  function time(btn){
    if (wait==0) {
        btn.value = "验证码";
        btn.setAttribute("onclick","getcode()");
        wait = 60;
    }else{
        btn.value = wait + "S";
        wait--;
        btn.setAttribute("onclick","");
        setTimeout(function(){
          time(btn);
        },1000);
    }
  }
  function sub () {
    var name = document.getElementById('name').value;
    if (!name) {
      $('#err').css('display','block');
      $('#err_lb').html('请输入用户名！');
    } else {
      $('#err').css('display','none');
    };
    var identity = document.getElementById('identity').value;
    if (identity==0) {
      alert('请选择要注册的身份！');
    };
    var tel = document.getElementById('tel').value;
    var myreg = /^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1}))+\d{8})$/;
    if (!myreg.test(tel)) {
      $('#tel_err').css('display','block');
      $('#tel_err_lb').html('请输入有效的手机号！');
    } else {
      $('#tel_err').css('display','none');
    };
    var code = document.getElementById('code').value;
    if (!code) {
      $('#code_err').css('display','block');
      $('#code_err_lb').html('请输入手机验证码！');
    } else {
      $('#code_err').css('display','none');
    };
    var password = document.getElementById('password').value;
    if (!password || password.length<6 || password.length>16) {
      $('#pwd_err').css('display','block');
      $('#pwd_err_lb').html('请输入6-16位字符组成的密码！');
    } else {
      $('#pwd_err').css('display','none');
    };
    var password2 = document.getElementById('password2').value;
    if (!password2) {
      $('#pwdd_err').css('display','block');
      $('#pwdd_err_lb').html('请再次输入密码！');
    } else if (password2 != password) {
      $('#pwdd_err').css('display','block');
      $('#pwdd_err_lb').html('密码不一致！');
    } else {
      $('#pwdd_err').css('display','none');
    };
    if (identity!=0 && name && myreg.test(tel) && code && password && 6<password.length<16 && password2 && password2==password) {
      $('#form').submit();
    };
  }
</script>
<div class="footer">
		<dl>
			<dd>
				<h2>消费者保障</h2>
				<a href="/newsmanu/newsmanu/id/121">网购警示</a>
				<a href="/newsmanu/newsmanu/id/122">隐私保护</a>
				<a href="/newsmanu/newsmanu/id/123">投诉维权</a>
				<a href="/newsmanu/newsmanu/id/124">客服中心</a>
			</dd>
			<dd>
				<h2>新手上路</h2>
				<a href="/newsmanu/newsmanu/id/111">订单状态</a>
				<a href="/newsmanu/newsmanu/id/112">购物流程</a>
				<a href="/newsmanu/newsmanu/id/113">用户注册</a>
				<a href="/newsmanu/newsmanu/id/114">订购方式</a>
			</dd>
			<dd>
				<h2>配送方式</h2>
				<a href="/newsmanu/newsmanu/id/101">商品签收</a>
				<a href="/newsmanu/newsmanu/id/102">配送网点</a>
			</dd>
			<dd>
				<h2>售后服务</h2>
				<a href="/newsmanu/newsmanu/id/91">退换货保障</a>
				<a href="/newsmanu/newsmanu/id/92">发票制度</a>
				<a href="/newsmanu/newsmanu/id/93">服务承诺</a>
				<a href="/newsmanu/newsmanu/id/94">快递查询</a>
			</dd>
			<dd>
				<h2>支付方式</h2>
				<a href="/newsmanu/newsmanu/id/81">银行转账&汇款</a>
				<a href="/newsmanu/newsmanu/id/82">网上银行支付</a>
				<a href="/newsmanu/newsmanu/id/83">货到付款</a>
			</dd>
			<dd>
				<h2>帮助中心</h2>
				<a href="/newsmanu/newsmanu/id/71">找回密码</a>
				<a href="/newsmanu/newsmanu/id/72">常见问题</a>
				<a href="/newsmanu/newsmanu/id/73">用户协议</a>
				<a href="/newsmanu/newsmanu/id/74">关于单体</a>
			</dd>
			<dt  style="display:none">
				<img src="__PUBLIC__images/footer_mark.png"/>
				<span>微信公众号</span>
			</dt>
		</dl>
		<P>互联网药品信息服务资格证编号：(渝)-非经营性-2013-0008 &nbsp;&nbsp;<a href="/index/Tpl/public/images/certificate1.jpg" target="_new" style="color:#06C">互联网药品交易服务资格证编号</a>&nbsp;&nbsp;备案号: <a href="http://www.miitbeian.gov.cn/" target="_new" style="color:#06C">渝ICP备15010503号</a><br />
©2015-2025 单体药店网版权所有  重庆真善美医药有限公司 design by cqtiandu.com &nbsp;   &nbsp;&nbsp;<a href="/index/Tpl/public/images/certificate2.jpg" target="_new" style="color:#06C">药品经营质量管理规范认证证书</a> &nbsp;&nbsp;<a href="/index/Tpl/public/images/certificate3.jpg" target="_new" style="color:#06C">公司营业执照</a> &nbsp;&nbsp;<a href="/index/Tpl/public/images/certificate4.jpg" target="_new" style="color:#06C">药品经营许可证</a> </P>
		<ul>
			<li>
				<a>
					<img src="__PUBLIC__img/footer_img01.png"  />
				</a>
			</li>
			<li>
				<a>
					<img src="__PUBLIC__img/footer_img02.png"  />
				</a>
			</li>
			<li>
				<a>
					<img src="__PUBLIC__img/footer_img03.png"  />
				</a>
			</li>
			<li>
				<a>
					<img src="__PUBLIC__img/footer_img04.png"  />
				</a>
			</li>
			<li>
				<a>
					<img src="__PUBLIC__img/footer_img05.png"  />
				</a>
			</li>
			<li>
				<a>
					<img src="__PUBLIC__img/footer_img06.png"  />
				</a>
			</li>
			<li>
				<a>
					<img src="__PUBLIC__img/footer_img07.png"  />
				</a>
			</li>
		</ul>
	</div>
    
    
    <style type="text/css">
 .feny{ text-align:center; line-height:18px; height:18px; margin:10px 0px;  font-size:12px }
 .feny a{ display:inline-block;  height:25px; line-height:25px; text-align:center; border:1px solid #eeeeee; padding:0px 5px; }
 .feny span{ display:inline-block;  height:25px; line-height:25px; text-align:center;border:1px solid #3b93de; background:#3b93de;color:#FFF;padding:0px 5px; }


</style>

    
    
    
    
    
    
    
    
    
    
</body>
</html>