<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<style type="text/css">
body {
	background-color:  #313A53;
}
a:link {
	color: #FFF;
}
a:visited {
	color: #FFF;
}
</style>
</head>

<body>
<table>
<tr>
<td width="50" height="50" ></td>
<td width="500" height="50" style="font-weight:bold;font-size:20px;color:#fff;">学院实验室易耗品管理系统
</td>
<td width="200" height="50" style="font-weight:bold;font-size:15px;color:#fff;" >
用户名：<?php 
$username=$_SESSION['username'];
echo "$username";
?>
</td>
<td width="200" height="50" style="font-weight:bold;font-size:15px;color:#fff;" >
权限：<?php 
virtual('/phpweb/Connections/webconn.php');
$userid=$_SESSION['userid'];
mysql_select_db($database_webconn, $webconn);
$query1= "SELECT * FROM user where userid='$userid'";
$result1= mysql_query($query1, $webconn);
$row1 = mysql_fetch_assoc($result1);
if($row1['supervisor']==1){$authority="超级管理员";}
else if($row1['admin']==1){$authority="管理员";}
else if($row1['dean']==1){$authority="主任";}
else{$authority="教师";} echo $authority; ?>

</td>

<td width="500" style="font-weight:bold;font-size:15px;color:#fff;">
<?php
echo "现在时间是： ";
date_default_timezone_set('Etc/GMT-8');
echo date("Y-m-d");
?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="/phpweb/index.php" target="_top">退出登录 </a>
</td>
</tr>
</table>



</body>
</html>
