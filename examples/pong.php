<?php
use React\EventLoop\Factory;
use React\EventLoop\LoopInterface;
use Rx\Scheduler\EventLoopScheduler;
use Rxnet\Event\Event;
use Rxnet\Zmq\RxZmq;
use Rxnet\Zmq\SocketWrapper;

require __DIR__ . "/../vendor/autoload.php";

$loop = Factory::create();
$serializer = new \Rxnet\Zmq\Serializer\MsgPack();
$zmq = new \Rxnet\Zmq\ZeroMQ($loop, $serializer);

$router = $zmq->router('tcp://127.0.0.1:2000');

$router->subscribeCallback(function ($msg) use ($router) {
    var_dump($msg);

});
$loop->run();