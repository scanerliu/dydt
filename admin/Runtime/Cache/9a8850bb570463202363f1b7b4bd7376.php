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
   
  <table width="99%" border="0" cellpadding="0" cellspacing="0" style=" margin-bottom:5px;" >
    <tr>
      <td style="background:url(__PUBLIC__images/a10.gif) repeat-x; height:26px; text-align:left" colspan="9">
         <form action="__APP__/productManagement/discount" method="get" name='form'>
       未过期的打折产品   <input name="keyword" type="text"  class="input1" style="width:300px;"  placeholder="请输入货号\批准文号\通用名称\商品名\厂家"   value="<?php echo ($_GET['keyword']); ?>"/> <a class="button1" onclick="form.submit()" >提交</a> 
      </form>
        </td>	
    </tr>
    <tr bgcolor="#fbfce2">
      <td height="30" width="50">id</td>
      <td >产品名称</td>
      <td width="130">缩略图</td>
        <td>开始时间</td>
        <td >结束时间</td>
        <td >折扣价格</td>
       <td width="100">链接地址;</td>
      <td width="100">管理地址</td>
      <td width="100">操作</td>
    </tr>
    <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><tr>
        <td height="30"><?php echo ($vol["product_id"]); ?></td>
        <td><?php echo ($vol["title"]); ?></td>
         <td><a   href="/Uploads/<?php echo ($vol["img"]); ?>" target="_new" ><img src="/Uploads/<?php echo ($vol["img"]); ?>" width="120" /></a></td>
          <td>
          <?php echo (date('Y年m月d日',$vol["discount_beg_time"])); ?>
          </td>
        <td><?php echo (date('Y年m月d日',$vol["discount_end_time"])); ?></td>
         <td ><?php echo ($vol["price3"]); ?></td>
        <td><a href="/shop/content/product_id/<?php echo ($vol["product_id"]); ?>" target="_blank" style="color:#06C">链接</a></td>
        <td><a href="__APP__/productManagement/productSave/product_id/<?php echo ($vol["product_id"]); ?>/class1/<?php echo ($vol["class1"]); ?>/class2/<?php echo ($vol["class2"]); ?>/class3/<?php echo ($vol["class3"]); ?>" target="_blank" style="color:#06C">链接</a></td>
        <td><a href="__APP__/productManagement/discountFun/product_id/<?php echo ($vol["product_id"]); ?>" style="color:#03C">取消打折</a></td>
      </tr><?php endforeach; endif; else: echo "" ;endif; ?>
  </table>
</div>
</body>
</html>