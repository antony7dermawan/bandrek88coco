<?php
include('web_setting/db_connection.php');
session_start();

for($i=0;$i<20;$i++)
{
  $selected_header[$i]='';
}
$selected_header[3]=" class='active'";

if(isset($_POST['return_logo']))
{
	header("Location: payroll.php");
}


$t_login_user_username = $_SESSION['t_login_user_username'];
$t_login_user_password = $_SESSION['t_login_user_password'];
$t_login_user_access=$_SESSION['t_login_user_access'];
$t_login_user_control=$_SESSION["t_login_user_control"];






#declare v


$done = '';
if(isset($_POST['submit']))
{
  $password_1= $_POST['password_1'];
  $password_2= $_POST['password_2'];
  $password_3= $_POST['password_3'];

  if($password_1!=null and $password_2!=null and $password_3!=null)
  {
    if($password_1==$t_login_user_password and $password_2==$password_3)
    {
      $DB_TABLE_NAME = 't_login_user';
      $update_db = "update {$DB_TABLE_NAME} set password='{$password_2}' where(username='{$t_login_user_username}')";
      $update_ex = $conn->query($update_db);
      $done = 'Password Changed';
    }
    else
    {
      $done='Wrong input';
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
      <h1> Change Password Form</h1><br>
      <h1><?php echo $done;?></h1>
      
      <form method = "POST" autocomplete="off">
        <table>
          <tr>
            <th>Old Password</th>
            <th>:
              <input type="password" name="password_1" autocomplete="off" readonly 
    onfocus="this.removeAttribute('readonly');">
            </th>
          </tr>
          <tr>
            <th>New Password</th>
            <th>:
              <input type="password" name="password_2" autocomplete="off" readonly 
    onfocus="this.removeAttribute('readonly');">
            </th>
          </tr>
          <tr>
            <th>Confirm New Password</th>
            <th>:
              <input type="password" name="password_3" autocomplete="off" readonly 
    onfocus="this.removeAttribute('readonly');">
            </th>
          </tr>
          <tr>
            <th>
              <input type="submit" name="submit" value="Submit">
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

