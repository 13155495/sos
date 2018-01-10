<?php
   require "config/config.php";
   class  Upload{

      public $logObj;
      public function __construct(){
        $this->logObj = KLoggerUtil::instance(LOG_PATH . "/upload",LOG_SDK_LEVEL);
      } 

      /**
       * [uploadImage 上传图片的接口]
       * @param  integer $override [1为覆盖图片 0为不覆盖图片]
       * @return [type]            [description]
       *
       * 修改php.ini
        upload_tmp_dir = "/var/www/tmp"
        upload_max_filesize = 4M
        max_file_uploads = 20
        file_uploads = On
        改上传图片路径权限 
        chmod -R 777 upload
       */
      public function uploadImage($override=0){
          
          
          $this->logObj->logDebug("请求信息:"."type=".$_FILES["file"]["type"].",name=".$_FILES["file"]["name"].",tmp_name=".$_FILES["file"]["tmp_name"]);
          //var_dump($_FILES);return;
          if ((($_FILES["file"]["type"] == "image/gif")
          || ($_FILES["file"]["type"]   == "image/jpeg")
          || ($_FILES["file"]["type"]   == "image/png")
          || ($_FILES["file"]["type"]   == "image/pjpeg"))
          && ($_FILES["file"]["size"]   <   UPLOAD_SIZE))//2m=2*1024*1024
          {

              
              
              $data = '';
              if ($_FILES["file"]["error"] > 0)
              {

                return array('res'=>0, 'data'=>'','message'=>'Return Code:' . $_FILES["file"]["error"]);
              }
              else
              {
                //上传文件路径建立
                $path  = UPLOAD_PATH.date('ymd',time()).'/';

                if(!is_dir($path))
                {
                    if(!mkdir($path, 0755, true))
                    {
                        return array('res'=>0, 'data'=>'','message'=>'create dir fail');
                    }
                }
                //加个sos/给客户端
                $path = "sos/".$path;
                //echo "Upload: " . $_FILES["file"]["name"] . "<br />";
                //echo "Type: " . $_FILES["file"]["type"] . "<br />";
                //echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
                //echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";
                //上传图片直接覆盖
                if($override == 1)
                {

                  move_uploaded_file($_FILES["file"]["tmp_name"],$path . $_FILES["file"]["name"]);
                  $data =  $path.$_FILES["file"]["name"];
                  return array('res'=>1, 'data'=>$data,'message'=>'sucess');
                
                }
                else{
                  if (file_exists($path . $_FILES["file"]["name"]))
                  {      
                    $data = $path.$_FILES["file"]["name"];
                    return array('res'=>0,'data'=>$data,'message'=>$_FILES["file"]["name"] .' already exists');
                  }
                  else
                  {
                     move_uploaded_file($_FILES["file"]["tmp_name"],$path . $_FILES["file"]["name"]);
                    //echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
                    $data = $path.$_FILES["file"]["name"];
                    return array('res'=>1, 'data'=>$data,'message'=>'sucess');
                  }
                
                }
                
               
              }
            }
            else
            {
              //echo "Invalid file";
              return array('res'=>0, 'data'=>'','message'=>'invalid file');
            }
            
          
            
    }
            
    
   }
   
   
?>