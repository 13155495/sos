<?php
require __DIR__ . '/../autoload.php';

use JPush\Client as JPush;

$app_key = 'b4994b8b05f01788d0d4a014';
$master_secret = '66cdc69c90461d08cb6f1edb';
$registration_id = getenv('registration_id');

$client = new JPush($app_key, $master_secret);
