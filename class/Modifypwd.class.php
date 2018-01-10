<?php
		
   
   require "config/config.php";  
   class  Modifypwd{
      
   	//提供一个验证用户是否存在的方法
   	public function check($tel,$email){
   		if(empty($email))
   		{
   			$sql = "SELECT tel,pwd FROM user WHERE tel ='$tel' ";
   		}
   		if(empty($tel))
   		{
   			$sql = "SELECT email,pwd FROM user WHERE email ='$email'";
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
   		
   		
   	
   	public function modify($tel,$email,$newpwd){

   		if(empty($email))
         {
            $sql = "UPDATE user SET pwd='$newpwd' WHERE tel='$tel'";
         }
         if(empty($tel))
         {
            $sql = "UPDATE user SET pwd='$newpwd' WHERE email='$email'";
         }
   		
         $sqlHelper = new SqlHelper();
         $res = $sqlHelper->execute_dml($sql);
         //echo $res ;
         if($res == 1 || $res == 2){
            return true;
         }else{
            return false;
         }
   	}
	}
   
?>
