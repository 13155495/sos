<?php
date_default_timezone_set('Asia/Shanghai'); 
$target = @$_REQUEST['target'] ? $_REQUEST['target'] : 'all';
$msg = @$_REQUEST['msg'] ? $_REQUEST['msg'] : '';
$result = @$_REQUEST['result'] ? $_REQUEST['result'] : '';
require 'conf.php';
try {
    $response = $client->push()
        ->setPlatform(array('ios'))
        ->addAllAudience($target)
        //->setAudience($target)
        //->addRegistrationId($target)
        ->iosNotification($msg , array(
             //'sound' => 'default',
             'badge' => '0',
             'content-available' => true,
        //     'mutable-content' => true,
                'extras' => array(
                'result' => $result,
                ),
        ))
        ->options(array(
            'apns_production' => true,
        ))
        ->send();
                                $fh = fopen('./10fen.log', "a+");
                                fwrite($fh, '-------------------------------------------\n'."\n"); 
                                fwrite($fh, $target); 
                                fwrite($fh, "\n"); 
                                fwrite($fh, date('Y-m-d H:i')); 
                                fwrite($fh, "\n"); 
                                fwrite($fh, json_encode($response)); 
                                fwrite($fh, "\n"); 
                                fclose($fh);
//print_r($response);

} catch (\JPush\Exceptions\APIConnectionException $e) {
    print $e;
} catch (\JPush\Exceptions\APIRequestException $e) {
    print $e;
}
