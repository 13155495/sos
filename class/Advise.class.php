<?php
		
   
   require_once "config/config.php";
   class  Advise{

   	    
        
        public function checkId($id){
           
            $sql = "SELECT id,email,pwd FROM user WHERE id='$id'";
            
            //创建一个SqlHelper对象
            $sqlHelper = new SqlHelper();
            $arr = $sqlHelper->execute_dql($sql);
            
            //资源关闭
            mysql_free_result($arr);
            //关闭连接
            $sqlHelper->close_connect();
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
          * [addContent 添加建议]
          * @param [type] $id      [description]
          * @param [type] $content [description]
          */
        public function addContent($id,$content)
        {
            $create_time = date('Y-m-d H:i:s',time());

            $sql = "INSERT INTO advise (user_id,content,create_time) VALUES ('".$id."','".$content."','".$create_time."')";
            //var_dump($sql);
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
