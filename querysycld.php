<?php virtual('/phpweb/Connections/webconn.php'); 
date_default_timezone_set('Etc/GMT-8');
    $year=date("Y");
	
mysql_select_db($database_webconn, $webconn);
if (isset($_GET['submit'])) {
	$query_Recordset1 = "SELECT * FROM useapply WHERE   usedstate!='未提交' and month(date)='$_GET[cdate]' and year(date)='$year' ORDER BY date";
}
else{
$query_Recordset1 = "SELECT * FROM useapply where usedstate!='未提交' and year(date)='$year'";}
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
  <a href="/phpweb/querysycld.php">查看全部 </a>
</form>
<form id="form1" name="form1" method="post" action="">
  <table width="1165" border="1">
  
    <caption>
      使用处理单
    </caption>
    <tr>
      <th width="130">申请单编号</th>
      <th width="95">日期</th>
      <th width="86">领用人</th>
      <th width="107">商品编号</th>
      <th width="64">品种</th>
      <th width="104">领用数量</th>
      <th width="107">剩余数量</th>
      <th width="307">实验室</th>
      <th width="117">使用处理单状态</th>
    </tr>
    <?php do { ?>
      <tr>
        <td><?php echo $row_Recordset1['id']; ?></td>
        <td><?php echo $row_Recordset1['date']; ?></td>
        <td><?php echo $row_Recordset1['username']; ?></td>
        <td><?php echo $row_Recordset1['productid']; ?></td>
        <td><?php echo $row_Recordset1['name']; ?></td>
        <td><?php echo $row_Recordset1['usenum']; ?></td>
        <td><?php echo $row_Recordset1['remainnum']; ?></td>
        <td><?php echo $row_Recordset1['lab']; ?></td>
        <td><?php echo $row_Recordset1['usedstate']; ?></td>
      </tr>
      <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
  </table>
</form>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
