<?php virtual('/phpweb/Connections/webconn.php'); 

mysql_select_db($database_webconn, $webconn);
$query_Recordset1 = "SELECT * FROM tbudget";
$Recordset1 = mysql_query($query_Recordset1, $webconn);
$row_Recordset1 = mysql_fetch_assoc($Recordset1);

if (isset($_POST['submit'])) {
    $cardid = $_POST['cardid'];
    $budget = $_POST['budget'];
	$period1 = $_POST['period1'];
	$period2 = $_POST['period2'];
	
	$year=substr($period1,0,4);
	
	$query1="insert into tbudget (cardid,budget,balance,period1,period2) values ('$cardid','$budget','$budget','$period1','$period2')";//插入经费设置数据
    $result1=mysql_query($query1,$webconn);
	
	$query2="select distinct lab from user";
	$result2=mysql_query($query2,$webconn);
	$row2=mysql_fetch_array($result2);
	do{
		$lab=$row2['lab'];
		if($lab!=""){
		$query3="select username from user where lab='$lab'";
    $result3=mysql_query($query3,$webconn);
	$row3=mysql_fetch_array($result3);
	$username=$row3['username'];
	$query4="insert into cost (lab,username,year,labcost) values ('$lab','$username','$year','0')";
	$result4=mysql_query($query4,$webconn);
		}
    } while ($row2 = mysql_fetch_array($result2));
		
	
	
	if($result1){ 
    echo"<script>alert('设置成功');location.href='tbudget.php'</script>"; 
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
<form id="form1" name="form1" method="post" action="">
  <table width="625" border="1">
    <caption>
      学院实验室经费设置
    </caption>
    <tr>
      <th width="142">经费卡号</th>
      <th width="152">经费</th>
      <th width="155">开始日期</th>
      <th width="148">截止日期</th>
    </tr>
    <?php do { ?>
      <tr>
        <td><?php echo $row_Recordset1['cardid']; ?></td>
        <td><?php echo $row_Recordset1['budget']; ?></td>
        <td><?php echo $row_Recordset1['period1']; ?></td>
        <td><?php echo $row_Recordset1['period2']; ?></td>
      </tr>
      <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
<tr>
      <td><label for="cardid"></label>
      <input type="text" name="cardid" id="cardid" /></td>
      <td><label for="budget"></label>
      <input type="text" name="budget" id="budget" /></td>
      <td><label for="period1"></label>
      <input type="text" name="period1" id="period1" /></td>
      <td><label for="period2"></label>
      <input type="text" name="period2" id="period2" /></td>
    </tr>
  </table>
  <input name="submit" type="submit" value="提交" />
</form>


</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
