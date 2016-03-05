<?php

use \Workerman\Worker;

$websocket_worker = new Worker('Websocket://0.0.0.0:3001');
$ws->onConnect = function($connection){

};
