<?php
		
    require_once "config/config.php";
    
   class  Register{

    /**
     * [checkTel 电话号码检测]
     * @param  [type] $tel [description]
     * @return [type]      [description]
     */
   	public function checkTel($tel){
     
   		$sql = "SELECT tel,pwd FROM user WHERE tel ='$tel'";;
   		//创建一个SqlHelper对象
   		$sqlHelper = new SqlHelper();
   		$arr = $sqlHelper->execute_dql($sql);
      if(!empty($arr))
      {
        return 1;
      }
      else{
        return 0;
      }
     	
   	}
   	/**
     * [邮箱检测]
     * @param  [type] $email [description]
     * @return [type]        [description]
     */
    public function checkEmail($email){
     
      $sql = "SELECT email,pwd FROM user WHERE email ='$email'";;
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
     * [addRegister 注册新用户]
     * @param [type] $tel     [description]
     * @param [type] $email   [description]
     * @param [type] $pwd     [description]
     * @param [type] $country [description]
     * @param [type] $name    [description]
     * @param [type] $reg_id  [description]
     */
 		public function addRegister($tel,$email,$pwd,$country,$name,$reg_id){
      $create_time = date('Y-m-d H:i:s',time());

        $sql = "INSERT INTO user (reg_id,name,email,tel,pwd,country,create_time) VALUES ('".$reg_id."','".$name."','".$email."','".$tel."','".$pwd."','".$country."','".$create_time."')";
      
 			

 			$sqlHelper = new SqlHelper();
 			$res = $sqlHelper->execute_dml($sql);
 			if($res == 1){
 				return true;
 			}else{
 				return false;
 			}
 		}
   		
   	
   }
   
   
?>