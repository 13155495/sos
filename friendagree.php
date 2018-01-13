<?php
	/*
	*	friendadd.php
	*	http://127.0.0.1/sos/friendadd.php
	*	
	*/
	
		require_once 'class/Friend.class.php';
	
		require_once 'class/Push.class.php';
		 
		 $email 		= getgpc('email', 'G');
		 $friend_email 	= getgpc('friend_email', 'G');
   		//用户名密码为空的验证
		if ($email == ''  || $friend_email == '')
		{
		
   			die( JSON(array('res' =>0, 'data' => 'required parameter missing')));	
		}
		
		
		$friend = new Friend();
		
		
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
		//检测email好友关系是否存在
		$arr = $friend->checkRelashion($email,$friend_email);
		
		if(empty($arr))
		{
			die(JSON(array ('res'=>0,'data'=>'invite recore is null')));
		}
		else
		{
			//条件满足再开始推送哦
			$push   = new Push();
			$time 	=   date('Y-m-d H:i:s',time());
			$msg = JSON(array(
							'msgtype'=>'friendagree','fromuid'=>$user_info[0]['id'],'touid'=>$friend_info[0]['id'],
							'content'=>'好友添加请求已通过','time'=>$time,'lat'=>'','lng'=>'','address'=>'',
							'type'=>'','isReaded'=>''
			));
			//var_dump($msg);return;
			//状态为被邀请状态才更改为好友
			if($arr['status'] == 3)
			{
					////////////////////推送//////////////////////
					//var_dump($friend_info[0]['reg_id']);
					$res = $push->jgPush($friend_info[0]['reg_id'],$msg);
					if($res == 1)
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
					else
					{
						die(JSON(array ('res'=>0,'data'=>'push fail')));
					}
					/////////////////////////////////////////////
					//die(JSON(array ('res'=>1,'data'=>'sucess')));
				
			}
			else{
				die(JSON(array ('res'=>0,'data'=>'invite status error :'.$arr['status'])));
			}
		}
		
			 	
	
?>
