<?php
		
   
   require_once "config/config.php";  
   class  Modifyuser{
      
   	//提供一个验证用户是否存在的方法
   	public function check($id){
   		
   		
   		$sql = "SELECT email,pwd,name FROM user WHERE id='$id'";
   		
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
   		
   		
   	
   	public function modify($tel,$email,$name,$id){

   		
   		
         $sql = "UPDATE user SET tel='$tel',email='$email',name='$name' WHERE id='$id'";
   		
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
