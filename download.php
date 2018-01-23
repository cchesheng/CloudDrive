<?php
	header("content-type:text/html;charset=utf-8");
	function download($src_path, $dist_name){
		$file_size=filesize($src_path);
		header("Content-type: application/octet-stream");
		header("Accept-Ranges: bytes");
		header("Accept-Length: {$file_size}");
		header("Content-Disposition: attachment; filename=".$dist_name);//这里客户端的弹出对话框，对应的文件名
		$handle=fopen($src_path,'r');
		$buffer=1024;
		$file_bytes=0;
		while(!feof($handle) && $file_size>$file_bytes){
			$file_data=fread($handle,$buffer);		
			$file_bytes+=$buffer;
			echo $file_data;
		}
		fclose($handle);
	}	
	session_start();
	if(!isset($_SESSION['user'])){
		echo "<html><head><link rel="stylesheet" href="css/ulstyle.css"/></head></html>";
		echo "<div class='unlogin'>Please Login first!<br>";
		echo "<a href='index.php'>Login</a></div>";
		exit;
	}
	$add=$_SESSION['main'].$_SESSION['sub'];
	download($add.$_GET['download'],$_GET['download']);
?>
