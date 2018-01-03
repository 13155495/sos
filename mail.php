
<?php
	
    
    
	header("content-type:text/html;charset=utf-8");
	//ini_set("magic_quotes_runtime",0);
	
	require_once("phpmailer/class.phpmailer.php"); 
    require_once("phpmailer/class.smtp.php");
	try {
		$mail 				= new PHPMailer(true); 
		$mail->SMTPDebug 	= true;
		$mail->IsSMTP();
		$mail->CharSet    	='UTF-8'; //设置邮件的字符编码，这很重要，不然中文乱码
		$mail->SMTPAuth   	= true;                  //开启认证
		$mail->Port       	= 465;                    
		$mail->Host       	= "smtp.lezhongyou.net"; 
		$mail->Username   	= "zhuxiangwei@lezhongyou.net";    
		$mail->Password   	= "~Zwwcdin980139";            
		//$mail->IsSendmail(); //如果没有sendmail组件就注释掉，否则出现“Could  not execute: /var/qmail/bin/sendmail ”的错误提示
		//$mail->AddReplyTo("phpddt1990@163.com","mckee");//回复地址
		$mail->From       	= "zhuxiangwei@lezhongyou.net";
		$mail->FromName   	= "zhuxiangwei";
		$to 				= "13155495@qq.com";
		$mail->AddAddress($to);
		$mail->Subject  	= "phpmailer测试标题";
		$mail->Body 		= "<h1>phpmail演示</h1>这是php点点通（<font color=red>www.phpddt.com</font>）对phpmailer的测试内容";
		$mail->AltBody    	= "To view the message, please use an HTML compatible email viewer!"; //当邮件不支持html时备用显示，可以省略
		$mail->WordWrap   	= 80; // 设置每行字符串的长度
		//$mail->AddAttachment("f:/test.png");  //可以添加附件
		$mail->IsHTML(true); 
		$mail->SMTPSecure 	= 'ssl';
		$mail->Send();
		echo '邮件已发送';
	} catch (phpmailerException $e) {
		echo "邮件发送失败：".$e->errorMessage();
	}
	
?>
