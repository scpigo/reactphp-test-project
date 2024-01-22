<?php

//$input = new \React\Stream\ReadableResourceStream(STDIN);
//$output = new \React\Stream\WritableResourceStream(STDOUT);
//
//$connector = new \React\Socket\Connector();
//
//$connector->connect('127.0.0.1:8080')
//    ->then(
//        function (\React\Socket\ConnectionInterface $connection) use ($input, $output) {
//            $input->pipe($connection);
//            $connection->pipe($output);
////            $connection->on('data', function ($data) use ($output) {
////                $output->write($data);
////            });
//        },
//        function (Exception $exception) {
//            echo $exception->getMessage();
//        }
//    );
