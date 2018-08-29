<?php virtual('/phpweb/Connections/webconn.php'); 

mysql_select_db($database_webconn, $webconn);
$query_Recordset1 = "SELECT distinct name FROM useapply where applystate='待审批'";
$Recordset1 = mysql_query($query_Recordset1, $webconn) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);


?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>无标题文档</title>
<link rel="stylesheet" href="css/table.css">
</head>

<body>
<form id="form3" name="form3"  action="">
  <a href="/phpweb/lysqspft.php">分条处理</a>
  <a href="/phpweb/lysqsp.php">批量处理</a>
</form>
<form id="form1" name="form1" method="get" action="">
  请选择品种：
  <label for="name"></label>
  <select name="name" id="name">
    <?php
do {  
?>
    <option value="<?php echo $row_Recordset1['name']?>"<?php if (!(strcmp($row_Recordset1['name'], $row_Recordset1['name']))) {echo "selected=\"selected\"";} ?>><?php echo $row_Recordset1['name']?></option>
    <?php
} while ($row_Recordset1 = mysql_fetch_assoc($Recordset1));
  $rows = mysql_num_rows($Recordset1);
  if($rows > 0) {
      mysql_data_seek($Recordset1, 0);
	  $row_Recordset1 = mysql_fetch_assoc($Recordset1);
  }
?>
  </select>
  <input type="submit" name="submit" id="submit" value="查询" />
  <a href="/phpweb/lysqspft.php">显示全部 </a>
</form>
<?php 
$name=$_GET['name'];  

if (isset($_GET['submit'])) { 
 $query1="select * from useapply where applystate='待审批' and name='$name'";}
else{$query1="select * from useapply where applystate='待审批'";}
 
 $result1 = mysql_query($query1, $webconn);

 $row1 = mysql_fetch_assoc($result1);
  
 
 
?>
<form id="form2" name="form2" method="post" action="">
  <table width="600" border="0">
<?php  if (isset($_GET['submit'])) { ?>
    <caption>
    品种：<?php echo $name; ?>
    </caption>
  <?php }?>  
      <tr>
        <th>申请单编号</th>
        <th>日期</th>
        <th>领用人</th>
        <th>实验室</th>
        <th>品种</th>
        <th>领用数量</th>
        <th>审批</th>
       
      </tr>
    <?php do{ ?>
      <tr>
        <td><?php echo $row1['id']; ?></td>
        <td><?php echo $row1['date']; ?></td>
        <td><?php echo $row1['username']; ?></td>
        <td><?php echo $row1['lab']; ?></td>
        <td><?php echo $row1['name']; ?></td>
        <td><?php echo $row1['usenum']; ?></td>
        <td><a href="/phpweb/lysqdsqft.php?id=<?php echo $row1['id'];?>">审批</a></td>
       
      </tr>
      
      <?php } while ($row1 = mysql_fetch_assoc($result1)); ?>
  </table>
  
  


</body>
</html>
<?php	  
mysql_free_result($Recordset1);
?>
