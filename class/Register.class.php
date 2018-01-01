<?php
		
    require "config/config.php";
    
   class  Register{

    /**
     * [checkTel 电话号码检测]
     * @param  [type] $tel [description]
     * @return [type]      [description]
     */
   	public function checkTel($tel){
     
   		$sql = "select tel,pwd from user where tel ='$tel'";;
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
   	/**
     * [邮箱检测]
     * @param  [type] $email [description]
     * @return [type]        [description]
     */
    public function checkEmail($email){
     
      $sql = "select email,pwd from user where email ='$email'";;
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

 		/**
     * [addRegister 注册新用户]
     * @param [type] $tel     [description]
     * @param [type] $email   [description]
     * @param [type] $pwd     [description]
     * @param [type] $country [description]
     * @param [type] $name    [description]
     */
 		public function addRegister($tel,$email,$pwd,$country,$name){
      $create_time = date('Y-m-d H:i:s',time());
 			$sql = "INSERT INTO user (name,email,tel,pwd,country,create_time) VALUES ('".$name."','".$email."','".$tel."','".$pwd."','".$country."','".$create_time."')";

 			$sqlHelper = new SqlHelper();
 			$num = $sqlHelper->execute_dml($sql);
 			if($num == 1){
 				return 1;
 			}else{
 				return false;
 			}
 		}
   		
   	
   }
   
   
?>