<div class= "top_button">
 	<ul class="main-nav">
 		<img src="image/acien.png" class="logo">
 		<?php
		
		echo "<li".$selected_header[0]."> <a href='home.php'> Cashier</a></li>";
		echo "<li".$selected_header[1]."> <a href='stock.php'> Stock</a></li>";
        echo "<li".$selected_header[2]."> <a href='index.php'> Logout</a></li>";
		
		
		
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