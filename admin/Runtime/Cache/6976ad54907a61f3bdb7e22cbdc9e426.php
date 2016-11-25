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
    <tbody>
      <tr style="background:url(/admin/Tpl/public/images/a10.gif) repeat-x; height:36px;">
        <td style="text-align:left; line-height:24px;"><form  action="/admin.php/order/message" method="get" name="form" >
              <div style="float:left">留言检索
              <input  type="text"  class="input1" style="width:300px;"  placeholder="请输入订单号\用户名" name="keyword" value="<?php echo ($_GET['keyword']); ?>"/>
            </div> &nbsp; <a class="button1" onclick="form.submit()">提交</a>
          </form></td>
      </tr>
    </tbody>
  </table>
     <table width="99%" border="0" cellpadding="0" cellspacing="0" style=" margin-bottom:5px;" >
    <tr>
      <td style="background:url(__PUBLIC__images/a10.gif) repeat-x; height:26px; text-align:left" colspan="9">文档列表</td>
    </tr>
    <tr bgcolor="#fbfce2">
      <td height="30" width="100">订单号</td>
      <td width="">留言内容</td>
       <td width="160">留言时间</td>
       <td width="150">回复内容</td>
       <td width="50">产品详情</td>
       <td width="50">订单详情</td>
       <td width="50">操作1</td>
       <td width="50">操作2</td>
    </tr>
    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><form action="/admin.php/order/messageFunReply/comment_id/<?php echo ($vol["comment_id"]); ?>" method="get"  name='form<?php echo ($vol["comment_id"]); ?>'>
        <tr>
        <td height="30"><?php echo ($vol["order_num"]); ?></td>
        <td><?php echo ($vol["content"]); ?></td>
        <td> <?php echo (date('Y年m月d日 H:i:s',$vol["time"])); ?></td>
        <td><textarea name="reply"  style="width:200px; border:1px solid  #D9D9D9; height:70px; padding:5px;"><?php echo ($vol["reply"]); ?></textarea></td>
         <td><a href="/shop/content/product_id/<?php echo ($vol["product_id"]); ?>" target="_blank" style="color:#06C">链接</a></td>
        <td><a href="/admin.php/order/orderDetail/order_id/<?php echo ($vol["order_id"]); ?>" target="_blank" style="color:#06C" >链接</a></td>
        <td><a style="color:#03C; cursor:pointer" onclick="form<?php echo ($vol["comment_id"]); ?>.submit()">确认</a></td>
        <td><a style="color:#03C;" href="/admin.php/order/messageFunDel/comment_id/<?php echo ($vol["comment_id"]); ?>">删除</a></td>
      </tr>
      </form><?php endforeach; endif; else: echo "" ;endif; ?>
    <tr>
      <td  colspan="9" bgcolor="#fbfce2"  height="36" class="feny"><?php echo ($page); ?></td>
    </tr>
  </table>
</div>
</body>
</html>