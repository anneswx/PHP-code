<?php virtual('/phpweb/Connections/webconn.php'); ?>
<?php
 session_start(); 
$username=$_SESSION['username'];
$userid=$_SESSION['userid']; 
date_default_timezone_set('Etc/GMT-8');
    $year=date("Y");

$cdate=$_GET['cdate'];
mysql_select_db($database_webconn, $webconn);
if (isset($_GET['submit'])) {
	$query_Recordset1 = "SELECT * FROM useapply WHERE userid='$userid' and year(date)='$year' and month(date)='$_GET[cdate]' order by date";
}
else{
$query_Recordset1 = "SELECT * FROM useapply WHERE userid='$userid' and year(date)='$year' order by date";}
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
<form id="form2" name="form2" method="get" action="">
请选择月份：
  <select name="cdate" id="cdate">
   <?php
for($i=1;$i<=12;$i++) {  
?>
    <option value="<?php echo $i;?>"<?php if ($i==$_GET['cdate']) {echo "selected=\"selected\"";} ?>><?php echo $i;?></option>
    <?php
} 
?>
  </select>
  月
   <input type="submit" name="submit" id="submit" value="查询" />
   <a href="/phpweb/queryapply.php">查看全部 </a>
</form>
<form id="form1" name="form1" method="post" action="">
  <table width="900" border="1">
    <caption>
     <input type="hidden" name="username" id="username" value="<?php $username=$_SESSION['username']; ?> " /> <?php echo $year."年";?>个人易耗品领用记录
    </caption>
    <tr>
      <th>日期
        <label for="cdate"></label></th>
      <th>领用人</th>
      <th>物品编号</th>
      <th>品种
        <label for="cname"></label></th>
      <th>领用数量</th>
      <th>实验室</th>
      <th>领用申请单状态</th>
    </tr>
    <?php do { ?>
      <tr>
        <td><?php echo $row_Recordset1['date']; ?></td>
        <td><?php echo $row_Recordset1['username']; ?></td>
        <td><?php echo $row_Recordset1['productid']; ?></td>
        <td><?php echo $row_Recordset1['name']; ?></td>
        <td><?php echo $row_Recordset1['usenum']; ?></td>
        <td><?php echo $row_Recordset1['lab']; ?></td>
        <td><?php echo $row_Recordset1['applystate']; ?></td>
      </tr>
      <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
  </table>
</form>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
