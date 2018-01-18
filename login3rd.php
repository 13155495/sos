<?php
	/*
	*	login3rd.php
	*	http://127.0.0.1/sos/login3rd.php
	*	
	*/
	
		require_once 'class/Login.class.php';
	
	
		 $id3 		= getgpc('id3', 'G');
		 
   		//用户名密码为空的验证
		if ($id3 == '' )
		{
			die(JSON(array ('res'=>0,'data'=>'three party id is null')));
		}
		

		$login = new Login();
		
		$num = $login->checkLoginId3($id3);
		
		if($num==0)
		{
				 die(JSON(array ('res'=>0,'data'=>'id3 is null')));
		}
		else
		{
				$row = $login->getUserInfoByid3($id3);
				if (empty($row))
				{
					die( JSON(array ('res'=>0,'data'=>'user info is null')) );   
				}
				else
				{
					die(JSON(array ('res'=>1,'data'=>$row[0])));
					//数组方式JSON
					//die(JSON(array ('res'=>1,'data'=>$row))); 
				}
					 	
		}
		
	
?>
