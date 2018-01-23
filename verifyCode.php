<?php
	function make_verfycode($digit,$type){
		$img=imagecreatetruecolor(100,50);
		switch($type){
			case "character":
				$code_range='0123456789QWERTYUIOPLKJHGFDSAZXCVBNM';
				$code_range_size=strlen($code_range);
				$verfiyCode='';
				$single_space=100/$digit;
				for($i=0;$i<$digit;$i++){
					$color=imagecolorallocate($img,rand(0,255),rand(0,255),rand(0,255));
					$index=rand(0,$code_range_size);
					$char=substr($code_range,$index,1);
					$verfiyCode.=$char;
					imagettftext($img,20,rand(-40,40),$i*$single_space+5,30,$color,'font.ttf',$char);
				}
				break;
			case "operation":
				$num1=rand(0,50);
				$num2=rand(0,50);
				$ope='+-';
				$ope_index=rand(0,1);
				$verfiyCode=$num1.substr($ope,$ope_index,1).$num2;
				$result=eval("return $verfiyCode;");
				$single_space=20;
				for($i=0;$i<5;$i++){
					$color=imagecolorallocate($img,rand(0,255),rand(0,255),rand(0,255));
					$char=substr($verfiyCode,$i,1);
					imagettftext($img,20,rand(-20,20),$i*18+5,30,$color,'font.ttf',$char);
				}
				break;
		}
		for($i=0;$i<5;$i++){
			$color=imagecolorallocate($img,rand(0,255),rand(0,255),rand(0,255));
			imageline($img,rand(0,25),rand(0,50),rand(75,100),rand(0,50),$color);
		}
		for($i=0;$i<100;$i++){
			$color=imagecolorallocate($img,rand(0,255),rand(0,255),rand(0,255));
			imagesetpixel($img,rand(0,100),rand(0,50),$color);
		}
		session_start();
		$verfiyCode=strtolower($verfiyCode);
		$_SESSION['verifycode']=$verfiyCode;
		header("content-type:image/jpeg");
		imagejpeg($img);
	}

	make_verfycode(4,'character');
?>