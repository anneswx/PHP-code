<?php 
header("content-type:text/html; charset=utf-8");
date_default_timezone_set('Etc/GMT-8');
?>
<?php

$conn = mysqli_connect('localhost', 'root', 'admin', 'system')
    or die('连接数据库出错');
	$query="select * from product order by count desc limit 3";//是否存在用户
    $result=mysqli_query($conn, $query);
	
while($row=mysqli_fetch_array($result)){
	$data[]=$row['count'];
    $name[]=$row['name'];
	}

mysqli_close($conn);

?>
<?php

require_once ('jpgraph/jpgraph.php');
require_once ('jpgraph/jpgraph_bar.php');

$graph = new Graph(500,400); 
$graph->SetScale("textlin");

$graph->SetShadow();
$graph->img->SetMargin(40,30,50,40);

$b1plot = new BarPlot($data);
$b1plot->SetFillColor("lightblue");
$b1plot->value->SetFormat('%0.0f');
$b1plot->value->SetFont(FF_SIMSUN,FS_BOLD,10);
$b1plot->value->Show();

$graph->Add($b1plot);

$graph->title->Set("易耗品领用数量排行（前3）");
$graph->title->SetMargin(10);
$graph->xaxis->title->Set("品种");
$graph->xaxis->SetTickLabels($name);
$graph->yaxis->title->Set("领用量");

$graph->title->SetFont(FF_SIMSUN,FS_BOLD,15);
$graph->xaxis->title->SetFont(FF_SIMSUN,FS_BOLD,13);
$graph->xaxis->SetFont(FF_SIMSUN,FS_BOLD,10);
$graph->yaxis->title->SetFont(FF_SIMSUN,FS_BOLD,13);
//$graph->yaxis->SetFont(FF_SIMSUN,FS_BOLD,10);
$graph->ygrid->SetColor('black@0.9');//X,y交叉表格颜色和透明度 @为程度值
$graph->yaxis->scale->SetGrace(0);

$graph->Stroke();
?>
