<?php
		
   
   require "config/config.php";  
   class  Friend{

      public function __construct(){
            
      }
   	//提供一个验证用户是否存在的方法
   	public function check($email){
   		
   		$sql = "SELECT id FROM user WHERE email ='$email'";
   	
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
       * [checkRelashion 检测好友记录是否存在]
       * @param  [type] $email        [description]
       * @param  [type] $friend_email [description]
       * @return [type]               [description]
       */
      public function checkRelashion($email,$friend_email){
         //2 发起邀请
         $sql = "SELECT id,status FROM friend WHERE user_email ='$email' AND friend_email='$friend_email'";
      
         //创建一个SqlHelper对象
         $sqlHelper = new SqlHelper();
         $arr = $sqlHelper->execute_dql($sql);
         return $arr[0];
      }
      /**
       * [updateRelashion 更新好友记录状态]
       * @param  [type] $email        [description]
       * @param  [type] $friend_email [description]
       * @param  [type] $status       [description]
       * @return [type]               [description]
       */
   	  public function updateRelashion($email,$friend_email,$status)
      {
        
         //数据库操作实例化
         $sqlHelper = new SqlHelper();

         //////邀请记录--存在更新状态
         $invite_sql    = "UPDATE friend SET status='$status' WHERE user_email='$email' AND friend_email='$friend_email'";
         //echo $invite_sql;
         $res = $sqlHelper->execute_dml($invite_sql);
         //var_dump($res);
         if($res == 1 || $res == 2){
            return true;
         }else{
            return false;
         }
         
      }
   	/**
       * [getFriendInfo 获取好友信息]
       * @param  [type] $email  [description]
       * @param  [type] $status [description]
       * @return [type]         [description]
       */
   	public function getFriendInfo($email,$status){
         //var_dump($status);
   	   if(empty($status))
       {
          $sql = "SELECT friend_id,friend_name,friend_email,friend_tel,friend_avatar FROM friend WHERE user_email='$email' AND status=1";
       }
       else
       {
           $sql = "SELECT friend_id,friend_name,friend_email,friend_tel,friend_avatar FROM friend WHERE user_email='$email' AND status='$status'";
       }
        
   	   //echo $sql;return;
   		
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

      /**
       * [getUserInfo 获取用户信息]
       * @param  [type] $email [description]
       * @return [type]        [description]
       */
      public function getUserInfo($email){
         
         $sql = "SELECT id,name,email,tel,avatar FROM user WHERE email ='$email'";
      
         //创建一个SqlHelper对象
         $sqlHelper = new SqlHelper();
         $arr = $sqlHelper->execute_dql($sql);
         return $arr;

      }

      /**
       * [createRelashion 
       * 创建好友关系
       * 1:好友 2:发起邀请 3:受到邀请 4.拒绝
       * 向好友列表插入一条记录,用户是自己，状态为发起邀请
         向好友列表插入一条记录,用户是好友，状态为受到邀请
       * ]
       * @param  [type] $user_info   [description]
       * @param  [type] $friend_info [description]
       * @return [type]              [description]
       */
      public function createRelashion($user_info,$friend_info){

         //var_dump($user_info);
         $invite_status    = 2;
         $beinvite_status  = 3;
         $create_time   = date('Y-m-d H:i:s',time());
         
         //
         $invite_sql = "INSERT INTO friend (
         user_id,user_name,user_email,user_tel,
         friend_id,friend_name,friend_email,friend_tel,friend_avatar,
         status,create_time) VALUES 
         ('".$user_info['id']."','".$user_info['name']."','".$user_info['email']."','".$user_info['tel']."',
         '".$friend_info['id']."','".$friend_info['name']."','".$friend_info['email']."','".$friend_info['tel']."','".$friend_info['avatar']."',
         '".$invite_status."','".$create_time."')";
         //
        

         $beinvite_sql = "INSERT INTO friend (
         user_id,user_name,user_email,user_tel,
         friend_id,friend_name,friend_email,friend_tel,friend_avatar,
         status,create_time) VALUES 
         ('".$friend_info['id']."','".$friend_info['name']."','".$friend_info['email']."','".$friend_info['tel']."',
         '".$user_info['id']."','".$user_info['name']."','".$user_info['email']."','".$user_info['tel']."','".$user_info['avatar']."',
         '".$beinvite_status."','".$create_time."')";
         //echo $beinvite_sql;
         //var_dump($invite_sql);var_dump($beinvite_sql);return;
         $sqlHelper = new SqlHelper();
         
         $res1 = $sqlHelper->execute_dml($invite_sql);
         $res2 = $sqlHelper->execute_dml($beinvite_sql);
         //echo $res1;echo $res2;return;
         return $res1."|".$res2;

      }
      
	}
   
?>
