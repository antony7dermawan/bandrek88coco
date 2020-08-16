<?php
include('web_setting/db_connection.php');
session_start();

for($i=0;$i<20;$i++)
{
  $selected_header[$i]='';
}
$selected_header[0]=" class='active'";

if(isset($_POST['return_logo']))
{
	header("Location: payroll.php");
}
$t_login_user_username = $_SESSION['t_login_user_username'];
$t_login_user_password = $_SESSION['t_login_user_password'];
$t_login_user_access=$_SESSION['t_login_user_access'];
$t_login_user_control=$_SESSION["t_login_user_control"];



date_default_timezone_set('Asia/Jakarta');
$today= date('Y-m-d'); 
$time_now = date('H:i:s');
$time_in = '17:30';
$time_in_limit = '16:00';
$time_out = '00:00';
$time_out_limit = '01:00';
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



$total_day=(round(abs(strtotime($today) - strtotime($date_before)) / (60*60*24),0))+1;

$DB_TABLE_NAME = 't_t_absent';
$select_db = "SELECT  SUM(aproval) aproval from {$DB_TABLE_NAME} where (username='{$t_login_user_username}' and DATE>='{$date_before}' and DATE<='{$today}' and absent_status=1)";
$select_ex = $conn->query($select_db);
if($select_ex->num_rows> 0)
{
  while($select_db = $select_ex->fetch_assoc())
  {
    $total_masuk= intval(($select_db['aproval']));
  }      
}
if($select_ex->num_rows== 0)
{
  $total_masuk=0;
}



$DB_TABLE_NAME = 't_t_absent';
$select_db = "SELECT  SUM(aproval) aproval from {$DB_TABLE_NAME} where (username='{$t_login_user_username}' and DATE>='{$date_before}' and DATE<='{$today}' and absent_status=2)";
$select_ex = $conn->query($select_db);
if($select_ex->num_rows> 0)
{
  while($select_db = $select_ex->fetch_assoc())
  {
    $total_keluar= intval(($select_db['aproval']));
  }      
}
if($select_ex->num_rows== 0)
{
  $total_keluar=0;
}


$hak_cuti=0;
if($total_keluar==$total_masuk and $total_masuk==$total_day)
{
  $hak_cuti=1;
}


#declare v


$done = '';
if(isset($_POST['submit']))
{ 
    if(strtotime($time_now)<=strtotime($time_in) and strtotime($time_now)>=strtotime($time_in_limit)) #1 masuk
    {
      $DB_TABLE_NAME = 't_t_absent';
      $select_db = "SELECT * from {$DB_TABLE_NAME} where (username='{$t_login_user_username}' and DATE='{$today}' and time<='{$time_in}' and absent_status=1)";
      $select_ex = $conn->query($select_db);
      if($select_ex->num_rows> 0)
      {
          $done = 'kamu SUDAH ABSEN MASUK';
      }
      if($select_ex->num_rows== 0)
      {
          $DB_TABLE_NAME = 't_t_absent';
          $insert_db = "insert into {$DB_TABLE_NAME} values ('0','{$t_login_user_username}','{$today}','{$time_now}','1','0')";
          $insert_ex = $conn->query($insert_db);
          $done = 'Absen Masuk Diterima, MENUNGGU APROVAL ATASAN';
      }
     
    }
    if(strtotime($time_now)>=strtotime($time_out) and strtotime($time_now)<=strtotime($time_out_limit)) #2 pulang
    {
      $DB_TABLE_NAME = 't_t_absent';
      $select_db = "SELECT * from {$DB_TABLE_NAME} where (username='{$t_login_user_username}' and DATE='{$today}' and time>='{$time_out}' and absent_status=2)";
      $select_ex = $conn->query($select_db);
      if($select_ex->num_rows> 0)
      {
          $done = 'kamu SUDAH ABSEN PULANG';
      }
      if($select_ex->num_rows== 0)
      {
        $DB_TABLE_NAME = 't_t_absent';
        $insert_db = "insert into {$DB_TABLE_NAME} values ('0','{$t_login_user_username}','{$today}','{$time_now}','2','0')";
        $insert_ex = $conn->query($insert_db);
        $done = 'Absen Pulang Diterima, MENUNGGU APROVAL ATASAN';
      }
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
      <h1> Absen Karyawan</h1><br>
      <h1><?php echo $done;

      


      ?></h1>
      
      <form method = "POST" autocomplete="off">
        <table>
          <tr>
            <th>Hak Cuti</th>
            <th>:
              <?php
              echo $hak_cuti.' hari';
              ?>
            </th>
          </tr>
          <tr>
            <th>Total Penjualan Cup
              <?php
              echo ' ';
              echo $date_before;
              echo '/';
              echo $date_after;
              ?></th>
            <th>:
              <?php
              echo $total_qty.' cup';

              ?>
            </th>
          </tr>
          
          <tr>
            <th>
              <input type="submit" name="submit" value="Absen">
            </th>
            
          </tr>
          
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

