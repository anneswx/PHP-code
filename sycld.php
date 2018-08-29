<?php 
session_start(); 
$username=$_SESSION['username'];
$id=$_GET['id'];
?>
<?php virtual('/phpweb/Connections/webconn.php'); ?>
<?php

mysql_select_db($database_webconn, $webconn);
$query_Recordset1 = "SELECT * FROM useapply where (applystate='审批通过' and usedstate='未提交' and username='$username')";
$Recordset1 = mysql_query($query_Recordset1, $webconn) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
	
?>


<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>无标题文档</title>
<link rel="stylesheet" href="css/table.css">
</head>

<body>
<form id="form1" name="form1" method="post" action="usedproduct.php">
  <table width="1008" border="1">
  
    <caption>
      使用处理
    </caption>
   <tr>
      <th width="125">申请单编号</th>
      <th width="100">日期</th>
      <th width="86">领用人</th>
      <th width="107">商品编号</th>
      <th width="84">品种</th>
      <th width="277">实验室</th>
      <th width="104">领用数量</th>
      <th width="73">剩余数量</th>
    </tr>
    <?php do { ?>
      <tr>
        <td><?php echo $row_Recordset1['id']; ?></td>
        <td><?php echo $row_Recordset1['date']; ?></td>
        <td><?php echo $row_Recordset1['username']; ?></td>
        <td><?php echo $row_Recordset1['productid']; ?></td>
        <td><?php echo $row_Recordset1['name']; ?></td>
        <td><?php echo $row_Recordset1['lab']; ?></td>
        <td><?php echo $row_Recordset1['usenum']; ?></td>
        <td><input type="text" name="<?php echo $row_Recordset1['id'];?>" ></td>
      </tr>
      <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
  </table>
  <input name="submit" id="submit" type="submit" value="提交">
</form>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
