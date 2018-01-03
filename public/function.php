<?php

	

	/*
	 * 提取提交的参数
	 * $k是数组下标 
	 * $var是表示  PHP全局变量
	 * G--_GET
	 * P--_POST
	 * C--_COOKIE
	 * R--_REQUEST
	 */
	function getgpc($k, $var = 'R')
	{
	    switch($var)
	    {
	        case 'G':
				$var = &$_GET;
				break;
	        case 'P':
				$var = &$_POST;
			    break;
	        case 'C': 
				$var = &$_COOKIE;
			    break;
	        case 'R':
				$var = &$_REQUEST;
			    break;
	    }
	    return isset($var[$k]) ? $var[$k] : NULL;
	}
	/*
		数组中往头部添加一个元素
		二维数组会遍历在每个一维数组中加
		
	*/
	function array_add($des,$add)
	{
		$count = count($des);
		
		foreach ($des as $value)	
		{
			$arr_ = $add + $value;
			$arr[] = $arr_ + $arr_;
		}
		//一个元素
		if($count == 1)
		{
			return $arr_;
		}
		//多个元素
		else
		{
			
			return $arr;
		}
	}
	

	function arrayRecursive(&$array, $function, $apply_to_keys_also = false)
	{
	    static $recursive_counter = 0;
	    if (++$recursive_counter > 1000) {
	        die('possible deep recursion attack');
	    }
	    foreach ($array as $key => $value) {
	        if (is_array($value)) {
	            arrayRecursive($array[$key], $function, $apply_to_keys_also);
	        } else {
	            $array[$key] = $function($value);
	        }
	         
	        if ($apply_to_keys_also && is_string($key)) {
	            $new_key = $function($key);
	            if ($new_key != $key) {
	                $array[$new_key] = $array[$key];
	                unset($array[$key]);
	            }
	        }
	    }
	    $recursive_counter--;
	}

	function JSON($array) {
	    arrayRecursive($array, 'urlencode', true);
	    $json = json_encode($array);
	    return urldecode($json);
	}
	
	/**
	 * 随机生成字符串
	 * @param unknown $len
	 * @return string
	 */
	 function getRandNameStr($len)
	{
		$chars = array(
				"a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k",
				"l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v",
				"w", "x", "y", "z","0","1","2","3","4","5","6","7","8",
				"9"
		);
		$charsLen = count($chars) - 1;
		shuffle($chars);
		$output = "";
		for ($i=0; $i<$len; $i++)
		{
		$output .= $chars[mt_rand(0, $charsLen)];
		}
		return $output;
	}

	/**
	 * 随机生成数字
	 * @param unknown $len
	 * @return int
	 */
	 function getRandNum($len)
	{
		$chars = array(0,1,2,3,4,5,6,7,8,9);
		$charsLen = count($chars) - 1;
		shuffle($chars);
		$output = "";
		for ($i=0; $i<$len; $i++)
		{
		$output .= $chars[mt_rand(0, $charsLen)];
		}
		return $output;
	}
	/**
	 * [isEmail 邮件地址格式检测]
	 * @param  [type]  $email [电子邮件地址]
	 * @return boolean        [description]
	 */
     function isEmail($email){  
        $mode = '/\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/';  
        if(preg_match($mode,$email)){  
            return true;  
	    }else{  
	        return false;  
		}  
	}

	function send_mail($to,$title,$content)
    {
    	require_once("phpmailer/class.phpmailer.php"); 
	    require_once("phpmailer/class.smtp.php");
		try {
			$mail = new PHPMailer(true); 
			$mail->SMTPDebug  = SMTP_DEBUG;				//是否启用smtp的debug进行调试
			$mail->IsSMTP();
			$mail->CharSet    = MAIL_CHARSET; 			//设置邮件的字符编码，这很重要，不然中文乱码
			$mail->SMTPAuth   = SMTP_AUTH;              //开启认证
			$mail->Port       = SMTP_PORT;              //设置ssl连接smtp服务器的远程服务器端口号    
			$mail->Host       = MAIL_HOST; 				//链接qq域名邮箱的服务器地址
			$mail->Username   = SMTP_USERNAME;    		//smtp登录的账号
			$mail->Password   = SMTP_PASSWORD;        	//smtp登录的密码    
			//$mail->IsSendmail(); //如果没有sendmail组件就注释掉，否则出现“Could  not execute: /var/qmail/bin/sendmail ”的错误提示
			//$mail->AddReplyTo("phpddt1990@163.com","mckee");//回复地址
			$mail->From       = MAIL_FROM;				 //设置发件人邮箱地址 这里填入上述提到的“发件人邮箱”
			$mail->FromName   = MAIL_FROMNAME;			 //设置发件人姓名（昵称） 任意内容，显示在收件人邮件的发件人邮箱地址前的发件人姓名
			
			$mail->AddAddress($to);
			$mail->Subject  = $title;
			$mail->Body = $content;
			$mail->WordWrap   = 80; // 设置每行字符串的长度
			//$mail->AddAttachment("f:/test.png");  //可以添加附件
			$mail->IsHTML(true); 
			$status  = $mail->Send();
			if($status) {
                 return true;
             }else{
                 return false;
            }
			
		} catch (phpmailerException $e) {
			//echo "邮件发送失败：".$e->errorMessage();
			$arr = array('res' =>0, 'data' => 'fail');
			die(JSON($arr));
		}
    }
?>