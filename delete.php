<html>
	<head>
		<link rel="stylesheet" href="css/ulstyle.css"/>
		<style type="text/css">
			*{
				margin:0;
				padding:0;
			}
			body{
				font-family: Georgia;
				text-align:center;
			}
		</style>
	</head>
</html>

<?php	
	session_start();
	if(!isset($_SESSION['user'])){
		echo "<div class='unlogin'>Please Login first!<br>";
		echo "<a href='index.php'>Login</a></div>";
		exit;
	}
	function rm_dir($dir){
		if(is_file($dir)){
			unlink($dir);
			echo "<div class='unlogin'>Deletion success.<br>";
		}else if(is_dir($dir)){
			$dirs=scandir($dir);
			array_shift($dirs);
			array_shift($dirs);
			foreach($dirs as $d){
				$file_path=$dir."/".$d;
				if(is_file($file_path)){
					$result=unlink($file_path);
				}else{
					$result=rm_dir($file_path);
				}
				if(!$result){
					return false;
				}		
			}
			rmdir($dir);
			echo "<div class='unlogin'>Deletion success.<br>";
			return true;
		}else{
			return false;
		}
	}
	
	if(!isset($_SESSION['user'])){
		echo "<div class='unlogin'>Please Login first!<br>";
		echo "<a href='index.php'>Login</a></div>";
		exit;
	}
	$add=$_SESSION['main'].$_SESSION['sub'];
	$deletepath=$add.$_GET['delete'];
	rm_dir($deletepath);
	echo "<a href='cloud.php?cd={$_SESSION['sub']}'>Refresh</a></div>";
?>

