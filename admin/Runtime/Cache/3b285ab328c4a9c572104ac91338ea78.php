<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="__PUBLIC__css/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="__PUBLIC__js/jquery.1.10.js"></script>
</head>
<body>
 <form action="__APP__/login/loginFundo"    method="post" name="form" >
 <div class="i_login">
      <div class="content">
         <div class="s_part1">
           <div class="L">后台登录</div>
           <div class="R"><a href="/">返回网站首页</a></div>
         </div>
         <!--s_part1-->
         <div class="s_part2">
           <div class="h1">
            <div class="L">用户名：</div>
            <div class="R1">
              <input name="name" type="text" />
            </div>
             <div class="R8" id="nameReturn"></div>
            <div class="clear"></div>
           </div>
         <!--h1-->
          <div class="h1">
            <div class="L">密码：</div>
            <div class="R1">
              <input  type="password"  name="password"/>
            </div>
            <div class="R8" id="passwordReturn"></div>
            <div class="clear"></div>
           </div>
         <!--h1-->
          <div class="h1">
            <div class="L">验证码：</div>
            <div class="R2">
              <input  type="text"  name="code"/>
            </div>
            <div class="R3"><img class="verifyCode" src="__APP__/login/verify"/></div>
            <div class="R4"><a href="javascript:void(0)" onclick=" $('.verifyCode').attr('src','__APP__/login/verify?'+Math.random())">看不清</a></div>
            <div class="R8" id="codeReturn"></div>
            <div class="clear"></div>
           </div>
         <!--h1-->
           <div class="h1">
            <div class="L">&nbsp;</div>
            <div class="R7"><img src="__PUBLIC__images/a3.jpg" onclick="formSubmit()"/></div>
            <div class="clear"></div>
           </div>
         <!--h1-->
         
           <div class="h1">
            <div class="L">&nbsp;</div>
            <div class="R5">
            <input name="sessionName" type="checkbox" value="1" />
            </div>
            <div class="R6">8小时内保持登录</div>
            <div class="clear"></div>
           </div>
         <!--h1-->
         </div>
         <!--s_part2-->
      </div>
      <!--content-->
  </div>
  <!--i_login-->
</form>
  <script type="text/javascript">
      $('.i_login').height(document.documentElement.clientHeight-200)
	  
	   function loginFunAjaxName () {         // ajax  验证用户名
	      $.post("__APP__/login/loginFunAjaxName", { name:$("input[name='name']").val() },
          function(data){
		   if(data==0){
			 $('#nameReturn').html('该用户不存在')  
 			   }
			 else{
			 $('#nameReturn').html('')  
			     nameJudge=1;
				 }  
              } <!--end fun-->
		     );<!--end post-->
      	  } <!--end fun-->
		  
	  
	  
	  	  function  loginFunAjaxPassword() {         // ajax  验证 密码
	      $.post("__APP__/login/loginFunAjaxPassword", { password:$("input[name='password']").val(),  name:$("input[name='name']").val()  },
          function(data){
			  
		   if(data==0){
			 $('#passwordReturn').html('密码错误') 
			  
 			   }
			 else{
			 $('#passwordReturn').html('') ;
			  passwordJudge=1; 
				 }  
              } <!--end fun-->
		     );<!--end post-->
      	  } <!--end fun-->
	        
	        
	
		  function  loginFunAjaxCode  () {         // ajax  验证 验证码
	      $.post("__APP__/login/loginFunAjaxCode", { code:$("input[name='code']").val() },
          function(data){
		   if(data==0){
			 $('#codeReturn').html('验证码错误') 
 			   }
			 else{
			 $('#codeReturn').html('') ;
			   codeJudge=1; 
				 }  
              } <!--end fun-->
		     );<!--end post-->
      	  } <!--end fun-->
	
	
	       
	   function  formSubmit(){    
	            loginFunAjaxName ();
				loginFunAjaxPassword();
			    loginFunAjaxCode ();
		    	 $(document).ajaxSuccess(function(){
			    	if ( codeJudge  &&  passwordJudge && codeJudge ){
			            form.submit();	
					}
			   });	
			}
	  
   	  
	
	
	  
	  
	  
   </script>
  </body>
</html>