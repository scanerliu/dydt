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
      <tr style="background:url(/admin/Tpl/public/images/a10.gif) repeat-x; height:36px;" class="status">
        <td style="text-align:left; line-height:24px;"><form  action="/admin.php/system/admin_rightFun_add" method="post" name="form" >
              用户名   <input name="name" type="text"  class="input1"/> &nbsp;&nbsp;&nbsp;   密码   <input name="password" type="text"  class="input1"/>&nbsp;&nbsp;&nbsp;权限 &nbsp;首页 <input name="right1" type="checkbox" value="1" />&nbsp;&nbsp;&nbsp;商品 <input name="right2" type="checkbox"  value="1"  />&nbsp;&nbsp;&nbsp;订单 <input name="right3" type="checkbox"  value="1"  />&nbsp;&nbsp;&nbsp;管理 <input name="right4" type="checkbox"  value="1"  />&nbsp;&nbsp;&nbsp;新闻 <input name="right5" type="checkbox"  value="1"  />&nbsp;&nbsp;&nbsp;金牌 <input name="right6" type="checkbox"  value="1"  />&nbsp;&nbsp;&nbsp;
            <a class="button1" onclick="form.submit()">提交</a>
          </form></td>
      </tr>
    </tbody>
  </table>
   <table width="99%" border="0" cellpadding="0" cellspacing="0" style=" margin-bottom:5px;" >
    <tr>
      <td style="background:url(__PUBLIC__images/a10.gif) repeat-x; height:26px; text-align:left" colspan="9">文档列表</td>
    </tr>
    <tr bgcolor="#fbfce2">
      <td height="30" width="">用户名</td>
      <td width="">用户权限</td>
      <td width="">操作</td>
    </tr>
    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><tr>
        <td height="30"><?php echo ($vol["name"]); ?></td>
        <td>
        <?php if($vol[right1]): ?>首页&nbsp;&nbsp;&nbsp;<?php endif; ?> <?php if($vol[right2]): ?>商品&nbsp;&nbsp;&nbsp;<?php endif; ?> <?php if($vol[right3]): ?>订单&nbsp;&nbsp;&nbsp;<?php endif; ?> <?php if($vol[right4]): ?>管理&nbsp;&nbsp;&nbsp;<?php endif; ?> <?php if($vol[right5]): ?>新闻&nbsp;&nbsp;&nbsp;<?php endif; ?> <?php if($vol[right6]): ?>金牌&nbsp;&nbsp;&nbsp;<?php endif; ?>
         </td>
       <td><a href="/admin.php/system/admin_rightFun_del/name/<?php echo ($vol["name"]); ?>">删除</a></td>
      </tr><?php endforeach; endif; else: echo "" ;endif; ?>
   </table>
</div>
</body>
</html>