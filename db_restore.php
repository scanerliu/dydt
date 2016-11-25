 <?php session_start(); ?>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <?php 
  if(!@$_SESSION[admin_name]){
	echo '权限错误';
	return;
 	}
  ?>

<?php
set_time_limit(0);//设置超时时间
// Name of the file
$filename = './backup/pharmacy.sql';
// MySQL host
$mysql_host = 'localhost';
// MySQL username
$mysql_username = 'root';
// MySQL password
$mysql_password = 'root33068';
// Database name
$mysql_database = 'pharmacy';

// Connect to MySQL server
mysql_connect($mysql_host, $mysql_username, $mysql_password) or die('Error connecting to MySQL server: ' . mysql_error());
// Select database
mysql_select_db($mysql_database) ;

// Temporary variable, used to store current query
$templine = '';
// Read in entire file
$lines = file($filename);
// Loop through each line
foreach ($lines as $line)
{
// Skip it if it's a comment
if (substr($line, 0, 2) == '--' || $line == '')
    continue;

// Add this line to the current segment
$templine .= $line;
// If it has a semicolon at the end, it's the end of the query
if (substr(trim($line), -1, 1) == ';')
{
    // Perform the query
    mysql_query("set names utf8"); 
    mysql_query($templine) or print('Error performing query \'<strong>' . $templine . '\': ' . mysql_error() . '<br /><br />');
    // Reset temp variable to empty
    $templine = '';
}
}
 echo "Tables imported successfully";
?>

<script language="javascript" type="text/javascript"> 
function loaction(){
	self.location='/admin.php/system/Database'; 
	}
 setTimeout('loaction()',2000);
</script> 








