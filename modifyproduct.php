<?php
virtual('/phpweb/Connections/webconn.php');
$productid=$_GET['productid'];
mysql_select_db($database_webconn, $webconn);
$query_rsproduct = "SELECT * FROM product where productid='$productid'";
$rsproduct = mysql_query($query_rsproduct, $webconn);
$row1 = mysql_fetch_assoc($rsproduct);


$name=$_POST['name'];
$brand=$_POST['brand'];
$size=$_POST['size'];
$unit=$_POST['unit'];
$number=$_POST['number'];
$unitprice=$_POST['unitprice'];

if (isset($_POST['submit'])) {
	$query2="update product set name='$name',brand='$brand',size='$size',unit='$unit',number='$number',unitprice='$unitprice' where productid='$productid'";//插入数据
	
	$result2 = mysql_query($query2, $webconn);
	
	if($result2){ 
    echo"<script>alert('修改成功');location.href='product.php'</script>"; 
    }
	else{
	echo"<script>alert('修改失败');location.href='product.php'</script>"; 
		}
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>无标题文档</title>
<link rel="stylesheet" href="css/table.css">
</head>

<body>
<form id="form1" name="form1" method="POST">
  <table width="506" border="1">
    <caption>
      <?php echo $row1['name'];?>
    </caption>
    <tr>
      <th>物品编号</th>
      <td><?php echo $row1['productid']; ?></td>
      <th>品种</th>
      <td><input type="text" name="name" id="name" autofocus required value="<?php echo $row1['name']; ?>"/></td>
    </tr>
    <tr>
      <th>品牌</th>
      <td><input type="text" name="brand" required id="brand" value="<?php echo $row1['brand']; ?>"/></td>
      <th>型号规格</th>
      <td><input type="text" name="size" id="size" required value="<?php echo $row1['size']; ?>"/></td>
    </tr>
    <tr>
      <th width="96">单位</th>
      <td width="128"><input type="text" name="unit" id="unit" required value="<?php echo $row1['unit']; ?>"/></td>
      <th width="84">库存量</th>
      <td width="170"><input type="text" name="number" id="number" required value="<?php echo $row1['number']; ?>"/></td>
    </tr>
    <tr>
      <th>单价(元)</th>
      <td><input type="text" name="unitprice" id="unitprice" required value="<?php echo $row1['unitprice']; ?>"/></td>
      <td></td>
      <td></td>
    </tr>
  </table>
<input type="submit" name="submit" id="submit" value="修改" />
</form>


</body>
</html>
<?php
mysql_free_result($rsproduct);
?>
