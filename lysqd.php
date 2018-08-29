<?php 
session_start();
virtual('/phpweb/Connections/webconn.php');
date_default_timezone_set('Etc/GMT-8');
    $date=date("Y-m-d");
	$username=$_SESSION['username'];
	$userid=$_SESSION['userid'];
	$usenum = $_POST['usenum'];
    $productid=$_GET['productid'];

$name=$_GET['name'];

mysql_select_db($database_webconn, $webconn);
if (isset($_GET['search'])) {
    $query_rsproduct = "SELECT * FROM product where name='$name'";}
else{
	$query_rsproduct = "SELECT * FROM product";
	}
$rsproduct = mysql_query($query_rsproduct, $webconn);
$row_rsproduct = mysql_fetch_assoc($rsproduct);

$query4="select name from product";
$result4 = mysql_query($query4, $webconn);
$row4 = mysql_fetch_assoc($result4);
?>	

<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>无标题文档</title>
<link rel="stylesheet" href="css/table.css">
</head>

<body>
<form id="form1" name="form1" method="get">
请输入品种：
  <label for="name"></label>
  <select name="name" id="name">
   <?php
do {  
?>
    <option value="<?php echo $row4['name']?>"<?php if ($row4['name']==$_GET['name']) {echo "selected=\"selected\"";} ?>><?php echo $row4['name']?></option>
    <?php
} while ($row4 = mysql_fetch_assoc($result4));
?>
  </select>
  <input type="submit" name="search" id="search" value="查询" />
<a href="/phpweb/lysqd.php">查看全部 </a>

<input type="hidden" name="username" id="username" value="<?php $username=$_SESSION['username']; ?> " />
<input type="hidden" name="date" id="date" value="<?php $date; ?> " />
</form>
<form id="form2" name="form2" method="POST" action="applyproduct.php">

  <table width="900" border="1">
    <caption>
    易耗品列表
    </caption>
    <tr>
      <th>物品编号      </th>
      <th>品种      </th>
      <th>品牌</th>
      <th>型号规格</th>
      <th>单位</th>
      <th>领用数量</th>
    </tr>
    <?php do { ?>
      <tr>
        <td><?php echo $row_rsproduct['productid']; ?></td>
        <td><?php echo $row_rsproduct['name']; ?></td>
        <td><?php echo $row_rsproduct['brand']; ?></td>
        <td><?php echo $row_rsproduct['size']; ?></td>
        <td><?php echo $row_rsproduct['unit']; ?></td>
        <td><input type="text" name="<?php echo $row_rsproduct['productid'];?>" ></td>
      </tr>
      
      <?php } while ($row_rsproduct = mysql_fetch_assoc($rsproduct)); ?>
</table>
<input name="insert" id="insert" type="submit" value="提交">
</form>

</body>
</html>
<?php
mysql_free_result($rsproduct);
?>
