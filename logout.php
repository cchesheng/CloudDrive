<?php
	session_start();
	session_unset();
	setcookie('PHPSESSID','');
	echo "<div class='main'>Log out successful, see you!<br>";
	echo "<a href='index.php'>Main Page</a><br></div>";
?>
<html>
	<head>
		<style type="text/css">
			*{
				margin:0;
				padding:5px 0 5px 0;
			}
			body{
				font-family: Georgia;
				text-align:center;
				background-color:rgb(135,193,184);
				font-size:15px;
				color:white;
			}
			.main{
				font-size:25px;
				padding:50px;
				margin:auto;
			}
			@media (max-width:640px){
				.main{
					width:100%;
					font-size:30px;
					background-color:rgb(135,193,184);
					color:white;
					padding:20px;
					height:100%;
					font-size:40px;
				}
			}
		</style>
	</head>
</html>