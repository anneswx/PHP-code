<?php 
session_start();
virtual('/phpweb/Connections/webconn.php');
date_default_timezone_set('Etc/GMT-8');
    $date=date("Y-m-d");	
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


if (isset($_POST['insert'])) {
	$productid=$_POST['productid'];
	$name2=$_POST['name2'];
	$brand=$_POST['brand'];
	$size=$_POST['size'];
	$unit=$_POST['unit'];
	$number=$_POST['number'];
	$unitprice=$_POST['unitprice'];
$query1="insert into product (productid,name,brand,size,unit,number,unitprice,count) values ('$productid','$name2','$brand','$size','$unit','$number','$unitprice','0')";
$result1 = mysql_query($query1, $webconn);
if($result1){ 
    echo"<script>alert('新增成功');location.href='product.php'</script>"; }
else{ 
    echo"<script>alert('新增失败');location.href='product.php'</script>"; }
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
<a href="/phpweb/product.php">查看全部 </a>
</form>
<form id="form2" name="form2" method="POST" action="deleteproduct.php">

  <table width="843" border="1" >
    <caption>
    易耗品列表
    </caption>
    <tr>
      <th width="123">物品编号      </th>
      <th width="101">品种      </th>
      <th width="102">品牌</th>
      <th width="91">型号规格</th>
      <th width="90">单位</th>
      <th width="113">数量</th>
      <th width="119">单价(元)</th>
      <th width="36">修改</th>
      <th width="68"><input type="submit"  name="delete" id="delete" value="删除所选"></th>
    </tr>
    <?php do { ?>
      <tr>
        <td><?php echo $row_rsproduct['productid']; ?></td>
        <td><?php echo $row_rsproduct['name']; ?></td>
        <td><?php echo $row_rsproduct['brand']; ?></td>
        <td><?php echo $row_rsproduct['size']; ?></td>
        <td><?php echo $row_rsproduct['unit']; ?></td>
        <td><?php echo $row_rsproduct['number']; ?></td>
        <td><?php echo $row_rsproduct['unitprice']; ?></td>
        <td><a href="/phpweb/modifyproduct.php?productid=<?php echo $row_rsproduct['productid'];?>">修改</a></td>
        <td>
          <input type="checkbox" name="<?php echo $row_rsproduct['productid'];?>" value=<?php echo $row_rsproduct['productid'];?>>
        </td>
      </tr>
      
      <?php } while ($row_rsproduct = mysql_fetch_assoc($rsproduct)); ?>
</table>
</form>
<form id="form3" name="form3" method="post">
 <table  border="1">
    <tr>
    <th colspan="9">新增易耗品</th>
    </tr>
      <tr>
        <td width="10%"><input style="width:140px" name="productid" type="text" id="productid" required placeholder="物品编号"/> </td>
        <td width="10%"><input style="width:113px" name="name2" type="text" id="name2" required placeholder="品种"/> </td> 
        <td width="10%"><input style="width:115px" name="brand" type="text" id="brand" required placeholder="品牌" /></td>
        <td width="10%"><input style="width:105px" name="size" type="text" id="size" required placeholder="型号规格"/></td>
        <td width="10%"><input style="width:100px" name="unit" type="text" id="unit" required placeholder="单位"/></td>
        <td width="10%"><input style="width:130px" name="number" type="text" id="number" required placeholder="数量"/></td>
        <td width="10%"><input style="width:135px" name="unitprice" type="text" id="unitprice" required placeholder="单价(元)"/></td>
        <td width="30%" style="text-align:center;"><input type="submit" name="insert" id="insert" value="新增" /></td>
      </tr>
      
      
</table>
</form>





</body>
</html>
<?php
mysql_free_result($rsproduct);
?>
