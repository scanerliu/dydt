<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="__PUBLIC__css/indexManagement/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="__PUBLIC__js/jquery.1.10.js"></script>
<script type="text/javascript" src="__PUBLIC__js/check.js"></script>
 </head>
<body>
 <div class="bannerList">
   <table  width="99%" border="0" cellpadding="0" cellspacing="0" style=" margin-bottom:5px;" >
    <tr style="background:url(__PUBLIC__images/a10.gif) repeat-x; height:36px;">
       <td style="text-align:right"> 
       <form action="__APP__/system/expressFeeListFunAdd" method="post" name="form">
        <select  name="area" ><option value="北京市">北京市</option><option value="天津市">天津市</option><option value="上海市">上海市</option><option value="重庆市">重庆市</option><option value="河北省">河北省</option><option value="山西省">山西省</option><option value="内蒙古">内蒙古</option><option value="辽宁省">辽宁省</option><option value="吉林省">吉林省</option><option value="黑龙江省">黑龙江省</option><option value="江苏省">江苏省</option><option value="浙江省">浙江省</option><option value="安徽省">安徽省</option><option value="福建省">福建省</option><option value="江西省">江西省</option><option value="山东省">山东省</option><option value="河南省">河南省</option><option value="湖北省">湖北省</option><option value="湖南省">湖南省</option><option value="广东省">广东省</option><option value="广西">广西</option><option value="海南省">海南省</option><option value="四川省">四川省</option><option value="贵州省">贵州省</option><option value="云南省">云南省</option><option value="西藏">西藏</option><option value="陕西省">陕西省</option><option value="甘肃省">甘肃省</option><option value="青海省">青海省</option><option value="宁夏">宁夏</option><option value="新疆">新疆</option><option value="香港">香港</option><option value="澳门">澳门</option><option value="台湾省">台湾省</option></select>
   &nbsp;<input name="fee" type="text" class="input1"  placeholder="快递费"    my_check='number_need'  value=""  error='快递费错误'/>&nbsp;<a href="javascript:void(0)" class="button1" onclick="if(!my_check()){return}; form.submit();">设置</a>
        </form>
     </td>
    </tr>
  </table>
     <table width="99%" border="0" cellpadding="0" cellspacing="0" style=" margin-bottom:5px;" >
    <tr>
      <td style="background:url(__PUBLIC__images/a10.gif) repeat-x; height:26px; text-align:left" colspan="9">文档列表</td>
    </tr>
    <tr bgcolor="#fbfce2">
      <td  width="100">省份</td>
       <td >金额</td>
       <td width="100">操作</td>
    </tr>
     <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><tr>
      <td ><?php echo ($vol["area"]); ?></td>
       <td><?php echo ($vol["fee"]); ?></td>
      <td><a href="__APP__/system/expressFeeListFunDel/area/<?php echo ($vol["area"]); ?>" style="color:#03C">删除</a></td>
    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
       <tr>
     </tr>
  </table>
  
</div>

</script>
</body>
</html>