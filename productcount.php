<?php
virtual('/phpweb/Connections/webconn.php'); 

mysql_select_db($database_webconn, $webconn);
$query_Recordset1 = "SELECT * FROM product ORDER BY `count` DESC";
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
<form id="form2" name="form2" method="POST">

  <table width="1043" border="1">
    <caption>易耗品领用统计
    </caption>
    <tr>
      <th width="95">排名</th>
      <th width="135">物品编号</th>
      <th width="109">品种</th>
      <th width="112">品牌</th>
      <th width="99">型号规格</th>
      <th width="98">单位</th>
      <th width="122">库存量</th>
      <th width="110">预估单价</th>
      <th width="65">领用量</th>
    </tr>
    <?php $rank=1; do { ?>
      <tr>
        <td><?php echo $rank; ?></td>
        <td><?php echo $row_Recordset1['productid']; ?></td>
        <td><?php echo $row_Recordset1['name']; ?></td>
        <td><?php echo $row_Recordset1['brand']; ?></td>
        <td><?php echo $row_Recordset1['size']; ?></td>
        <td><?php echo $row_Recordset1['unit']; ?></td>
        <td><?php echo $row_Recordset1['number']; ?></td>
        <td><?php echo $row_Recordset1['unitprice']; ?></td>
        <td><?php echo $row_Recordset1['count']; ?></td>
      </tr>
      <?php $rank=$rank+1;} while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
  </table>
  
</form>
<form id="form3" name="form3" method="POST">
<img src="chartcount.php" name="chartcount" width="500" height="400" id="chartcount" />
</form>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
