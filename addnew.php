<?php
session_start();
date_default_timezone_set('Etc/GMT-8');
    $date=date("Y-m-d");
	$username=$_SESSION['username'];
	
	
if (isset($_POST['submit'])) {
    $productid = $_POST['productid'];
    $name = $_POST['name'];
	$brand = $_POST['brand'];
    $size = $_POST['size'];
	$unit = $_POST['unit'];
	$number = 0;
	$addnum = $_POST['number'];
	$unitprice = $_POST['unitprice'];
	$cardid = $_POST['cardid'];
	$addcost=$unitprice*$addnum;
	
    $conn = mysqli_connect('localhost', 'root', 'admin', 'system')
    or die('连接数据库出错');
    $query2="insert into addproduct (date,username,productid,name,brand,size,unit,number,unitprice,addnum,addcost,cardid)" .
        " values ('$date','$username','$productid','$name','$brand','$size','$unit','$number','$unitprice','$addnum','$addcost','$cardid')";//插入数据
	
	$result2=mysqli_query($conn, $query2);
	mysqli_close($conn);
	if($result2){ 
    echo"<script>alert('提交成功');location.href='addnew.php'</script>"; }
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
    新品种采购入库单
    </caption>
    <tr>
      <th>日期</th>
      <td><?php echo $date; ?></td>
      <th>采购人</th>
      <td><?php echo $username; ?></td>
    </tr>
    <tr>
      <th>物品编号</th>
      <td><label for="productid"></label>
      <input type="text" name="productid" id="productid" /></td>
      <th>品种</th>
      <td><input name="name" type="text" id="name"<?php if($_GET['name']){?> value="<?php echo $_GET['name'];?>" <?php }?>/></td>
    </tr>
    <tr>
      <th>品牌</th>
      <td><input type="text" name="brand" id="brand" /></td>
      <th>型号规格</th>
      <td><input type="text" name="size" id="size" /></td>
    </tr>
    <tr>
      <th width="96">单位</th>
      <td width="128"><input type="text" name="unit" id="unit" /></td>
      <th width="84">入库数量</th>
      <td width="170"><input name="number" type="text" id="number"<?php if($_GET['number']){?> value="<?php echo $_GET['number'];?>" <?php }?>/></td>
    </tr>
    <tr>
      <th>采购单价</th>
      <td><input type="text" name="unitprice" id="unitprice" /></td>
      <th>经费卡号</th>
      <td><input type="text" name="cardid" id="cardid" /></td>
    </tr>
 
  </table>
<input type="submit" name="submit" id="submit" value="提交" /></td>
      <td></form>
</body>
</html>