<?php
    
    
	require_once 'class/Mail.class.php';	
    //header("content-type:text/html;charset=utf-8");
    //strtoupper
    $email 	= getgpc('email', 'G');
    
    //邮件地址格式检测
    if(!isEmail($email))
    {
    	$arr = array('res' =>0, 'data' => 'email format is error');
		die(JSON($arr));
    }
    //
    $mail = new Mail();

    //检测邮箱用户是否存在-返回一个array
	$arr = $mail->checkEmail($email);
	//var_dump($arr);

	//不存在该邮箱的用户
	if(empty($arr)){
		$arr = array('res' =>0, 'data' => 'email is not exist');
		die(JSON($arr));
	}
	$user_id 	= $arr[0]['id'];
	$email 	= $arr[0]['email'];
	//echo $user_id_."|".$email_;return;
	//发邮件地址
	$mail_to = $arr[0]['email'];//echo $mail_to; return;

	//邮件标题
	$title = "SOS验证码";
	//邮件内容
    $verify_code =  $mail->generateVerifiyCode($user_id,$email);
    //echo $verify_code; return;
	//die(JSON(array('res' =>1, 'data' => array('verify_code'=>$verify_code))));

    $mail_comtent = '验证码为:'.$verify_code.',请回到应用输入验证码修改密码';
   
	
    //发邮件--->>>
    $flag = $mail->sendMail($mail_to,$title,$mail_comtent);
	//$flag = $mail->send_mail("13155495@qq.com",$title,$mail_comtent);
    if($flag){
		die(JSON(array('res' =>1, 'data' => array('verify_code'=>$verify_code))));
    }else{
		die(JSON(array('res' =>0, 'data' => 'send mail fail')));
    }
?>