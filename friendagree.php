<?php
	/*
	*	friendadd.php
	*	http://127.0.0.1/sos/friendadd.php
	*	
	*/
	
		require_once 'class/Friend.class.php';
	
	
		 
		 $email 		= getgpc('email', 'G');
		 $friend_email 	= getgpc('friend_email', 'G');
   		//用户名密码为空的验证
		if ($email == ''  || $friend_email == '')
		{
		
   			die( JSON(array('res' =>0, 'data' => 'required parameter missing')));	
		}
		
		//strtoupper
		$friend = new Friend();
		//先查用户该是否存在
		$res = $friend->check($email);
		
		if($res==0)
		{
			die(JSON(array ('res'=>0,'data'=>'user info  is not exists')));
		}
		$res = $friend->check($friend_email);
		if($res==0)
		{
			die(JSON(array ('res'=>0,'data'=>'friend info  is not exists')));
		}
		//检测email好友关系是否存在
		$arr = $friend->checkRelashion($email,$friend_email);
		if(empty($arr))
		{
			die(JSON(array ('res'=>0,'data'=>'invite recore is null')));
		}
		else
		{
			//状态为被邀请状态才更改为好友
			if($arr['status'] == 3)
			{
				//接受邀请,两人成为朋友
				$res1 = $friend->updateRelashion($email,$friend_email,1);
				$res2 = $friend->updateRelashion($friend_email,$email,1);
				if($res1 && $res2)
				{
					die(JSON(array ('res'=>1,'data'=>'sucess')));
				}
				else
				{
					die(JSON(array ('res'=>1,'data'=>'fail ')));
				}
			}
			else{
				die(JSON(array ('res'=>0,'data'=>'invite status error :'.$arr['status'])));
			}
		}
		
			 	
	
?>