<?php 

//引入发送邮件类
require("smtp.php"); 
//使用163邮箱服务器
$smtpserver = "smtp.yeah.net";
//163邮箱服务器端口 
$smtpserverport = 25;
//你的163服务器邮箱账号
$smtpusermail = "xinlaipsy@yeah.net";
//收件人邮箱
$smtpemailto = $_GET['smtpemailto'];
//你的邮箱账号(去掉@163.com)
$smtpuser = "xinlaipsy";//SMTP服务器的用户帐号 
//你的邮箱密码
$smtppass = "qzmpodqlxgpzatvl"; //SMTP服务器的用户密码
 
//邮件主题 
$mailsubject = $_GET['mailsubject'];
//邮件内容 
$mailbody = stripslashes($_GET['mailbody']);
//邮件格式（HTML/TXT）,TXT为文本邮件 
$mailtype = "HTML";
//这里面的一个true是表示使用身份验证,否则不使用身份验证. 
$smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);
//是否显示发送的调试信息 
$smtp->debug = false;

  //发送邮件
 $smtp->sendmail($smtpemailto, $smtpusermail, $mailsubject, $mailbody, $mailtype); 
 
?>












