<?php
session_start();
$username=$_SESSION['username'];
?>
<?php
if (isset($_POST['submit'])) {
    
    $ypassword = $_POST['ypassword'];
	$npassword = $_POST['npassword'];

    $conn = mysqli_connect('localhost', 'root', 'admin', 'system')
    or die('连接数据库出错');
	$query1="select * from user where username='$username'";
	$query2="update user set password='$npassword' where username='$username'";
    $result1=mysqli_query($conn, $query1);
	
	$row1=mysqli_fetch_array($result1);
	$password=$row1['password'];
	
	if ($password!=$ypassword) {
	
		echo"<script language='JavaScript'>alert('原密码输入错误！');window.location='setting.php'</script>";
	}
	else if ($ypassword==$npassword) {
		echo"<script language='JavaScript'>alert('新密码不能与原密码一样！');window.location='setting.php'</script>";
		
	}
	else{
		$result2=mysqli_query($conn, $query2);
	echo"<script language='JavaScript'>alert('密码修改成功！');window.location='setting.php'</script>";
		
	}
    mysqli_close($conn);
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
  <table width="411" border="1">
    <caption>
      修改密码
    </caption>
    <tr>
      <th width="134">用户名</th>
      <td width="261"><?php echo $username; ?></td>
    </tr>
    <tr>
      <th>请输入原密码</th>
      <td><label for="password"></label>
      <input type="text" name="ypassword" id="ypassword" /></td>
    </tr>
    <tr>
      <th>请输入新密码</th>
      <td><label for="npassword"></label>
      <input type="text" name="npassword" id="npassword" /></td>
    </tr>
  </table>
  <input type="submit" name="submit" id="submit" value="提交" />
</form>
</body>
</html>