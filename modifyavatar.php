<?php
	/*
	*	modfypwd.php
	*	http://127.0.0.1/sos/modfyavatar.php
	*	
	*/
	
		require_once 'class/Modifyavatar.class.php';
	
	
		 $avatar		= getgpc('avatar', 'G');
		 $id 			= getgpc('id', 'G');

   		//参数检测
		if($avatar == '' ||  $id =='')
		{
		
			die( JSON(array('res' =>0, 'data' => 'required parameter missing')));
		}
			
		
		//strtoupper
		$mod = new Modifyavatar();
		
		$res = $mod->check($id);
		
		if($res ==0)
		{
			die(JSON(array ('res'=>0,'data'=>'user is not exists')));
		}
		else
		{
			$res = $mod->modify($id,$avatar);
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
