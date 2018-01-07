<?php
		
    require "config/config.php";
    
   class  Upload{
      /**
       * [uploadImage 上传图片的接口]
       * @param  integer $override [1为覆盖图片 0为不覆盖图片]
       * @return [type]            [description]
       */
      public function uploadImage($override=0){
     
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
                //echo "Upload: " . $_FILES["file"]["name"] . "<br />";
                //echo "Type: " . $_FILES["file"]["type"] . "<br />";
                //echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
                //echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";
                //上传图片直接覆盖
                if($override == 1)
                {

                  move_uploaded_file($_FILES["file"]["tmp_name"],$path . $_FILES["file"]["name"]);
                  $data = UPLOAD_URI.$path.$_FILES["file"]["name"];
                  return array('res'=>1, 'data'=>$data,'message'=>'sucess');
                
                }
                else{
                  if (file_exists($path . $_FILES["file"]["name"]))
                  {      
                    $data = UPLOAD_URI.$path.$_FILES["file"]["name"];
                    return array('res'=>0,'data'=>$data,'message'=>$_FILES["file"]["name"] .' already exists');
                  }
                  else
                  {
                     move_uploaded_file($_FILES["file"]["tmp_name"],$path . $_FILES["file"]["name"]);
                    //echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
                    $data = UPLOAD_URI.$path.$_FILES["file"]["name"];
                    return array('res'=>1, 'data'=>$data,'message'=>'sucess');
                  }
                
                }
                
               
              }
            }
            else
            {
              //echo "Invalid file";
              return array('res'=>1, 'data'=>'','message'=>'invalid file');
            }
            
    }
         		
   	
   }
   
   
?>