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
      <td style="text-align:right"><a href="__APP__/productManagement/productClassifyAdd/" class="button1">添加分类</a></td>
    </tr>
  </tbody></table>
  <table width="99%" border="0" cellpadding="0" cellspacing="0" style=" margin-bottom:5px;" >
    <tr>
      <td style="background:url(__PUBLIC__images/a10.gif) repeat-x; height:26px; text-align:left" colspan="9">文档列表</td>
    </tr>
    <tr bgcolor="#fbfce2">
      <td  >类别名称</td>
       <td width="120">产品属性-<a href="__APP__/productManagement/attributeList"  style="color:#03C">共有属性</a></td>
      <td width="170">操作</td>
    </tr>
    <?php if(is_array($class)): $i = 0; $__LIST__ = $class;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><tr>
        <td height="30" style="text-align:left; background:url(/admin/Tpl/public/images/a12.png) 10px center no-repeat #f0f0f0; padding-left:35px; "><?php echo ($vol["title"]); ?></td>
           <td  style="background:#f0f0f0"><a href="__APP__/productManagement/attributeList/product_classify_id/<?php echo ($vol["product_classify_id"]); ?>"  style="color:#03C">属性</a></td>
        <td style="background:#f0f0f0"><a href="__APP__/productManagement/productClassifyAdd/product_classify_id/<?php echo ($vol["product_classify_id"]); ?>" style="color:#03C">添加类</a> &nbsp;&nbsp;&nbsp;<a href="__APP__/productManagement/productClassifySave/product_classify_id/<?php echo ($vol["product_classify_id"]); ?>" style="color:#03C">名称修改</a></td>
      </tr>
      <?php if(is_array($vol["class2"])): $i = 0; $__LIST__ = $vol["class2"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol2): $mod = ($i % 2 );++$i;?><tr>
          <td height="30" style="text-align:left; background:url(/admin/Tpl/public/images/a12.png) 30px center no-repeat; padding-left:55px;">小类：<?php echo ($vol2["title"]); ?></td>
           <td><a href="__APP__/productManagement/attributeList/product_classify_id/<?php echo ($vol2["product_classify_id"]); ?>"  style="color:#03C">属性</a></td>
        <td><a href="__APP__/productManagement/productClassifyAdd/product_classify_id/<?php echo ($vol2["product_classify_id"]); ?>" style="color:#03C">添加类</a>&nbsp;&nbsp;&nbsp; <a href="__APP__/productManagement/productClassifyFunDel/product_classify_id/<?php echo ($vol2["product_classify_id"]); ?>" style="color:#03C">删除</a>&nbsp;&nbsp;&nbsp; <a href="__APP__/productManagement/productClassifySave/product_classify_id/<?php echo ($vol2["product_classify_id"]); ?>" style="color:#03C">名称修改</a>
        
        </td>
        </tr>
        <?php if(is_array($vol2["class3"])): $i = 0; $__LIST__ = $vol2["class3"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol3): $mod = ($i % 2 );++$i;?><tr>
            <td height="30" style="text-align:left; background:url(/admin/Tpl/public/images/a12.png) 50px center no-repeat; padding-left:75px; color:#666">---子类：<?php echo ($vol3["title"]); ?> 产品 数量 <?php echo ($vol3["num"]); ?></td>
           <td><a href="__APP__/productManagement/attributeList/product_classify_id/<?php echo ($vol3["product_classify_id"]); ?>"  style="color:#03C">属性</a></td>
        <td><a href="__APP__/productManagement/productClassifyFunDel/product_classify_id/<?php echo ($vol2["product_classify_id"]); ?>" style="color:#03C">删除</a> &nbsp;&nbsp;&nbsp;<a href="__APP__/productManagement/productClassifySave/product_classify_id/<?php echo ($vol3["product_classify_id"]); ?>" style="color:#03C">名称修改</a></td>
          </tr><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
  </table>
</div>
</script>
</body>
</html>