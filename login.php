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
		 $reg_id = getgpc('reg_id', 'G');
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
				$row = $login->getUserInfo($tel,$email);
				if (empty($row))
				{
					die( JSON(array ('res'=>0,'data'=>'user info is null')) );   
				}
				else
				{
					//var_dump($row);return;
					//对象方式JSON
					//$row[0][avatar] = UPLOAD_DOMAIN	.$row[0][avatar];
					if($reg_id != '')
					{

						if($row[0]['reg_id'] != $reg_id)
						{
							//更新记录
							$login->updateRegid($row[0]['id'],$reg_id);
						}
						$row[0]['reg_id']=$reg_id;
					}
					
					die(JSON(array ('res'=>1,'data'=>$row[0])));
					//数组方式JSON
					//die(JSON(array ('res'=>1,'data'=>$row))); 
				}
					 	
		}
		
	
?>
