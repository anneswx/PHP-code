<?php
session_start();
if (isset($_POST['submit'])) {
    $userid = $_POST['userid'];
    $password = $_POST['password'];
	

    $conn = mysqli_connect('localhost', 'root', 'admin', 'system')
    or die('连接数据库出错');
	$query1="select * from user where userid='$userid'";//是否存在用户
    $query2="select * from user where userid='$userid'and password='$password'";//用户与密码匹配
	
	//执行某个针对数据库的查询
    $result1=mysqli_query($conn, $query1);
	$result2=mysqli_query($conn, $query2);
	
	//返回与读取行匹配的字符串数组
	$row1=mysqli_fetch_array($result1);
	$row2=mysqli_fetch_array($result2);

    $a=$row1['admin'];
	$d=$row1['dean'];
	$s=$row1['supervisor'];
	$username=$row1['username'];
	if ($row1) {
		if($row2){//判断密码正确
			if($s){//判断超级管理员
		echo"<script language='JavaScript'>;window.location='mainsupervisor.php'</script>"; } 
			else if($d){//判断主任
		echo"<script language='JavaScript'>;window.location='maindean.php'</script>"; } 
		    else if($a){//判断管理员
		echo"<script language='JavaScript'>;window.location='mainadmin.php'</script>"; }
		else{
		echo"<script language='JavaScript'>window.location='mainteacher.php'</script>"; } 
		}
		
		else{ 
		echo"<script language='JavaScript'>alert('密码不正确');window.location='index.php'</script>";  }
	    }
	else{
		echo"<script language='JavaScript'>alert('该用户名不存在');window.location='index.php'</script>";}  
	
    $_SESSION['userid'] = $userid;
	$_SESSION['username'] = $username;
    mysqli_close($conn);
    }
?>	
<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title></title>
<link rel="stylesheet" href="css/login.css">
</head>

<body>
<form id="login" name="login" method="post" action="">
    <h1>登录</h1>
    <fieldset id="inputs">
      <input name="userid" type="text" autofocus required id="userid" placeholder="请输入工号">   
      <input name="password" type="password" required id="password" placeholder="请输入密码">
  </fieldset>
    <fieldset id="actions">
        <input name="submit" type="submit" id="submit" value="登录">
    </fieldset>
</form>
</body>
</html>
