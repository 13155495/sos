<?php
		
   
   require "config/config.php";  
   class  Login{
      public function __construct(){
            
      }
   	//提供一个验证用户是否存在的方法
   	public function checkLogin($tel,$email,$pwd){
   		if(empty($email))
   		{
   			$sql = "SELECT tel,pwd FROM user WHERE tel ='$tel' AND pwd='$pwd'";
   		}
   		if(empty($tel))
   		{
   			$sql = "SELECT email,pwd FROM user WHERE email ='$email' AND pwd='$pwd'";
   		}
   		//创建一个SqlHelper对象
   		$sqlHelper = new SqlHelper();
   		$arr = $sqlHelper->execute_dql($sql);
         if(!empty($arr))
         {
            return 1;
         }
         else
         {
            return 0;
         }

   	}
   		
   		
   	/**
   	 * [getUserInfo 获取用户信息]
   	 * @param  [type] $tel [description]
   	 * @return [type]      [description]
   	 */
   	public function getUserInfo($tel,$email){
   		if(empty($email))
   		{
   			 $sql = "SELECT id,name,email,tel,country FROM user WHERE tel='$tel'"; 
   		}
   	     if(empty($tel))
   		{
   			 $sql = "SELECT id,name,email,tel,country FROM user WHERE email='$email'"; 
   		}
   	      //$sql = "select * from label";
   	      // print $sql;
   	      
   	      $sqlHelper = new SqlHelper();
   	      $arr = $sqlHelper->execute_dql($sql);
            //资源关闭
            mysql_free_result($arr);
            //关闭连接
            $sqlHelper->close_connect();
   	      return $arr;

   	    }
	}
   
?>
