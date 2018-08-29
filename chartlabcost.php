<?php 
header("content-type:text/html; charset=utf-8");
date_default_timezone_set('Etc/GMT-8');

$year3=date("Y");
$year2=$year3-1;
$year1=$year3-2;

$conn = mysqli_connect('localhost', 'root', 'admin', 'system') or die('连接数据库出错');
$query="select distinct lab from user";
$result=mysqli_query($conn,$query);
$row = mysqli_fetch_array($result);
$i=0; $datay1=array();$datas=array();
do{
	 if($row['lab']!=""){
	 $lab=$row['lab'];$datas[$i]=$lab;
	 $query1="select labcost from cost where lab='$lab' and year='$year1'";
	 $result1=mysqli_query($conn,$query1);
     $row1 = mysqli_fetch_array($result1);
	 $labcost1=$row1['labcost'];
	 $datay1[$i]=$labcost1;
	 
	 
	 $query2="select labcost from cost where lab='$lab' and year='$year2'";
	 $result2=mysqli_query($conn,$query2);
     $row2 = mysqli_fetch_array($result2);
	 $labcost2=$row2['labcost'];
	 $datay2[$i]=$labcost2;
	 
	 $query3="select labcost from cost where lab='$lab' and year='$year3'";
	 $result3=mysqli_query($conn,$query3);
     $row3 = mysqli_fetch_array($result3);
	 $labcost3=$row3['labcost'];
	 $datay3[$i]=$labcost3;
	 
	 $i=$i+1;
	 }
	   
} while ($row = mysqli_fetch_array($result));
?>
<?php

require_once ('jpgraph/jpgraph.php');
require_once ('jpgraph/jpgraph_bar.php');


//创建图像
$graph = new Graph(700,400);
$graph->SetScale("textlin");
$graph->SetShadow();
$graph->SetMargin(60,30,50,60);

$title="近三年各实验室费用";//图表标题
$graph->title->Set($title);
$graph->title->SetFont(FF_SIMSUN,FS_BOLD,15);
$graph->title->SetMargin(10);
$graph->xaxis->SetTickLabels($datas);
$graph->xaxis->title->Set('实验室');//x轴标题
$graph->xaxis->title->SetFont(FF_SIMSUN,FS_BOLD,13);
$graph->xaxis->SetFont(FF_SIMSUN,FS_BOLD,10);
$graph->xaxis->title->SetMargin(10);
$graph->yaxis->title->Set('单位：（元）');//y轴标题
$graph->yaxis->title->SetFont(FF_SIMSUN,FS_BOLD,13);
$graph->yaxis->SetFont(FF_SIMSUN,FS_BOLD,10);
$graph->yaxis->title->SetMargin(10);

// Setup graph colors
$graph->SetMarginColor('white:0.98');


// Create the "Y" axis group
$bplot1 = new BarPlot($datay1);
$bplot1->SetLegend("$year1 年");
$bplot1->value->SetFont(FF_SIMSUN,FS_BOLD,8);
$bplot1->SetFillColor('#000066');
$bplot1->SetColor("white");

$bplot1->value->Show();
// Create the "Y" axis group
$bplot2 = new BarPlot($datay2);
$bplot2->SetLegend("$year2 年");
$bplot2->value->SetFont(FF_SIMSUN,FS_BOLD,8);
$bplot2->SetFillColor('#6666ff');
$bplot2->SetColor("white");
$bplot2->value->Show();

// Create the "Y" axis group
$bplot3 = new BarPlot($datay3);
$bplot3->SetLegend("$year3 年");
$bplot3->value->SetFont(FF_SIMSUN,FS_BOLD,8);
$bplot3->SetFillColor('#cccccc');
$bplot3->SetColor("white");
$bplot3->value->Show();

$gbarplot=new GroupBarPlot(array($bplot1,$bplot2,$bplot3));
$gbarplot->SetWidth(0.8);
$graph->Add($gbarplot);
$graph->Stroke();
?>