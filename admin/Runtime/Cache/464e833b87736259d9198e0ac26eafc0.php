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
  <form action="__APP__/productManagement/productAptitudeSaveFun/id/<?php echo ($_GET['id']); ?>" method="post" name="form">
    <table  width="99%" border="0" cellpadding="0" cellspacing="0" style=" margin-bottom:5px;" >
      <tr style="background:url(__PUBLIC__images/a10.gif) repeat-x; height:36px;">
        <td style="text-align:left"><a href="__APP__/productManagement/productAptitudes">药品类型</a> >> 药品类型修改 </td>
      </tr>
    </table>
    <table  width="99%" border="0" cellpadding="0" cellspacing="0" style=" margin-bottom:5px;" >
      <tr style="height:36px;">
        <td style="text-align:left"><span>类别名称:</span><span><input name="name" type="text"  class="input1" value="<?php echo ($data["name"]); ?>"/></span></td>          
      </tr>
      <tr style="height:36px;">
        <td style="text-align:left"><span>排序值:</span><span><input name="sort_by" type="text"  class="input1" value="<?php echo ($data["sort_by"]); ?>"/></span></td>          
      </tr>
      <tr style="height:36px;">
        <td style="text-align:left"><a href="javascript:void(0)" class="button1"  onclick="form.submit()">确定</a> <a href="__APP__/productManagement/productAptitudes" class="button1">返回</a></td>
      </tr>
    </table>
  </form>
 </div>
</body>
</html>