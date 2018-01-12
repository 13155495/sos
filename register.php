<?php
	/*
	*	register.php
	*	http://127.0.0.1/sos/register.php
	*	
	*/
	 require_once 'class/Register.class.php';
	
	 $tel 		= getgpc('tel', 'G');
	 $email 	= getgpc('email', 'G');
	 $pwd 		= getgpc('pwd', 'G');
	 $country 	= getgpc('country', 'G');
	 $name 		= getgpc('name', 'G');
	 $reg_id 	= getgpc('reg_id', 'G');
   	//用户名密码为空的验证
	if ($tel == ''  )
	{
		$arr = array('res' =>0, 'data' => 'tel is null');
		die( JSON($arr));
	}
	if ($email == ''  )
	{
		$arr = array('res' =>0, 'data' => 'email is null ');
		die( JSON($arr));
	}
	if ($pwd == ''  )
	{
		$arr = array('res' =>0, 'data' => 'pwd is null ');
		die( JSON($arr));
	}
	
	
	
	$register=new Register();
	//检测用户号码是否注册过
	$res = $register->checkTel($tel);
	if($res == 1){
		$arr = array('res' =>0, 'data' => 'tel is exist');
		die( JSON($arr));
	}
	//检测用户邮箱是否注册过
	$res = $register->checkEmail($email);
	if($res == 1){
		$arr = array('res' =>0, 'data' => 'email is exist');
		die( JSON($arr));
	}
	
	//注册新用户		
	$res = $register->addRegister($tel,$email,$pwd,$country,$name,$reg_id);
    if($res)
    {
        //合法
        die(JSON(array ('res'=>1,'data'=>'sucess')));
        
    }
    else
    {
        //非法
        die(JSON(array ('res'=>0,'data'=>'register fail')));
    }
	
	
		
?>