<?php
	session_start();
	if(isset($_SESSION['user'])){
		session_start();
		header("Location:http://".$_SESSION['ipadress']."/cloud_drive/cloud.php");
	}
?>
<html>
    <head>
        <title>LOG IN</title>
		<meta name="viewport" content="width=device-width, initial-scale=1" /> 
		<link rel="stylesheet" href="css/cbstyle.css"/>
		<link rel="stylesheet" href="css/style.css"/>
		<link href="http://fonts.googleapis.com/css?family=Calligraffitti" rel="stylesheet" type="text/css">
		<link href="http://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
		<style>
			
			label{
				color:white;
				font-size:20px;
				padding-bottom:20px;
				width:70%;
				float:left;
				margin:auto;
			}
			@media (max-width:667px){
				label{
					width:65%;
				}
			}
			@media (max-width:640px){
				label{
					width:65%;
				}
			}
			
		</style>
	</head>
    <body>
		<div class="login-form">
			<div class="head-info">
				<h2>Welcome</h2>
			</div>
			<form method="post" action="login.php" class="txt-center">
				<input type="text" class="text" value="User Name" 
				onfocus="this.value='';" onblur="if(this.value == ''){this.value='User Name';}"
				name="username"/>
				<input type='text' value="Password" 
				onfocus="this.value='';this.type='password';"  onblur="if(this.value == ''){this.value='Password';}"
				name="password"/>
				<label>Login for 1 week</label>
				<input type="checkbox" id="checkbox_c2" class="chk_3" name='checkbox' value='1' checked /><label for="checkbox_c2"></label>
				<input type="submit" value="Log In"/>
			</form>
			<div class="password">
				<a href='signup.html'>Signup</a>
			</div>
		</div>
		
		
		
    </body>
</html>