<?php

use React\Http\HttpServer;
use React\Socket\SocketServer;

$loop = \React\EventLoop\Loop::get();
$pool = new ConnectionsPool();
$socket = new SocketServer('127.0.0.1:8080');

$posts = [];

$conn = null;

$socket->on('connection', function (React\Socket\ConnectionInterface $connection) use ($pool, $conn) {
    $conn = $connection;
    $pool->add($connection);
});

$server = new HttpServer(function (\Psr\Http\Message\ServerRequestInterface $request) use ($conn, $pool) {
    $path = $request->getUri()->getPath();
     if ($path === '/chat/message') {
         $posts = $request->getParsedBody();

         $pool->sendMessage($conn, $posts['message']);
     }


});

$server->listen($socket);
