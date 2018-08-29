<?php 
session_start();
date_default_timezone_set('Etc/GMT-8');
    $date=date("Y-m-d");
	$username=$_SESSION['username'];
	$userid=$_SESSION['userid'];
	$usenum = $_POST['usenum'];
	$name = $_POST['name'];
?>
<?php
//显示物品名称
$conn = mysqli_connect('localhost', 'root', 'admin', 'system')
    or die('连接数据库出错');
	
	$query1="select * from user where userid='$userid'";
	$result1=mysqli_query($conn, $query1);
	$row1=mysqli_fetch_array($result1);
	$lab=$row1['lab'];
	
if (isset($_POST['submit'])) {	
	$query2="insert into useapply (date,userid,username,name,usenum,lab,applystate)" .
        " values ('$date','$userid','$username','$name','$usenum','$lab','待审批')";
	$result2=mysqli_query($conn, $query2);
	
	mysqli_close($conn);
	if($result2){ 
    echo"<script>alert('提交成功');location.href='depute.php'</script>"; 
    }
	else{
	echo"<script>alert('提交失败');location.href='depute.php'</script>"; 
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

<form id="form3" name="form3" method="POST">
  <table width="506" border="1">
    <caption>
    领用新品种申请单
    </caption>
    <tr>
      <th width="96">日期</th>
      <td width="128"><?php echo $date; ?></td>
      <th width="84">领用人</th>
      <td width="170"><?php echo $username; ?></td>
    </tr>
    <tr>
      <th>品种</th>
      <td><input type="text" name="name" id="name" /></td>
      <th>领用数量</th>
      <td><input type="text" name="usenum" id="usenum" /></td>
    </tr>
    <tr>
      <th>实验室</th>
      <td><?php echo $lab; ?></td>
      <td></td>
      <td></td>
    </tr>
  </table>
<input type="submit" name="submit" id="submit" value="提交" />
</form>

</body>
</html>

