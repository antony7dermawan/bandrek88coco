<?php
include('web_setting/db_connection.php');
session_start();

for($i=0;$i<20;$i++)
{
  $selected_header[$i]='';
}
$selected_header[4]=" class='active'";

if(isset($_POST['return_logo']))
{
  header("Location: payroll.php");
}
date_default_timezone_set('Asia/Jakarta');







$gaji_pokok = 900000;
$potongan_alpa = 25000;
$tj_kehadiran = 100000;

$range_1 = 2500;
$range_2 = 2800;
$range_3 = 3100;
$range_4 = 3500;
$range_5 = 3800;


$bonus_1 = 100000;






$today= date('Y-m-d'); 
$time_now = date('H:i:s');

$cut_off_start = 26;
$cut_off_end = 25;


$date_today = date('d');


if($date_today<=$cut_off_end)
{
  $month_before = date("m", strtotime("-1 months"));
  $year_before = date("Y", strtotime("-1 months"));

  $ym_after= date('Y-m'); 


  $date_before= $year_before.'-'.$month_before.'-'.$cut_off_start;
  $date_after= $ym_after.'-'.$cut_off_end;
}



if($date_today>$cut_off_end)
{
  $month_before = date("m", strtotime("-0 months"));
  $year_before = date("Y", strtotime("-0 months"));

  $y_after= date("Y", strtotime("+1 months"));
  $m_after= date("m", strtotime("+1 months"));


  $date_before= $year_before.'-'.$month_before.'-'.$cut_off_start;
  $date_after= $y_after.'-'.$m_after.'-'.$cut_off_end;
}






$t_login_user_username = $_SESSION['t_login_user_username'];
$t_login_user_password = $_SESSION['t_login_user_password'];
$t_login_user_access=$_SESSION['t_login_user_access'];
$t_login_user_control=$_SESSION["t_login_user_control"];


$DB_TABLE_NAME = 'T_T_REPORT';
$select_db = "SELECT  SUM(qty) qty from {$DB_TABLE_NAME} where (ID_DATE>='{$date_before}' and ID_DATE<='{$date_after}')";
$select_ex = $conn->query($select_db);
if($select_ex->num_rows> 0)
{
  while($select_db = $select_ex->fetch_assoc())
  {
    $total_qty= (($select_db['qty']));
  }      
}
if($select_ex->num_rows== 0)
{
  $total_qty=0;
}



$total_day=(round(abs(strtotime($today) - strtotime($date_before)) / (60*60*24),0))+1;


#declare v

      $DB_TABLE_NAME = 't_login_user';
      $select_db = "SELECT * from {$DB_TABLE_NAME} where (control='99' and access='{$t_login_user_access}')";
      $select_ex = $conn->query($select_db);
      if($select_ex->num_rows> 0)
      {
          while($select_db = $select_ex->fetch_assoc())
          {
            $id_kar[]= (($select_db['id']));
            $username_kar[]= (($select_db['username']));
            $name_kar[]= (($select_db['name']));
          }   
      }
foreach( array_keys($id_kar) as $total_id_kar ){}





date_default_timezone_set('Asia/Jakarta');
    $today= date('Y-m-d'); 
    $time_now = date('H:i:s');
    $time_in = '17:00';
    $time_out = '22:00';
    $cut_off_start = 26;
    $cut_off_end = 25;


    $date_today = date('d');


    if($date_today<=$cut_off_end)
    {
      $month_before = date("m", strtotime("-1 months"));
      $year_before = date("Y", strtotime("-1 months"));

      $ym_after= date('Y-m'); 


      $date_before= $year_before.'-'.$month_before.'-'.$cut_off_start;
      $date_after= $ym_after.'-'.$cut_off_end;
    }



    if($date_today>$cut_off_end)
    {
      $month_before = date("m", strtotime("-0 months"));
      $year_before = date("Y", strtotime("-0 months"));

      $y_after= date("Y", strtotime("+1 months"));
      $m_after= date("m", strtotime("+1 months"));


      $date_before= $year_before.'-'.$month_before.'-'.$cut_off_start;
      $date_after= $y_after.'-'.$m_after.'-'.$cut_off_end;
    }








    $DB_TABLE_NAME = 'T_T_REPORT';
    $select_db = "SELECT  SUM(qty) qty from {$DB_TABLE_NAME} where (ID_DATE>='{$date_before}' and ID_DATE<='{$date_after}')";
    $select_ex = $conn->query($select_db);
    if($select_ex->num_rows> 0)
    {
      while($select_db = $select_ex->fetch_assoc())
      {
        $total_qty= (($select_db['qty']));
      }      
    }
    if($select_ex->num_rows== 0)
    {
      $total_qty=0;
    }
    #$total_qty=3500;


    $total_day=(round(abs(strtotime($today) - strtotime($date_before)) / (60*60*24),0))+1;





