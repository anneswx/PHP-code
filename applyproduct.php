<?php
header("content-type:text/html; charset=utf-8");
virtual('/phpweb/Connections/webconn.php'); date_default_timezone_set('Etc/GMT-8');
    $date=date("Y-m-d");
	$username=$_SESSION['username'];
	$userid=$_SESSION['userid'];
while(list($productid,$usenum)=each($_POST))
  {	
	  $query1="select * from product where productid='$productid'";
	  $result1=mysql_query($query1,$webconn);
	  $row1=mysql_fetch_array($result1);
	  $name=$row1['name'];
	  $brand=$row1['brand'];
	  $size=$row1['size'];
	  $unit=$row1['unit'];
	  $number=$row1['number'];
	  $unitprice=$row1['unitprice'];
	   
	  $query2="select * from user where userid='$userid'";
	  $result2=mysql_query($query2,$webconn);
	  $row2=mysql_fetch_array($result2);
	  $lab=$row2['lab'];
	  
	  $cost=$unitprice*$usenum;
	  
    $query3="insert into useapply (date,userid,username,productid,name,brand,size,unit,number,unitprice,usenum,cost,lab) values ('$date','$userid','$username','$productid','$name','$brand','$size','$unit','$number','$unitprice','$usenum','$cost','$lab')";
	$result3 = mysql_query($query3, $webconn);
if($result3){ 
    echo"<script>alert('领用申请成功');location.href='lysqd.php'</script>"; }
}
?>