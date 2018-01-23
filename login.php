<html>
	<head>
        <link href="css/main.css" rel="stylesheet">
	<body>
		<?php
			$username=$_POST['username'];
			$usernamelen=strlen($username);
			$password=$_POST['password'];
			//if user has fill in all blands
			if(empty($username)||empty($password)){
				?>
				<p>Please fill up all the blanks</p>
				<a href="index.php">Log In</a>
				<?php
				exit;
			}
			//if username valided or not
			if($usernamelen<4||$usernamelen>8){
				?>
				<p>User name is not valided: username should be 4-8 digites.</p>
				<a href="index.php">Log In</a>
				<?php
				exit;
			}else{
				$users=scandir("user");
				array_shift($users);
				array_shift($users);
				$usernamemd5=md5($username);
				foreach($users as $user){
					$name=pathinfo($user,PATHINFO_FILENAME);
					//looking for user, if found, check file content with password
					if(strcmp($usernamemd5,$name)==0){
						$passwordmd5=md5($password);
						$pw=file_get_contents("user/".$user);
						//see if the password matched
						if(strcmp($passwordmd5,$pw)==0){
							?>
							<div class="main">
								<p>User login success.</p>
								<a href="cloud.php">To Main Page</a>
							</div>
							<?php
							session_start();
							$_SESSION['user']=$usernamemd5;
							$_SESSION['id']=$username;
							$_SESSION['main']="file/".$usernamemd5;
							$_SESSION['ipadress']='localhost';
							$_SESSION['sub']='';
							if(empty($_POST['checkbox'])){
								exit;
							}
							if($_POST['checkbox']=='1'){
								setcookie('PHPSESSID',session_id(),time()+604800000,'./');
							}
							exit;
						}else{
							?>
							<p>Wrong password, please try again.</p>
							<a href="index.php">Log In</a>
							<?php
							exit;
						}
					}
				
				}
				?>
				<p>No such username found, please try again.</p>
				<a href="index.php">Log In</a>
				<?php
			}	
		?>
	</body>
</html>