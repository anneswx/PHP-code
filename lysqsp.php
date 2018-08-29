<?php virtual('/phpweb/Connections/webconn.php'); 
date_default_timezone_set('Etc/GMT-8');
    $year=date("Y");
mysql_select_db($database_webconn, $webconn);
$query_Recordset1 = "SELECT distinct name FROM useapply where applystate='待审批'";
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
<form id="form3" name="form3"  action="">
  <a href="/phpweb/lysqspft.php">分条处理</a>
  <a href="/phpweb/lysqsp.php">批量处理</a>
</form>
<form id="form1" name="form1" method="get" action="">
  请选择品种：
  <label for="name"></label>
  <select name="name" id="name">
   <?php
do {  
?>
    <option value="<?php echo $row_Recordset1['name']?>"<?php if ($row_Recordset1['name']==$_GET['name']) {echo "selected=\"selected\"";} ?>><?php echo $row_Recordset1['name']?></option>
    <?php
} while ($row_Recordset1 = mysql_fetch_assoc($Recordset1));
?>
  </select>
  <input type="submit" name="submit" id="submit" value="查询" />
</form>
<?php 
$name=$_GET['name'];  

if (isset($_GET['submit'])) { 

	$query4="SELECT distinct lab FROM useapply where applystate='待审批'";	//分实验室显示领用数量
	$result4 = mysql_query($query4, $webconn) or die(mysql_error());
$row4 = mysql_fetch_array($result4);
foreach($row4 as $lab){
	$query1="select *,sum(usenum) as labusenum from useapply where applystate='待审批' and name='$name' group by lab";
}

  $query2 = "select sum(usenum) as allnum FROM useapply where name='$name' and applystate='待审批'";//计算总领用数量
  $query3 = "SELECT * FROM product where name='$name'";//判断是否采购新品种
 $result1 = mysql_query($query1, $webconn);
  $result2 = mysql_query($query2, $webconn);
  $result3 = mysql_query($query3, $webconn);
  $row1 = mysql_fetch_assoc($result1);
  $row2 = mysql_fetch_assoc($result2);
  $row3 = mysql_fetch_assoc($result3);
  
  $allnum=$row2['allnum'];
  $number=$row3['number'];
 
?>
<form id="form2" name="form2" method="post" action="">
  <table width="600" border="0">
    <caption>
    品种：<?php echo $name; ?>
    </caption>
      <tr>
        <th>领用人</th>
        <th>实验室</th>
        <th>领用数量</th>
       
      </tr>
    <?php do{ ?>
      <tr>
        <td><?php echo $row1['username']; ?></td>
        <td><?php echo $row1['lab']; ?></td>
        <td><?php echo $row1['labusenum']; ?></td>
      </tr>
      <?php
	  } while ($row1 = mysql_fetch_assoc($result1)); ?>
  </table>
    <?php if($row3){
		  $productid=$row3['productid'];
		  }//判断该品种是新品种
          else{$number=0;}?>
   库存量：<?php echo $number;?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;总领用数量：<?php echo $allnum;?>
    <?php if(!$row3){//判断库中没有该品种?>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;该品种不存在，请<a href="/phpweb/addnew.php?name=<?php echo $name;?>&number=<?php echo $allnum;?>">采购新品种</a>
    <?php }
	      else if($allnum>$number){//判断需求量大于库存量 
		  $addnum=$allnum-$number;?>
		  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;库存量不够，请<a href="/phpweb/cgrkd.php?productid=<?php echo $productid;?>&addnum=<?php echo $addnum;?>">新增该品种</a>
  <?php }
		  else{?>
		

<br/> <br/> <input type="submit" name="yes" id="yes" value="通过" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="no" id="no" value="不通过" /> </form>	

<?php 
if (isset($_POST['yes'])) {
	
		    $query11="select * from useapply where name='$name' and applystate='待审批'";
		    $result11 = mysql_query($query11, $webconn);
			$row11=mysql_fetch_array($result11);
			
		   do{
			   $lab=$row11['lab'];
			   $query8="select * from cost where lab='$lab' and year='$year'";
	           $result8 = mysql_query($query8, $webconn);
		       $row8=mysql_fetch_array($result8);
		       $labcost=$row8['labcost'];
			   
			   $cost=$row11['cost'];
			   $labcost=$labcost+$cost;
	           $query10="update cost set labcost='$labcost' where lab='$lab' and year='$year'";
		       $result10= mysql_query($query10, $webconn);	     	
            } while ($row11 = mysql_fetch_array($result11));
             
			$query5="select * from product where name='$name'";
	        $result5 = mysql_query($query5, $webconn);
	        $row5 = mysql_fetch_array($result5);
			$count=$row5['count'];
			
            $number=$number-$allnum;
	        $count=$count+$allnum;
			
	        $query6="update useapply set applystate='审批通过' where name='$name' and applystate='待审批'";//更改领用申请单
	        $query7="update product set number='$number',count='$count' where name='$name'";//减少物品数量，增加领用量
			
	        $result6 = mysql_query($query6, $webconn);
            $result7 = mysql_query($query7, $webconn);
		   
	        if($result11&&$result6&&$result7){
            echo"<script>alert('处理成功');location.href='lysqsp.php'</script>"; }
	        else{
	        echo"<script>alert('处理失败');location.href='lysqsp.php'</script>"; }
			
}   
	    
if (isset($_POST['no'])) {
		    $query12="update useapply set applystate='审批未通过'  where name='$name' and applystate='待审批'";
			 $result12=mysql_query($query12, $webconn);
	    
	    if($result12){
            echo"<script>alert('处理成功');location.href='lysqsp.php'</script>"; }
	        else{
	        echo"<script>alert('处理失败');location.href='lysqsp.php'</script>"; }
	   }
}

}
?>
</body>
</html>
<?php	

mysql_free_result($Recordset1);
?>
