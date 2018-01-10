<?php
	/*
	*	friend.php
	*	http://127.0.0.1/sos/friend.php
	*	
	*/
	
		require_once 'class/Friend.class.php';
	
	
		 
		 $status 	= getgpc('status', 'G');
		 $email 	= getgpc('email', 'G');
   		//用户名密码为空的验证
		if ($email == ''  )
		{
		
   				die( JSON(array('res' =>0, 'data' => 'required parameter missing')));	
		}
		
		//strtoupper
		$friend=new Friend();
		//先查用户该是否存在
		$res = $friend->check($email);
		
		if($res==0)
		{
			die(JSON(array ('res'=>0,'data'=>'user is not exists')));
		}
		else
		{
			$row = $friend->getFriendInfo($email,$status);
			die(JSON(array ('res'=>1,'data'=>$row)));
			/*
			if (empty($row))
			{
				die( JSON(array ('res'=>0,'data'=>'friend info is null')) );   
			}
			else
			{
				die(JSON(array ('res'=>1,'data'=>$row)));
			}
			*/
					 	
		}
		
	
?>
