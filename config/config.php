<?php

	
	define('DB_HOST'			,'localhost');
	define('DB_USER'			,'root');
	define('DB_PW'				,'123456');
	define('DB_NAME'			,'sos');
	define('DEBUG'				, FALSE);
	///////////////////////////////系统文件定义////////////////////////////////////////
	define("BASE_PATH"			,		dirname(__FILE__));						//	程序根目录
	define("CLASS_PATH"			,		dirname(BASE_PATH) . "/class");		//	业务类目录
	define("PUBLIC_PATH"		,		dirname(BASE_PATH) . "/public");		//	PUBLIC配置文件路径
	define("CONF_PATH"			,		dirname(BASE_PATH) . "/config");		//	配置目录
	define("LOG_PATH"			,		dirname(BASE_PATH) . "/log");			//	log目录
	/////////////////////////////引入各种工具/////////////////////////////////////////
	
	require PUBLIC_PATH 		.'/function.php';				//	引入函数工具
	require PUBLIC_PATH 		.'/klogger_util.php';			//	引入LOG工具
	require PUBLIC_PATH 		.'/sql_helper.class.php';				//	引入sql数据库工具
	///////////////////////////////邮件相关////////////////////////////////////////
	define("SMTP_DEBUG"			,		0); 					//是否启用smtp的debug进行调试 开发环境建议开启 
	define("SMTP_AUTH"			,		true);					//smtp需要鉴权 这个必须是true
	define("SMTP_USERNAME"		,		'zhuxiangwei@lezhongyou.net');	//smtp登录的账号
	define("SMTP_PASSWORD"		,		'~Zwwcdin980139');					//smtp登录的密码
	define("SMTP_PORT"			,		465);					//设置连接smtp服务器的远程服务器端口号
	define("MAIL_HOST"			,		"smtp.lezhongyou.net");		//链接qq域名或者163邮箱的服务器地址
	define("MAIL_CHARSET"		,		'UTF-8'); 				//设置发送的邮件的编码
	define("MAIL_FROM"			,		'zhuxiangwei@lezhongyou.net'); 	//设置发件人邮箱地址
	define("MAIL_FROMNAME"		,		'SOS验证码'); 			//设置发件人姓名,显示在收件人邮件的发件人邮箱地址前的发件人姓名
	
	/////////////////////////////设置服务器时区//////////////////////////////////////
	define("VERIFY_CODE_EXPIRE_TIME"		,		30);//单位为分
	date_default_timezone_set("Asia/Shanghai");
	/////////////////////////////上传图片相关////////////////////////////////////////
	define("UPLOAD_PATH"		,		    'upload/avatar/');		 	//图片上传目录
	define("UPLOAD_DOMAIN"			,		'http://lezhongyou.net/sos/');	//图片上传uri
	define("UPLOAD_SIZE"		,		2*1024*1024);				//2M大小图片限制
	///////////////////////////////各种业务日志开关标识////////////////////////////////////////
	define('LOG_SDK_LEVEL'		,			KLoggerUtil::DEBUG);	//	sdk日志等级
	define('LOG_API_LEVEL'		,			KLoggerUtil::DEBUG);	//	API日志等级
	define('LOG_SERVICE_LEVEL'	,			KLoggerUtil::DEBUG);	//	service日志等级
	define('LOG_DB_LEVEL'		,			KLoggerUtil::OFF);	//	db日志等级
	define('LOG_PAYBACK_API_LEVEL',			KLoggerUtil::DEBUG);	//	payBackApi日志等级
	/////////////////////////////设置HTTP头//////////////////////////////////////////
	//header('Content-type: application/json; charset=utf-8');
	header("content-type:text/html;charset=utf-8");
	/*
	 * PHP警告提示等级
	*/
	if (DEBUG)
	{
		error_reporting(E_ALL);/*7*/
	}
	else
	{
		error_reporting(0);
	}
?>
