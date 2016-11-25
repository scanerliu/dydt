<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="__PUBLIC__css/indexManagement/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="__PUBLIC__js/jquery.1.10.js"></script>
</head>
<body>


 <div class="bannerAdd"> 
   <form action="__APP__/indexManagement/bannerAddFunUpload/class/<?php echo ($_GET['class']); ?>" method="post" enctype="multipart/form-data"  name="form">   
   <table  width="99%" border="0" cellpadding="0" cellspacing="0" style=" margin-bottom:5px;" >
  <tr style="background:url(__PUBLIC__images/a10.gif) repeat-x; height:36px;">
    <td style="text-align:left">
     <a href="__APP__/indexManagement/bannerList/class/<?php echo ($_GET['class']); ?>">文章列表</a> >> 文章新增
     </td>
  </tr>
</table>
   <table  width="99%" border="0" cellpadding="0" cellspacing="0" style=" margin-bottom:5px;" >
  <tr style="height:36px;">
    <td style="text-align:left">
         <input type="file"  name="file"> 
     </td>
  </tr>
    <tr style="height:36px;">
       <td style="text-align:left">
        <span>图片链接:</span><span><input name="link" type="text"  class="input1" style="width:200px;"/></span>
     </td> 
   </tr>
       <tr style="height:36px;">
       <td style="text-align:left">
       <a href="javascript:void(0)" class="button1"  onclick="formSubmit()">确定</a> <a href="__APP__/indexManagement/bannerList/class/<?php echo ($_GET['class']); ?>" class="button1">返回</a>
     </td> 
   </tr>
</table>
</form>
<script type="text/javascript">
function formSubmit(){
		 form.submit();
	}
</script>





</div>
</body>
</html>