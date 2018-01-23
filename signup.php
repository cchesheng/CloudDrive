<html>
	<head>
		<link href="css/main.css" rel="stylesheet">
	</head>
	<body>
		<div class='main'>
			<?php
				$username=$_POST['username'];
				$userNameLen=strlen($username);
				$userNameMd5=md5($username);
				$password1=$_POST['password'];
				$password2=$_POST['reenterpw'];
				$verifyCode=$_POST['verifycode'];
				if($username=='User Name'||$password1=='Password'||
				$password2=='Re-enter Password'||$verifyCode=='Verify Code'){
					?>
					<p>Please fill up all the blanks</p>
					<a href="signup.html">Sign Up</a>
					<?php	
					exit;
				}
				//check if username valid
				if($userNameLen>=4&&$userNameLen<=8){
					if(file_exists("user/".$userNameMd5.".log")){
						?>
						<p>User name is not valid: User name already existed.</p>
						<a href="signup.html">Sign Up</a>
						<?php
						exit;
					}
				}else{
					?>
					<p>User name is not valided: Please keep username 4-8 digites.</p>
					<a href="signup.html">Sign Up</a>
					<?php
					exit;
				}
				//check if password valid
				if(strcmp($password1,$password2)!=0){
					?>
					<p>password is not valided: Please enter same password sencond time.</p>
					<a href="signup.html">Sign Up</a>
					<?php
					exit;
				}
				session_start();
				$verifyCode=strtolower($verifyCode);
				if(strcmp($verifyCode,$_SESSION['verifycode']) != 0){
					?>
					<p>Verify code isn't correct, please try again.</p>
					<a href="signup.html">Sign Up</a>
					<?php
					exit;
				}else{
					file_put_contents("user/".$userNameMd5.".log",md5($password1));
					mkdir("file/".$userNameMd5);
					?>
					<p>User has signed up success, please log in.</p>
					<a href="index.php">Log In</a>
					<?php
				}
			?>
		</div>
	</body>
</html>