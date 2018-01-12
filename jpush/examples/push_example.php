<?php
// 这只是使用样例,不应该直接用于实际生产环境中 !!

require 'conf.php';

// 简单推送示例
// 这只是使用样例,不应该直接用于实际生产环境中 !!

$push_payload = $client->push()
    ->setPlatform('all')
    ->addAllAudience()
    ->setNotificationAlert('Hi, JPush');
try {
    $response = $push_payload->send();
}catch (\JPush\Exceptions\APIConnectionException $e) {
    // try something here
    print $e;
} catch (\JPush\Exceptions\APIRequestException $e) {
    // try something here
    print $e;
}
print_r($response);

