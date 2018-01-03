<?php
	/*
	*	modfypwd.php
	*	http://127.0.0.1/sos/modfypwd.php
	*	
	*/
	
		require_once 'class/Modifypwd.class.php';
	
	
		 $tel 	= getgpc('tel', 'G');
		 $email = getgpc('email', 'G');
		 $newpwd 	= getgpc('newpwd', 'G');
   		//用户名密码为空的验证
		if ($tel == '' )
		{
			if($newpwd == '' || $email == '')
			{
				$arr = array('res' =>0, 'data' => 'email or newpwd is null');
   				die( JSON($arr));
			}
			
		}
		if ($email == '' )
		{
			if($newpwd == '' || $tel == '')
			{
				$arr = array('res' =>0, 'data' => 'tel or newpwd is null');
   				die( JSON($arr));
			}
			
		}
		//strtoupper
		$mod=new Modifypwd();
		
		$res = $mod->check($tel,$email);
		
		if($res ==0)
		{
			die(JSON(array ('res'=>0,'data'=>'user is not exists')));
		}
		else
		{
			$res = $mod->modify($tel,$email,$newpwd);
			if ($res)
			{
				
				die(JSON(array ('res'=>1,'data'=>'sucess')));   
			}
			else
			{
				die( JSON(array ('res'=>0,'data'=>'modify pwd fail')) ); 
			}
					 	
		}
		
	
?>
