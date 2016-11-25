<?php
include_once $_SERVER ['DOCUMENT_ROOT'] . '/upacp_sdk_php/utf8/func/common.php';
include_once $_SERVER ['DOCUMENT_ROOT'] . '/upacp_sdk_php/utf8/func/secureUtil.php';
?>
<!DOCTYPE unspecified PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>响应页面</title>

<style type="text/css">
body table tr td {
	font-size: 14px;
	word-wrap: break-word;
	word-break: break-all;
	empty-cells: show;
}
</style>
</head>
<body>
	<table width="800px" border="1" align="center">
		<tr>
			<th colspan="2" align="center">响应结果</th>
		</tr>
	
			<?php
			foreach ( $_POST as $key => $val ) {
				?>
			<tr>
			<td width='30%'><?php echo isset($mpi_arr[$key]) ?$mpi_arr[$key] : $key ;?></td>
			<td><?php echo $val ;?></td>
		</tr>
			<?php }?>
			<tr>
			<td width='30%'>验证签名</td>
			<td><?php			
			if (isset ( $_POST ['signature'] )) {
				
				echo verify ( $_POST ) ? '验签成功' : '验签失败';
				$orderId = $_POST ['orderId']; //其他字段也可用类似方式获取
				$respCode = $_POST ['respCode']; //判断respCode=00或A6即可认为交易成功
 				if( $respCode==00 or $respCode=='A6'){
				
				$mysql_server_name='localhost'; //改成自己的mysql数据库服务器
                 $mysql_username='root'; //改成自己的mysql数据库用户名
                 $mysql_password='root33068'; //改成自己的mysql数据库密码
                $mysql_database='pharmacy'; //改成自己的mysql数据库名
 				 $conn=mysql_connect($mysql_server_name,$mysql_username,$mysql_password); //连接数据库
                 mysql_query("set names 'utf8'"); //数据库输出编码
                 mysql_select_db($mysql_database); //打开数据库
				 $time=time();
                 $sql = "UPDATE  `order` SET  `status` = 2 , time2=$time  where order_num = '$_POST[orderId]'";
                 mysql_query($sql);
                 mysql_close(); //关闭MySQL连接	
  			 	//如果卡号我们业务配了会返回且配了需要加密的话，请按此方法解密
                //if(array_key_exists ("accNo", $_POST)){
				//	$accNo = decryptData($_POST["accNo"]);
				//}
				}
			} else {
				echo '签名为空';
			}
			
			
 
			
			
			
			?>
            
            
            </td>
		</tr>
	</table>
</body>
</html>
