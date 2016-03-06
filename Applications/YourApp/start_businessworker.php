<?php 
/**
 * This file is part of workerman.
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the MIT-LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @author walkor<walkor@workerman.net>
 * @copyright walkor<walkor@workerman.net>
 * @link http://www.workerman.net/
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 */
use \Workerman\Worker;
use \Workerman\WebServer;
use \GatewayWorker\Gateway;
use \GatewayWorker\BusinessWorker;
use \Workerman\Autoloader;

// 自动加载类
require_once __DIR__ . '/../../Workerman/Autoloader.php';
require_once __DIR__ . '/../../Channel/src/Client.php';

Autoloader::setRootPath(__DIR__);


// bussinessWorker 进程
$worker = new BusinessWorker();
// worker名称
$worker->name = 'YourAppBusinessWorker';
// bussinessWorker进程数量
$worker->count = 4;

$worker->onWorkerStart = function(){
    Channel\Client::connect();
    // 订阅broadcast事件，并注册事件回调
    Channel\Client::on('user_login', function($event_data)use($worker){
        // 向所当前worker进程的所有客户端广播消息
        foreach($worker->connections as $connection)
        {
            $connection->send($event_data);
        }
    });
};

// 如果不是在根目录启动，则运行runAll方法
if(!defined('GLOBAL_START'))
{
    Worker::runAll();
}

