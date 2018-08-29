<?php
header("content-type:text/html; charset=utf-8");
virtual('/phpweb/Connections/webconn.php'); 
while(list($id,$remainnum)=each($_POST))
  {	
	$query1="select * from useapply where id='$id'";
	$result1=mysql_query($query1,$webconn);
	$row1=mysql_fetch_array($result1);
	
	$unitprice=$row1['unitprice'];
	$usenum=$row1['usenum'];
    
	$rusenum=$usenum-$remainnum;
	$rcost=$unitprice*$rusenum;
	
	$query3="update useapply set usedstate='待审批',remainnum='$remainnum',rusenum='$rusenum',rcost='$rcost' where id='$id'";
	
	$result3=mysql_query($query3,$webconn);
	if($result3){ 
    echo"<script>alert('处理成功');location.href='sycld.php'</script>"; 
	}

  }
?>