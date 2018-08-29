<?php 
$id=$_GET['id'];
virtual('/phpweb/Connections/webconn.php'); 

date_default_timezone_set('Etc/GMT-8');
    $date=date("Y-m-d");
	
mysql_select_db($database_webconn, $webconn);
$query_Recordset1 = "SELECT * FROM addproduct where state='待审批'";
$Recordset1 = mysql_query($query_Recordset1, $webconn) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>	

<?php 
$conn = mysqli_connect('localhost', 'root', 'admin', 'system')
    or die('连接数据库出错');
	$query1="select * from addproduct where id='$id'";
	$result1=mysqli_query($conn, $query1);
	$row1=mysqli_fetch_array($result1);
	
	$date=$row1['date'];
	$username=$row1['username'];
	$productid=$row1['productid'];
	$name=$row1['name'];
	$brand=$row1['brand'];
	$size=$row1['size'];
	$unit=$row1['unit'];
	
	$unitprice=$row1['unitprice'];
	$addnum=$row1['addnum'];
	$cardid=$row1['cardid'];
	$addcost=$row1['addcost'];
	
	$query5="select * from product where productid='$productid'";
    $result5=mysqli_query($conn, $query5);
	$row5=mysqli_fetch_array($result5);
	$number=$row5['number'];
	
	$query9="select * from tbudget where cardid='$cardid'";
	$result9=mysqli_query($conn, $query9);
	$row9=mysqli_fetch_array($result9);
	$balance=$row9['balance'];
	$period1=$row9['period1'];
	$period2=$row9['period2'];
	
	
	
	
	

	

	
?>

