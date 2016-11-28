<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<style type="text/css">
* { line-height:22px; font-size:14px; margin:0px; padding:0px; color:#000; font-family:'微软雅黑'; }
.ibody { width:800px; margin:10px auto; border:1px solid #d4d4d4; padding:10px  20px;; }
.a1 { font-size:30px; text-align:center; color:#F00; line-height:60px; margin-top:30px; font-weight:bold }
.a2 { text-align:center; margin-bottom:20px; color:#a7a7a7 }
.a4 { color:#09F; margin-top:10px; }
#canvas { border: 1px solid #d8d8d8; }
.a5 {   }
.a5 .p1 { background:#CCC; border-radius:5px; text-align:center; height:40px; line-height:40px; color:#FFF; margin-top:15px; width:390px; float:right; cursor:pointer }
.a5 .p2 { background: #F00; border-radius:5px; text-align:center; height:40px; line-height:40px; color:#FFF; margin-top:15px; width:390px; float:left; cursor:pointer  }
.clear { height:0px; overflow:hidden; clear:both }
</style>
</head>
<body>
<div class="ibody">
  <div class="a1">单体药店 药品购买合同</div>
  <div class="a2">签署时间 <?php echo (date('Y年m月d日 H:i:s',$data["contract_3"])); ?></div>
  <div>
     <?php echo (stripslashes($data["contract_1"])); ?>
     </div>
  <div class="a4">客户签名</div>
  <div class="a5">
  <img src="<?php echo ($data["contract_2"]); ?>" style="width:600px; height:200px;"/></div>
  <!--a5--> 
</div>

</body>
</html>