<?php
$t_login_user_access=$_SESSION['t_login_user_access'];
$t_login_user_control=$_SESSION["t_login_user_control"];


?>



<div class= "top_button">
 	<ul class="main-nav">
 		<img src="image/acien.png" class="logo">
 		<?php
		if($t_login_user_control==0) #admin
		{
			echo "<li".$selected_header[0]."> <a href='home.php'> Cashier</a></li>";
			echo "<li".$selected_header[1]."> <a href='stock_information.php'> Stock</a></li>";
			echo "<li".$selected_header[2]."> <a href='report.php'> Report</a></li>";
			echo "<li".$selected_header[3]."> <a href='change_password.php'> Change Password</a></li>";
			echo "<li".$selected_header[4]."> <a href='gaji_karyawan.php'> Gaji Karyawan</a></li>";
	        echo "<li".$selected_header[5]."> <a href='index.php'> Logout</a></li>";
		}
		if($t_login_user_control==1) #kasir
		{
			echo "<li".$selected_header[0]."> <a href='home.php'> Cashier</a></li>";
			
	        echo "<li".$selected_header[4]."> <a href='index.php'> Logout</a></li>";
		}
		if($t_login_user_control==99) #karyawan
		{
			echo "<li".$selected_header[0]."> <a href='absen.php'> absen</a></li>";
			echo "<li".$selected_header[3]."> <a href='change_password.php'> Change Password</a></li>";
	        echo "<li".$selected_header[4]."> <a href='index.php'> Logout</a></li>";
		}
		
		
		
		
		?>
</div>


<style>

.logo
{
	margin-top: 20px;
	float: right;
	width: 100px;
	height: 20px;
	margin-right: 100px;
}
.main-nav
{
	margin-top: 0px;
	background: #fff;
	position: fixed;
	top:0;
  width: 100%;
	height:50px;
}

.main-nav li
{
	display: inline-block;
	margin-top: 15px;

}
.main-nav li a
{
	color:black;
	text-decoration: none;
	padding: 5px 20px;
	font-family: "Roboto", sans-serif;
	font-size: 15px;
}
.main-nav li.active a
{
	border:1px solid blue;
}
.main-nav li a:hover
{
	border:1px solid blue;
}
  </style>