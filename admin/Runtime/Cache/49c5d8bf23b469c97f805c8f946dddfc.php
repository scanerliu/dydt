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
  <table  width="99%" border="0" cellpadding="0" cellspacing="0" style=" margin-bottom:5px;" >
    <tr >
      <td style="text-align:left">数据库备份时间:<?php echo (date('Y年m月d日 H:i:s',$db_save_time)); ?> &nbsp;&nbsp;&nbsp;<a href="/db_backup.php" class="button1">备份</a>&nbsp;&nbsp;&nbsp;<a href="/db_restore.php"  class="button1">还原</a>
       </td>
    </tr>
    <tr >
 
 


     
  </table>



</body>
</html>