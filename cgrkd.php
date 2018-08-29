<?php 
session_start();
virtual('/phpweb/Connections/webconn.php'); 
date_default_timezone_set('Etc/GMT-8');
    $date=date("Y-m-d");
	$username=$_SESSION['username'];
$productid=$_GET['productid'];
$name=$_GET['name'];
mysql_select_db($database_webconn, $webconn);
if (isset($_GET['search'])) {
    $query_rsproduct = "SELECT * FROM product where name='$name'";}
else{
	$query_rsproduct = "SELECT * FROM product";
	}
$rsproduct = mysql_query($query_rsproduct, $webconn) or die(mysql_error());
$row_rsproduct = mysql_fetch_assoc($rsproduct);

$query4="select name from product";
$result4 = mysql_query($query4, $webconn);
$row4 = mysql_fetch_assoc($result4);
?>

<?php
//显示物品名称
$conn = mysqli_connect('localhost', 'root', 'admin', 'system')
    or die('连接数据库出错');
	
    $query1="select * from product where productid='$productid'";
	
	$result1=mysqli_query($conn, $query1);
	$row1=mysqli_fetch_array($result1);
	
	$name=$row1['name'];
	$brand=$row1['brand'];
	$size=$row1['size'];
	$unit=$row1['unit'];
	$number=$row1['number'];
	$unitprice=$row1['unitprice'];

	$addnum = $_POST['addnum'];
	$addcost=$unitprice*$addnum;
	$cardid=$_POST['cardid'];
if (isset($_POST['submit'])) {
	
    $query2="insert into addproduct (date,username,productid,name,brand,size,unit,number,unitprice,addnum,addcost,cardid)" .
        " values ('$date','$username','$productid','$name','$brand','$size','$unit','$number','$unitprice','$addnum','$addcost','$cardid')";//插入数据
	
	$result2=mysqli_query($conn, $query2);
	mysqli_close($conn);
	if($result2){ 
    echo"<script>alert('提交成功');location.href='cgrkd.php'</script>"; }
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
<p>
请输入品种：
  <label for="keyword"></label>
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
<a href="/phpweb/cgrkd.php">查看全部 </a>

<input type="hidden" name="username" id="username" value="<?php $username=$_SESSION['username']; ?> " />
<input type="hidden" name="date" id="date" value="<?php $date; ?> " /></p>
<p>
<a href="/phpweb/addnew.php">采购入库新品种</a>
</p>
</form>
<form id="form2" name="form2" method="POST">

  <table width="969" border="1">
    <caption>易耗品列表
    </caption>
    <tr>
      <th width="135">物品编号      </th>
      <th width="109">品种      </th>
      <th width="112">品牌</th>
      <th width="99">型号规格</th>
      <th width="98">单位</th>
      <th width="122">库存量</th>
      <th width="128">预估单价</th>
      <th width="72">领用</th>
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
        <td><a href="cgrkd.php?productid=<?php echo $row_rsproduct['productid'];?>">采购入库</a></td>
      </tr>
      
      <?php } while ($row_rsproduct = mysql_fetch_assoc($rsproduct)); ?>
</table>
</form>

<form id="form3" name="form3" method="POST">
  <table width="506" border="1">
    <caption>
      采购入库单
    </caption>
    <tr>
      <th>日期</th>
      <td><?php echo $date; ?></td>
      <th>采购人</th>
      <td><?php echo $username; ?></td>
    </tr>
    <tr>
      <th>物品编号</th>
      <td><?php echo $productid; ?></td>
      <th>品种</th>
      <td><?php echo $name; ?></td>
    </tr>
    <tr>
      <th>品牌</th>
      <td><?php echo $brand; ?></td>
      <th>型号规格</th>
      <td><?php echo $size; ?></td>
    </tr>
    <tr>
      <th width="96">单位</th>
      <td width="128"><?php echo $unit; ?></td>
      <th width="84">库存量</th>
      <td width="170"><?php echo $number; ?></td>
    </tr>
    <tr>
      <th>预估单价</th>
      <td><?php echo $unitprice; ?></td>
      <th>入库数量</th>
      <td><input name="addnum" type="text" id="addnum" <?php if($_GET['addnum']){?> value="<?php echo $_GET['addnum'];?>" <?php }?>/></td>
    </tr>
    <tr>
      <th>经费卡号</th>
      <td><input type="text" name="cardid" id="cardid" /></td>
      <td></td>
      <td></td>
    </tr>
  
  </table>
  <input type="submit" name="submit" id="submit" value="提交" />

</form>




</body>
</html>
<?php
mysql_free_result($rsproduct);
?>