<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>无标题文档</title>
<link rel="stylesheet" href="css/table.css">
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="895" border="1">
  
    <caption>
      采购入库单
    </caption>
    <tr>
      <th width="130">申请单编号</th>
      <th width="115">日期</th>
      <th width="146">采购人</th>
      <th width="147">商品编号</th>
      <th width="134">品种</th>
      <th width="104">入库数量</th>
      <th width="73">&nbsp;</th>
    </tr>
    <?php do { ?>
      <tr>
        <td><?php echo $row_Recordset1['id']; ?></td>
        <td><?php echo $row_Recordset1['date']; ?></td>
        <td><?php echo $row_Recordset1['username']; ?></td>
        <td><?php echo $row_Recordset1['productid']; ?></td>
        <td><?php echo $row_Recordset1['name']; ?></td>
        <td><?php echo $row_Recordset1['addnum']; ?></td>
        <td><a href="cgrkdsp.php?id=<?php echo $row_Recordset1['id'];?>">查看详情</a></td>
      </tr>
      <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
  </table>
</form>

<form id="form2" name="form2" method="post" action="">
  <table width="506" border="1">
    <caption>
    采购入库单审批
    </caption>
    <tr>
      <th>采购入库单号</th>
      <td><?php echo $id; ?></td>
      <th>日期</th>
      <td><?php echo $date; ?></td>
    </tr>
    <tr>
      <th>采购人</th>
      <td><?php echo $username; ?></td>
      <th>物品编号</th>
      <td><?php echo $productid; ?></td>
    </tr>
    <tr>
      <th>品种</th>
      <td><?php echo $name; ?></td>
      <th>品牌</th>
      <td><?php echo $brand; ?></td>
    </tr>
    <tr>
      <th width="107">型号规格</th>
      <td width="117"><?php echo $size; ?></td>
      <th width="84">单位</th>
      <td width="170"><?php echo $unit; ?></td>
    </tr>
    <tr>
      <th>库存量</th>
      <td><?php echo $number; ?></td>
      <th>预估单价</th>
      <td><?php echo $unitprice; ?></td>
    </tr>
    <tr>
      <th>入库数量</th>
      <td><?php echo $addnum; ?></td>
      <th>预估总价</th>
      <td><?php echo $addcost; ?></td>
    </tr>
    <tr>
      <th>经费卡号</th>
      <td><?php echo $cardid; ?></td>
      <th>经费余额</th>
      <td><?php echo $balance; ?></td>
    </tr>
  </table>
  
<?php
if(!$row9){//判断经费卡是否存在
$reason="经费卡不存在";?>提示：经费卡不存在 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;回执：<input type="text" name="reason" id="reason" value="经费卡不存在" /><input type="submit" name="submit" id="submit" value="提交" /><?php }
else if(!($date>=$period1&&$date<=$period2)){//判断经费卡号有效期
$reason="经费卡过期";?>提示：经费卡过期&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;回执：<input type="text" name="reason" id="reason" value="经费卡过期" /><input type="submit" name="submit" id="submit" value="提交" /><?php }
else if($balance<$addcost){//判断经费不够
$reason="经费卡余额不足"?>提示：经费卡余额不足&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;回执：<input type="text" name="reason" id="reason" value="经费卡余额不足" /><input type="submit" name="submit" id="submit" value="提交" /><?php }

else{//经费足够
?><input type="submit" name="yes" id="yes" value="通过" /><input type="submit" name="no" id="no" value="不通过" />
<?php
if (isset($_POST['yes'])) {
	if(!$row5){//若库中不存在此品种，则表product添加新品种
	$query6="insert into product (productid,name,brand,size,unit,number,unitprice,count) values ('$productid','$name','$brand','$size','$unit','$number','$unitprice','0')";
	$result6=mysqli_query($conn, $query6);
	
	//更新领用申请表中新品种的信息
	$query10="select * from useapply where name='$name'";
	$result10=mysqli_query($conn, $query10);
	$row10=mysqli_fetch_array($result10);
	foreach($row10 as $a){//遍历数组
		$usenum=$row10['usenum'];
	$cost=$usenum*$unitprice;
	$cgrkdid=$row10['id'];
	$query8="update useapply set productid='$productid',brand='$brand',size='$size',unit='$unit',number='$number',unitprice='$unitprice',cost='$cost' where id='$cgrkdid'";
	$result8=mysqli_query($conn, $query8);
		}
	}
    
	$query2="update addproduct set state='审批通过' where id='$id'";
	$number=$number+$addnum;
	$query3="update product set number='$number' where productid='$productid'";
	$balance=$balance-$addcost;
	$query7="update tbudget set balance='$balance' where cardid='$cardid'";
	
	$result2=mysqli_query($conn, $query2);
	$result3=mysqli_query($conn, $query3);
	$result7=mysqli_query($conn, $query7);
	mysqli_close($conn);
	if($result2&&$result3&&$result7){ 
    echo"<script>alert('处理成功');location.href='cgrkdsp.php'</script>"; }
	else{ 
    echo"<script>alert('处理失败');location.href='cgrkdsp.php'</script>"; }
	}	
if (isset($_POST['no'])) {	?>
回执：<input type="text" name="aaa" id="aaa"  /><input type="submit" name="submit4" id="submit4" value="提交" /></form>
<?php 

}}?>

	
    
	


</body>
</html>
<?php
if (isset($_POST['submit'])) {	
$query4="update addproduct set state='审批未通过',reason='$reason' where id='$id'";
$result4=mysqli_query($conn, $query4);
if($result4){ 
    echo"<script>alert('处理成功');location.href='cgrkdsp.php'</script>"; }
	else{ 
    echo"<script>alert('处理失败');location.href='cgrkdsp.php'</script>"; }
}

$reason=$_POST['aaa'];
if (isset($_POST['submit4'])) {	
$query4="update addproduct set state='审批未通过',reason='$_POST[aaa]' where id='$id'";
$result4=mysqli_query($conn, $query4);
if($result4){ 
    echo"<script>alert('处理成功');location.href='cgrkdsp.php'</script>"; }
	else{ 
    echo"<script>alert('处理失败');location.href='cgrkdsp.php'</script>"; }
}
mysql_free_result($Recordset1);
?>
