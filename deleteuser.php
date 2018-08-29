<?php
header("content-type:text/html; charset=utf-8");
virtual('/phpweb/Connections/webconn.php'); 
while(list($name,$userid)=each($_POST))
  {
	  $query1="select lab from user where userid='$userid'";
	  $result1=mysql_query($query1,$webconn);
	  $row1=mysql_fetch_array($result1);
	  $lab=$row1['lab'];
	  
	  if($lab!=""){  
	  $query2="delete from cost where lab='$lab'";
	  $result2=mysql_query($query2,$webconn);
	  }
	  $query3="delete from user where userid='$userid'";
	  $result3=mysql_query($query3,$webconn);
  }
  
if($result3){ 
    echo"<script>alert('删除成功');location.href='user.php'</script>"; }
?>