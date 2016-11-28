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
      <td style="text-align:right"><a href="__APP__/productManagement/productAptitudeSave" class="button1">添加分类</a></td>
    </tr>
  </tbody></table>
  <table width="99%" border="0" cellpadding="0" cellspacing="0" style=" margin-bottom:5px;" >
    <tr>
      <td style="background:url(__PUBLIC__images/a10.gif) repeat-x; height:26px; text-align:left" colspan="9">文档列表</td>
    </tr>
    <tr bgcolor="#fbfce2">
      <td width="120">类别ID</td>
      <td  >类别名称</td>
       <td width="120">排序值</td>
       <td width="120">更新时间</td>
      <td width="170">操作</td>
    </tr>
    <?php if(is_array($aptitudes)): $i = 0; $__LIST__ = $aptitudes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><tr>
        <td height="30"><?php echo ($vol["id"]); ?></td>
        <td><?php echo ($vol["name"]); ?></td>
        <td><?php echo ($vol["sort_by"]); ?></td>
        <td><?php echo (date('Y年m月d日 H:i:s',$vol["update_time"])); ?></td>
        <td><a href="__APP__/productManagement/productAptitudeSave/id/<?php echo ($vol["id"]); ?>" style="color:#03C">修改</a>&nbsp;<a href="__APP__/productManagement/productAptitudeFunDel/id/<?php echo ($vol["id"]); ?>" style="color:#03C">删除</a></td>
      </tr><?php endforeach; endif; else: echo "" ;endif; ?>
  </table>
</div>
<script>
</script>
</body>
</html>