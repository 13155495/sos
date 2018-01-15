<?php
	/*
	*	friendadd.php
	*	http://127.0.0.1/sos/frienddelete.php
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
		
		
		$friend = 	new Friend();
		
		

		
		//先查用户该是否存在
		$user_info 	 = $friend->getUserInfo($email);
		$friend_info = $friend->getUserInfo($friend_email);

		//var_dump($friend_info);return;
		if(empty($user_info[0]))
		{
			die(JSON(array ('res'=>0,'data'=>'user info is not exists')));
		}
		if(empty($friend_info[0]))
		{
			die(JSON(array ('res'=>0,'data'=>'friend info is not exists')));
		}
		
		//var_dump($msg);return;
		//检测email好友关系是否存在
		$arr1 = $friend->checkRelashion($email,$friend_email);
		//检测friend_email好友关系是否存在
		$arr2 = $friend->checkRelashion($friend_email,$email);
		//var_dump($arr1);var_dump($arr2);return;
		if(!empty($arr1) &&  !empty($arr2))
		{
			//好友状态才能删除
			if($arr1['status'] == 1 && $arr2['status'] == 1)
			{
				
	
					//email-->发起删除
					$res1 = $friend->updateRelashion($email,$friend_email,6);
					//friend_email-->被删除
					$res2 = $friend->updateRelashion($friend_email,$email,7);
					
					if($res1 && $res2)
					{
						die(JSON(array ('res'=>1,'data'=>'sucess')));
					}
					else
					{
						die(JSON(array ('res'=>1,'data'=>'delete friend fail')));
					}

			}
			else{
				die(JSON(array ('res'=>0,'data'=>'not friend relashion')));
			}
			
		}
		
		
			 	
	
?>
