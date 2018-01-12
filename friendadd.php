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
		$user_info 	 = $friend->getUserInfo($email);
		$friend_info = $friend->getUserInfo($friend_email);
		if(empty($user_info[0]))
		{
			die(JSON(array ('res'=>0,'data'=>'user info is not exists')));
		}
		if(empty($friend_info[0]))
		{
			die(JSON(array ('res'=>0,'data'=>'friend info is not exists')));
		}
		//检测email好友关系是否存在
		$arr1 = $friend->checkRelashion($email,$friend_email);
		//检测friend_email好友关系是否存在
		$arr2 = $friend->checkRelashion($friend_email,$email);
		//var_dump($arr1);var_dump($arr2);return;
		if(!empty($arr1) &&  !empty($arr2))
		{
			//非好友状态才更新
			if($arr1['status'] != 1 && $arr2['status'] != 1)
			{
				
				//更新状态email 向 friend_email 发起邀请 2
				$res1 = $friend->updateRelashion($email,$friend_email,2);
				$res2 = $friend->updateRelashion($friend_email,$email,3);
				die(JSON(array ('res'=>1,'data'=>'sucess')));
			}
			else{
				die(JSON(array ('res'=>0,'data'=>'already  friend')));
			}
			
		}
		//var_dump($user_info[0]);var_dump($friend_info[0]);return;
		//新的好友关系建立
		$res = $friend->createRelashion($user_info[0],$friend_info[0]);
		if($res == '1|1')
		{
			die(JSON(array ('res'=>1,'data'=>'sucess')));
		}
		else{
			$res_arr = explode('|',$res); 
			if($res_arr[0] == '0'){
				die(JSON(array ('res'=>0,'data'=>'invite fail')));
			}
			if($res_arr[1] == '0'){
				die(JSON(array ('res'=>0,'data'=>'be invite fail')));
			}
		}
			 	
	
?>
