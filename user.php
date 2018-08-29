<?php 
session_start();
virtual('/phpweb/Connections/webconn.php');
date_default_timezone_set('Etc/GMT-8');
    $date=date("Y-m-d");	
	$year=date("Y");
    $productid=$_GET['productid'];

mysql_select_db($database_webconn, $webconn);
$query2= "SELECT * FROM user order by userid";
$result2= mysql_query($query2, $webconn);
$row2 = mysql_fetch_assoc($result2);



if (isset($_POST['insert'])) {
	$userid=$_POST['userid'];
	$username=$_POST['username'];
	$admin=0;
	$dean=0;
	if($_POST['authority']=="管理员"){$admin=1;}
	$lab=$_POST['lab'];
	
$query1="insert into user (userid,password,username,lab,admin,dean,supervisor) values ('$userid','111','$username','$lab','$admin','$dean','0')";
$result1 = mysql_query($query1, $webconn);

if($lab!=""){
	$query3="insert into cost(lab,username,year,labcost) values ('$lab','username','$year','0')";
	$result3 = mysql_query($query3, $webconn);
	}
if($result1){ 
    echo"<script>alert('新增成功');location.href='user.php'</script>"; }
else{ 
    echo"<script>alert('新增失败');location.href='user.php'</script>"; }
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
<form id="form1" name="form1" method="POST" action="deleteuser.php">

  <table  border="1" >
    <caption>
    用户与实验室列表
    </caption>
    <tr>
      <th>工号</th>
      <th>教师</th>
      <th >权限</th>
      <th>实验室</th>
      <th >修改</th>
      <th><input type="submit"  name="delete" id="delete" value="删除所选"></th>
    </tr>
    <?php do { ?>
      <tr>
        <td><?php echo $row2['userid']; ?></td>
        <td><?php echo $row2['username']; ?></td>
        <td><?php if($row2['supervisor']==1){$authority="超级管理员";}
else if($row2['admin']==1){$authority="管理员";}
else if($row2['dean']==1){$authority="主任";}
else{$authority="教师";} echo $authority; ?></td>
        <td><?php echo $row2['lab']; ?></td>
         <td><a href="/phpweb/modifyuser.php?userid=<?php echo $row2['userid'];?>&username=<?php echo $row2['username'];?>">修改</a></td>
        <td>
          <input type="checkbox" name="<?php echo $row2['userid'];?>" value=<?php echo $row2['userid'];?>>
        </td>
      </tr>
      
      <?php } while ($row2 = mysql_fetch_assoc($result2)); ?>
</table>
</form>
<form id="form2" name="form2" method="post">
 <table  border="1">
    <tr>
    <th colspan="5">新增用户与实验室</th>
    </tr>
      <tr>
        <td width="20%"><input  name="userid" type="text" id="userid" required placeholder="工号"/> </td>
        <td width="20%"><input  name="username" type="text" id="username" required placeholder="教师"/> </td> 
        <td width="20%">权限：<select name="authority" id="authority">
          <option selected="selected">教师</option>
          <option>管理员</option>
        </select>
        </td> 
        <td width="20%"><input style="width:155px" name="lab" type="text" id="lab" placeholder="实验室"/></td>
        <td width="20%" style="text-align:center;"><input type="submit" name="insert" id="insert" value="新增" /></td>
      </tr>    
</table>
</form>

</body>
</html>

