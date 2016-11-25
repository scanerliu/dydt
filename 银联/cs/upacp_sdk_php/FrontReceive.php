<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<body>
<?php 

              $mysql_server_name='localhost'; //改成自己的mysql数据库服务器
                 $mysql_username='root'; //改成自己的mysql数据库用户名
                 $mysql_password='root33068'; //改成自己的mysql数据库密码
                $mysql_database='pharmacy'; //改成自己的mysql数据库名
 				 $conn=mysql_connect($mysql_server_name,$mysql_username,$mysql_password); //连接数据库
                 mysql_query("set names 'utf8'"); //数据库输出编码
                 mysql_select_db($mysql_database); //打开数据库
                  $sql = "select order_id from `order`  where order_num ='$_POST[orderId]'  ";
                 $result=mysql_query($sql);
 				 $data=mysql_fetch_row($result);
                  mysql_close(); //关闭MySQL连接	

 ?>
  <form action="/order/orderDetail2_mid/order_id/<?php  echo  $data[0]; ?>" method="post" name="form">
  </form>
<script type="text/javascript">
  form.submit();
</script>
</body>
</html>

