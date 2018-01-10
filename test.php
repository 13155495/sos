<?php  
//header('Content-type:text/html; charset=utf-8');
function curl_post($url,$post_array){

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible;)");
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_array); 
    $response = curl_exec($ch);
    curl_close($ch);
    
    return $response;

}
$url="http://lezhongyou.net/sos/upload.php";

$post_array=array(
    "file"=>"@D:/1.jpg;type=image/jpeg", //这里要注意@符串
);

$list=curl_post($url,$post_array);


print_r($list);






?>