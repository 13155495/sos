<?php
		
   require "config/config.php";
    
   class  Login{

   	//提供一个验证用户是否存在的方法
   	public function checkLogin($tel,$email,$pwd){
   		if(empty($email))
   		{
   			$sql = "select tel,pwd from user where tel ='$tel' AND pwd='$pwd'";
   		}
   		if(empty($tel))
   		{
   			$sql = "select email,pwd from user where email ='$email' AND pwd='$pwd'";
   		}
   		//创建一个SqlHelper对象
   		$sqlHelper = new SqlHelper();
   		$res = $sqlHelper->execute_dql_a($sql);
     	if($row=mysql_fetch_assoc($res)){
   			
   			return 1;
     	}
   		else{
   			return 0;
   		}
   		
   		//资源关闭
   		mysql_free_result($res);
   		//关闭连接
   		$sqlHelper->close_connect();
   		return false;
   	}
   		
   		
   		     //最新标签
   	public function getUserInfo($tel){
   	      $sql = "select name,email,tel,pwd,country,create_time from user where tel='$tel'";  
   	      //$sql = "select * from label";
   	      // print $sql;
   	      
   	      $sqlHelper = new SqlHelper();
   	      $arr = $sqlHelper->execute_dql($sql);
   	      return $arr;
   	      
   	      //资源关闭
   	      mysql_free_result($arr);
   	      //关闭连接
   	      $sqlHelper->close_connect();
   	      return false;
   	    }
	}
   
?>
