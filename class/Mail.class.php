<?php
		
   
   require "config/config.php";
   class  Mail{

   	    
        /**
        * [邮箱检测]
        * @param  [type] $email [description]
        * @return [type]        [description]
        */
        public function checkEmail($email){
           
            $sql = "SELECT id,email,pwd FROM user WHERE email='$email'";
            
            //创建一个SqlHelper对象
            $sqlHelper = new SqlHelper();
            $arr = $sqlHelper->execute_dql($sql);
            
            //资源关闭
            mysql_free_result($arr);
            //关闭连接
            $sqlHelper->close_connect();
            return $arr;
        }

        /**
         * [send_mail 发送邮件]
         * @param  [type] $to      [发送邮件地址]
         * @param  [type] $title   [邮件标题]
         * @param  [type] $content [邮件内容]
         * @return [type]          [邮件发送返回状态 true-成功 false-失败]
         */
        public function sendMail($to,$title,$content)
        {
            require_once("phpmailer/class.phpmailer.php"); 
            require_once("phpmailer/class.smtp.php");
            try {
                    $mail = new PHPMailer(true); 
                    $mail->SMTPDebug  = SMTP_DEBUG;             //是否启用smtp的debug进行调试
                    $mail->IsSMTP();
                    $mail->CharSet    = MAIL_CHARSET;           //设置邮件的字符编码，这很重要，不然中文乱码
                    $mail->SMTPAuth   = SMTP_AUTH;              //开启认证
                    $mail->Port       = SMTP_PORT;              //设置ssl连接smtp服务器的远程服务器端口号    
                    $mail->Host       = MAIL_HOST;              //链接qq域名邮箱的服务器地址
                    $mail->Username   = SMTP_USERNAME;          //smtp登录的账号
                    $mail->Password   = SMTP_PASSWORD;          //smtp登录的密码    
                    //$mail->IsSendmail(); //如果没有sendmail组件就注释掉，否则出现“Could  not execute: /var/qmail/bin/sendmail ”的错误提示
                    //$mail->AddReplyTo("phpddt1990@163.com","mckee");//回复地址
                    $mail->From       = MAIL_FROM;               //设置发件人邮箱地址 这里填入上述提到的“发件人邮箱”
                    $mail->FromName   = MAIL_FROMNAME;           //设置发件人姓名（昵称） 
                    $mail->SMTPSecure = 'ssl';
                    $mail->AddAddress($to);
                    $mail->Subject  = $title;
                    $mail->Body = $content;
                    $mail->WordWrap   = 80; // 设置每行字符串的长度
                    //$mail->AddAttachment("f:/test.png");  //可以添加附件
                    $mail->IsHTML(true); 
                    $status  = $mail->Send();
                    //echo $status;
                    if($status) {
                         return true;
                     }else{
                         return false;
                }
            } catch (phpmailerException $e) {
                    //echo "邮件发送失败：".$e->errorMessage();
                    $arr = array('res' =>0, 'data' => 'send mail error');
                    die(JSON($arr));
            }
        }
        /**
         * [generateVerifiyCode 生成验证码]
         * @param  [type] $user_id [description]
         * @param  [type] $email   [description]
         * @return [type]          [description]
         */
        public function generateVerifiyCode($user_id,$email){

            //检测verify_code表中是否已经存在记录,存在就判断时间是否过期,没有过期就查表返回验证码
            //过期就更新,不存在记录就插入，保证唯一性
            $sql = "SELECT code,user_id,email,deadline FROM veriry_code WHERE user_id ='$user_id'";;
            //创建一个SqlHelper对象
            $sqlHelper = new SqlHelper();
            $arr = $sqlHelper->execute_dql($sql);
            //var_dump($arr[0]['code']) ;return;
            //存在记录
            if(!empty($arr)){
                
                //当前时间
                $cur_time       = date('Y-m-d H:i:s',time());
                $deadline       = $arr[0]['deadline'];
                $verify_code    = $arr[0]['code'];
                //过期时间
                $new_deadline   = date('Y-m-d H:i:s',time() + 60*VERIFY_CODE_EXPIRE_TIME);
                //计算验证码是否过期               
                $minute         = floor((strtotime($deadline) - strtotime($cur_time))%86400/60);
               
                //验证码过期->使用参数的验证码
                if($minute <= 0 )
                {
                    
                    $verify_code = getRandNameStr(6);//生成验证码
                    //更新记录,验证码更新
                    $sql = "UPDATE veriry_code SET code='$verify_code',deadline='$new_deadline' WHERE user_id='$user_id'";
                    //echo $sql;
                    $sqlHelper = new SqlHelper();
                    $res = $sqlHelper->execute_dml($sql);
                    //echo $res;return;
                    return $verify_code;
                }
                else
                {

                    return $verify_code;
                }
            }
            
            //第一次验证
            $code =  getRandNameStr(6);
            $deadline       = date('Y-m-d H:i:s',time() + 60*VERIFY_CODE_EXPIRE_TIME);//1800秒,半小时
            
            //echo $create_time."|".$deadline;die();
            $sql = "INSERT INTO veriry_code (code,user_id,email,deadline) VALUES ('".$code."','".$user_id."','".$email."','".$deadline."')";

            $sqlHelper = new SqlHelper();
            $sqlHelper->execute_dml($sql);
            return $code;
            
        }
   }


?>
