<?php

error_reporting(E_ALL ^ E_DEPRECATED);
require('/app/vendor/autoload.php');

use PhpAmqpLib\Connection\AMQPStreamConnection;


include __DIR__ . '/config.php';
$consumerTag = 'consumer';

$connection = new AMQPStreamConnection($config['host'], 5672, $config['user'], $config['pass']);
$channel = $connection->channel();


$callback = function ($msg) {
    echo ' [x] Received ', $msg->body, "\n";
};

$channel->basic_consume($config['queue'], $consumerTag, false, true, false, false, $callback);

while ($channel->is_consuming()) {
    $channel->wait();
}

$channel->close();
$connection->close();