for($i=0;$i<=$total_id_kar;$i++)
{

    

    $DB_TABLE_NAME = 't_t_absent';
    $select_db = "SELECT  SUM(aproval) aproval from {$DB_TABLE_NAME} where (username='{$username_kar[$i]}' and DATE>='{$date_before}' and DATE<='{$date_after}' and absent_status=1)";
    $select_ex = $conn->query($select_db);
    if($select_ex->num_rows> 0)
    {
      while($select_db = $select_ex->fetch_assoc())
      {
        $total_masuk[$i]= intval(($select_db['aproval']));
      }      
    }
    if($select_ex->num_rows== 0)
    {
      $total_masuk[$i]=intval(0);
    }



    $DB_TABLE_NAME = 't_t_absent';
    $select_db = "SELECT  SUM(aproval) aproval from {$DB_TABLE_NAME} where (username='{$username_kar[$i]}' and DATE>='{$date_before}' and DATE<='{$date_after}' and absent_status=2)";
    $select_ex = $conn->query($select_db);
    if($select_ex->num_rows> 0)
    {
      while($select_db = $select_ex->fetch_assoc())
      {
        $total_keluar[$i]= intval(($select_db['aproval']));
      }      
    }
    if($select_ex->num_rows== 0)
    {
      $total_keluar[$i]=intval(0);
    }


    $hak_cuti[$i]=0;
    if($total_keluar[$i]==$total_masuk[$i] and $total_masuk[$i]==$total_day)
    {
      $hak_cuti[$i]=1;
    }

    $absen_masuk = $total_day - $total_masuk[$i];
    $absen_keluar = $total_day - $total_keluar[$i];

    $total_alpa[$i] =  (($absen_masuk+$absen_keluar)/2);
    $pot_alpa[$i] = $potongan_alpa*$total_alpa[$i];

    $tj_cuti[$i]= $hak_cuti[$i]*$tj_kehadiran;


    $total_gaji[$i]=($tj_cuti[$i]+$gaji_pokok+($bonus_1*0))-$total_alpa[$i];
    if($total_qty>=$range_1 and $total_qty<$range_2)
    {
      $total_gaji[$i]= ($tj_cuti[$i]+$gaji_pokok+($bonus_1*1))-$total_alpa[$i];
    }
    if($total_qty>=$range_2 and $total_qty<$range_3)
    {
      $total_gaji[$i]= ($tj_cuti[$i]+$gaji_pokok+($bonus_1*2))-$total_alpa[$i];
    }
    if($total_qty>=$range_3 and $total_qty<$range_4)
    {
      $total_gaji[$i]= ($tj_cuti[$i]+$gaji_pokok+($bonus_1*3))-$total_alpa[$i];
    }
    if($total_qty>=$range_4 and $total_qty<$range_5)
    {
      $total_gaji[$i]= ($tj_cuti[$i]+$gaji_pokok+($bonus_1*4))-$total_alpa[$i];
    }
    if($total_qty>=$range_5 )
    {
      $total_gaji[$i]= ($tj_cuti[$i]+$gaji_pokok+($bonus_1*5))-$total_alpa[$i];
    }
}


 ?>

 <!DOCTYPE html>
 <html>
 <head>
  <title>Change Password</title>
  <link href="style.css" rel = "stylesheet" type="text/css">
 </head>
 <body>

  <div class="main">
    
    
    <div class='table_position'>
      <h1> Gaji Karyawan</h1><br>
      
      
      <form method = "POST" autocomplete="off">
        <table>
          <tr>
            <th>No</th>
            <th>Nama Karyawan</th>
            <th>Total Penjualan</th>
            <th>Total Absen</th>
            <th>TJ Cuti</th>
            <th>Gaji</th>
          </tr>
          <?php
          for($i=0;$i<=$total_id_kar;$i++)
          {
            echo '<tr>';

            echo '<th>'.($i+1).'</th>';
            echo '<th>'.($username_kar[$i]).'</th>';
            echo '<th>'.($total_qty).'</th>';
            echo '<th>Rp '.number_format($pot_alpa[$i]).'</th>';
            echo '<th>Rp '.number_format($tj_cuti[$i]).'</th>';
            echo '<th>Rp '.number_format($total_gaji[$i]).'</th>';
            echo '</tr>';
          }

          ?>
          
        </table>
          
          
          
          
        
      </form>

      
    </div>
  </div>
    
  <?php
  include('header.php');
  ?>
</body>
</html>

<style type="text/css">
.table_position input[type="text"],input[type="password"]
{
  border:none;
  border-bottom: 1px solid lightblue;
  background: transparent;
  outline: none;
  color: black;
  font-size: 16px;
  width: 75%;
}
.table_position input[type='submit']
{
  margin-top: 15px;
  border:none;
  outline: none;
  height:20px;
  background: lightblue;
  color:black;
  font-size:14px;
  border-radius:2px;
}
.table_position input[type='submit']:hover
{
  cursor:pointer;
  background: navy;
  color: white;
}
.table_position h1
{
  font-size: 24px;
}
.table_position table tr th
{
  padding: 10px 10px 10px 10px;
}
.table_position table
{
  text-align: left;
}
.table_position
{
  margin-left: 100px;
  margin-top: -30px;
}
.return_logo input
{
  width: 50px;
  height: 51px;
    background-size: 100%;
    background: url(image/return_logo.png);
  background-size: 100%;
  border-radius: 20px;
  float: left;
  margin-top: -50px;
}

.main
{
  margin-top:360px;
  width:100%;
  height: 600px;
  background: white;
  
  
  left:50%;
  position: relative;
  transform: translate(-50%,-50%);
  
  box-sizing:border-box;
  padding :70px 30px;
  opacity: 0.9;
  filter: alpha(opacity=100);
}
</style>

