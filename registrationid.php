<?php
	/*
	*	login.php
	*	http://127.0.0.1/sos/login.php
	*	
	*/
	
		require_once 'class/Login.class.php';
	
	
		 $user_id 	= getgpc('user_id', 'G');
		 $reg_id 	= getgpc('reg_id', 'G');
		 
   		//用户名密码为空的验证
		if ($user_id == '' )
		{
			
   			die( JSON(array('res' =>0, 'data' => 'user_id is null')));
			
			
		}
		if ($reg_id == '' )
		{
			die( JSON(array('res' =>0, 'data' => 'reg_id is null')));	
		}

		//strtoupper
		$login=new Login();
		
		$num=$login->checkUserInfoByid($user_id);
		
		if($num==0)
		{
			die(JSON(array ('res'=>0,'data'=>'user is no exists')));
		}
		else
		{
			$res = 	$login->updateRegid($user_id,$reg_id);
			if($res)
			{
				die(JSON(array ('res'=>1,'data'=>'sucess')));
			}
			else
			{
				die(JSON(array ('res'=>0,'data'=>'update fail')));
			}
					 	
		}
		
	
?>
