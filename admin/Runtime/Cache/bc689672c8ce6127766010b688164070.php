<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="__PUBLIC__css/indexManagement/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="__PUBLIC__js/jquery.1.10.js"></script>
</head>
<body>
 <form action="__APP__/system/passwordFunSave" method="post" name="form" enctype="multipart/form-data" >  
  <table  width="99%" border="0" cellpadding="0" cellspacing="0" style=" margin-bottom:5px;" >
     <tr >
        <td style="text-align:left">
        &nbsp;&nbsp;&nbsp;&nbsp;旧密码:<input name="oldPassword" type="password"  class="input1"  width="300px;"/>
          </td>
      </tr>
      <tr >
        <td style="text-align:left">
        &nbsp;&nbsp;&nbsp;&nbsp;新密码:<input name="newPassword" type="password"  class="input1"  width="300px;"/>
          </td>
      </tr>
  <tr >
        <td style="text-align:left">
        再输入一次:<input name="newPassword2" type="password"  class="input1"  width="300px;"/>
        </td>
      </tr>
       <tr style="height:36px;">
        <td style="text-align:left;"><a href="javascript:void(0)" class="button1"  onclick=" formSubmit()">确定</a></td>
      </tr>
    </table>
    </form>

  <script type="text/javascript">
function formSubmit(){
	   if(  $(" input[name='newPassword']").length >0 &&   $(" input[name='newPassword']").val()==  $(" input[name='newPassword2']").val() ){
	   	form.submit();	  
	   }
	   else{  alert(' 新密码错误')
		   }
	   
		
	}
</script> 




</body>
</html>