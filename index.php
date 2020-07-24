<?php
$password_status = "<h1>Login Here</h1>";
/*

include('web_setting/db_connection.php');
$user_click = '';

session_start();



$_SESSION['absent_id_for_absent'] = 1;

$_SESSION['method_gaji']=1;
$_SESSION['date_input_absent'] = date('Y-m-d');
$_SESSION['time_minute'] = '00:00';
$_SESSION['line_id'] = 0;
$_SESSION['date_lost_analysis']= 0;
$_SESSION['shift_lost_analysis']= 0;
$_SESSION['date_lost_analysis']=0;
$_SESSION['date_main']=0;
$_SESSION['date_la']=0;
$_SESSION['la']=0;
$_SESSION['shift_main']='SHIFT1';
$_SESSION['shift_la']=1;
$_SESSION['view_type']=1;
$_SESSION['time_main']=null;
$_SESSION['graph_lines']=60;

$_SESSION['T_T_DAILY_PAYROLL_page']=0;
$_SESSION['employee_id_for_cuti']=0;
$_SESSION['input_absent_create_driver']='';
$_SESSION['absent_id_for_absent_driver']=0;
$_SESSION['calender_month']=1;
$_SESSION['date_from_period']=date('Y-m-d');
$_SESSION['date_to_period']=date('Y-m-d');
$_SESSION['date_from_period_data_karyawan']=date('Y-m-d');
$_SESSION['date_to_period_data_karyawan']=date('Y-m-d');


$_SESSION['from_generate_payroll']=date('Y-m-d');
$_SESSION['to_generate_payroll']=date('Y-m-d');
$_SESSION['date_to_transfer']=date('Y-m-d');
$_SESSION['T_M_C_SHIFT_TIME_page']=0;
$_SESSION['T_M_C_STATUS_page']=0;
$_SESSION['T_M_P_BANK_CODE_page']=0;
$_SESSION['T_M_P_DAILYDEDUCTION_page']=0;
$_SESSION['T_M_P_MONTHLYDEDUCTION_page']=0;
$_SESSION['T_M_P_MONTHLYLOANS_page']=0;
$_SESSION['T_M_P_GENDER_page']=0;
$_SESSION['T_M_P_MARITAL_STATUS_page']=0;
$_SESSION['T_M_P_RELIGION_page']=0;
$_SESSION['T_M_P_PERSONAL_page']=0;
$_SESSION['T_M_P_POSITION_page']=0;
$_SESSION['daily_payroll_page']=0;
$_SESSION['T_M_P_MONTHLY_ALLOWANCE_page']=0;
$_SESSION['T_M_P_MONTHLY_DEDUCTION_page']=0;
$_SESSION['T_T_OTHER_ALLOWANCE_page']=0;
$_SESSION['T_T_OTHER_ALLOWANCE_page_a']=0;
$_SESSION['T_T_ABSENT_STATUS_page']=0;
$_SESSION['T_T_PAY_LOAN_page']=0;
$_SESSION['T_M_P_DEPARTMENT_page']=0;
$_SESSION['T_T_LOAN_page']=0;
$_SESSION['T_M_C_ABSENT_page']=0;
$_SESSION['T_T_KASBON_page']=0;

$_SESSION['T_T_OT_page']=0;
$_SESSION['pilihan']=0;
$_SESSION['T_T_CUTI_TAHUNAN_page']=0;
$_SESSION['employee_id_for_other_allowance']=0;

$_SESSION['bulan_refresh_now']=(date("m"));
$_SESSION['bulan_refresh']=date("m");
$_SESSION['tahun_refresh_now']=date("Y");
$_SESSION['tahun_refresh']=date("Y");

$_SESSION['employee_id_for_absent']=0;
$_SESSION['position_id_controlled_1']=0;
$_SESSION['position_id_controlled_2']=0;
$_SESSION['position_id_controlled_3']=0;
$_SESSION['position_id_controlled_4']=0;
$_SESSION['position_id_controlled_5']=0;


$_SESSION['selected_position']='All';

$_SESSION['other_allowance']='create_allowance';
$_SESSION['input_absent_create']='input_absent_create';
$_SESSION['new_loan']='new_loan';
$_SESSION['new_loan_paid']='new_loan_paid';


#..............need to select top1 db
$_SESSION['id_textbox']='20004';
$_SESSION['employee_grade']='ACT';
$_SESSION['gender_id']='1';
$_SESSION['religion']='1';
$_SESSION['marital_status']='1';
$_SESSION['salary_table_page']='0';
$_SESSION['db_name']='T_M_C_SHIFT_TIME';
$_SESSION['employee_list_select']='employee_list_view';
$_SESSION['db_name_2']= 'monthly_payroll';

$DB_TABLE_NAME = 'T_M_P_PERSONAL';
$select_db = "SELECT TOP 1 EMPLOYEE_ID FROM {$DB_TABLE_NAME}";
$select_ex = $conn->prepare($select_db);
$select_ex->execute();
$select_db = $select_ex->fetchAll(PDO::FETCH_BOTH);

  foreach($select_db as $select_db_a)
  {
    $_SESSION['new_employee'] = ($select_db_a['EMPLOYEE_ID']);
  }
$DB_TABLE_NAME = 'T_M_C';
$select_db = "SELECT CREATED_DATE FROM {$DB_TABLE_NAME} where STATUS=99";
$select_ex = $conn->prepare($select_db);
$select_ex->execute();
$select_db = $select_ex->fetchAll(PDO::FETCH_BOTH);

  foreach($select_db as $select_db_a)
  {
    $expire_date = substr($select_db_a['CREATED_DATE'],0,10);
  }

$expire_date = '2020-08-30';

if($_POST)
{ 
	$user_click= $_POST['username'];
	$password_click= $_POST['password'];
	if($user_click!=null)
	{
		if($password_click!=null)
		{
			$DB_TABLE_NAME ='T_USER_LOGIN';
			$user_db = "SELECT * FROM {$DB_TABLE_NAME} where (ID_USER = '{$user_click}' and ID_PASSWORD = '{$password_click}')";
			$user_db_ex = $conn->prepare($user_db);
			$user_db_ex->execute();
		 	$got_user_db = $user_db_ex->fetchAll(PDO::FETCH_BOTH);
		 	if(date('Y-m-d')>=$expire_date)
		 	{
		 		$password_status = "<h1>Program Expired,please contact vendor</h1>";
		 	}

		 	if(date('Y-m-d')<=$expire_date)
		 	{
		 		if($got_user_db == NULL)
				{
					$password_status = "<h1>Wrong Password!</h1>";
				}
			 	if($got_user_db != NULL)
				{
						
					foreach($got_user_db as $got_user_s)
					{
							$id_user_login = ($got_user_s['ID_USER']);
							$id_password_login = ($got_user_s['ID_PASSWORD']);
							$access_tf = ($got_user_s['ACCESS']);
							$status_tf = ($got_user_s['STATUS']);
							

							
								$_SESSION['id_user_login']= $id_user_login;
								$_SESSION['id_password_login']= $id_password_login;
								$_SESSION['access_tf']= $access_tf;
								$_SESSION['status_tf']= $status_tf;
								$_SESSION['id_user']= $user_click;
								
								
								header("Location: payroll.php");
							$DB_TABLE_NAME='T_USER_LOGIN';
							$update_db = "update {$DB_TABLE_NAME} set CONTROL_1=1  where(ID_USER = '{$user_click}' and ID_PASSWORD = '{$password_click}')";
						    $update_ex = $conn->prepare($update_db);
						    $update_ex->execute();
							
					}
		
				}
		 	}

		 	
		}
	}
	
}


*/
?>



<!DOCTYPE html>
<html>
<head>
	<title> Login </title>
	<link rel="icon" sizes="14x14" href="/image/mo_logo.png">
	
	
<body>
	<div class="logincover">
		<img src="image/acien.png" class="logo">
		<a class='payroll_text'>Payroll</a>
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
				
				<input type="submit" name="submit" value="login">
				
				

				
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