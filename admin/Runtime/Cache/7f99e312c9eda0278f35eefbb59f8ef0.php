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
    <tbody><tr style="background:url(/admin/Tpl/public/images/a10.gif) repeat-x; height:36px;" class="status">
      <td style="text-align:right">
      <a href="__APP__/manage/suggest/" class="button1">全部</a>
      <a href="__APP__/manage/suggest/status/1" class="button1">未处理</a>
      <a href="__APP__/manage/suggest/status/2" class="button1">已处理</a>
   </tr>
  </tbody></table>
  <script type="text/javascript">
     <?php if($_GET['status']): ?>$('.status a').eq(<?php echo ($_GET['status']); ?>).css('color','#06C')
    <?php else: ?> $('.status a').eq(0).css('color','#06C')<?php endif; ?>
    </script>
  <table width="99%" border="0" cellpadding="0" cellspacing="0" style="margin-bottom:5px;" >
    <tr>
      <td style="background:url(__PUBLIC__images/a10.gif) repeat-x; height:26px; text-align:left" colspan="10">建议列表
        <label style="padding-left:33px;">搜索类别</label>
        <?php if($keyv == 2): ?><select id="key">
                  <option value="1">投诉人</option>
                  <option value="2" selected="true">联系电话</option>
                  <option value="3">投诉内容</option>
              </select>
          <?php elseif($keyv == 3): ?>
              <select id="key">
                  <option value="1">投诉人</option>
                  <option value="2">联系电话</option>
                  <option value="3" selected="true">投诉内容</option>
              </select>
          <?php else: ?>
              <select id="key">
                  <option value="1">投诉人</option>
                  <option value="2">联系电话</option>
                  <option value="3">投诉内容</option>
              </select><?php endif; ?>
          <label id="kw" style="margin-left:9px;">搜索关键字</label>
          <input type="text" id="keyword" placeholder="请输入搜索关键字" value="<?php echo ($keyword); ?>" />
          <input type="submit" style="width:60px;" onclick="ss()" value="搜索">
      </td>  
    </tr>
    <tr bgcolor="#fbfce2">
      <td style="width:320px;">内容</td>
      <td>提交时间</td>
      <td>用户名</td>
      <td>手机</td>
      <td>email</td>
      <td>QQ</td>
      <td>操作</td>
      <td style="color:#db6969">处理人</td>
      <td style="color:#db6969;width:320px;">处理内容</td>
      <td style="color:#db6969">处理时间</td>
    </tr>
    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
      <td><?php echo ($vo["note"]); ?></td>
      <td><?php echo (date('Y-m-d H:i:s',$vo["date"])); ?></td>
      <td><?php echo ($vo["user_name"]); ?></td>
      <td><?php echo ($vo["mobile_phone"]); ?></td> 
      <td><?php echo ($vo["email"]); ?></td>
      <td><?php echo ($vo["qq"]); ?></td>
      <?php if($vo['status'] == 0): ?><td><a onclick="alertpro()" name="<?php echo ($vo["id"]); ?>" style="color:#db6969;cursor:pointer" id="alertpro">回复</td>
      <?php else: ?>
        <td>已处理</td><?php endif; ?>
      <td style="color:#db6969"><?php echo ($vo["back_admin"]); ?></td>
      <td style="color:#db6969"><?php echo ($vo["back"]); ?></td>
      <td style="color:#db6969">
        <?php if($vo["back_date"] != null): echo (date('Y-m-d H:i:s',$vo["back_date"])); endif; ?>
      </td>
    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    <tr>
    </tr>
  </table>
</div>
<div style="margin-left:40%;margin-top:30%;"><?php echo ($page); ?></div>

<script type="text/javascript">
  function ss () {
    var key=document.getElementById('key').value;
    var keyword=document.getElementById('keyword').value;
    window.location.href="__APP__/manage/suggest/key/"+key+"/keyword/"+keyword;
  }

  function alertpro () {
      var alertpro = document.getElementById('alertpro');
      var name=prompt("请输入回复内容（注：回复不能为空）","");
      if (name!=null && name!="") {
        alertpro.href = "__APP__/manage/suggest_cl/id/"+alertpro.name+"/name/"+name;
        alertpro.onclick = "";
        alertpro.click();
      }
  }
</script>
</body>
</html>