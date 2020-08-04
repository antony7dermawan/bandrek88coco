<?php
$password_status = "<h1>Login Here</h1>";


include('web_setting/db_connection.php');



$login_title = 'Online Apps Login';

session_start();


$_SESSION['user_text']='TOTAL=';
$_SESSION['user_submit']='SUBMIT';
$_SESSION['user_cash']=0;
$_SESSION['line_id'] = 0;
$_SESSION['remain_logic']=0;
$_SESSION['textbox_discount']='';
$_SESSION['date_main']=date('Y-m-d');
$_SESSION['total_sum']=0;
$_SESSION['discount_price']=0;
$_SESSION['discount_percentage']=0;
$_SESSION['discount_price_limit']=0;
$_SESSION['discount_qty']=0;




if(isset($_POST['login_button']))
{ 
	$textbox_id_user= $_POST['username'];
	$textbox_id_password= $_POST['password'];
	if($textbox_id_user!=null and $textbox_id_password!=null)
	{
		$DB_TABLE_NAME = 't_login_user';
		$select_db = "SELECT * FROM {$DB_TABLE_NAME} where username='{$textbox_id_user}' and password='{$textbox_id_password}'";
		$select_ex = $conn->query($select_db);
		if($select_ex->num_rows> 0)
		{
			while($select_db = $select_ex->fetch_assoc())
			{
				$t_login_user_access= ($select_db["access"]);
				$t_login_user_control= ($select_db["control"]);
				$t_login_user_status= ($select_db["status"]);
			}

			$_SESSION['t_login_user_username']=$textbox_id_user;
			$_SESSION['t_login_user_password']=$textbox_id_password;
			$_SESSION['t_login_user_access'] = $t_login_user_access;
			$_SESSION["t_login_user_control"] = $t_login_user_control;
			$_SESSION["t_login_user_status"] = $t_login_user_status;

			if($t_login_user_control==0 or $t_login_user_control==1)
			{
				header("Location: home.php");
			}
			if($t_login_user_control==99)
			{
				header("Location: absen.php");
			}
							
			
		}
		if($select_ex->num_rows== 0)
		{
			$login_title = 'Wrong Password';
		}

	}	
}



?>



<!DOCTYPE html>
<html>
<head>
	<title> Login </title>
	<link rel="icon" sizes="14x14" href="/image/mo_logo.png">
	
	
<body>
	<div class="logincover">
		<img src="image/acien.png" class="logo">
		<a class='payroll_text'>Cashier</a>
		<div class="loginbox">
			<img src="image/login_picture.png" class="login_logo">
			 <?php echo $password_status; ?>
			<form method = "POST" action = "" autocomplete="off">
				<p>Username</p>
				<input type="text" name="username" placeholder="Enter Username" value = "<?php #echo #$user_click;?>" autocomplete="off" readonly 
    onfocus="this.removeAttribute('readonly');">
				<p>Password</p>
				<input type="password" name="password" placeholder="Enter Password" autocomplete="off" readonly 
    onfocus="this.removeAttribute('readonly');">
				
				<input type="submit" name="login_button" value="login">
				
				

				
			</form>
		</div>
		<h2> Warning: This Computer Program is protected by copyright law and international treaties, Unauthorized reproduction or distribution of this program, or any portion of it, may result in severe civil and criminal penalties, and will be prosecuted to the maximun extent possible under law</h2>

	</div>
</body>



</head>

</html>





<style>
body{
	

	background-color: lightblue;
	font-family: sans-serif;
}
.payroll_text
{
	margin-top: 50px;
	left:15%;
	position:absolute;
	top:110px;
	font-size: 35px;
	font-style: italic;
	color: darkslategray;
}
.logo
{
	width: auto;
	height: 20px;
	margin-top: 10px;
	
	position:absolute;
	top:20px;
}
.loginbox{
	width:320px;
	height: 520px;
	background: white;
	color: darkslategray;
	top:50%;
	left:75%;
	position: absolute;
	transform: translate(-50%,-50%);
	
	box-sizing:border-box;
	padding :70px 30px;
	opacity: 0.9;
  	filter: alpha(opacity=100);
}

.logincover
{
	width:620px;
	height: 520px;
	background: aliceblue;
	
	top:50%;
	left:50%;
	position: absolute;
	transform: translate(-50%,-50%);
	
	box-sizing:border-box;
	padding :70px 30px;
	opacity: 0.9;
  	filter: alpha(opacity=100);
}
.logincover h2
{
	color: black;
	width:320px;
	height: 520px;
	
	margin-top: 240px;
	left:25%;
	position: absolute;
	transform: translate(-50%);
	
	box-sizing:border-box;
	padding :70px 30px;
	opacity: 0.9;
  	filter: alpha(opacity=100);
}
.login_logo
{
	width:100px;
	height: 100px;
	border-radius: 50%;
	position:absolute;
	top:30px;
	left:calc(50% - 50px);
	background-color: navy;

}
h1{
	margin-top: 90px;
	padding: 0 0 20px;
	text-align: center;
	font-size: 22px;
}
h2{
	margin: 0;
	color: 'black';
	padding: 0 0 10px;
	text-align: justify;
	font-size: 11px;
}

h2[class="version"]
{
	margin: 0;
	color: 'black';
	padding: 0 0 10px;
	text-align: right;
	font-size: 11px;
}
.loginbox p{
	margin: 0;
	padding: 0;
	font-weight: bold;

}
.loginbox input {
	width: 100%;
	margin-bottom: 20px;
}
.loginbox input[type="text"], input[type="password"]{
	border:none;
	border-bottom: 1px solid lightblue;
	background: transparent;
	outline: none;
	height:40px;
	color: black;
	font-size: 16px;

}
.loginbox input[type="submit"]
{
	border:none;
	outline: none;
	height:40px;
	background: lightblue;
	color:#fff;
	font-size:18px;
	border-radius:20px;

}

.loginbox input[type="submit"]:hover
{
	cursor:pointer;
	background: navy;
	color: white;

}


</style>