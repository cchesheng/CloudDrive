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

	header("content-type:text/html;charset=utf-8");
	$cwd=$_SESSION['main'].'/';
	$user = $_SESSION['user'];
	$userlen=strlen($user);
	$add=$_SESSION['main'].$_SESSION['sub'];
	if(!empty($_GET['cd'])){
		$cdpath=$_SESSION['main'].$_GET['cd'].'/';
		$ru='/\./';
		$ru2='/(\/)+/';
		$cdpath=preg_replace($ru,'',$cdpath);
		$cdpath=preg_replace($ru2,'/',$cdpath);
		if((strcmp(substr($cdpath,0,5+$userlen+1),$cwd)!=0)||
		(strcmp(substr($cdpath,0,5+$userlen),$_SESSION['main'])!=0))
		{
			$cwd=$_SESSION['main'].'/';
		}
		else if(strlen($cdpath)<$userlen+5){
			$cwd=$_SESSION['main'].'/';
			
		}else{
			if(!is_dir($cdpath)){
				$cwd=$add;
				
			}else{
				$cwd=$cdpath;
			}
		}
	}
	
	echo "<div class='main'><div class='header float-rt'>User: ".$_SESSION['id']."<br>";
	echo "<a href='logout.php'>Log Out</a><br><br>";
	$location=substr($cwd,5+$userlen);
	$backdir=pathinfo($location,PATHINFO_DIRNAME)."/";
	if(strcmp($cwd,$_SESSION['main'].'/')!=0){
		echo "<a href='cloud.php?cd={$backdir}'>Back level</a><br><br>";
	}
	
	
	
	echo "LOCATION: ".$location."</div>";
	$_SESSION['sub']=$location;
	$dirs=scandir($cwd);
	array_shift($dirs);
	array_shift($dirs);
	
	foreach($dirs as $d){
		echo "<div class='item'><h3>".$d."</h3>&nbsp&nbsp&nbsp<br>";
		$file=$cwd.$d;
		if(is_dir($file)){
			//if is a directory, give option for open, delete, rename
			$adddir=$_SESSION['sub'].$d;
			echo "<a href='cloud.php?cd={$adddir}'>open</a>&nbsp";
			echo "<a href='rename.php?rename={$d}'>rename</a>&nbsp";
			echo "<a href='delete.php?delete={$d}'>delete</a><br><hr></div>";
		}else{
			//if is a file, give option for downloa'd, delete, rename
			echo "<a href='download.php?download={$d}'>download</a>&nbsp";
			echo "<a href='rename.php?rename={$d}'>rename</a>&nbsp";
			echo "<a href='delete.php?delete={$d}'>delete</a><br><hr></div>";
		}
	}
?>		

<html>
	<head>
		<title>CLOUD</title>
		<meta name="viewport" content="width=device-width, initial-scale=1" /> 
		<link href="http://fonts.googleapis.com/css?family=Calligraffitti" rel="stylesheet" type="text/css">
		<link href="http://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
		
		<style type="text/css">
			*{
				margin:0;
				padding:0;
			}
			body{
				font-family: 'Lato', sans-serif;
				text-align:left;
				magin:auto;
				color:black;	
			}
			a{
				text-decoration:none;
				color:white;
			}
			.main{
				color:black;
				width:70%;
				margin:auto;
				background-color:rgb(232,228,185);
				min-height:100%;
			}
			.header{
				font-family: 'Lato', sans-serif;
				background-color:rgb(30,160,132);
				color:white;
				padding:15px 0 15px 15px;
			}
			header a:hover{
				color:rgb(220,159,113);
			}
			.item{
				font-family: 'Lato', sans-serif;
				background-color:rgb(220,159,113);
				text-align:left;
				color:white;
				padding:15px;
			}
			.item h3{
				font-size:130%;
			}
			.item a{
				padding:0 15px 0 0;
			}
			.item a:hover{
				color:black;
			}
			.footer{
				padding-left:15px;
				padding-bottom:50px;
			}
			@media (max-width:640px){
				.main {
					width: 100%;
					background-color:rgb(252,225,209);
				}
				.header{
					background-color:rgb(135,193,184);
				}
				.item{
					background-color:rgb(244,169,122);
				}
				
			}
		</style>
	</head>
	<body>
		
		<br>
			<div class='footer'>
				<p>Upload to this folder</p>
				<form enctype="multipart/form-data" method="post" action="upload.php">
					<input type="file" name="file"><br>	
					<input type="submit" value="upload">
				</form>
				<br>
				<p>Make new folder</p>
				<form method="post" action="mkdir.php">
					<input type="text" name="foldername">
					<input type="submit" value="new folder">
				</form>
			</div>
		</div>
	</body>
</html>