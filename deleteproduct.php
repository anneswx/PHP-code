<?php
header("content-type:text/html; charset=utf-8");
virtual('/phpweb/Connections/webconn.php'); 
while(list($name,$productid)=each($_POST))
  {
    $query="delete from product where productid='$productid'";
	$result=mysql_query($query,$webconn);
  }
if($result){ 
    echo"<script>alert('删除成功');location.href='product.php'</script>"; }
?>