<html>
	<head>
		<link rel="stylesheet" href="css/ulstyle.css"/>
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
			}
		</style>
	</head>
	<body>
		<div class="main">
			<?php
				session_start();
				if(!isset($_SESSION['user'])){
					echo "<div class='unlogin'>Please Login first!<br>";
					echo "<a href='index.php'>Login</a></div>";
					exit;
				}
				function upload($dir){
					foreach($_FILES as $f){
						if(empty($f)){break;}
						$file_tmpname=$f['tmp_name'];
						$file=$dir.$f['name'];
						$extension=pathinfo($file,PATHINFO_EXTENSION);
						if(strcmp('php',$extension)==0){
							echo "php file would not be accepted.<br>";
							break;
						}
						if(is_uploaded_file($file_tmpname)){
							if(move_uploaded_file($file_tmpname,$file)){
								echo $f['name']." has been uploaded.<br>";
							}else{
								echo $f['name']." fail to upload.<br>";
							}
						}else{
							echo $f['name']." is not valid.<br>";
						}
					}
				}
				$add=$_SESSION['main'].$_SESSION['sub'];
				upload($add);
			
				echo "<a href='cloud.php?cd={$_SESSION['sub']}'>BACK</a>"
			?>
		</div>
	</body>
</html>