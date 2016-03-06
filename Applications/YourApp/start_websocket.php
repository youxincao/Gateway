<?php

use \Workerman\Worker;

require_once __DIR__ . '/../../Channel/src/Client.php';

$ws_worker = new Worker('Websocket://0.0.0.0:3001');

$ws_worker->onWorkerStart = function() {
    Channel\Client::connect();
};

$ws_worker->onConnect = function($connection){
    CustomLogger::getLogger()->info("WebSocket A client conenct");
    CustomLogger::getLogger()->info($connection->id);

    $event_name = "user_login";
    $event_data = array('uid' => 123, 'uname' => 'tom');

    Channel\Client::publish($event_name, $event_data);
};
