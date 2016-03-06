<?php

use \Workerman\Worker;

$websocket_worker = new Worker('Websocket://0.0.0.0:3001');
$websocket_worker->onConnect = function($connection){
    CustomLogger::getLogger()->info("WebSocket A client conenct");
};
