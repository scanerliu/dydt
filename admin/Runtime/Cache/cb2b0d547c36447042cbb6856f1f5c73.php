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
      <td style="background:url(__PUBLIC__images/a10.gif) repeat-x; height:26px; text-align:left" colspan="9">认证列表 
          <input style="margin-left:100px;" type="text" placeholder="请输入要添加的认证类型..." id="doc_type" name="doc_type">
          <input style="width:80px;" type="button" onclick="add()" value="添加">
      </td>
    </tr>
    <tr bgcolor="#fbfce2">
      <td>认证ID</td>
      <td>认证类型</td>
      <td>身份</td>
      <td>是否必要</td>
      <td>操作</td>
    </tr>
    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
      <td><?php echo ($vo["id"]); ?></td>
      <td><?php echo ($vo["doc_type"]); ?></td>
      <td>
        <?php if($vo["identity"] == 1): ?><a href="__APP__/manage/doc_ids/id/<?php echo ($vo["id"]); ?>/identity/0">通用</a>
         <a href="__APP__/manage/doc_ids/id/<?php echo ($vo["id"]); ?>/identity/1" style="color:#db6969">诊所</a>
         <a href="__APP__/manage/doc_ids/id/<?php echo ($vo["id"]); ?>/identity/2">药房</a>
        <?php elseif($vo["identity"] == 2): ?>
          <a href="__APP__/manage/doc_ids/id/<?php echo ($vo["id"]); ?>/identity/0">通用</a>
          <a href="__APP__/manage/doc_ids/id/<?php echo ($vo["id"]); ?>/identity/1">诊所</a>
          <a href="__APP__/manage/doc_ids/id/<?php echo ($vo["id"]); ?>/identity/2" style="color:#db6969">药房</a>
        <?php else: ?>
          <a href="__APP__/manage/doc_ids/id/<?php echo ($vo["id"]); ?>/identity/0" style="color:#db6969">通用</a>
          <a href="__APP__/manage/doc_ids/id/<?php echo ($vo["id"]); ?>/identity/1">诊所</a>
          <a href="__APP__/manage/doc_ids/id/<?php echo ($vo["id"]); ?>/identity/2">药房</a><?php endif; ?>
      </td>
      <td>
        <?php if($vo["status"] == 1): ?>是
        <?php else: ?>
          否<?php endif; ?>
      </td>
      <td>
        <a href="__APP__/manage/del_doc/id/<?php echo ($vo["id"]); ?>">删除</a>
        <?php if($vo["status"] == 1): ?><a href="__APP__/manage/down_doc/id/<?php echo ($vo["id"]); ?>" style="margin-left:20px;">取消必要</a>
        <?php else: ?>
          <a href="__APP__/manage/up_doc/id/<?php echo ($vo["id"]); ?>" style="margin-left:20px;color:#db6969">设为必要</a><?php endif; ?>
      </td>
    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    <tr>
    </tr>
  </table>
</div>
<div style="margin-left:40%;margin-top:30%;"><?php echo ($page); ?></div>
<script type="text/javascript">
  function add() {
    var doc_type=document.getElementById('doc_type').value;
    if (doc_type=="") {
      alert("认证类型不能为空！");
    } else {
      window.location.href="__APP__/manage/add_doc/doc_type/"+doc_type;
    } 
  }
</script>
</body>
</html>