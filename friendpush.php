<?php
	/*
	*	friend.php
	*	http://127.0.0.1/sos/friendpush.php
	*	
	*/
	
		require_once 'class/Push.class.php';
	
	
		 
		 $from_id 	= getgpc('from_id', 'G');
		 $msg 		= getgpc('msg', 'G');
		 $to_id 	= getgpc('to_id', 'G');
   		//用户名密码为空的验证
		if ($from_id == '' )
		{
		
   				die( JSON(array('res' =>0, 'data' => 'from_id is null')));	
		}
		if ($msg == '' )
		{
		
   				die( JSON(array('res' =>0, 'data' => 'msg is null')));	
		}
		
		$push=new Push();
		//var_dump($to_id); return;
		//先查用户该是否存在
		$res = $push->checkUser($from_id);
		
		if($res==0)
		{
			die(JSON(array ('res'=>0,'data'=>'from_id user is not exists')));
		}
		else
		{
			//点对点推送
			if($to_id != ''){

				$res = $push->checkUser($to_id);

				if($res == 0)
				{
					die(JSON(array ('res'=>0,'data'=>'to_id user is not exists')));
				}
				else
				{
					$array_id = $push->getFriendOne($to_id);
					//var_dump($array_id);
					if(empty($array_id))
					{
						die(JSON(array ('res'=>0,'data'=>'reg_id is null')));
					}
					else
					{
						
						$res = $push->jgPush($array_id,$msg);
						if($res == 1)
						{
							die(JSON(array ('res'=>1,'data'=>'sucess')));
						}
						else
						{
							die(JSON(array ('res'=>1,'data'=>'fail')));
						}
					}
				}
			    
			}
			//群推
			else{
				$array_id = $push->getFriendList($from_id);
				if(empty($array_id))
				{
					die(JSON(array ('res'=>0,'data'=>'reg_id is null')));
				}
				else
				{
					//$array_id = '1104a89792a3b477ec2';
					$res = $push->jgPush($array_id,$msg);
					if($res == 1)
					{
						die(JSON(array ('res'=>1,'data'=>'sucess')));
					}
					else
					{
						die(JSON(array ('res'=>0,'data'=>'push fail')));
					}
				}
			}
		}	
		
	
?>
