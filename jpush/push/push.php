<?php
$target = @$_REQUEST['target'] ? $_REQUEST['target'] : 'all';
$msg = @$_REQUEST['msg'] ? $_REQUEST['msg'] : '';
$result = @$_REQUEST['result'] ? $_REQUEST['result'] : '';
require 'conf.php';
try {
    $response = $client->push()
        ->setPlatform(array('ios'))
	//->addAllAudience($target)
	//->setAudience($target)
	->addRegistrationId($target)
        ->iosNotification($msg , array(
             'sound' => 'default',
             'badge' => '+1',
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
	$fh = fopen('./test.log', "a+");
				fwrite($fh, '-------------------------------------------\n'."\n"); 
				fwrite($fh, $target); 
				fwrite($fh, "\n"); 
				fwrite($fh, $msg); 
				fwrite($fh, "\n"); 
				fwrite($fh, json_encode($response)); 
				fwrite($fh, "\n"); 
				fclose($fh);
//print_r($response);
print json_encode($response);


} catch (\JPush\Exceptions\APIConnectionException $e) {
    print $e;
	$fh = fopen('./test.log', "a+");
				fwrite($fh, '---------error1---------------------------------\n'."\n"); 
				fwrite($fh, $e); 
				fclose($fh);
} catch (\JPush\Exceptions\APIRequestException $e) {
    print $e;
	$fh = fopen('./test.log', "a+");
				fwrite($fh, '---------------errorw2----------------------------\n'."\n"); 
				fwrite($fh, $e); 
				fclose($fh);
}

