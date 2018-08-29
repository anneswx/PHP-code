<?php 
$id=$_GET['id'];
date_default_timezone_set('Etc/GMT-8');
    $year=date("Y");
virtual('/phpweb/Connections/webconn.php'); 

mysql_select_db($database_webconn, $webconn);
$query_Recordset1 = "SELECT * FROM useapply where usedstate='待审批'";
$Recordset1 = mysql_query($query_Recordset1, $webconn) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$conn = mysqli_connect('localhost', 'root', 'admin', 'system')
    or die('连接数据库出错');
	$query1="select * from useapply where id='$id'";
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
	$usenum=$row1['usenum'];
	$lab=$row1['lab'];
	$remainnum=$row1['remainnum'];
	$rcost=$row1['rcost'];
	
	$query2="select * from product where productid='$productid'";
	$result2=mysqli_query($conn, $query2);
	$row2=mysqli_fetch_array($result2);
	$number=$row2['number'];
	$count=$row2['count'];
	$query6="select * from cost where lab='$lab'";
	$result6=mysqli_query($conn, $query6);
	$row6=mysqli_fetch_array($result6);
	$labcost=$row6['labcost'];
	
if (isset($_POST['yes'])) {
    
	$number=$number+$remainnum;
	$count=$count-$remainnum;
	$save=$unitprice*$remainnum;
	$labcost=$labcost+$save;
	$query2="update useapply set usedstate='审批通过' where id='$id'";
	$query3="update product set number='$number',count='$count' where productid='$productid'";
	$query5="update cost set labcost='$labcost' where lab='$lab' and year='$year'";
	
	$result2=mysqli_query($conn, $query2);
    $result3=mysqli_query($conn, $query3);
	$result5=mysqli_query($conn, $query5);
	mysqli_close($conn);
	if($result2&&$result3&&$result5){ 
    echo"<script>alert('处理成功');location.href='sycldsp.php'</script>"; 
	}else{ echo"<script>alert('处理失败');location.href='sycldsp.php'</script>"; }
    }
	
if (isset($_POST['no'])) {
    
    $query4="update useapply set usedstate='审批未通过' where id='$id'";
	
	$result4=mysqli_query($conn, $query3);
	mysqli_close($conn);
	if($result4){ 
    echo"<script>alert('处理成功');location.href='sycldsp.php'</script>"; 
	}else{ echo"<script>alert('处理失败');location.href='sycldsp.php'</script>"; }
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
<form id="form1" name="form1" method="post" action="">
  <table width="1131" border="1">
  
    <caption>
      使用处理单审批
    </caption>
    <tr>
      <th width="130">申请单编号</th>
      <th width="115">日期</th>
      <th width="96">领用人</th>
      <th width="127">商品编号</th>
      <th width="84">品种</th>
      <th width="104">领用数量</th>
      <th width="307">实验室</th>
      <th width="97">状态</th>
      <th width="73">&nbsp;</th>
    </tr>
    <?php do { ?>
      <tr>
        <td><?php echo $row_Recordset1['id']; ?></td>
        <td><?php echo $row_Recordset1['date']; ?></td>
        <td><?php echo $row_Recordset1['username']; ?></td>
        <td><?php echo $row_Recordset1['productid']; ?></td>
        <td><?php echo $row_Recordset1['name']; ?></td>
        <td><?php echo $row_Recordset1['usenum']; ?></td>
        <td><?php echo $row_Recordset1['lab']; ?></td>
        <td><?php echo $row_Recordset1['usedstate']; ?></td>
        <td><a href="sycldsp.php?id=<?php echo $row_Recordset1['id'];?>">查看详情</a></td>
      </tr>
      <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
  </table>
</form>
<form id="form2" name="form2" method="post" action="">
  <table width="506" border="1">
    <caption>
      使用处理单    
    </caption>
    <tr>
      <th>领用申请单号</th>
      <td><?php echo $id; ?></td>
      <th>日期</th>
      <td><?php echo $date; ?></td>
    </tr>
    <tr>
      <th>领用人</th>
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
      <th>领用数量</th>
      <td><?php echo $usenum; ?></td>
      <th>实验室</th>
      <td><?php echo $lab; ?></td>
    </tr>
    <tr>
      <th>剩余数量</th>
      <td><?php echo $remainnum; ?></td>
      <td></td><td></td>
    </tr>
  </table>
  <input type="submit" name="yes" id="yes" value="通过" />
  <input type="submit" name="no" id="no" value="不通过" />
</form>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
