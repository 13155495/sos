<?php
	/*
	*	login.php
	*	http://127.0.0.1/sos/login.php
	*	
	*/
	
		require_once 'class/Login.class.php';
	
	
		 $tel 	= getgpc('tel', 'G');
		 $pwd 	= getgpc('pwd', 'G');
		 $email = getgpc('email', 'G');
   		//用户名密码为空的验证
		if ($tel == '' )
		{
			if($pwd == '' || $email == '')
			{
				$arr = array('res' =>0, 'data' => 'email or pwd is null');
   				die( JSON($arr));
			}
			
		}
		if ($email == '' )
		{
			if($pwd == '' || $tel == '')
			{
				$arr = array('res' =>0, 'data' => 'tel or pwd is null');
   				die( JSON($arr));
			}
			
		}
		//strtoupper
		$login=new Login();
		
		$num=$login->checkLogin($tel,$email,$pwd);
		
		if($num==0)
		{
				 die(JSON(array ('res'=>0,'data'=>'login fail')));
		}
		else
		{
				die(JSON(array ('res'=>1,'data'=>'sucess')));  	 	
		}
		
	
?>
