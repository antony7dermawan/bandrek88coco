<?php
include('web_setting/db_connection.php');
session_start();

for($i=0;$i<20;$i++)
{
  $selected_header[$i]='';
}
$selected_header[4]=" class='active'";


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






date_default_timezone_set('Asia/Jakarta');
    $today= date('Y-m-d'); 
    $time_now = date('H:i:s');
    $time_in = '17:00';
    $time_out = '22:00';
    $cut_off_start = 26;
    $cut_off_end = 25;


    $date_today = date('d');

 
if(isset($_POST['date_to_insert']))
{
  $date_to_insert=$_POST['date_to_insert'];
  $_SESSION['date_to_insert']=$date_to_insert;

}


$date_to_insert=$_SESSION['date_to_insert'];




    $DB_TABLE_NAME = 't_t_absent';
    $select_db = "SELECT * from {$DB_TABLE_NAME} where (date='{$date_to_insert}')";
    $select_ex = $conn->query($select_db);
    if($select_ex->num_rows> 0)
    {
      while($select_db = $select_ex->fetch_assoc())
      {
        $id_g[]= $select_db['id'];
        $username_g[]= $select_db['username'];
        $time_g[]= $select_db['time'];
        $absent_status_g[]= $select_db['absent_status'];
        $aproval_g[]= $select_db['aproval'];
      }      
    }
    if($select_ex->num_rows== 0)
    {
      $id_g[0]='';
      $username_g[0]='';
      $time_g[0]= '';
      $absent_status_g[0]= '';
      $aproval_g[0]= '';
    }
    foreach(array_keys($username_g) as $total_date_from_db){}

for($i=0;$i<=($total_date_from_db);$i++)
{
  if(isset($_POST['aproval_'.$i]))
  {
    $DB_TABLE_NAME = 't_t_absent';
    $update_db = "update {$DB_TABLE_NAME} set aproval='1' where id='{$id_g[$i]}'";
    $update_ex = $conn->query($update_db);
    header("Location: kehadiran.php");
  }
}



 ?>

 <!DOCTYPE html>
 <html>
 <head>
  <title>Aproval Absen</title>
  <link href="style.css" rel = "stylesheet" type="text/css">
 </head>
 <body>

  <div class="main">
    
    <?php

    


    ?>

    <form method = "POST" class="employee_data" action = "">
          
    <div class='table_head'>
      <table name='table_head'>
        <tr>
          <th name='colom_1'>Date</th>
          <th name='colom_2'>:
            
                <form action="/action_page.php" >
                  <input type="date" name="date_to_insert" value="<?php echo $date_to_insert;?>" onchange='this.form.submit();'> - 
                </form>
          </th>
        </tr>
      </table>
  </div>
  <div class="table_body">
      <table name='table_body'>
        <thead>
          <tr class="header">
            <th name='t_1'>Nama</th>
            <th name='t_2'>Jam Absen</th>
            <th name='t_3'>Masuk/Pulang</th>
            <th name='t_4'>Aprove</th>
            
            
          </tr>
        </thead>
        <tbody>
          <form method = "POST" action = "">
          <?php
          for($i=0;$i<=($total_date_from_db);$i++)
          {
                $rmd=(float)($i/2);
                $rmd=($rmd-(int)$rmd)*2;
                if($rmd==0)
                {
                  echo "<tr name='row_0'>";
                }
                if($rmd==1)
                {
                    echo "<tr name='row_1'>";
                }
                  if($i<=$total_date_from_db)
                  {
                    echo "<th name='t_1'>".$username_g[$i]."</th>";
                    echo "<th name='t_2'>".$time_g[$i]."</th>";
                    echo "<th name='t_3'>";
                    if($absent_status_g[$i]==1)
                    {
                      echo 'Masuk';
                    }
                    if($absent_status_g[$i]==2)
                    {
                      echo 'Pulang';
                    }
                    
                    echo "</th>";                        
                    echo "<th name='t_4'>";


                    if($aproval_g[$i]==0)
                    {
                      echo "<input type='submit' name='aproval_".$i."' value='Aprove'>";
                    }
                  }
                  if($aproval_g[$i]==1)
                  {
                    echo "aproved";
                  }
                    echo "</th>";
          
                  

                
              
            echo "</tr>";
          }
          ?>
          </form>
        
              
        </tbody>
        
      </table>
  </div>
  </form>

  </div>
    
  <?php
  include('header.php');
  ?>
</body>
</html>

<style type="text/css">



.table_body table
{
  overflow: hidden;

}
.table_body table thead tr
{
  font-family: helvetica;  
    background-color: navy;
    color:white;
    height:30px;
    font-size: 10px;

    position: -webkit-sticky;
  position: sticky;
  top: 0; 
}
.table_body table thead tr th
{
  padding: 1px 2px 1px 2px;
}
.table_body
{
  width: 100%;
  height: 1500px;
  background-color: white;
  margin-top: 0px;
  box-sizing: border-box;
  border-radius: 20px;
  overflow: scroll;

}

.employee_data table[name='table_body'] tbody tr th[name='t_3'] 
{
  width: 120px;
}


.employee_data table[name='table_body'] tbody tr[name='row_0'] 
{

  background-color: white;
  color: black;
  font-family: helvetica;
  height:20px;
 
  font-size: 10px;
}


.employee_data table[name='table_body'] tbody tr[name='row_1'] 
{
  font-family: helvetica;  
 
  background-color: aliceblue;
  color:navy;
  
  height:20px;

  font-size: 10px;

}

.employee_data table[name='table_body'] tbody tr:hover
{
  color: white;
  background-color: darkslategray

}




.employee_data table[name='table_body']
{
  margin-top: 0px;
}



.select_type
{
  margin-top: -30px;
  margin-left: 105px;
  position: absolute;
}
.employee_data table[name='table_head'] tr th[name='colom_1']
{
  width: 100px;
  height: 30px;
  text-align: left;

}
.employee_data table[name='table_head'] tr th[name='colom_2']
{
  width: 300px;
  height: 30px;
  text-align: left;

}
.employee_data table[name='table_head']
{
  margin-top: 0px;
}
.employee_data table tr th input[type="text"]
{
  border:none;
  border-bottom: 1px solid lightblue;
  background: transparent;
  outline: none;
  color: black;
  font-size: 16px;
  width: 75%;
}

.employee_data
{
  margin-left: 100px;
  margin-top: -50px;
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

.employee_data input[type="submit"]
{
  border:none;
  outline: none;
  height:30px;
  background: lightblue;
  color:black;
  font-size:14px;
  border-radius:10px;

}

.employee_data input[type="submit"]:hover
{
  cursor:pointer;
  background: navy;
  color: white;

}
.main table
{
  margin-top: 20px;
}
.main input[name='download_report']
{
  position: absolute;
  margin-top: -30px;
  margin-left: 230px;
  font-weight: bold;
}
.main a
{
  position: absolute;
  margin-top: -40px;
  font-size: 26px;
  margin-left: 50px;
  font-weight: bold;
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

<script>
window.onscroll = function() {myFunction()};

var header = document.getElementById("myHeader");
var sticky = header.offsetTop;

function myFunction() {
  if (window.pageYOffset > sticky) {
    header.classList.add("sticky");
  } else {
    header.classList.remove("sticky");
  }
}
</script>