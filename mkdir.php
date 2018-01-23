<?php
	session_start();
	if(!isset($_SESSION['user'])){
		?>
		<html><head><link rel="stylesheet" href="css/ulstyle.css"/></head></html>
		<div class='unlogin'>Please Login first!<br>
		<a href='index.php'>Login</a></div>
		<?php
		exit;
	}
	echo "<div class='main'>";
	if(!empty($_POST['foldername'])){
		$add=$_SESSION['main'].$_SESSION['sub'];
		$dir=$_SESSION['main'].$_SESSION['sub'].$_POST['foldername']."/";
		if(is_dir($dir)){
			echo "folder already exist.<br>";
		}else{
			if(mkdir($dir)){
				echo "folder has been made.<br>";
			}else{
				echo "folder making failed.<br>";
			}
		}
	}else{
		echo "Please enter a valid folder name.";
	}
	
	echo "<a href='cloud.php?cd={$_SESSION['sub']}'>Refresh</a>";
	echo "</div>";
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
			}
			.main{
				color:white;
				font-size:25px;
				padding:20px;
				margin:auto;
			}
			@media (max-width:640px){
				.main{
					text-align:center;
					width:100%;
					font-size:30px;
					background-color:rgb(135,193,184);
					color:white;
					padding:30px;
					font-size:40px;
				}
			}
		</style>
	</head>
</html>