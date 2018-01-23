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
	$add=$_SESSION['main'].$_SESSION['sub'];
	if(!empty($_GET['rename'])){
		$path=$add.$_GET['rename'];
		if(is_file($path)){
			$_SESSION['rename_extention']= pathinfo($path,PATHINFO_EXTENSION);
		}
		$_SESSION['rename']=$path;
	}
?>
<html>
	<head>
		<style type="text/css">
			*{
				margin:0;
				padding:0;
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
			.subphp{
				dont-size:20px;
				color:white;
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
				.subphp{
					color:white;
				}
			}
		</style>
	</head>
	<body>
		<div class="main">
			<form method="post" action="rename.php">
				Please enter the new name:<br>
				<input type="text" name="rename"/><br>
				<input type="submit">
			</form>
		</div>
	</body>
</html>
<?php
	if(!empty($_POST['rename'])){
		$old=$_SESSION['rename'];
		if(is_file($old)){
			$new=$add.$_POST['rename'].".".$_SESSION['rename_extention'];
		}else{
			$new=$add.$_POST['rename'];
		}
		if(rename($old,$new)){
			echo "<div class='subhtml'>Rename success.<br>";
			echo "<a href='cloud.php?cd={$_SESSION['sub']}'>Refresh</a></div>";
			$_SESSION['rename']='';
			$_SESSION['rename_extention']='';
		}
	}

?>