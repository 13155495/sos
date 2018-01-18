<?php
		
   
   require_once "config/config.php";  
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
     * [checkByid 通过id来检测用户]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
      public function checkByid($id){
      
          $sql = "SELECT id FROM user WHERE id ='$id'";
        
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
       * [checkRelashionById 通过用户id和朋友id检测记录是否存在]
       * @param  [type] $id        [description]
       * @param  [type] $friend_id [description]
       * @return [type]            [description]
       */
      public function checkRelashionById($id,$friend_id){
         //2 发起邀请
         $sql = "SELECT user_id,friend_id,status FROM friend WHERE user_id ='$id' AND friend_id='$friend_id'";
      
         //创建一个SqlHelper对象
         $sqlHelper = new SqlHelper();
         $arr = $sqlHelper->execute_dql($sql);
         return $arr[0];
      }

      /**
       * [updateRelashionById 通过ID更新好友记录状态]
       * @param  [type] $id        [description]
       * @param  [type] $friend_id [description]
       * @param  [type] $status    [description]
       * @return [type]            [description]
       */
      public function updateRelashionById($id,$friend_id,$status)
      {
        
         //数据库操作实例化
         $sqlHelper = new SqlHelper();

         //////邀请记录--存在更新状态
         $invite_sql    = "UPDATE friend SET status='$status' WHERE user_id='$id' AND friend_id='$friend_id'";
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
   	public function getFriendInfo($id,$status){
         //var_dump($status);
   	   if(empty($status))
       {
          $sql = "SELECT user.id,user.name,user.email,user.tel,user.avatar FROM friend,user WHERE  user.id=friend.friend_id AND STATUS=1 AND   friend.user_id='$id'";
       }
       else
       {
           $sql = "SELECT user.id,user.name,user.email,user.tel,user.avatar FROM friend,user WHERE  user.id=friend.friend_id AND STATUS='$status' AND   friend.user_id='$id' ";
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
      public function getUserInfoByEmail($email){
         
         $sql = "SELECT id,reg_id,name,email,tel,avatar FROM user WHERE email ='$email'";
      
         //创建一个SqlHelper对象
         $sqlHelper = new SqlHelper();
         $arr = $sqlHelper->execute_dql($sql);
         return $arr;

      }
     /**
      * [getUserInfoByTel 通过电话获取用户信息]
      * @param  [type] $tel [description]
      * @return [type]      [description]
      */
      public function getUserInfoByTel($tel){
         
         $sql = "SELECT id,reg_id,name,email,tel,avatar FROM user WHERE tel ='$tel'";
      
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
         user_id,
         friend_id,
         status,create_time) VALUES 
        ('".$user_info['id']."','".$friend_info['id']."','".$invite_status."','".$create_time."')";
         //
        

         $beinvite_sql = "INSERT INTO friend (
         user_id,
         friend_id,
         status,create_time) VALUES 
         ('".$friend_info['id']."','".$user_info['id']."','".$beinvite_status."','".$create_time."')";
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
