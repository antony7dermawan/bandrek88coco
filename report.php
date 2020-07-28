<?php
for($i=0;$i<20;$i++)
{
  $selected_header[$i]='';
}
$selected_header[2]=" class='active'";

include('web_setting/db_connection.php');
session_start();


$selected_date=$_SESSION['date_main'];

if(isset($_POST['calender']))
{
$selected_date = $_POST['calender'];
$_SESSION['date_main']=$selected_date;
}







/*
$DB_TABLE_NAME='T_T_REPORT';
$total_sum_db = "SELECT  SUM(TOTAL_CASH) TOTAL_CASH from {$DB_TABLE_NAME} where (ID_DATE='{$selected_date}')";
$total_sum_ex = $conn->prepare($total_sum_db);
$total_sum_ex->execute();
$total_sum_s = $total_sum_ex->fetchAll(PDO::FETCH_BOTH);

foreach($total_sum_s as $total_sum_got)
{
  $total_sum =($total_sum_got['TOTAL_CASH']);
}
if($total_sum==0)
{
    $name_from_report[0] =null;
    $total_sum_qty[0] =null;
}


*/


$DB_TABLE_NAME = 'T_T_REPORT';
$select_db = "SELECT  SUM(TOTAL_CASH) TOTAL_CASH from {$DB_TABLE_NAME} where (ID_DATE='{$selected_date}')";
$select_ex = $conn->query($select_db);
if($select_ex->num_rows> 0)
{
  while($select_db = $select_ex->fetch_assoc())
  {
    $total_sum= (($select_db['TOTAL_CASH']));
  }      
}
if($select_ex->num_rows== 0)
{
  $total_sum=0;
}

$DB_TABLE_NAME = 'T_T_REPORT';
$select_db = "SELECT  SUM(profit) profit from {$DB_TABLE_NAME} where (ID_DATE='{$selected_date}')";
$select_ex = $conn->query($select_db);
if($select_ex->num_rows> 0)
{
  while($select_db = $select_ex->fetch_assoc())
  {
    $total_profit= (($select_db['profit']));
  }      
}
if($select_ex->num_rows== 0)
{
  $total_profit=0;
}






/*

$DB_TABLE_NAME='T_T_STOCK';
$select_db = "SELECT ID_NAME FROM {$DB_TABLE_NAME}";
$select_ex = $conn->prepare($select_db);
$select_ex->execute();
$select_get = $select_ex->fetchAll(PDO::FETCH_BOTH);
foreach($select_get as $got_stock_s)
{
  $name_from_stock[]= ($got_stock_s['ID_NAME']);
}
*/


$DB_TABLE_NAME = 'T_T_STOCK';
$select_db = "SELECT id_name,qty FROM {$DB_TABLE_NAME}";
$select_ex = $conn->query($select_db);
if($select_ex->num_rows> 0)
{
  while($select_db = $select_ex->fetch_assoc())
  {
    $name_from_stock[]= (($select_db['id_name']));
    $total_sum_qty[]= intval($select_db['qty']);
  }      
}

foreach( array_keys($name_from_stock) as $total_item){}

for($i=0;$i<=$total_item;$i++)
{
  $DB_TABLE_NAME = 'T_T_REPORT';
  $select_db = "SELECT  SUM(qty) qty from {$DB_TABLE_NAME} where (id_name='{$name_from_stock[$i]}' and ID_DATE='{$selected_date}')";
  $select_ex = $conn->query($select_db);
  if($select_ex->num_rows> 0)
  {
    while($select_db = $select_ex->fetch_assoc())
    {
      $total_qty_sold[$i]= intval($select_db['qty']);
    }      
  }
  if($select_ex->num_rows== 0)
  {
    $total_qty_sold[$i] =0;
  }
}





$total_modal = $total_sum-$total_profit;
?>

<!DOCTYPE html>
<html>
<head>
 <title>Daily Report</title>
 <link href="style_index.css" rel = "stylesheet" type="text/css">
</head>
<body>
  <div class="main_report">
    <form method="post">
    <form action="/action_page.php">
    <input type="date" name="calender" value="<?php echo $selected_date;?>"onchange='this.form.submit();'>
    </form>

    <?php
      echo 'OMSET = Rp '.number_format($total_sum).'<br>';
      echo 'UNTUNG = Rp '.number_format($total_profit).'<br>';
      echo 'MODAL = Rp '.number_format($total_modal).'<br>';

     ?>


     <script src="java_graph/kotak1.js"></script>
     <script src="java_graph/kotak2.js"></script>
     <script src="java_graph/kotak3.js"></script>

     <div id="container_1" style="min-width: 310px; max-width: 800px; height: 400px; margin: 0 auto"></div>

  </div>
 <?php
  include('header.php');
  ?>

</body>
</html>








<script>
Highcharts.chart('container_1', {
    chart: {
        type: 'bar'
    },
    title: {
        text: 'Daily Sold Product'
    },
    xAxis: {
        categories:<?= json_encode($name_from_stock);?>
    },
    yAxis: {

        title: {
            text: 'Total QTY'
        }
    },
    legend: {
        reversed: true
    },
    plotOptions: {
        series: {
            stacking: 'normal'
        }
    },
    series: [{
        name: 'QTY',
        data: <?= json_encode($total_qty_sold);?>
    }]
});

</script>
