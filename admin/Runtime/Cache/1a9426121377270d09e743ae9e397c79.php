<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="__PUBLIC__css/indexManagement/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="__PUBLIC__js/jquery.1.10.js"></script>
</head>
<body>
<div class="bannerList">
<table width="99%" border="0" cellpadding="0" cellspacing="0" style=" margin-bottom:5px;">
    <tbody><tr style="background:url(/admin/Tpl/public/images/a10.gif) repeat-x; height:36px;">
      <td style="text-align:right"><a href="__APP__/productManagement/attributeAdd/product_classify_id/<?php echo ($_GET['product_classify_id']); ?>" class="button1">添加属性</a></td>
    </tr>
  </tbody></table>
  <table width="99%" border="0" cellpadding="0" cellspacing="0" style=" margin-bottom:5px;" >
    <tr>
      <td style="background:url(__PUBLIC__images/a10.gif) repeat-x; height:26px; text-align:left" colspan="9"><a href="__APP__/productManagement/productClassify">返回上一级目录</a> >  <?php echo ($weiz); ?> 属性列表</td>
    </tr>
    <tr bgcolor="#fbfce2">
      <td>属性名称</td>
      <td width="200">操作</td>
    </tr>
    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><tr>
        <td height="30" style="text-align:left;"><?php echo ($vol["title"]); ?></td>
         <td>
         <?php if($vol["lock"] != 1): ?><a href="__APP__/productManagement/attributeSave/attribute_id/<?php echo ($vol["attribute_id"]); ?>/product_classify_id/<?php echo ($_GET['product_classify_id']); ?>" style="color:#06C">编辑</a> &nbsp;&nbsp;<a href="__APP__/productManagement/attributeListFunDel/attribute_id/<?php echo ($vol["attribute_id"]); ?>">删除</a>
          <?php else: ?> 锁定<?php endif; ?>
         </td>
      </tr><?php endforeach; endif; else: echo "" ;endif; ?>
   </table>
</div>
</script>
</body>
</html>