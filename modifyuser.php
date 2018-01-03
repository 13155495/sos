<?php
	/*
	*	modfypwd.php
	*	http://127.0.0.1/sos/modfyuser.php
	*	
	*/
	
		require_once 'class/Modifyuser.class.php';
	
	
		 $tel 		= getgpc('tel', 'G');
		 $email 	= getgpc('email', 'G');
		 $name 		= getgpc('name', 'G');
		 $id 		= getgpc('id', 'G');

   		//参数检测
		if($tel == '' || $email == '' || $name=='' ||  $id =='')
		{
		
			die( JSON(array('res' =>0, 'data' => 'required parameter missing')));
		}
			
		
		//strtoupper
		$mod = new Modifyuser();
		
		$res = $mod->check($id);
		
		if($res ==0)
		{
			die(JSON(array ('res'=>0,'data'=>'user is not exists')));
		}
		else
		{
			$res = $mod->modify($tel,$email,$name,$id);
			if ($res)
			{
				
				die(JSON(array ('res'=>1,'data'=>'sucess')));   
			}
			else
			{
				die( JSON(array ('res'=>0,'data'=>'modify user fail')) ); 
			}
					 	
		}
		
	
?>
