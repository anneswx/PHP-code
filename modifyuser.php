<?php
virtual('/phpweb/Connections/webconn.php');
$userid=$_GET['userid'];
$username=$_GET['username'];
mysql_select_db($database_webconn, $webconn);
$query_rsproduct = "SELECT * FROM user where userid='$userid'";
$rsproduct = mysql_query($query_rsproduct, $webconn);
$row1 = mysql_fetch_assoc($rsproduct);

 if($row1['supervisor']==1){$authority="超级管理员";}
else if($row1['admin']==1){$authority="管理员";}
else if($row1['dean']==1){$authority="主任";}
else{$authority="教师";}

if (isset($_POST['submit'])) {
	$lab=$_POST['lab'];
	$admin=0;
	$dean=0;
	$supervisor=0;
	if($_POST['authority']=="超级管理员"){$supervisor=1;}
	if($_POST['authority']=="管理员"){$admin=1;}
	if($_POST['authority']=="主任"){$dean=1;}
	$query2="update user set username='$username',lab='$lab',admin='$admin',dean='$dean',supervisor='$supervisor' where userid='$userid'";//插入数据
	
	$result2 = mysql_query($query2, $webconn);
	
	if($result2){ 
    echo"<script>alert('修改成功');location.href='user.php'</script>"; 
    }
	else{
	echo"<script>alert('修改失败');location.href='user.php'</script>"; 
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
<form id="form1" name="form1" method="POST">
  <table width="506" border="1">
    <caption>用户：
      <?php echo $row1['username'];?>
    </caption>
    <tr>
      <th width="96">工号</th>
      <td width="128"><?php echo $userid; ?></td>
      <th width="84">教师</th>
      <td width="170"><input type="text" name="name" id="name" autofocus required value="<?php echo $row1['username']; ?>"/></td>
    </tr>
    <tr>
      <th>权限</th>
      <td><select name="authority" id="authority">
          <option selected="selected">教师</option>
          <option>管理员</option>
          <option>超级管理员</option>
          <option>主任</option>
      </select></td>
      <th>实验室</th>
      <td><input type="text" name="lab" id="lab"  value="<?php echo $row1['lab']; ?>"/></td>
    </tr>
  </table>
<input type="submit" name="submit" id="submit" value="修改" />
</form>


</body>
</html>
<?php
mysql_free_result($rsproduct);
?>
