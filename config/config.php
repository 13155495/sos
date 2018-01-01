
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
	
	/////////////////////////////引入各种工具/////////////////////////////////////////
	
	require PUBLIC_PATH 		.'/function.php';				//	引入函数工具
	require PUBLIC_PATH 		.'/klogger_util.php';			//	引入LOG工具
	require PUBLIC_PATH 		.'/sql_helper.class.php';				//	引入sql数据库工具
	///////////////////////////////返回值响应码////////////////////////////////////////
	
	/////////////////////////////设置服务器时区//////////////////////////////////////
	date_default_timezone_set("Asia/Shanghai");
	/////////////////////////////设置HTTP头//////////////////////////////////////////
	//header('Content-type: application/json; charset=utf-8');
	header('Content-Type: text/html; charset=utf-8');
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
