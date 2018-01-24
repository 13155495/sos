<?php
   require_once "config/config.php";
   
   use JPush\Client as JPush;
   class  Push{

      public $client;
      public function __construct(){
        //echo JPUSH_PATH       .'/autoload.php';return;
         
        // 初始化
        //var_dump(APP_KEY);var_dump(MASTER_SECRET);
        $this->client = new JPush(APP_KEY, MASTER_SECRET);
        //var_dump($this->client);return;
        $this->logObj  = KLoggerUtil::instance(LOG_PATH . "/push",LOG_SDK_LEVEL);
      } 

      //检测用户是否存在
      public function checkUser($id)
      {
          
          
          $sql = "SELECT tel FROM user WHERE id='$id'";
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
       * [getFriendOne 查询单个用户]
       * @param  [type] $to_id [description]
       * @return [type]        [description]
       */
      public function getFriendOne($to_id)
      {
          $sql = "SELECT reg_id FROM user WHERE id='$to_id'";

          //创建一个SqlHelper对象
          $sqlHelper = new SqlHelper();
          $arr = $sqlHelper->execute_dql($sql);
          $array_id[0] = $arr[0]['reg_id'];
          
          return $array_id;
      }
      /**
       * [getFriendList 查询所有的好友]
       * @param  [type] $from_id [description]
       * @return [type]          [description]
       */
      public function getFriendList($from_id)
      { 
          //echo "123";return;
          //SELECT friend.user_id,user.reg_id,friend.friend_id FROM USER ,friend WHERE    friend.user_id = '$from_id' AND friend.friend_id=user.id AND friend.status=1 
          $sql = "SELECT user.reg_id FROM user,friend WHERE friend.user_id = '$from_id' AND friend.friend_id=user.id AND friend.status=1";
          $array_id = array();
          //创建一个SqlHelper对象
          $sqlHelper = new SqlHelper();
          $arr = $sqlHelper->execute_dql($sql);
          //var_dump($arr);return;
          if(empty($arr))
          {
            return null;
          }
          else
          {
              foreach ($arr as $key => $value) {
                $array_id[$key] =  $value['reg_id'];
              }
          }
          //var_dump($array_id);
          return $array_id;
      }

      public function jgPush($registration_id,$msg){
          //var_dump($id);var_dump($msg);return;
          $this->logObj->logDebug("registration_id", $registration_id);
          $this->logObj->logDebug("msg:", $msg);
          try {
                $response = $this->client->push()
                    ->setPlatform(array('ios', 'android'))
                    //->addAllAudience($target)
                    //->setAudience($target)
                    ->addRegistrationId($registration_id)
                    /*
                    ->androidNotification('测试' , array(
                       'sound' => 'default',
                       'badge' => '+1',
                       'content-available' => true,
                        //'mutable-content' => true,
                        'extras' => array(
                        'result' => $msg,
                        ),
                    ))
                    ->iosNotification('测试' , array(
                       'sound' => 'default',
                       'badge' => '+1',
                       'content-available' => true,
                        //     'mutable-content' => true,
                        'extras' => array(
                        'result' => $msg,
                        ),
                          ))
                        ->options(array(
                                'apns_production' => true,
                        ))
                    */
                    ->setMessage($msg/*, 'msg title', 'type'*/)//自定义消息
                    ->send();
                $this->logObj->logDebug("push sucess", $response);
                //var_dump(json_encode($response)) ;
                return 1;

            } catch (\JPush\Exceptions\APIConnectionException $e) {
                $this->logObj->logDebug("push error", $e);
                //print $e;
                return 0;
            } catch (\JPush\Exceptions\APIRequestException $e) {

                $this->logObj->logDebug("push error", $e);
                return 0;
                //print $e;
            }
      }
            
    
   }
   
   
?>