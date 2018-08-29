<?php
header("content-type:text/html; charset=utf-8"); 
virtual('/phpweb/Connections/webconn.php'); 
date_default_timezone_set('Etc/GMT-8');

$year3=date("Y");
$year2=$year3-1;
$year1=$year3-2;

mysql_select_db($database_webconn, $webconn);
$query="select distinct lab from cost";
$result=mysql_query($query,$webconn);
$row = mysql_fetch_array($result);
$i=0; $datay1=array();$datas=array();
do{
	 
	 $lab=$row['lab'];$datas[$i]=$lab;
	 $query1="select labcost from cost where lab='$lab' and year='$year1'";
	 $result1=mysql_query($query1,$webconn);
     $row1 = mysql_fetch_array($result1);
	 $labcost1=$row1['labcost'];
	 $datay1[$i]=$labcost1;
	 
	 
	 $query2="select labcost from cost where lab='$lab' and year='$year2'";
	 $result2=mysql_query($query2,$webconn);
     $row2 = mysql_fetch_array($result2);
	 $labcost2=$row2['labcost'];
	 $datay2[$i]=$labcost2;
	 
	 $query3="select labcost from cost where lab='$lab' and year='$year3'";
	 $result3=mysql_query($query3,$webconn);
     $row3 = mysql_fetch_array($result3);
	 $labcost3=$row3['labcost'];
	 $datay3[$i]=$labcost3;
	 
	 $i=$i+1;
	   
} while ($row = mysql_fetch_array($result));
$year=$_GET['year'];
$query4="select * from cost where year like '%".$year."%'";
$result4=mysql_query($query4,$webconn);
$row4 = mysql_fetch_array($result4);
?>

<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>无标题文档</title>
<link rel="stylesheet" href="css/table.css">
</head>

<body>
<form id="form1" name="form1" method="get" action="">
请输入年份:
<select name="year">
  <option <?php if ($year1==$_GET['year']) {echo "selected=\"selected\"";} ?>><?php echo $year1;?></option>
  <option <?php if ($year2==$_GET['year']) {echo "selected=\"selected\"";} ?>><?php echo $year2;?></option>
  <option <?php if ($year3==$_GET['year']) {echo "selected=\"selected\"";} ?>><?php echo $year3;?></option>
</select>
<input name="submit" type="submit" value="查询">
</form>
<form id="form2" name="form2" method="get" action="">
<table width="400" border="1">
  <caption>
    实验室费用报表
  </caption>
  <tr>
    <th>年份</th>
    <th>实验室</th>
    <th>管理员</th>
    <th>费用(元)</th>
  </tr>
  <?php while($row4 = mysql_fetch_array($result4)){?>
  <tr>
    <td><?php echo $row4['year'];?></td>
    <td><?php echo $row4['lab'];?></td>
    <td><?php echo $row4['username'];?></td>
    <td><?php echo $row4['labcost'];?></td>
  </tr>
	  <?php }?>
</table>

</form>
<form id="form2" name="form2" method="GET">

<img src="chartlabcost.php" name="chartlabcost" width="700" height="400" id="chartlabcost" />
</form>
</body>
</html>