<?php 
$id=$_GET['id'];
date_default_timezone_set('Etc/GMT-8');
    $year=date("Y");
	
$conn = mysqli_connect('localhost', 'root', 'admin', 'system')
    or die('连接数据库出错');
  
  $query1 = "SELECT * FROM useapply where id='$id'";
  $result1=mysqli_query($conn, $query1);
  $row1=mysqli_fetch_array($result1);
  
  $date=$row1['date'];
  $username=$row1['username'];
  $productid=$row1['productid'];
  $name=$row1['name'];
  $brand=$row1['brand'];
  $size=$row1['size'];
  $unit=$row1['unit'];
  $number=$row1['number'];
  $unitprice=$row1['unitprice'];
  $usenum=$row1['usenum'];
  $lab=$row1['lab'];
  $cost=$row1['cost'];
  
   $query3 = "SELECT * FROM product where productid='$productid'";//判断是否采购新品种
 
   $result3=mysqli_query($conn, $query3);
   $row3=mysqli_fetch_array($result3);
   $count=$row3['count'];
 
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
  <table width="506" border="1">
    <caption>
      领用申请单    
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
      <th>预估总花费</th>
      <td><?php echo $cost; ?></td>
    </tr>
    <tr>
      <th>实验室</th>
      <td><?php echo $lab; ?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
 <?php if($row3){
		  $productid=$row3['productid'];
		  }//判断该品种是新品种
          else{$number=0;}?>
   库存量：<?php echo $number;?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;领用数量：<?php echo $usenum;?><br/><br/>
    <?php if(!$row3){//判断库中没有该品种?>
          该品种不存在，请<a href="/phpweb/addnew.php?name=<?php echo $name;?>&number=<?php echo $usenum;?>">采购新品种</a>
    <?php }
	      else if($usenum>$number){//判断需求量大于库存量 
		  $addnum=$usenum-$number;?>
		  库存量不够，请<a href="/phpweb/cgrkd.php?productid=<?php echo $productid;?>&addnum=<?php echo $addnum;?>">新增该品种</a>
  <?php }else{?>
     <br/><br/> <input name="yes" id="yes" type="submit" value="通过"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input name="no" id="no" type="submit" value="不通过">
</form>      
<?php 
if (isset($_POST['yes'])) {	

            $number=$number-$usenum;
	        $count=$count+$usenum;
			
	        $query6="update useapply set applystate='审批通过' where id='$id'";//更改领用申请单
	        $query7="update product set number='$number',count='$count' where name='$name'";//减少物品数量，增加领用量
			$query8="select * from cost where lab='$lab' and year='$year'";
	
	        $result6 = mysqli_query($conn, $query6);
            $result7 = mysqli_query($conn, $query7);
	        $result8 = mysqli_query($conn, $query8);
			
			$row8=mysqli_fetch_array($result8);
			$labcost=$row8['labcost'];
			$labcost=$labcost+$cost;
			$query10="update cost set labcost='$labcost' where lab='$lab' and year='$year'";
			$result10=mysqli_query($conn, $query10);
			
	        if($result6&&$result7&&$result8&&$result10){
            echo"<script>alert('处理成功');location.href='lysqspft.php'</script>"; }
	        else{
	        echo"<script>alert('处理失败');location.href='lysqspft.php'</script>"; }
}

	    
if (isset($_POST['no'])) {
		    $query9="update useapply set applystate='审批未通过'  where id='$id'";
			 $result9=mysql_query($query9, $webconn);
	    
	    if($result9){
            echo"<script>alert('处理成功');location.href='lysqspft.php'</script>"; }
	        else{
	        echo"<script>alert('处理失败');location.href='lysqspft.php'</script>"; }
	   }
}

?>
</body>
</html>
