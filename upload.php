<?php

/*
图片上传接口

  php.ini
  upload_tmp_dir = "/var/www/tmp"
  upload_max_filesize = 4M
  max_file_uploads = 20
  file_uploads = On
*/

require_once 'class/Upload.class.php';


$upload = new Upload();

$res = $upload->uploadImage(1);
die(JSON($res));

?>



